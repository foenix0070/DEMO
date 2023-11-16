<?php
// Include flex forms
$pluginSignature = 'tinyaccordion_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:tinyaccordion/Configuration/FlexForms/flexform_pi1.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Tinyaccordion',
    'Pi1',
    'TinyAccordion',
    'EXT:tinyaccordion/ext_icon.gif'
);