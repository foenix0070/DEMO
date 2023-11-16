<?php
defined('TYPO3') or die('Access denied.');

/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['fluid_new_site_bni'] = 'EXT:fluid_new_site_bni/Configuration/RTE/Default.yaml';

/***************
 * PageTS */
 
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '@import "EXT:fluid_new_site_bni/Configuration/page.tsconfig"'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import "EXT:fluid_new_site_bni/Configuration/TsConfig/Page/All.tsconfig"');


/***************
 *
ExtensionManagementUtility::addPageTSConfig('
    @import "EXT:site_package/Configuration/page.tsconfig",
    @import "EXT:fluid_new_site_bni/Configuration/TsConfig/Page/All.tsconfig"
');
*/