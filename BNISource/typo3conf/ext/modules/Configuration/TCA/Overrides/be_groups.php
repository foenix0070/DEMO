<?php

//
// Group tables select/modify in a palette
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'be_groups',
    'tables_select_tables_modify_non_exclude_fields',
    'tables_select, tables_modify, --linebreak--, non_exclude_fields'
);
$GLOBALS['TCA']['be_groups']['types'][0]['showitem'] = str_replace(
    'non_exclude_fields',
    '',
    $GLOBALS['TCA']['be_groups']['types'][0]['showitem']
);
$GLOBALS['TCA']['be_groups']['types'][0]['showitem'] = str_replace(
    'tables_select',
    '',
    $GLOBALS['TCA']['be_groups']['types'][0]['showitem']
);
$GLOBALS['TCA']['be_groups']['types'][0]['showitem'] = str_replace(
    'tables_modify',
    '',
    $GLOBALS['TCA']['be_groups']['types'][0]['showitem']
) . ',--div--;Tables,--palette--;;tables_select_tables_modify_non_exclude_fields,';
//
// Move custom options on a separate tab
$GLOBALS['TCA']['be_groups']['types'][0]['showitem'] = str_replace(
    'custom_options',
    '',
    $GLOBALS['TCA']['be_groups']['types'][0]['showitem']
) . ',--div--;Modules,custom_options,';
//
// Move widgets on a separate tab
$GLOBALS['TCA']['be_groups']['types'][0]['showitem'] = str_replace(
    'availableWidgets',
    '',
    $GLOBALS['TCA']['be_groups']['types'][0]['showitem']
) . ',--div--;Widgets,availableWidgets,';
