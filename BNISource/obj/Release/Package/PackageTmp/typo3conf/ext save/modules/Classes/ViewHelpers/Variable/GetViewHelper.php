<?php

namespace CodingMs\Modules\ViewHelpers\Variable;

use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class GetViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    public function initializeArguments()
    {
        $this->registerArgument('name', 'string', 'Name of variable to retrieve');
        $this->registerArgument(
            'useRawKeys',
            'boolean',
            'If TRUE, the path is directly passed to ObjectAccess. If FALSE, a custom and compatible VHS method is used'
        );
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $variableProvider = $renderingContext->getVariableProvider();
        $name = $arguments['name'];
        $useRawKeys = $arguments['useRawKeys'];
        if (false === strpos($name, '.')) {
            if (true === $variableProvider->exists($name)) {
                return $variableProvider->get($name);
            }
        } else {
            $segments = explode('.', $name);
            $lastSegment = array_shift($segments);
            $templateVariableRootName = $lastSegment;
            if (true === $variableProvider->exists($templateVariableRootName)) {
                $templateVariableRoot = $variableProvider->get($templateVariableRootName);
                if (true === $useRawKeys) {
                    return ObjectAccess::getPropertyPath($templateVariableRoot, implode('.', $segments));
                }
                try {
                    $value = $templateVariableRoot;
                    foreach ($segments as $segment) {
                        if (true === ctype_digit($segment)) {
                            $segment = intval($segment);
                            $index = 0;
                            $found = false;
                            // Note: this loop approach is not a stupid solution. If you doubt this,
                            // attempt to feth a number at a numeric index from ObjectStorage ;)
                            foreach ($value as $possibleValue) {
                                if ($index === $segment) {
                                    $value = $possibleValue;
                                    $found = true;
                                    break;
                                }
                                ++$index;
                            }
                            if (!$found) {
                                return null;
                            }
                            continue;
                        }
                        $value = ObjectAccess::getProperty($value, $segment);
                    }
                    return $value;
                } catch (\Exception $e) {
                    return null;
                }
            }
        }
        return null;
    }
}
