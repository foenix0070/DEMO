<?php

namespace CodingMs\Modules\Domain\DataTransferObject;

/***************************************************************
 *
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

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\BackendWorkspaceRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * DTO: Permission access Backend User Groups
 */
final class BackendUserGroupPermission extends AbstractPermission
{
    use PermissionTrait;

    /**
     * @var string
     */
    public const KEY = 'modules_backend_usergroup_action_permissions';

    protected function populateData(): void
    {
        $this->data = [
            'header' => 'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:backend_access_group_permissions',
            'items' => [],
        ];
        foreach ($this->getBackendGroupsForList() as $group) {
            $this->data['items'][$group['uid']] = [
                $group['title'],
                'EXT:my_user_management/Resources/Public/Icons/table-user-group-backend.svg',
                $group['description'],
            ];
        }
    }

    /**
     * @return array
     */
    protected function getBackendGroupsForList(): array
    {
        $queryBuilder = $this->getQueryBuilderForTable('be_groups');
        $query = $queryBuilder->select('uid', 'title', 'description')->from('be_groups');
        // Attention: Don't use fetchAllAssociative(), it's not available in older versions of Doctrine DBAL
        return $query->execute()->fetchAll();
    }

    /**
     * Get QueryBuilder without any default restrictions
     *
     * @param  string  $table
     * @return QueryBuilder
     */
    protected function getQueryBuilderForTable(string $table): QueryBuilder
    {
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable($table);
        // Show all records except versioning placeholders
        /** @var DeletedRestriction $deletedRestriction */
        $deletedRestriction = GeneralUtility::makeInstance(DeletedRestriction::class);
        /** @var BackendWorkspaceRestriction $backendWorkspaceRestriction */
        $backendWorkspaceRestriction = GeneralUtility::makeInstance(BackendWorkspaceRestriction::class);
        $queryBuilder->getRestrictions()->removeAll()->add($backendWorkspaceRestriction)->add($deletedRestriction);
        return $queryBuilder;
    }

    /**
     * @param  int  $group
     * @return bool
     */
    public static function hasAccessToGroup(int $group): bool
    {
        return static::isConfigured($group);
    }
}
