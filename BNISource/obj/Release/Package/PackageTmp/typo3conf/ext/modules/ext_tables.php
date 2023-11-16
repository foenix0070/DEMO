<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
if (TYPO3_MODE === 'BE') {
    //
    // Extension configuration
    $configuration = \CodingMs\Modules\Utility\ExtensionUtility::getExtensionConfiguration('modules');
    //
    // Page type
    $GLOBALS['PAGES_TYPES'][1659186453] = [
        'type' => 'web',
        // ATTENTION: Don't insert line breaks into the "allowedTables" - this will break this functionality!
        'allowedTables' => implode(
            ',',
            [
                'fe_users',
                'fe_groups',
                'sys_file_reference',
                'pages',
            ]
        ),
    ];
    //
    // Registers a Backend Module
    if (!(bool)$configuration['module']['frontendUser']['disable']) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Modules',
            'web',
            'frontenduser',
            '',
            [
                \CodingMs\Modules\Controller\FrontendUserBackendController::class => 'list,listFrontendUserGroups,listInvitationCodes,importInvitationCodes',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:modules/Resources/Public/Icons/module-frontenduser.svg',
                'iconIdentifier' => 'module-frontenduser',
                'labels' => 'LLL:EXT:modules/Resources/Private/Language/locallang_frontenduser.xlf',
            ]
        );
    }
    //
    // Registers a Backend Module
    if (!(bool)$configuration['module']['backendUser']['disable']) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Modules',
            'system',
            'backenduser',
            'top',
            [
                \CodingMs\Modules\Controller\BackendUserBackendController::class => 'list',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:modules/Resources/Public/Icons/module-backenduser.svg',
                'iconIdentifier' => 'module-backenduser',
                'labels' => 'LLL:EXT:modules/Resources/Private/Language/locallang_backenduser.xlf',
            ]
        );
    }
}
//
// register svg icons: identifier and filename
$iconsSvg = [
    'module-frontenduser' => 'Resources/Public/Icons/module-frontenduser.svg',
    'module-backenduser' => 'Resources/Public/Icons/module-backenduser.svg',
    'mimetypes-x-content-profile' => 'Resources/Public/Icons/iconmonstr-user-20.svg',
    'mimetypes-x-content-modules-invitationcode' => 'Resources/Public/Icons/iconmonstr-key-13.svg',
];
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($iconsSvg as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:modules/' . $path]
    );
}
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_modules_domain_model_invitationcode'
);
//
// Authorizations in backend
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_backend_user_action_permissions'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\BackendUserActionPermission::class
    );
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_frontend_user'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\FrontendUserActionPermission::class
    );
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_frontend_user_group'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\FrontendUserGroupActionPermission::class
    );
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_frontend_user_invitation_code'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\FrontendUserInvitationCodeActionPermission::class
    );
