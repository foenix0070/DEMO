<?php

$extKey = 'modules';
$table = 'tx_modules_domain_model_frontenduser';
$lll = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_db.xlf:' . $table;

/**
 * Table configuration fe_users
 */
$feUsersColumns = [
    'tx_modules_gender' => [
        'exclude' => 1,
        'label' => $lll . '.gender',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [$lll . '.gender_male', 'male'],
                [$lll . '.gender_female', 'female'],
                [$lll . '.gender_other', 'other'],
            ],
        ]
    ],
    'tx_modules_birthday' => [
        'exclude' => 1,
        'label' => $lll . '.birthday',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('date', false, false, ''),
    ],
    'tx_modules_mobile' => [
        'exclude' => 1,
        'label' => $lll . '.mobile',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
    ],
    'tx_modules_profession' => [
        'exclude' => 1,
        'label' => $lll . '.profession',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [$lll . '.profession_employed', 'employed'],
                [$lll . '.profession_officer', 'officer'],
                [$lll . '.profession_self_employed', 'self_employed'],
                [$lll . '.profession_pensioner', 'pensioner']
            ],
        ]
    ],
    'tx_modules_marital_status' => [
        'exclude' => 1,
        'label' => $lll . '.marital_status',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [$lll . '.marital_status_single', 'single'],
                [$lll . '.marital_status_married', 'married']
            ],
        ]
    ],
    'tx_modules_children' => [
        'exclude' => 1,
        'label' => $lll . '.children',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['0', '0'],
                ['1', '1'],
                ['2', '2'],
                ['3', '3'],
                ['4', '4'],
                ['5', '5'],
                ['6', '6'],
                ['7', '7'],
                ['8', '8'],
                ['9', '9'],
            ],
        ]
    ],
    'tx_modules_hash' => [
        'exclude' => 1,
        'label' => $lll . '.hash',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
    ],
    'tx_modules_terms_confirmed' => [
        'exclude' => 1,
        'label' => $lll . '.terms_confirmed',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('checkbox'),
    ],
    'tx_modules_privacy_confirmed' => [
        'exclude' => 1,
        'label' => $lll . '.privacy_confirmed',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('checkbox'),
    ],
    'tx_modules_disclaimer_confirmed' => [
        'exclude' => 1,
        'label' => $lll . '.disclaimer_confirmed',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('checkbox'),
    ],
    'tx_modules_newsletter' => [
        'exclude' => 1,
        'label' => $lll . '.newsletter',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('checkbox'),
    ],

    'tx_modules_bank_account_owner_name' => [
        'exclude' => 1,
        'label' => $lll . '.bank_account_owner_name',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
    ],
    'tx_modules_bank_account_bank_name' => [
        'exclude' => 1,
        'label' => $lll . '.bank_account_bank_name',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
    ],
    'tx_modules_bank_account_bic' => [
        'exclude' => 1,
        'label' => $lll . '.bank_account_bic',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
    ],
    'tx_modules_bank_account_iban' => [
        'exclude' => 1,
        'label' => $lll . '.bank_account_iban',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
    ],
    'tx_modules_accounting_type' => [
        'exclude' => 1,
        'label' => $lll . '.accounting_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [$lll . '.accounting_type_debit', 'debit'],
                [$lll . '.accounting_type_accounting', 'accounting']
            ],
        ],
    ],
    'tx_modules_vat_number' => [
        'exclude' => 1,
        'label' => $lll . '.vat_number',
        'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('string'),
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_modules_gender, tx_modules_birthday',
    '',
    'after:name'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_modules_mobile',
    '',
    'after:telephone'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_modules_hash',
    '',
    'after:disable'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_modules_profession, tx_modules_marital_status, tx_modules_children, --palette--;' . $lll . '.palette_confirmations;terms_privacy_disclaimer_newsletter_confirmed, --palette--;' . $lll . '.palette_bank_account;bank_account, tx_modules_accounting_type, tx_modules_vat_number',
    '',
    'after:last_login'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $feUsersColumns);
//
// Define new custom palettes
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'username_password',
    'username, password'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'first_name_middle_name_last_name',
    'first_name, middle_name, last_name'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'terms_privacy_disclaimer_newsletter_confirmed',
    'tx_modules_terms_confirmed, tx_modules_privacy_confirmed, tx_modules_disclaimer_confirmed, tx_modules_newsletter'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'bank_account',
    'tx_modules_accounting_type, --linebreak--, tx_modules_bank_account_owner_name, tx_modules_bank_account_bank_name, --linebreak--, tx_modules_bank_account_bic, tx_modules_bank_account_iban'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'telephone_mobile_fax_email_www',
    'telephone, tx_modules_mobile, --linebreak--, fax, email, --linebreak--, www'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'address_country_zip_city',
    'address, country, --linebreak--, zip, city'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'company_tx_modules_vat_number',
    'company, tx_modules_vat_number'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'gender_title_name',
    'tx_modules_gender, title, name'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'disable_starttime_endtime',
    'disable, starttime, endtime'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'crdate_lastlogin',
    'crdate, lastlogin'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'fe_users',
    'birthday_profession_martial_status_children',
    'tx_modules_birthday, tx_modules_profession, --linebreak--, tx_modules_marital_status, tx_modules_children'
);
//
// Modify exsting fields
$GLOBALS['TCA']['fe_users']['columns']['description']['exclude'] = true;
$GLOBALS['TCA']['fe_users']['columns']['title']['config'] = \CodingMs\AdditionalTca\Tca\Configuration::get(
    'badgeSuggested'
);
$GLOBALS['TCA']['fe_users']['columns']['crdate'] = [
    'label' => $lll . '.crdate',
    'config' => \CodingMs\AdditionalTca\Tca\Configuration::get(
        'dateTime',
        false,
        true,
        '',
        ['dbType' => 'timestamp']
    )
];
$GLOBALS['TCA']['fe_users']['columns']['tstamp'] = [
    'label' => $lll . '.tstamp',
    'config' => \CodingMs\AdditionalTca\Tca\Configuration::get(
        'dateTime',
        false,
        true,
        '',
        ['dbType' => 'timestamp']
    )
];
//
// Define own type
$GLOBALS['TCA']['fe_users']['columns']['tx_extbase_type']['config']['items'][] = [
    $lll,
    'CodingMs\Modules\Domain\Model\FrontendUser'
];
$GLOBALS['TCA']['fe_users']['types']['CodingMs\Modules\Domain\Model\FrontendUser']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        tx_extbase_type,
        --palette--;;username_password,
        --palette--;;crdate_lastlogin,
        --palette--;;gender_title_name,
        --palette--;;first_name_middle_name_last_name,
        image,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_users.tabs.personelData,
        --palette--;' . $lll . '.palette_personal_data;birthday_profession_martial_status_children,
        --palette--;' . $lll . '.palette_address_data;address_country_zip_city,
        --palette--;' . $lll . '.palette_contact_data;telephone_mobile_fax_email_www,
        --palette--;' . $lll . '.palette_business_data;company_tx_modules_vat_number,
         --palette--;' . $lll . '.palette_bank_account;bank_account,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_users.tabs.options,
        TSconfig,
        felogin_redirectPid,
    --div--;' . $lll . '.tab_confirm_access,
        usergroup,
        --palette--;;disable_starttime_endtime,
         --palette--;' . $lll . '.palette_confirmations;terms_privacy_disclaimer_newsletter_confirmed,
        tx_modules_hash,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        description,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended
 ';
