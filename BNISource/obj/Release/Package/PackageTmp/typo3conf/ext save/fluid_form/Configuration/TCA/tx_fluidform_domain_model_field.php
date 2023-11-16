<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

$GLOBALS['TCA']['tx_fluidform_domain_model_field'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_field',
        'label' => 'field_label',
        'label_alt' => 'field_value',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'field_type,field_label,field_key,field_upload,field_value,field_text,',
        'iconfile' => 'EXT:fluid_form/Resources/Public/Icons/iconmonstr-email-9.svg',
        'typeicon_classes' => ['default' => 'mimetypes-x-content-fluid-form-field']
    ],
    'interface' => [
        'showRecordFieldList' => 'field_type, field_label, field_key, field_upload, field_value, field_text',
    ],
    'types' => [
        '1' => [
            'showitem' => '--palette--;;label_key_type, field_upload, field_value, field_text'
        ],
    ],
    'palettes' => [
        'label_key_type' => ['showitem' => 'field_label, field_key, field_type', 'canNotCollapse' => 1],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 0,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_fluidform_domain_model_field',
                'foreign_table_where' => 'AND tx_fluidform_domain_model_field.pid=###CURRENT_PID### AND tx_fluidform_domain_model_field.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'field_type' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_field.field_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 'default',
                'items' => [
                    ['Hidden', 'Hidden'],
                    ['Input', 'Input'],
                    ['Textarea', 'Textarea'],
                    ['DateTime', 'DateTime'],
                    ['Checkbox', 'Checkbox'],
                    ['Select', 'Select'],
                    ['Radio', 'Radio'],
                    ['Captcha', 'Captcha'],
                    ['Upload', 'Upload'],
                ],
                'readOnly' => 1,
            ],
        ],
        'field_label' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_field.field_label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => 1,
            ],
        ],
        'field_key' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_field.field_key',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => 1,
            ],
        ],
        'field_upload' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_field.field_upload',
            'displayCond' => 'FIELD:field_type:=:Upload',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'field_upload',
                [
                    'maxitems' => 1,
                    'foreign_match_fields' => [
                        'fieldname' => 'field_upload',
                        'tablenames' => 'tx_fluidform_domain_model_field',
                        'table_local' => 'sys_file',
                    ],
                ],
                '*'
                /**
                 * @todo: needs an restriction!
                 */
            ),
        ],
        'field_value' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_field.field_value',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim',
                'readOnly' => 1,
            ],
            'defaultExtras' => 'fixed-font:enable-tab',
        ],
        'field_text' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_field.field_text',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => 1,
            ],
        ],
        'fluidform' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
