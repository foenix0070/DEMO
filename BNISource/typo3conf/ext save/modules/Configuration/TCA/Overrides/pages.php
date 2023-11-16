<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Add new page type as possible select item:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'LLL:EXT:modules/Resources/Private/Language/locallang_db.xlf:tx_modules_label.frontend_user_page_type',
        1659186453,
        'EXT:modules/Resources/Public/Icons/iconmonstr-user-20.svg',
        'special'
    ],
    '1',
    'after'
);

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['pages'],
    [
        // add icon for new page type:
        'ctrl' => [
            'typeicon_classes' => [
                1659186453 => 'apps-pagetree-frontend-user',
            ],
        ],
        // add all page standard fields and tabs to your new page type
        'types' => [
            1659186453 => [
                'showitem' => '
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;standard,
                    --palette--;;titleonly,
                    hidden
                '
            ]
        ]
    ]
);
