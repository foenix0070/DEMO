<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Lavitto\Gridgallery\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class ImageSizeViewHelper
 *
 * @package Lavitto\Gridgallery\ViewHelpers
 */
class ImageSizeViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument(
            'src',
            'string',
            'Path to the image file to determine info for.',
            true
        );
        $this->registerArgument(
            'type',
            'string',
            'possible values: "width" or "height"'
        );
    }

    /**
     * Returns the width or height of an image by the given path
     *
     * @return int
     * @throws Exception
     */
    public function render(): int
    {
        $src = $this->arguments['src'] ?? null;
        if ($src === null) {
            throw new Exception('No source image given', 1560760753);
        }
        $type = $this->arguments['type'] === 'width' ? 0 : 1;
        if (filter_var($src, FILTER_VALIDATE_URL) !== false) {
            $file = $src;
        } else {
            $file = GeneralUtility::getFileAbsFileName($this->getRelativePath($src));
            if (false === file_exists($file) || true === is_dir($file)) {
                throw new Exception('Cannot determine info for "' . $file . '".', 1560760754);
            }
        }
        $imageSize = getimagesize($file);
        return (int)$imageSize[$type];
    }

    /**
     * Converts an absolute path to a relative path
     *
     * @param string $absolutePath
     * @return string
     */
    protected function getRelativePath(string $absolutePath): string
    {
        return ltrim($absolutePath, GeneralUtility::getIndpEnv('TYPO3_SITE_PATH'));
    }
}
