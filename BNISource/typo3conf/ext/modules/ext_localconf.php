<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Modules',
    'Registration',
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'registration,invitationCodeAvailable'],
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'registration,invitationCodeAvailable']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Modules',
    'Profile',
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'profile'],
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'profile']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Modules',
    'LoginFromBackend',
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'loginFromBackend'],
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'loginFromBackend']
);
//
// Provide icon for page tree, list view, ...
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry
    ->registerIcon(
        'apps-pagetree-frontend-user',
        TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:modules/Resources/Public/Icons/iconmonstr-user-20.svg',
        ]
    );
//
// Allow backend users to drag and drop the new page type:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
    'options.pageTree.doktypesToShowInNewPageDragArea := addToList(1659186453)'
);
//
// Page TypoScript
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:modules/Configuration/PageTS/tsconfig.typoscript">'
);
//
// Handle authorizations
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['checkModifyAccessList']['modules'] =
    \CodingMs\Modules\Hook\DataHandlerCheckModifyAccessListHook::class;
//
// Override Mail template paths
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['templateRootPaths'][1659186453] = 'EXT:modules/Resources/Private/Templates/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['layoutRootPaths'][1659186453] = 'EXT:modules/Resources/Private/Layouts/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['partialRootPaths'][1659186453] = 'EXT:modules/Resources/Private/Partials/Email/';
