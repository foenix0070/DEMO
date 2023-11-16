<?php

namespace CodingMs\FluidForm\Service;

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

use CodingMs\FluidForm\Utility\FileUpload;
use MathGuard;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Validation\Validator\EmailAddressValidator;

/**
 * Services for validate requests
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class ValidationService
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function injectObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param array $arguments
     * @param array $form
     * @return array validated form data
     */
    public function validateForm(array $form = [], array $arguments = [])
    {
        $form['valid'] = 1;
        $form['finished'] = 0;
        foreach ($form['fieldsets'] as $fieldsetKey => $fieldset) {
            $fieldset['key'] = 'form-' . $form['uid'] . '-' . $fieldsetKey;
            $form['fieldsets'][$fieldsetKey] = $this->validateFieldset($fieldset, $arguments);
            // Some error found?!
            if ($form['fieldsets'][$fieldsetKey]['valid'] === 0) {
                $form['valid'] = 0;
            }
        }
        return $form;
    }

    /**
     * Validates all fields within a fieldset
     *
     * @param $fieldset
     * @param $arguments
     * @return mixed
     */
    protected function validateFieldset(array $fieldset = [], array $arguments = [])
    {
        $fieldset['valid'] = 1;
        foreach ($fieldset['fields'] as $fieldKey => $field) {
            // Field needs to be validated
            if ($field['type'] !== 'Submit' && $field['type'] !== 'Notice') {
                // Validate a single field
                $field['key'] = $fieldset['key'] . '-' . $fieldKey;
                $fieldset['fields'][$fieldKey] = $this->validateFieldsetField($field, $arguments);
                // Some error found?!
                if ($fieldset['fields'][$fieldKey]['valid'] === 0) {
                    $fieldset['valid'] = 0;
                }
            }
        }
        return $fieldset;
    }

    /**
     * @param array $field
     * @param array $arguments
     * @return array
     */
    protected function validateFieldsetField(array $field = [], array $arguments = [])
    {
        $emailAddressValidator = null;
        $field['valid'] = 1;
        //
        // Get the argument value
        if (isset($arguments[$field['key']]) && is_string($arguments[$field['key']])) {
            $field['value'] = trim($arguments[$field['key']]);
        } else {
            $field['value'] = $arguments[$field['key']] ?? [];
        }
        //
        // Is required?!
        if ($field['required'] == 1) {
            $field['notices'] = [];
            // Validators available?!
            if (isset($field['validation']) && is_array($field['validation']) && !empty($field['validation'])) {
                foreach ($field['validation'] as $validator => $errorMessage) {
                    // Check for empty fields
                    if ($validator == 'NotEmpty') {
                        switch ($field['type']) {
                            case 'Hidden':
                                if ($field['value'] == '') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                            case 'Input':
                                // Input
                                if ($field['value'] == '') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                            case 'Textarea':
                                // Textarea
                                if ($field['value'] == '') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                            case 'DateTime':
                                // DateTime
                                if ($field['value'] == '') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                            case 'Checkbox':
                                // Checkbox
                                if ($field['value'] == '') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                            case 'Select':
                                if ($field['multiple']) {
                                    // Multiple value selection
                                    // Check if value is really an array. In case of non selected items, the value is type of string.
                                    if (is_array($field['value'])) {
                                        foreach ($field['value'] as $selectKey => $selectValue) {
                                            // If value isn't in definition, delete them
                                            if (!isset($field['options'][$selectValue])) {
                                                unset($field['value'][$selectKey]);
                                            }
                                        }
                                    } else {
                                        // Ensure that we are processing with an array value!
                                        $field['value'] = [];
                                    }
                                    // If there are no values let, the validation failed
                                    if (count($field['value']) === 0) {
                                        $field['messages']['error'] = $errorMessage;
                                        $field['notices'][] = $errorMessage;
                                    }
                                } else {
                                    // Single value selection
                                    if ($field['value'] == '' || $field['value'] == 'empty') {
                                        $field['messages']['error'] = $errorMessage;
                                        $field['notices'][] = $errorMessage;
                                    }
                                }
                                break;
                            case 'Radio':
                                if ($field['value'] == '' || $field['value'] == 'empty') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                            case 'Upload':
                                // http://php.net/manual/de/features.file-upload.errors.php
                                if (isset($field['value']['error']) && $field['value']['error'] === 4) {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                        }
                    } // Check for empty field
                    elseif ($validator == 'Empty') {
                        /**
                         * @todo können diese ['notices'] weg?
                         */
                        //$field['notices'][] = 'ENPT';
                        switch ($field['type']) {
                            case 'Hidden':
                                //$field['notices'][] = 'gefunden';
                                if ($field['value'] != '') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                            case 'Input':
                                if ($field['value'] != '') {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                        }
                    } // Check for valid email addresses
                    elseif ($validator == 'MathGuard') {
                        $answer = (int)GeneralUtility::_GP('mathguard_answer');
                        $code = trim(GeneralUtility::_GP('mathguard_code'));
                        if (!MathGuard::checkResult($answer, $code)) {
                            $field['messages']['error'] = $errorMessage;
                            $field['notices'][] = $errorMessage;
                        }
                    } // Check for valid email addresses
                    elseif ($validator == 'Email') {
                        switch ($field['type']) {
                            case 'Input':
                                // There must be a value
                                if ($field['value'] != '') {
                                    // Get validator
                                    if ($emailAddressValidator === null) {
                                        /** @var EmailAddressValidator $emailAddressValidator */
                                        $emailAddressValidator = $this->objectManager->get(EmailAddressValidator::class);
                                    }
                                    $validateEmail = $emailAddressValidator->validate($field['value']);
                                    if ($validateEmail->hasErrors()) {
                                        $field['messages']['error'] = $errorMessage;
                                        $field['notices'][] = $errorMessage;
                                    }
                                }
                                break;
                        }
                    }
                }
            }
            // Add error css class
            if (isset($field['messages']['error']) && !empty($field['messages']['error'])) {
                $field['css']['class']['wrapper'] .= 'is-invalid';
                $field['valid'] = 0;
            }
        }
        //
        // Validate file uploads
        if ($field['type'] === 'Upload') {
            if (isset($field['value']['error']) && $field['value']['error'] > 0) {
                switch ($field['value']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $errorMessage = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $errorMessage = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $errorMessage = 'The uploaded file was only partially uploaded';
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        // At this place, we don't check if an upload was performed.
                        // We only check for errors
                        //$errorMessage = "No file was uploaded";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $errorMessage = 'Missing a temporary folder';
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $errorMessage = 'Failed to write file to disk';
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $errorMessage = 'File upload stopped by extension';
                        break;
                    default:
                        $errorMessage = 'Unknown upload error';
                        break;
                }
                if ($field['value']['error'] !== 4) {
                    $field['messages']['error'] = $errorMessage;
                    $field['notices'][] = $errorMessage;
                    $field['valid'] = 0;
                }
            } else {
                $allowedFileTypes = $field['upload']['allowedFileTypes'];
                if (!FileUpload::checkExtension($field['value']['name'], $allowedFileTypes)) {
                    $errorMessage = 'Invalid file type/extension';
                    $field['messages']['error'] = $errorMessage;
                    $field['notices'][] = $errorMessage;
                    $field['valid'] = 0;
                }
            }
        }
        //
        if (isset($field['notices']) && count($field['notices']) > 0) {
            $field['message'] = implode('<br />', $field['notices']);
        }
        //
        // don't show the used validators in publicity
        unset($field['validation']);
        return $field;
    }
}
