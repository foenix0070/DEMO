<?php

namespace CodingMs\Modules\ViewHelpers\Variable;

use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class SetViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeChildren = false;

    public function initializeArguments()
    {
        $this->registerArgument('value', 'mixed', 'Value to set');
        $this->registerArgument('name', 'string', 'Name of variable to assign');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $name = $arguments['name'];
        $value = $renderChildrenClosure();
        if ($value === null) {
            $value = $arguments['value'];
        }
        $variableProvider = $renderingContext->getVariableProvider();
        if (false === strpos($name, '.')) {
            if (true === $variableProvider->exists($name)) {
                $variableProvider->remove($name);
            }
            $variableProvider->add($name, $value);
        } elseif (1 === mb_substr_count($name, '.')) {
            $parts = explode('.', $name);
            $objectName = array_shift($parts);
            $path = implode('.', $parts);
            if (false === $variableProvider->exists($objectName)) {
                return null;
            }
            $object = $variableProvider->get($objectName);
            try {
                ObjectAccess::setProperty($object, $path, $value);
                // Note: re-insert the variable to ensure unreferenced values like arrays also get updated
                $variableProvider->remove($objectName);
                $variableProvider->add($objectName, $object);
            } catch (\Exception $error) {
                return null;
            }
        }
        return null;
    }
}
