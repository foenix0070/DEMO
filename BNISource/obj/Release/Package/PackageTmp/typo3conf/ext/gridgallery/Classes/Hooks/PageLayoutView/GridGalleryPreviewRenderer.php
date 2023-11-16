<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Lavitto\Gridgallery\Hooks\PageLayoutView;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class GridGalleryPreviewRenderer
 *
 * @package Lavitto\Gridgallery\Hooks\PageLayoutView
 */
class GridGalleryPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

    /**
     * Preprocesses the preview rendering of a content element of type "gridgallery_gallery"
     *
     * @param PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     */
    public function preProcess(
        PageLayoutView &$parentObject,
        &$drawItem,
        &$headerContent,
        &$itemContent,
        array &$row
    ): void {
        if ($row['CType'] === 'gridgallery_gallery') {
            if ($row['assets']) {
                $itemContent .= $parentObject->linkEditContent($parentObject->getThumbCodeUnlinked($row, 'tt_content',
                        'assets'), $row) . '<br />';
            }

            $infos = [];
            if ($row['imageheight'] > 0) {
                $infos[] = '<strong>' . LocalizationUtility::translate('LLL:EXT:gridgallery/Resources/Private/Language/Tca.xlf:tt_content.gridgallery_gallery.imageheight') . ':</strong> ' . $row['imageheight'] . 'px';
            }
            if ($row['imagewidth'] > 0) {
                $infos[] = '<strong>' . LocalizationUtility::translate('LLL:EXT:gridgallery/Resources/Private/Language/Tca.xlf:tt_content.gridgallery_gallery.imagewidth') . ':</strong> ' . $row['imagewidth'] . 'px';
            }

            if (!empty($infos)) {
                $itemContent .= $parentObject->linkEditContent(implode(' / ', $infos), $row);
            }

            $drawItem = false;
        }
    }
}
