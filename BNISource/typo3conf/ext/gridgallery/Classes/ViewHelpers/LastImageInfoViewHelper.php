<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Lavitto\Gridgallery\ViewHelpers;

use InvalidArgumentException;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class LastImageInfoViewHelper
 *
 * Available properties: width, height, format, path, origFile
 * Example: {lo:lastImageInfo(property: 'width')}
 *
 * @package Lavitto\Gridgallery\ViewHelpers
 */
class LastImageInfoViewHelper extends AbstractViewHelper
{

    /**
     * Initialize the property-argument
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument(
            'property',
            'string',
            'Property to return: width, height, format, path, origFile',
            true
        );
    }

    /**
     * Returns the given property of the info-array of the most recent rendered image.
     *
     * @return string
     */
    public function render(): string
    {
        $output = '';
        $lastImageInfo = $GLOBALS['TSFE']->lastImageInfo ?? [];
        if (!empty($lastImageInfo)) {
            switch ($this->arguments['property']) {
                case 'width':
                    $output = $lastImageInfo[0] ?? '';
                    break;
                case 'height':
                    $output = $lastImageInfo[1] ?? '';
                    break;
                case 'format':
                    $output = $lastImageInfo[2] ?? '';
                    break;
                case 'path':
                    $output = $lastImageInfo[3] ?? '';
                    break;
                case 'origFile':
                    $output = $lastImageInfo['origFile'] ?? '';
                    break;
                default:
                    throw new InvalidArgumentException(
                        'Invalid property given (possible properties: width, height, format, path, origFile)',
                        1559561913
                    );
                    break;
            }
        }
        return $output;
    }
}
