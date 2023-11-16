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

use CodingMs\Modules\Service\LogService;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Database\Schema\Parser\AST\Identifier;
use TYPO3\CMS\Core\Utility\Exception\NotImplementedMethodException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Generic trait for Permissions access Backend User Groups
 *
 * @usage $GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions'][class::KEY]
 * @see \TYPO3\CMS\Backend\Form\FormDataProvider\AbstractItemProvider::addItemsFromSpecial
 */
trait PermissionTrait
{
    /**
     * @var array|null
     */
    protected static ?array $configured = null;

    /**
     * @var bool cached admin lookup from aspect context
     */
    protected static ?bool $isAdmin = null;

    /**
     * @return string
     */
    protected static function key(): string
    {
        if (static::KEY === null) {
            throw new NotImplementedMethodException('Key should return the permission key in custom_options');
        }
        return static::KEY;
    }

    /**
     * @return bool
     */
    protected static function userIsAdmin(): bool
    {
        if (static::$isAdmin === null) {
            try {
                static::$isAdmin = GeneralUtility::makeInstance(Context::class)
                    ->getPropertyFromAspect('backend.user', 'isAdmin', false);
            } catch (AspectNotFoundException $e) {
                static::$isAdmin = false;
            }
        }
        return static::$isAdmin;
    }

    /**
     * Get configured options based on current backend user
     *
     * @return array<int, string>
     */
    public static function getConfigured(): array
    {
        if (static::$configured === null) {
            static::$configured = [];
            // If admin, don't return any configured options
            if (static::userIsAdmin()) {
                return [];
            }
            /** @var BackendUserAuthentication $backendUser */
            $backendUser = $GLOBALS['BE_USER'];
            if ($backendUser === null) {
                return [];
            }
            $options = $backendUser->groupData['custom_options'] ?? '';
            foreach (GeneralUtility::trimExplode(',', $options, true) as $value) {
                // Check if custom option value is a key for this object
                if (strpos($value, static::key()) === 0) {
                    // Only return auth-key; remove `my_custom_key` and cast as int
                    $key = trim(substr($value, strlen(static::key()) + 1));
                    if ($key !== '') {
                        static::$configured[] = $key;
                    }
                }
            }
        }
        return static::$configured;
    }

    /**
     * @return bool
     */
    public static function hasConfigured(): bool
    {
        return static::getConfigured() !== [];
    }

    /**
     * Check if identifier is configured by backend user
     *
     * @param string $identifier
     * @return bool
     */
    public static function isConfigured(string $identifier): bool
    {
        $logPrefix = __CLASS__ . '::isConfigured(' . $identifier . ') returns ';
        if (static::userIsAdmin()) {
            LogService::log($logPrefix . ' true (admin user)', 999, 10);
            return true;
        }
        $return = in_array($identifier, static::getConfigured(), true);
        LogService::log($logPrefix . ($return ? 'true' : 'false') . ' (non admin user)', 999, 10);
        return $return;
    }
}
