<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

$GLOBALS['TCA']['tx_fluidform_domain_model_form'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_form',
        'label' => 'form_key',
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
        'searchFields' => 'form_key,form_uid,unique_id,fields,',
        'iconfile' => 'EXT:fluid_form/Resources/Public/Icons/iconmonstr-email-9.svg',
        'typeicon_classes' => ['default' => 'mimetypes-x-content-fluid-form-mail']
    ],
    'interface' => [
        'showRecordFieldList' => 'form_key, form_uid, unique_id, fields',
    ],
    'types' => [
        '1' => ['showitem' => '--palette--;;form_key_form_uid_unique_id, fields'],
    ],
    'palettes' => [
        'form_key_form_uid_unique_id' => ['showitem' => 'form_key, form_uid, unique_id', 'canNotCollapse' => 1],
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
                'foreign_table' => 'tx_fluidform_domain_model_form',
                'foreign_table_where' => 'AND tx_fluidform_domain_model_form.pid=###CURRENT_PID### AND tx_fluidform_domain_model_form.sys_language_uid IN (-1,0)',
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
        'form_key' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_form.form_key',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => 1,
            ],
        ],
        'form_uid' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_form.form_uid',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => 1,
            ],
        ],
        'unique_id' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_form.unique_id',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => 1,
            ],
        ],
        'fields' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_db.xlf:tx_fluidform_domain_model_form.fields',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_fluidform_domain_model_field',
                'foreign_field' => 'fluidform',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'crdate' => [
            'exclude' => 0,
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'checkbox' => 0,
                'readOnly' => 1,
            ],
        ],
    ],
];
