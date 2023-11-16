<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'FluidForm',
    'Form',
    [
        \CodingMs\FluidForm\Controller\FluidFormController::class => 'show,download'
    ],
    // non-cacheable actions
    [
        \CodingMs\FluidForm\Controller\FluidFormController::class => 'show,download'
    ]
);

$tsConfig = '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fluid_form/Configuration/PageTS/tsconfig.typoscript">';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($tsConfig);

if (!class_exists('\MathGuard')) {
    include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('fluid_form') . '/Resources/Private/Php/MathGuard/MathGuard.php');
}

// Register for hook to show preview in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['fluid_form'] =
    \CodingMs\FluidForm\Hooks\PageLayoutView\FormContentElementPreviewRenderer::class;
//
// Override Mail template paths
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['templateRootPaths'][1661595067] = 'EXT:fluid_form/Resources/Private/Templates/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['layoutRootPaths'][1661595067] = 'EXT:fluid_form/Resources/Private/Layouts/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['partialRootPaths'][1661595067] = 'EXT:fluid_form/Resources/Private/Partials/Email/';
//
// register svg icons: identifier and filename
$iconsSvg = [
    'contains-mails' => 'ext_icon.svg',
    'apps-pagetree-folder-contains-mails' => 'ext_icon.svg',
    'mimetypes-x-content-fluid-form-mail' => 'Resources/Public/Icons/iconmonstr-email-9.svg',
    'mimetypes-x-content-fluid-form-field' => 'Resources/Public/Icons/iconmonstr-email-9.svg',
    'module-fluid-form' => 'Resources/Public/Icons/module-fluid-form.svg',
];
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($iconsSvg as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:fluid_form/' . $path]
    );
}
