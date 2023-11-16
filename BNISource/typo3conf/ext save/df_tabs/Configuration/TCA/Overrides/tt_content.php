<?php

defined('TYPO3') or die();
/**
 *
 * Copyright notice
 *
 * (c) sgalinski Internet Services (https://www.sgalinski.de)
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

// add plugin
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	[
		'LLL:EXT:df_tabs/Resources/Private/Language/locallang.xlf:tt_content.list_type_plugin1',
		'df_tabs_plugin1',
		'EXT:df_tabs/Resources/Public/Images/contentElementWizard.png'
	],
	'list_type',
	'df_tabs'
);

// remove default plugin fields
$list = 'select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['df_tabs_plugin1'] = $list;

// add flexform configuration
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['df_tabs_plugin1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	'df_tabs_plugin1',
	'FILE:EXT:df_tabs/Configuration/FlexForms/flexform.xml'
);
