<?php

namespace CodingMs\FluidForm\Service\Finisher;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use CodingMs\FluidForm\Domain\Model\Field;
use CodingMs\FluidForm\Domain\Model\FileReference;
use CodingMs\FluidForm\Domain\Model\Form;
use Exception;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

/**
 * Database finishing service
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class DatabaseService extends AbstractService
{
    /**
     * Validates all fields within a fieldset
     *
     * @param array $form
     * @param array $finisher
     * @param UriBuilder $uriBuilder
     * @param array $session
     * @return bool|mixed
     * @throws Exception
     */
    public function finish($form, $finisher, UriBuilder $uriBuilder, array &$session = [])
    {
        $success = true;
        /** @var Form $formObject */
        $formObject = GeneralUtility::makeInstance(Form::class);
        $formObject->setPid($finisher['storagePid']);
        $formObject->setFormKey($form['key']);
        $formObject->setFormUid($form['uid']);
        $formObject->setUniqueId($session['uniqueId']);
        foreach ($form['fieldsets'] as $fieldsetKey => $fieldset) {
            foreach ($fieldset['fields'] as $fieldKey => $field) {
                $fieldUniqueId = 'form-' . $form['uid'] . '-' . $fieldsetKey . '-' . $fieldKey;
                /** @var Field $fieldObject */
                $fieldObject = GeneralUtility::makeInstance(Field::class);
                $fieldObject->setPid($finisher['storagePid']);
                $fieldObject->setFieldType($field['type']);
                $fieldObject->setFieldKey($fieldKey);
                $fieldObject->setFieldLabel($field['label']);
                // Don't print field in database?!
                if (isset($field['excludeFromDb']) && (int)$field['excludeFromDb'] === 1) {
                    continue;
                }
                // Print field depending on field type
                switch ($field['type']) {
                    case 'Hidden':
                        $fieldObject->setFieldValue($field['value']);
                        break;
                    case 'Input':
                        // Input
                        $fieldObject->setFieldValue($field['value']);
                        break;
                    case 'DateTime':
                        // DateTime
                        $fieldObject->setFieldValue($field['value']);
                        break;
                    case 'Textarea':
                        // Textarea
                        $fieldObject->setFieldValue($field['value']);
                        break;
                    case 'Select':
                        if ($field['multiple']) {
                            $selectValues = [];
                            if (count($field['value']) > 0) {
                                foreach ($field['value'] as $selectValue) {
                                    if (isset($field['options'][$selectValue])) {
                                        $selectValues[] = $field['options'][$selectValue];
                                    }
                                }
                            }
                            if (count($selectValues) > 0) {
                                $fieldObject->setFieldValue(implode(', ', $selectValues));
                            } else {
                                $fieldObject->setFieldValue('-/-');
                            }
                        } else {
                            $fieldObject->setFieldValue($field['options'][$field['value']]);
                        }
                        break;
                    case 'Radio':
                        $fieldObject->setFieldValue($field['options'][$field['value']]);
                        break;
                    case 'Checkbox':
                        if (trim($field['label']) != '') {
                            $fieldObject->setFieldLabel(strip_tags($field['label']));
                        }
                        break;
                    case 'Upload':
                        /** @var File $file */
                        $file = $session['uploads'][$fieldUniqueId]['file'];
                        $downloadFilename = $session['uploads'][$fieldUniqueId]['downloadFilename'];
                        if ($file instanceof File) {
                            /** @var FileReference $fileReference */
                            $fileReference = GeneralUtility::makeInstance(FileReference::class);
                            $fileReference->setFile($file);
                            $fileReference->setDownloadFilename($downloadFilename);
                            $fieldObject->setFieldUpload($fileReference);
                        }
                        unset($session['uploads'][$fieldUniqueId]['file']);
                        break;
                }
                $formObject->addField($fieldObject);
            }
        }
        $this->formRepository->add($formObject);
        $this->persistenceManager->persistAll();
        $session['formObjectUid'] = $formObject->getUid();
        return $success;
    }
}
