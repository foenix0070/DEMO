<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Lavitto\Gridgallery\ViewHelpers;

use Closure;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Class RemoveWhitespaceViewHelper
 *
 * @package Lavitto\Gridgallery\ViewHelpers
 */
class RemoveWhitespaceViewHelper extends AbstractViewHelper
{

    use CompileWithRenderStatic;

    /**
     * Do not escape output
     *
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * Replace multiple whitespaces with a single whitespace
     *
     * @param array $arguments
     * @param Closure $childClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        Closure $childClosure,
        RenderingContextInterface $renderingContext
    ): string {
        return trim(preg_replace('/\s+/', ' ', $childClosure()));
    }
}
