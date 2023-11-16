<?php

namespace CodingMs\Modules\Utility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Thomas Deuling <typo3@coding.ms>
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

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\Request;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Utility for building lists
 */
class BackendListUtility
{
    /**
     * @param array $list
     * @param Request $request
     * @param array $fetch A list with array keys for fields to restore from user settings
     * @return array
     * @throws NoSuchArgumentException
     */
    public function initList(array $list, Request $request, array $fetch = [])
    {
        //
        // Restore settings
        $settings = $this->restoreSettings($list['id']);
        //
        // Sorting field passed by argument!?
        if ($request->hasArgument('sortingField')) {
            $tempSortingField = $request->getArgument('sortingField');
            // Compare sorting field with field definition
            if (array_key_exists(str_replace('.', '_', $tempSortingField), $list['fields'])) {
                $list['sortingFieldUnmapped'] = $tempSortingField;
                $list['sortingField'] = $list['fields'][$tempSortingField]['sortingField'] ?? $tempSortingField;
            }
        } // Sorting field stored in session!?
        elseif (isset($settings['sortingField']) && trim($settings['sortingField']) != '') {
            $list['sortingField'] = $settings['sortingField'];
        }
        //
        // Sorting order passed by argument!?
        if ($request->hasArgument('sortingOrder')) {
            $list['sortingOrder'] = ($request->getArgument('sortingOrder') == 'asc') ? 'asc' : 'desc';
        } // Sorting order stored in session!?
        elseif (isset($settings['sortingOrder']) && trim($settings['sortingOrder']) != '') {
            $list['sortingOrder'] = $settings['sortingOrder'];
        }
        //
        // Offset passed by argument!?
        if ($request->hasArgument('offset')) {
            $list['offset'] = (int)$request->getArgument('offset');
        } // Sorting order stored in session!?
        elseif (isset($settings['offset']) && trim($settings['offset']) != '') {
            $list['offset'] = (int)$settings['offset'];
        } else {
            $list['offset'] = 0;
        }
        //
        // Fetch other filter
        foreach ($fetch as $key) {
            if (isset($settings[$key])) {
                if (is_array($settings[$key]) && isset($settings[$key]['selected'])) {
                    $list[$key]['selected'] = $settings[$key]['selected'];
                } else {
                    $list[$key] = $settings[$key];
                }
            }
        }
        //
        // Disabled
        if (isset($settings['disable'])) {
            $list['disable'] = ($settings['disable'] == '1' || $settings['disable'] == '0') ? (string)$settings['disable'] : '';
        } else {
            $list['disable'] = '';
        }
        //
        // Identify current action
        $list['action'] = $request->getControllerActionName();
        $list['underscoredId'] = GeneralUtility::camelCaseToLowerCaseUnderscored($list['id']);
        $list['columnsInList'] = 0;
        $list['columnsInExport'] = 0;
        if (isset($settings['plugin']) && trim($settings['plugin']) != '') {
            $list['plugin'] = $settings['plugin'];
        }
        //
        $listFields = [];
        foreach ($list['fields'] as $key => $options) {
            $list['fields'][$key]['underscoredId'] = GeneralUtility::camelCaseToLowerCaseUnderscored($key);
            //
            // Identify visible columns
            $list['fields'][$key]['hideInList'] = !isset($options['hideInList']) ? 0 : (int)$options['hideInList'];
            if ($list['fields'][$key]['hideInList'] == 0) {
                $list['columnsInList']++;
            }
            $list['fields'][$key]['hideInExport'] = !isset($options['hideInExport']) ? 0 : (int)$options['hideInExport'];
            if ($list['fields'][$key]['hideInExport'] == 0) {
                $list['columnsInExport']++;
            }
            //
            // Fix some keys, because of TypoScript is unable to use dots in keys
            if (strstr($key, '_')) {
                $listFields[str_replace('_', '.', $key)] = $list['fields'][$key];
                unset($list['fields'][$key]);
            } else {
                $listFields[$key] = $list['fields'][$key];
            }
            //
            // Visibility
            $listFields[$key]['visible'] = true;
            if ($request->hasArgument('visible')) {
                if (is_array($request->getArgument('visible')) && in_array($key, $request->getArgument('visible'))) {
                    $listFields[$key]['visible'] = true;
                } else {
                    $listFields[$key]['visible'] = false;
                }
            } elseif (isset($settings['fields'][$key]['visible'])) {
                $listFields[$key]['visible'] = $settings['fields'][$key]['visible'];
            }
        }
        $list['fields'] = $listFields;
        //
        // Different Bootstrap classes between TYPO3 10 and 11
        if (version_compare((string)GeneralUtility::makeInstance(Typo3Version::class), '10.0.0', '<=')) {
            $list['css'] = [
                'select' => 'form-control',
                'bootstrap' => '3',
            ];
        } else {
            $list['css'] = [
                'select' => 'form-select',
                'bootstrap' => '5',
            ];
        }
        //
        $list['authorization']['isDdev'] = isset($_SERVER['DDEV_HOSTNAME']);
        //
        // Check default columns and hide others
        if (isset($list['columnDefault']) && $list['columnDefault'] !== ''
            && !$request->hasArgument('visible')
            && !isset($settings['fields'])) {
            $defaultColumnsArray = explode(',', preg_replace('/\s+/', '', (string)$list['columnDefault']));
            foreach ($list['fields'] as $key => $field) {
                if (in_array($key, $defaultColumnsArray)) {
                    $list['fields'][$key]['visible'] = true;
                } else {
                    $list['fields'][$key]['visible'] = false;
                }
            }
        }
        //
        // Save current settings
        $this->writeSettings($list['id'], $list);
        return $list;
    }

