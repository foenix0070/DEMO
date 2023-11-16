<?php

namespace CodingMs\Modules\ViewHelpers\Format;

/***************************************************************
 *  Copyright notice
 *  (c) 2016 Thomas Deuling <typo3@coding.ms>, www.coding.ms
 *
 *  All rights reserved
 *  License for this script located in "\License\License.pdf"
 *  Neither this script nor parts of it are permitted for free distribution!
 ***************************************************************/

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Replaces $substring in $content with $replacement.
 */
class ReplaceViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Initialize
     */
    public function initializeArguments()
    {
        $this->registerArgument('substring', 'string', 'String that should be found');
        $this->registerArgument('content', 'string', 'Content wherein the substring should be replaced');
        $this->registerArgument('replacement', 'string', 'Substring replacement');
        $this->registerArgument('count', 'int', 'Amount of replacements');
    }

    /**
     * Trims content by stripping off $characters
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        if (null === $arguments['content']) {
            $arguments['content'] = $renderChildrenClosure();
        }
        return str_replace(
            $arguments['substring'],
            $arguments['replacement'],
            $arguments['content'],
            $arguments['count']
        );
    }
}
