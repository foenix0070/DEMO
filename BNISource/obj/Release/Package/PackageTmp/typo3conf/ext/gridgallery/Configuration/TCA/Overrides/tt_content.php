<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:gridgallery/Resources/Private/Language/Tca.xlf:gridgallery_gallery',
        'gridgallery_gallery',
        'EXT:gridgallery/Resources/Public/Icons/ContentElements/gridgallery_gallery.svg'
    ],
    'CType',
    'gridgallery'
);

$GLOBALS['TCA']['tt_content']['palettes']['gridgallery_gallery'] = [
    'label' => 'LLL:EXT:gridgallery/Resources/Private/Language/Tca.xlf:gridgallery_gallery',
    'showitem' => 'image_zoom, 
        imageheight;LLL:EXT:gridgallery/Resources/Private/Language/Tca.xlf:tt_content.gridgallery_gallery.imageheight,
        imagewidth;LLL:EXT:gridgallery/Resources/Private/Language/Tca.xlf:tt_content.gridgallery_gallery.imagewidth,
        --linebreak--,
        pi_flexform;LLL:EXT:gridgallery/Resources/Private/Language/Tca.xlf:tt_content.gridgallery_gallery.pi_flexform'
];

$GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,gridgallery_gallery'] = 'FILE:EXT:gridgallery/Configuration/FlexForm/GridGallery.xml';
$GLOBALS['TCA']['tt_content']['types']['gridgallery_gallery'] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        assets,
        --palette--;;gridgallery_gallery,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,'
];
