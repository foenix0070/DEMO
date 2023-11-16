<?php

declare(strict_types=1);

return [
    \CodingMs\Modules\Domain\Model\FrontendUser::class => [
        'tableName' => 'fe_users',
        'properties' => [
            'creationDate' => [
                'fieldName' => 'crdate'
            ],
            'modificationDate' => [
                'fieldName' => 'tstamp'
            ],
            'creationUser' => [
                'fieldName' => 'cruser'
            ],
            'gender' => [
                'fieldName' => 'tx_modules_gender'
            ],
            'birthday' => [
                'fieldName' => 'tx_modules_birthday'
            ],
            'mobile' => [
                'fieldName' => 'tx_modules_mobile'
            ],
            'hash' => [
                'fieldName' => 'tx_modules_hash'
            ],
            'termsConfirmed' => [
                'fieldName' => 'tx_modules_terms_confirmed'
            ],
            'privacyConfirmed' => [
                'fieldName' => 'tx_modules_privacy_confirmed'
            ],
            'disclaimerConfirmed' => [
                'fieldName' => 'tx_modules_disclaimer_confirmed'
            ],
            'newsletter' => [
                'fieldName' => 'tx_modules_newsletter'
            ],
            'maritalStatus' => [
                'fieldName' => 'tx_modules_marital_status'
            ],
            'bankAccountOwnerName' => [
                'fieldName' => 'tx_modules_bank_account_owner_name'
            ],
            'bankAccountBankName' => [
                'fieldName' => 'tx_modules_bank_account_bank_name'
            ],
            'bankAccountBic' => [
                'fieldName' => 'tx_modules_bank_account_bic'
            ],
            'bankAccountIban' => [
                'fieldName' => 'tx_modules_bank_account_iban'
            ],
            'accountingType' => [
                'fieldName' => 'tx_modules_accounting_type'
            ],
            'vatNumber' => [
                'fieldName' => 'tx_modules_vat_number'
            ],
            'recordType' => [
                'fieldName' => 'tx_extbase_type'
            ],
        ],
    ],
    \CodingMs\Modules\Domain\Model\FrontendUserGroup::class => [
        'tableName' => 'fe_groups',
        'properties' => [
            'creationDate' => [
                'fieldName' => 'crdate'
            ],
            'modificationDate' => [
                'fieldName' => 'tstamp'
            ],
            'creationUser' => [
                'fieldName' => 'cruser'
            ],
        ],
    ],
    \CodingMs\Modules\Domain\Model\BackendUser::class => [
        'tableName' => 'be_users',
        'properties' => [
            'creationDate' => [
                'fieldName' => 'crdate'
            ],
            'modificationDate' => [
                'fieldName' => 'tstamp'
            ],
            'disable' => [
                'fieldName' => 'disable'
            ],
        ],
    ],
];
