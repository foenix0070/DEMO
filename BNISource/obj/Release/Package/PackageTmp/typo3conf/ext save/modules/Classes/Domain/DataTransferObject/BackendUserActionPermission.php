<?php

namespace CodingMs\Modules\Domain\DataTransferObject;

use CodingMs\Modules\Utility\AccessUtility;

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
 * DTO: Permission access Backend User Actions
 */
final class BackendUserActionPermission extends AbstractPermission
{
    use PermissionTrait;

    /**
     * @var string
     */
    public const KEY = 'modules_backend_user_action_permissions';

    /**
     * Disabled actions
     */
    public const ACTION_ADD_USER = 'ACTION_ADD_USER';
    public const ACTION_DELETE_USER = 'ACTION_DELETE_USER';

    /**
     * @return array<string, mixed>
     */
    public static function getItems(): array
    {
        return [
            self::ACTION_ADD_USER => [
                'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:tx_modules_authorization.backend_user_add_user_title',
                'module-backenduser',
            ],
            self::ACTION_DELETE_USER => [
                'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:tx_modules_authorization.backend_user_delete_user_title',
                'module-backenduser',
            ],
        ];
    }

    protected function populateData(): void
    {
        $this->data = [
            'header' => 'LLL:EXT:modules/Resources/Private/Language/locallang.xlf:tx_modules_authorization.backend_user_group_header',
            'items' => self::getItems(),
        ];
    }

    /** Helper classes for readability */

    /**
     * @return bool
     */
    public static function userCreationAllowed(): bool
    {
        return static::isConfigured(self::ACTION_ADD_USER);
    }

    /**
     * @return bool
     */
    public static function userDeletionAllowed(): bool
    {
        return static::isConfigured(self::ACTION_DELETE_USER);
    }

    /**
     * @return bool
     */
    public static function userEnableDisableAllowed(): bool
    {
        return AccessUtility::beUserHasRightToEditTableField('be_users', 'disable');
    }
}
