<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Lavitto\Gridgallery\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class DivisionViewHelper
 *
 * Calculates the division of two integers
 *
 * @package Lavitto\Gridgallery\ViewHelpers
 */
class DivisionViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument(
            'a',
            'string',
            'first number',
            true
        );
        $this->registerArgument(
            'b',
            'string',
            'second number'
        );
    }

    /**
     * Calculates the division of a and b
     *
     * @return int
     */
    public function render(): int
    {
        $a = (int)$this->arguments['a'];
        $b = (float)$this->arguments['b'];
        return $b > 0 ? round($a / $b) : 0;
    }
}
