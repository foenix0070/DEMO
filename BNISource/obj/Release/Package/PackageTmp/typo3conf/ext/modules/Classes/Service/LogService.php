<?php

declare(strict_types=1);

namespace CodingMs\Modules\Service;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2021 Thomas Deuling <typo3@coding.ms>
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

use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Services for logging
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class LogService implements SingletonInterface
{
    /**
     * Push log entries
     *
     * @param string $string
     * @param int $type
     * @param int $action
     * @param array $data
     */
    public static function log(string $string, int $type = 999, int $action = 0, array $data = []): void
    {
        /**
         * Available types:
         * 0: any
         * 1: Database
         * 2: File
         * 3: Cache
         * 254: Settings
         * 255: Login
         * 999: Modules
         * 1000: API
         * -1: Errors
         */

        /**
         * Available actions:
         *
         * 10: Authorization
         */

        /** @var array $extConf */
        $extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('modules');
        $loglevel = !empty($extConf['loglevel']) ? $extConf['loglevel'] : 'ERROR';

        if ($loglevel !== 'DEBUG') {
            return;
        }

        $fields = [
            'tstamp' => time(),
            'details' => $string,
            'type' => $type,
            'action' => $action,
            'userid' => self::getBackendUserAuthentication()->user['uid'],
            'IP' => $_SERVER['REMOTE_ADDR'],
            'channel' => 'modules',
        ];
        if (!empty($data)) {
            $fields['data'] = json_encode($data, JSON_PRETTY_PRINT);
        }
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('sys_log');
        $queryBuilder->insert('sys_log')->values($fields)->execute();
    }

    /**
     * @return BackendUserAuthentication
     */
    protected static function getBackendUserAuthentication(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }
}
