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

/**
 * DTO: Permission access Frontend User Group Actions
 */
final class FrontendUserGroupActionPermission extends AbstractPermission
{
    use PermissionTrait;

    /**
     * @var string
     */
    public const KEY = 'modules_frontend_user_group';

    /**
     * Disabled actions
     */
    public const ACTION_LIST_GROUPS = 'ACTION_LIST_GROUPS';
    public const ACTION_ADD_GROUP = 'ACTION_ADD_GROUP';
    public const ACTION_DELETE_GROUP = 'ACTION_DELETE_GROUP';

    /**
     * @return array<string, mixed>
     */
    public static function getItems(): array
    {
        return [
            self::ACTION_ADD_GROUP => [
                'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:tx_modules_authorization.frontend_user_group_add_group_title',
                'module-frontenduser',
            ],
            self::ACTION_DELETE_GROUP => [
                'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:tx_modules_authorization.frontend_user_group_delete_group_title',
                'module-frontenduser',
            ],
            self::ACTION_LIST_GROUPS => [
                'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:tx_modules_authorization.frontend_user_group_list_groups_title',
                'module-frontenduser',
            ],
        ];
    }

    protected function populateData(): void
    {
        $this->data = [
            'header' => 'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:tx_modules_authorization.frontend_user_group_header',
            'items' => self::getItems(),
        ];
    }

    /** Helper classes for readability */

    /**
     * @return bool
     */
    public static function groupCreationAllowed(): bool
    {
        return static::isConfigured(self::ACTION_ADD_GROUP);
    }

    /**
     * @return bool
     */
    public static function groupDeletionAllowed(): bool
    {
        return static::isConfigured(self::ACTION_DELETE_GROUP);
    }

    /**
     * @return bool
     */
    public static function listGroupsAllowed(): bool
    {
        return static::isConfigured(self::ACTION_LIST_GROUPS);
    }
}
