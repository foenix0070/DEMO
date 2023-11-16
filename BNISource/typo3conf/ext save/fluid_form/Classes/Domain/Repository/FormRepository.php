<?php

namespace CodingMs\FluidForm\Domain\Repository;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use CodingMs\FluidForm\Domain\Model\Form;
use PDO;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Form repository
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FormRepository extends Repository
{
    /**
     * @return DataMapper
     */
    protected function getDataMapper(): DataMapper
    {
        /** @var DataMapper $dataMapper */
        $dataMapper = $this->objectManager->get(DataMapper::class);
        return $dataMapper;
    }

    /**
     * @param array $filter
     * @param false $count
     * @return array|int
     */
    public function findAllForBackendList(array $filter = [], $count = false)
    {
        //
        $dateFromTimestamp = strtotime($filter['dateFrom']);
        $dateToTimestamp = strtotime($filter['dateTo']) + (60 * 60 * 24);
        //
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_fluidform_domain_model_form');
        $queryBuilder->getRestrictions()->removeAll();
        if (!$count) {
            $queryBuilder->select('tx_fluidform_domain_model_form.*');
        } else {
            $queryBuilder->selectLiteral('COUNT(DISTINCT tx_fluidform_domain_model_form.uid)');
        }
        $queryBuilder->from('tx_fluidform_domain_model_form');
        $queryBuilder->join(
            'tx_fluidform_domain_model_form',
            'tx_fluidform_domain_model_field',
            'tx_fluidform_domain_model_field',
            $queryBuilder->expr()->eq(
                'tx_fluidform_domain_model_form.uid',
                $queryBuilder->quoteIdentifier('tx_fluidform_domain_model_field.fluidform')
            )
        );
        $queryBuilder->where(
            $queryBuilder->expr()->andX(
                $queryBuilder->expr()->eq(
                    'tx_fluidform_domain_model_form.form_key',
                    $queryBuilder->createNamedParameter($filter['form']['selected'], PDO::PARAM_STR)
                ),
                $queryBuilder->expr()->eq(
                    'tx_fluidform_domain_model_form.pid',
                    $queryBuilder->createNamedParameter((int)$filter['page']['selected'], PDO::PARAM_INT)
                ),
                $queryBuilder->expr()->eq(
                    'tx_fluidform_domain_model_form.hidden',
                    $queryBuilder->createNamedParameter(0, PDO::PARAM_INT)
                ),
                $queryBuilder->expr()->eq(
                    'tx_fluidform_domain_model_form.deleted',
                    $queryBuilder->createNamedParameter(0, PDO::PARAM_INT)
                ),
                $queryBuilder->expr()->gte(
                    'tx_fluidform_domain_model_form.crdate',
                    $queryBuilder->createNamedParameter($dateFromTimestamp, PDO::PARAM_INT)
                ),
                $queryBuilder->expr()->lte(
                    'tx_fluidform_domain_model_form.crdate',
                    $queryBuilder->createNamedParameter($dateToTimestamp, PDO::PARAM_INT)
                )
            )
        );
        //
        // Search in all field relations with contains name or mail
        if (isset($filter['searchWord']) && trim($filter['searchWord']) !== '') {
            $queryBuilder->andWhere(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->like(
                            'tx_fluidform_domain_model_field.field_key',
                            $queryBuilder->createNamedParameter('%name%', PDO::PARAM_STR)
                        ),
                        $queryBuilder->expr()->like(
                            'tx_fluidform_domain_model_field.field_key',
                            $queryBuilder->createNamedParameter('%mail%', PDO::PARAM_STR)
                        )
                    ),
                    $queryBuilder->expr()->like(
                        'tx_fluidform_domain_model_field.field_value',
                        $queryBuilder->createNamedParameter('%' . $filter['searchWord'] . '%', PDO::PARAM_STR)
                    )
                )
            );
        }
        if (!$count) {
            $queryBuilder->groupBy('tx_fluidform_domain_model_form.unique_id');
            if (isset($filter['sortingField']) && trim($filter['sortingField']) !== '') {
                $order = ($filter['sortingOrder'] === 'asc') ? 'ASC' : 'DESC';
                if ($filter['sortingField'] === 'creationDate') {
                    $queryBuilder->orderBy('tx_fluidform_domain_model_form.crdate', $order);
                } elseif ($filter['sortingField'] === 'formKey') {
                    $queryBuilder->orderBy('tx_fluidform_domain_model_form.form_key', $order);
                } else {
                    $queryBuilder->orderBy('tx_fluidform_domain_model_field.field_value', $order);
                }
            }
            if ((int)$filter['limit'] > 0) {
                $queryBuilder->setFirstResult((int)$filter['offset']);
                $queryBuilder->setMaxResults((int)$filter['limit']);
            }
            return $this->getDataMapper()->map(Form::class, $queryBuilder->execute()->fetchAll());
        }
        return (int)$queryBuilder->execute()->fetchColumn();
    }
}
