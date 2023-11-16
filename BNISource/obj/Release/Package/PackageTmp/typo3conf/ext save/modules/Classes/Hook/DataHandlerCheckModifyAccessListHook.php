<?php

namespace CodingMs\Modules\Hook;

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

use CodingMs\Modules\Service\LogService;
use CodingMs\Modules\Utility\AccessUtility;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\DataHandling\DataHandlerCheckModifyAccessListHookInterface;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Security\Exception;

/**
 * Hook: DataHandler Manipulation when adjusting records for current backend user
 */
final class DataHandlerCheckModifyAccessListHook implements DataHandlerCheckModifyAccessListHookInterface
{
    /**
     * Hook that determines whether a user has access to modify a table.
     *
     * @inheritDoc
     * @param bool &$accessAllowed Whether the user has access to modify a table
     * @param string $table The name of the table to be modified
     * @param DataHandler $parent The calling parent object
     * @throws Exception
     */
    public function checkModifyAccessList(&$accessAllowed, $table, DataHandler $parent)
    {
        //
        // if already false processed, don't do anything..
        if (!$accessAllowed) {
            return;
        }
//        //
//        // Only apply on this extensions table to minimize collision with other extension hooks
//        if (!in_array($table, ['be_users'], true)) {
//            return;
//        }
        /**
         * @todo wieder eingrenzen!?
         */
        //
        // If user is not allowed to edit this table through configuration
        if (!AccessUtility::beUserHasRightToEditTable($table)) {
            $accessAllowed = false;
            return;
        }
        //
        // Check rights per invoked action
        if (isset($parent->cmdmap[$table]) && is_array($parent->cmdmap)) {
            foreach ($parent->cmdmap[$table] as $id => $incomingCmdArray) {
                foreach ($incomingCmdArray as $command => $value) {
                    switch ($command) {
                        case 'delete':
                            $accessAllowed = $this->accessAllowedOnAction($table, 'delete');
                            break;
                        case 'undelete':
                            $accessAllowed = $this->accessAllowedOnAction($table, 'insert');
                            break;
                    }
                }
            }
        }
        //
        if (isset($parent->datamap[$table]) && is_array($parent->datamap)) {
            foreach ($parent->datamap[$table] as $id => $value) {
                if (strpos($id, 'NEW') !== false || MathUtility::canBeInterpretedAsInteger($id) === false) {
                    $accessAllowed = $this->accessAllowedOnAction($table, 'insert');
                } else {
                    $accessAllowed = $this->accessAllowedOnAction($table, 'update');
                }
            }
        }
    }

    /**
     * @param  string  $table
     * @param  string  $action
     * @return bool true, or exception otherwise
     * @throws Exception
     */
    protected function accessAllowedOnAction(string $table, string $action): bool
    {
        LogService::log(
            'AccessListHook->accessAllowedOnAction(' . $table . ', ' . $action . ')',
            999,
            10
        );
        // Only access check for insert/delete/update possible by this extension configuration!
        switch ($action) {
            case 'insert':
                if (!AccessUtility::beUserHasRightToAddTable($table)) {
                    throw new Exception('You are not allowed to add new (' . $table . ') records!');
                }
                break;

            case 'delete':
                if (!AccessUtility::beUserHasRightToDeleteTable($table)) {
                    throw new Exception('You are not allowed to delete (' . $table . ') records!');
                }
                break;

            case 'update':
                if (!AccessUtility::beUserHasRightToEditTable($table)) {
                    throw new Exception('You are not allowed to update (' . $table . ') records!');
                }
                break;
        }
        return true;
    }
}
