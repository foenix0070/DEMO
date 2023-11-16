<?php

defined('TYPO3_MODE') or die();
//
// Profile plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'modules',
    'Profile',
    'Frontend-User - Profile'
);
// Include flex forms
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['modules_profile'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('modules_profile', 'FILE:EXT:modules/Configuration/FlexForms/Profile.xml');
//
// Static template
//
// Registration plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'modules',
    'Registration',
    'Frontend-User - Registration'
);
// Include flex forms
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['modules_registration'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('modules_registration', 'FILE:EXT:modules/Configuration/FlexForms/Registration.xml');
