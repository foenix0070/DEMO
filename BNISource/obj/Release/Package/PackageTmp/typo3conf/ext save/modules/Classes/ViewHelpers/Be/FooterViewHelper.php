<?php

namespace CodingMs\Modules\ViewHelpers\Be;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

/**
 * Insert a footer for backend modules
 */
class FooterViewHelper extends AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    /**
     * Initialize
     */
    public function initializeArguments()
    {
        $this->registerArgument('footer', 'string', 'Backend footer element title');
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
        return '<p style="color: #c3c3c3; text-align: right">
            This module by powered by
            <a href="https://www.typo3.org" target="_blank" style="color: #c3c3c3; text-decoration: underline" title="Visit TYPO3">TYPO3</a> and
            <a href="https://www.coding.ms/typo3-extensions" target="_blank" style="color: #c3c3c3; text-decoration: underline" title="Visit coding.ms">coding.ms</a>
        </p>';
    }
}