    /**
     * @param string $id
     * @return array<string, mixed>
     */
    public function restoreSettings(string $id = ''): array
    {
        $settings = $GLOBALS['BE_USER']->getModuleData('BackendList/' . $id, 'ses');
        if ($settings === null) {
            $settings = [];
            $settings['sortingField'] = '';
            $settings['sortingOrder'] = '';
            $settings['offset'] = 0;
            $settings['disable'] = '';
        }
        return $settings;
    }

    /**
     * @param string $id
     * @param array<string, mixed> $list
     */
    public function writeSettings(string $id = '', array $list = []): void
    {
        $settings = $list;
        $settings['offset'] = (int)$list['offset'];
        $settings['disable'] = (string)$list['disable'];
        $GLOBALS['BE_USER']->pushModuleData('BackendList/' . $id, $settings);
    }

    /**
     * @param QueryResult $data
     * @param array<string, mixed> $list
     */
    public function exportAsCsv(QueryResult $data, array $list = []): void
    {
        header('Content-Type: text/csv');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Pragma: no-cache');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Disposition: attachment;filename=' . date('Y-m-d') . '-export-' . $list['id'] . '.csv');
        $csv = fopen('php://output', 'w');
        if (count($data) > 0) {
            $isFirst = true;
            foreach ($data as $entry) {
                if ($isFirst) {
                    $isFirst = false;
                    fputcsv($csv, $this->csvHeader($list), ';');
                }
                if (method_exists($entry, 'toCsvArray')) {
                    fputcsv($csv, $entry->toCsvArray($list), ';');
                } else {
                    fputcsv($csv, ['Model ' . get_class($entry) . ' needs a toCsvArray method!'], ';');
                    break;
                }
            }
        }
        fclose($csv);
        exit;
    }

    /**
     * @param array<string, mixed> $list
     * @return array<string, mixed>
     */
    public function csvHeader(array $list = []): array
    {
        $array = [];
        foreach ($list['fields'] as $key => $options) {
            if ((int)$options['hideInExport'] === 1) {
                continue;
            }
            $translationKey = 'tx_modules_label.list_' . $list['underscoredId'] . '_col_' . $options['underscoredId'];
            $plugin = 'Modules';
            if (isset($list['plugin'])) {
                $plugin = $list['plugin'];
            }
            $translation = LocalizationUtility::translate($translationKey, $plugin);
            if (!is_string($translation) || trim($translation) === '') {
                $array[$key] = $plugin . ':' . $translationKey;
            } else {
                $array[$key] = $translation;
            }
        }
        return $array;
    }
}
