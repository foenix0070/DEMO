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
 * Class FlexFormViewHelper
 *
 * @package Lavitto\Gridgallery\ViewHelpers
 */
class FlexFormViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments(): void
    {
        $this->registerArgument(
            'flexform',
            'string',
            'The flexform-xml of the content element',
            true
        );
        $this->registerArgument(
            'option',
            'string',
            'The option to get from flexform array',
            true
        );
        $this->registerArgument(
            'defaultValue',
            'string',
            'The default value if there is no value in the flexform array'
        );
    }

    /**
     * Returns the value of a flexform option
     *
     * @return string
     * @throws Exception
     */
    public function render(): string
    {
        $option = $this->arguments['option'] ?? null;
        if ($option === null) {
            throw new Exception('No option given', 1566396622);
        }
        $flexFormContent = $this->arguments['flexform'] ?? null;
        if ($flexFormContent !== null) {
            $flexFormArray = $this->getFlexFormService()->convertFlexFormContentToArray($flexFormContent);
        }
        return $flexFormArray[$option] ?? $this->arguments['defaultValue'] ?? '';
    }

    /**
     * Returns the FlexFormService
     *
     * @return object
     */
    protected function getFlexFormService()
    {
        if(version_compare(TYPO3_branch, '9.5', '>=')) {
            /** @noinspection ClassConstantCanBeUsedInspection */
            $flexFormServiceClass = 'TYPO3\CMS\Core\Service\FlexFormService';
        } else {
            /** @noinspection ClassConstantCanBeUsedInspection */
            $flexFormServiceClass = 'TYPO3\CMS\Extbase\Service\FlexFormService';
        }
        return GeneralUtility::makeInstance($flexFormServiceClass);
    }
}
