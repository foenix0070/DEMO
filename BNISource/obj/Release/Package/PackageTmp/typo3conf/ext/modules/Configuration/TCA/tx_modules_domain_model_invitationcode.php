<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$extKey = 'modules';
$table = 'tx_modules_domain_model_invitationcode';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;

return [
    'ctrl' => [
        'title' => $lll,
        'label' => 'code',
        'label_alt' => 'used, used_at',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'used',
        ],
        'searchFields' => 'code,',
        'iconfile' => 'EXT:modules/Resources/Public/Icons/iconmonstr-key-13.svg',
        'typeicon_classes' => ['default' => 'mimetypes-x-content-modules-invitationcode']
    ],
    'types' => [
        '1' => ['showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            code,
                --palette--;;used_used_at,
            --div--;' . $lll . '.tab_defaults,
                defaults_information,
                --palette--;;first_name_last_name_company,
                usergroups,
                birthday,
                --palette--;;starttime_endtime,
        '],
    ],
    'palettes' => [
        'used_used_at' => ['showitem' => 'used, used_at'],
        'starttime_endtime' => ['showitem' => 'starttime_endtime_information, --linebreak--, starttime, endtime'],
        'first_name_last_name_company' => ['showitem' => 'first_name, last_name, company'],
    ],
    'columns' => [
        'code' => [
            'label' => $lll . '.code',
            'description' => $lll . '.code_description',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string', true),
        ],
        'used' => [
            'label' => $lll . '.used',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('checkbox')
        ],
        'used_at' => [
            'label' => $lll . '.used_at',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get(
                'dateTime',
                false,
                false,
                '',
                [
                    'dbType' => 'datetime'
                ]
            ),
        ],
        'usergroups' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => $lll . '.usergroups',
            'description' => $lll . '.usergroups_description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 7,
                'maxitems' => 20,
                'allowed' => 'fe_groups',
                'foreign_table' => 'fe_groups',
                'foreign_table_where' => 'AND fe_groups.pid = ###CURRENT_PID###',
                //
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'defaults_information' => [
            'label' => '',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('notice', false, false, '', [
                'notice' => $lll . '.defaults_information',
                'display' => 'info',
            ]),
        ],
        'first_name' => [
            'exclude' => 1,
            'label' => $lll . '.first_name',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'last_name' => [
            'exclude' => 1,
            'label' => $lll . '.last_name',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'company' => [
            'exclude' => 1,
            'label' => $lll . '.company',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
        ],
        'starttime_endtime_information' => [
            'label' => '',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('notice', false, false, '', [
                'notice' => $lll . '.starttime_endtime_information',
            ]),
        ],
        'birthday' => [
            'exclude' => 1,
            'label' => $lll . '.birthday',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('date', false, false, ''),
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => $lll . '.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => $lll . '.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],
    ],
];
