<?php

namespace CodingMs\Modules\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Thomas Deuling <typo3@coding.ms>, coding.ms
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Frontend user repository
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FrontendUserRepository extends Repository
{
    /**
     * @param string $username
     * @param string $disable
     * @return object
     */
    public function findByUsername($username, $disable = 'no')
    {
        $query = $this->createQuery();
        $constraints = [];
        $constraints[] = $query->equals('username', $username);
        if ($disable === 'no') {
            $constraints[] = $query->equals('disable', 0);
        } elseif ($disable === 'yes') {
            $query->getQuerySettings()->setIgnoreEnableFields(true);
            $constraints[] = $query->equals('disable', 1);
        } elseif ($disable === 'both') {
            $query->getQuerySettings()->setIgnoreEnableFields(true);
        }
        if (count($constraints) > 1) {
            $query->matching(
                $query->logicalAnd($constraints)
            );
        } else {
            $query->matching($constraints[0]);
        }
        return $query->execute()->getFirst();
    }

    /**
     * @param string $hash
     * @param string $disable
     * @return object
     */
    public function findByHash($hash, $disable = 'no')
    {
        $query = $this->createQuery();
        $constraints = [];
        $constraints[] = $query->equals('hash', $hash);
        if ($disable === 'no') {
            $constraints[] = $query->equals('disable', 0);
        } elseif ($disable === 'yes') {
            $query->getQuerySettings()->setIgnoreEnableFields(true);
            $constraints[] = $query->equals('disable', 1);
        } elseif ($disable === 'both') {
            $query->getQuerySettings()->setIgnoreEnableFields(true);
        }
        if (count($constraints) > 1) {
            $query->matching(
                $query->logicalAnd($constraints)
            );
        } else {
            $query->matching($constraints[0]);
        }
        return $query->execute()->getFirst();
    }

    /**
     * @param array $filter
     * @param bool $count
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface|int
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findAllForBackendList(array $filter = [], $count = false)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setRespectStoragePage(false);
        $constraints = [];
        if (isset($filter['searchWord']) && $filter['searchWord'] !== '') {
            $constraintsSearchWord = [];
            $constraintsSearchWord[] = $query->like('username', '%' . $filter['searchWord'] . '%');
            $constraintsSearchWord[] = $query->like('name', '%' . $filter['searchWord'] . '%');
            $constraintsSearchWord[] = $query->like('email', '%' . $filter['searchWord'] . '%');
            $constraints[] = $query->logicalOr($constraintsSearchWord);
        }
        //
        // Backend user can have a frontend user group selection/restriction
        $allowedGroups = $GLOBALS['BE_USER']->user['fe_groups'] ?? '';
        $allowedGroups = GeneralUtility::trimExplode(',', $allowedGroups, true);
        if (isset($filter['usergroup']['selected']) && (int)$filter['usergroup']['selected'] > 0) {
            $constraints[] = $query->contains('usergroup', $filter['usergroup']['selected']);
        } elseif (count($allowedGroups) > 0) {
            $constraintsUserGroup = [];
            foreach ($allowedGroups as $allowedGroup) {
                $constraintsUserGroup[] = $query->contains('usergroup', $allowedGroup);
            }
            $constraints[] = $query->logicalOr($constraintsUserGroup);
        }
        if (isset($filter['disabled']) && $filter['disabled']) {
            $constraints[] = $query->equals('disable', '1');
        } else {
            $constraints[] = $query->equals('disable', '0');
        }
        $constraints[] = $query->equals('pid', $filter['pid']);
        if (count($constraints) > 1) {
            $query->matching(
                $query->logicalAnd($constraints)
            );
        } else {
            $query->matching($constraints[0]);
        }
        if (!$count) {
            if (isset($filter['sortingField']) && $filter['sortingField'] != '') {
                if ($filter['sortingOrder'] == 'asc') {
                    $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_ASCENDING]);
                } else {
                    if ($filter['sortingOrder'] == 'desc') {
                        $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_DESCENDING]);
                    }
                }
            }
            if ((int)$filter['limit'] > 0) {
                $query->setOffset((int)$filter['offset']);
                $query->setLimit((int)$filter['limit']);
            }
            return $query->execute();
        }
        return $query->execute()->count();
    }
}
