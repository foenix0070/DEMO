<?php

defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'fluid_form',
    'Form',
    'Fluid-Form'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['fluidform_form'] = 'pi_flexform';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['fluidform_form'] = 'recursive,pages';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('fluidform_form', 'FILE:EXT:fluid_form/Configuration/FlexForms/Form.xml');
