<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Lavitto\Gridgallery\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class CaptionViewHelper
 *
 * @package Lavitto\Gridgallery\ViewHelpers
 */
class CaptionViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument(
            'properties',
            'array',
            'Properties from File',
            true
        );
        $this->registerArgument(
            'fields',
            'string',
            'Fieldnames separated by commas and ordered by priority'
        );
    }

    /**
     * Returns the width or height of an image by the given path
     *
     * @return string
     */
    public function render(): string
    {
        $caption = '';
        $properties = (array)$this->arguments['properties'];
        $fields = GeneralUtility::trimExplode(',', $this->arguments['fields']);
        if (!empty($fields)) {
            foreach ($fields as $field) {
                if (isset($properties[$field]) && $properties[$field]) {
                    $caption = $properties[$field];
                    break;
                }
            }
        }
        return $caption;
    }
}
