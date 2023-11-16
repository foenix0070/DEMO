<?php

namespace CodingMs\Modules\ViewHelpers\Be;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

/**
 * Insert a header for backend modules
 */
class HeaderViewHelper extends AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    protected $escapeOutput = false;
    protected $escapeChildren = false;

    /**
     * Initialize
     */
    public function initializeArguments()
    {
        $this->registerArgument('header', 'string', 'Backend header element title');
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
        $logoPath = GeneralUtility::getFileAbsFileName('EXT:modules/Resources/Public/Images/codingms.svg');
        return '<h1 style="position: relative">' . $arguments['header'] . '
            <a style="position: absolute; right: 0; display: block; top: -8px; width: 160px; padding: 8px;"
                target="_blank" title="More TYPO3-Extensions by coding.ms"
                href="https://www.coding.ms/typo3-extensions">' . file_get_contents($logoPath) . '
            </a>
        </h1>';
    }
}
