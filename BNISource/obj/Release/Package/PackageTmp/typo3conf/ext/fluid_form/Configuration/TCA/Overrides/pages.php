<?php

defined('TYPO3') or die();

//
// Page tree icon
$GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
    0 => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_label.contains_mails',
    1 => 'mails',
    2 => 'apps-pagetree-folder-contains-mails'
];
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-mails'] = 'apps-pagetree-folder-contains-mails';
