<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:gridgallery/Configuration/TSconfig/page.tsconfig">
');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['gridgallery_gallery'] =
    \Lavitto\Gridgallery\Hooks\PageLayoutView\GridGalleryPreviewRenderer::class;
