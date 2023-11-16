<?php

namespace CodingMs\Modules\Utility;

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

use CodingMs\Modules\Domain\DataTransferObject\BackendUserActionPermission;
use CodingMs\Modules\Domain\DataTransferObject\FrontendUserActionPermission;
use CodingMs\Modules\Domain\DataTransferObject\FrontendUserGroupActionPermission;
use CodingMs\Modules\Domain\DataTransferObject\FrontendUserInvitationCodeActionPermission;
use CodingMs\Modules\Service\LogService;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Result;
use PDO;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Utility: Access Permissions for Backend User Authentication
 */
class AccessUtility
{
    /**
     * @return BackendUserAuthentication
     */
    protected static function getBackendUserAuthentication(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * @param int $pageType
     * @return array<int, mixed>
     * @throws DBALException
     * @throws Exception
     */
    public static function getAllowedPageUids(int $pageType=0): array
    {
        $pages = [];
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('pages');
        $constraints = [
            self::getBackendUserAuthentication()->getPagePermsClause(1)
        ];
        if ($pageType > 0) {
            $constraints[] = $queryBuilder->expr()->eq(
                'doktype',
                $queryBuilder->createNamedParameter($pageType, PDO::PARAM_INT)
            );
        }
        $queryBuilder->select('uid')->from('pages')->where(...$constraints);
        $statement = $queryBuilder->execute();
        if ($statement instanceof Result) {
            foreach ($statement->fetchAllAssociative() as $page) {
                $pages[] = $page['uid'];
            }
        }
        return $pages;
    }

    /**
     * Check if user has access to table
     *
     * @param  string  $table
     * @return bool
     */
    public static function beUserHasRightToSeeTable(string $table): bool
    {
        if (static::getBackendUserAuthentication()->isAdmin()) {
            return true;
        }
        return static::getBackendUserAuthentication()->check('tables_select', $table);
    }

    /**
     * Check if user has access to table
     *
     * @param  string  $table
     * @return bool
     */
    public static function beUserHasRightToEditTable(string $table): bool
    {
        if (static::getBackendUserAuthentication()->isAdmin()) {
            return true;
        }
        if (!static::getBackendUserAuthentication()->check('tables_modify', $table)) {
            return false;
        }
        // Check minimal required field for tables
        switch ($table) {
            case 'be_users':
                return static::beUserHasRightToEditTableField($table, 'username');
        }
        return true;
    }

    /**
     * Check if user has access to table field
     *
     * @param  string  $table
     * @param  string  $field
     * @return bool
     */
    public static function beUserHasRightToEditTableField(string $table, string $field): bool
    {
        if (static::getBackendUserAuthentication()->isAdmin()) {
            return true;
        }
        return static::getBackendUserAuthentication()->check('non_exclude_fields', $table . ':' . $field);
    }

    /**
     * Check if user can add table
     *
     * @param  string  $table
     * @return bool
     */
    public static function beUserHasRightToAddTable(string $table): bool
    {
        $logPrefix = __CLASS__ . '::beUserHasRightToAddTable(' . $table . ') returns ';
        if (static::getBackendUserAuthentication()->isAdmin()) {
            LogService::log($logPrefix . ' true (admin user)', 999, 10);
            return true;
        }
        if (static::beUserHasRightToEditTable($table)) {
            switch ($table) {
                case 'be_users':
                    $return = BackendUserActionPermission::isConfigured(BackendUserActionPermission::ACTION_ADD_USER);
                    break;
                case 'fe_users':
                    $return = FrontendUserActionPermission::isConfigured(FrontendUserActionPermission::ACTION_ADD_USER);
                    break;
                case 'fe_groups':
                    $return = FrontendUserGroupActionPermission::isConfigured(FrontendUserGroupActionPermission::ACTION_ADD_GROUP);
                    break;
                case 'tx_modules_domain_model_invitationcode':
                    $return = FrontendUserInvitationCodeActionPermission::isConfigured(FrontendUserInvitationCodeActionPermission::ACTION_MANAGE_INVITATION_CODES);
                    break;
                default:
                    $return = true;
                    if (isset($GLOBALS['TCA'][$table]['ctrl']['accessUtility']) && class_exists($GLOBALS['TCA'][$table]['ctrl']['accessUtility'])) {
                        $return = $GLOBALS['TCA'][$table]['ctrl']['accessUtility']::beUserHasRightToAddTable($table);
                    }
                    break;
            }
        }
        LogService::log($logPrefix . ($return ? 'true' : 'false') . ' (non admin user)', 999, 10);
        return $return;
    }

    /**
     * Check if user can delete table
     *
     * @param  string  $table
     * @return bool
     */
    public static function beUserHasRightToDeleteTable(string $table): bool
    {
        $logPrefix = __CLASS__ . '::beUserHasRightToDeleteTable(' . $table . ') returns ';
        if (static::getBackendUserAuthentication()->isAdmin()) {
            LogService::log($logPrefix . ' true (admin user)', 999, 10);
            return true;
        }
        switch ($table) {
            case 'be_users':
                $return = BackendUserActionPermission::isConfigured(BackendUserActionPermission::ACTION_DELETE_USER);
                break;
            case 'fe_users':
                $return = FrontendUserActionPermission::isConfigured(FrontendUserActionPermission::ACTION_DELETE_USER);
                break;
            case 'fe_groups':
                $return = FrontendUserGroupActionPermission::isConfigured(FrontendUserGroupActionPermission::ACTION_DELETE_GROUP);
                break;
            case 'tx_modules_domain_model_invitationcode':
                $return = FrontendUserInvitationCodeActionPermission::isConfigured(FrontendUserInvitationCodeActionPermission::ACTION_MANAGE_INVITATION_CODES);
                break;
            default:
                $return = true;
                if (isset($GLOBALS['TCA'][$table]['ctrl']['accessUtility'])) {
                    $return = $GLOBALS['TCA'][$table]['ctrl']['accessUtility']::beUserHasRightToDeleteTable($table);
                }
                break;
        }
        LogService::log($logPrefix . ($return ? 'true' : 'false') . ' (non admin user)', 999, 10);
        return $return;
    }
}
