<?php

namespace CodingMs\FluidForm\Service;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2020 Thomas Deuling <typo3@coding.ms>
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

use PDO;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Backend service
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class BackendService
{
    /**
     * @return array
     */
    public function getMailsPages()
    {
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('pages');
        $queryBuilder->select('uid', 'title')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq(
                    'module',
                    $queryBuilder->createNamedParameter('mails')
                )
            )
            ->orderBy('uid', 'ASC');
        $resource = $queryBuilder->execute();
        $pages = [];
        while ($page = $resource->fetch(PDO::FETCH_ASSOC)) {
            //
            // Check page access before collect the page
            $pageInformation = BackendUtility::readPageAccess($page['uid'], '');
            if (is_array($pageInformation)) {
                $pages[$page['uid']] = $pageInformation;
            }
        }
        return $pages;
    }
}
