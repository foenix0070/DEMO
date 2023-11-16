<?php

declare(strict_types=1);

namespace CodingMs\Modules\Service;

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

use MathGuard;
use PDO;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Object\Exception as ObjectException;
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
     * @param array $arguments
     * @param array $form
     * @param AbstractEntity $object In case of editing the object, in case of creation null
     * @return array validated form data
     * @throws ObjectException
     */
    public function validateForm(array $form = [], array $arguments = [], AbstractEntity $object = null)
    {
        $form['valid'] = 1;
        $form['finished'] = 0;
        foreach ($form['fieldsets'] as $fieldsetKey => $fieldset) {
            $fieldset['key'] = $fieldsetKey;
            $form['fieldsets'][$fieldsetKey] = $this->validateFieldset($fieldset, $arguments, $object, $form);
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
     * @param array $fieldset
     * @param array $arguments
     * @param AbstractEntity $object In case of editing the object, in case of creation null
     * @param array $form
     * @return mixed
     * @throws ObjectException
     */
    protected function validateFieldset(array $fieldset = [], array $arguments = [], AbstractEntity $object = null, array $form = [])
    {
        $fieldset['valid'] = 1;
        foreach ($fieldset['fields'] as $fieldKey => $field) {
            // Field needs to be validated
            if ($field['type'] !== 'Submit' && $field['type'] !== 'Notice') {
                // Validate a single field
                $field['key'] = $fieldKey;
                $fieldset['fields'][$fieldKey] = $this->validateFieldsetField($field, $arguments, $object, $form);
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
     * @param AbstractEntity $object In case of editing the object, in case of creation null
     * @param array $form
     * @return array
     * @throws ObjectException
     */
    protected function validateFieldsetField(array $field = [], array $arguments = [], AbstractEntity $object = null, array $form = [])
    {
        $field['valid'] = 1;
        if (in_array($field['type'], ['Button', 'Divider'])) {
            //
            // Buttons and Divider doesn't need a validation
            unset($field['validation']);
            return $field;
        }
        //
        // Get the argument value
        if (isset($arguments[$field['key']])) {
            if (is_string($arguments[$field['key']])) {
                $field['value'] = trim($arguments[$field['key']]);
            } else {
                $field['value'] = $arguments[$field['key']];
            }
        }
        //
        // Value is empty and a valueIfEmpty is defined?
        if (isset($field['value']) && !is_array($field['value']) && $field['type'] !== 'Files') {
            if (($field['value'] === null || trim($field['value']) === '')
                && isset($field['valueIfEmpty']) && trim($field['valueIfEmpty']) !== '') {
                $field['value'] = $field['valueIfEmpty'];
            }
        }
        //
        // Select and checkboxes values must be mapped into options array
        if ($field['type'] === 'Select') {
            $field = $this->prepareSelect($field);
            //
            // Ensure that there is a valid selection
            $hasValidSelection = false;
            foreach ($field['options'] as $optionKey => $optionData) {
                if ($field['options'][$optionKey]['selected']) {
                    $hasValidSelection = true;
                    break;
                }
            }
            if (!$hasValidSelection) {
                $field['css']['class']['wrapper'] .= ' is-invalid-field ';
                $field['css']['class']['field'] .= ' is-invalid ';
                $field['valid'] = 0;
                return $field;
            }
        }
        if ($field['type'] === 'Checkboxes') {
            $field = $this->prepareCheckboxes($field, $arguments);
        }
        //
        // Prepare single checkbox
        if ($field['type'] === 'Checkbox') {
            $field = $this->prepareCheckbox($field);
        }
        //
        // Files
        if ($field['type'] === 'Files') {
            $field = $this->prepareFiles($field, $arguments);
        }
        //
        // Textarea
        if ($field['type'] === 'Textarea') {
            $field = $this->prepareTextarea($field, $arguments);
        }
        //
        //
        if ($field['type'] === 'DateTime') {
            $field = $this->prepareDateTime($field, $arguments);
        }
        //
        //
        // Is required?!
        if ($field['required'] == 1) {
            $field['notices'] = [];
            // Validators available?!
            if (isset($field['validation']) && is_array($field['validation']) && !empty($field['validation'])) {
                foreach ($field['validation'] as $validator => $errorMessage) {
                    // Check for empty fields
                    if ($validator === 'NotEmpty') {
                        if (in_array($field['type'], ['Hidden', 'Input', 'Textarea', 'DateTime', 'Checkbox', 'Email'])) {
                            if (!$this->validateNotEmpty($field)) {
                                $field['messages']['error'] = $errorMessage;
                                $field['notices'][] = $errorMessage;
                            }
                        }
                        if (in_array($field['type'], ['Select', 'Radio'])) {
                            if (!$this->validateNotEmpty($field, 'empty')) {
                                $field['messages']['error'] = $errorMessage;
                                $field['notices'][] = $errorMessage;
                            }
                        }
                        if (in_array($field['type'], ['Slug'])) {
                            if (!$this->validateNotEmpty($field, '/')) {
                                $field['messages']['error'] = $errorMessage;
                                $field['notices'][] = $errorMessage;
                            }
                        }

                        /*
                        switch ($field['type']) {


                            case 'Upload':
                                // http://php.net/manual/de/features.file-upload.errors.php
                                if (isset($field['value']['error']) && $field['value']['error'] === 4) {
                                    $field['messages']['error'] = $errorMessage;
                                    $field['notices'][] = $errorMessage;
                                }
                                break;
                        }
                        */
                    } elseif ($validator === 'Empty') {
                        // Check for empty field
                        if (in_array($field['type'], ['Hidden', 'Input'])) {
                            if (!$this->validateEmpty($field)) {
                                $field['messages']['error'] = $errorMessage;
                                $field['notices'][] = $errorMessage;
                            }
                        }
                    }
                }
            }
            // Add error css class
            if (isset($field['messages']['error']) && !empty($field['messages']['error'])) {
                $field['css']['class']['wrapper'] .= ' is-invalid-field ';
                $field['css']['class']['field'] .= ' is-invalid ';
                $field['valid'] = 0;
            }
        }

        //
        // Validate file uploads
        /*
        if ($field['type'] === 'Upload') {
            if (isset($field['value']['error']) && $field['value']['error'] > 0) {
                switch ($field['value']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $errorMessage = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $errorMessage = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $errorMessage = "The uploaded file was only partially uploaded";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        // At this place, we don't check if an upload was performed.
                        // We only check for errors
                        //$errorMessage = "No file was uploaded";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $errorMessage = "Missing a temporary folder";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $errorMessage = "Failed to write file to disk";
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $errorMessage = "File upload stopped by extension";
                        break;
                    default:
                        $errorMessage = "Unknown upload error";
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
        */

        //
        //
        // Validations in general
        if (isset($field['validation']) && is_array($field['validation']) && !empty($field['validation'])) {
            foreach ($field['validation'] as $validator => $errorMessage) {
                // Check for valid email addresses
                if ($validator === 'MathGuard') {
                    if (!MathGuard::checkResult(GeneralUtility::_GP('mathguard_answer'), GeneralUtility::_GP('mathguard_code'))) {
                        $field['messages']['error'] = $errorMessage;
                        $field['notices'][] = $errorMessage;
                    }
                } // Check for valid email addresses
                elseif ($validator === 'Email' && $field['type'] === 'Input') {
                    if (!$this->validateEmail($field)) {
                        $field['messages']['error'] = $errorMessage;
                        $field['notices'][] = $errorMessage;
                    }
                }
                //
                // Slug validation
                elseif ($validator === 'Slug') {
                    if (!$this->validateSlug($field)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                }
                //
                // Slug unique
                elseif ($validator === 'SlugUnique') {
                    if (!$this->validateSlugUnique($field, $object)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                }
                //
                // Field unique
                elseif ($validator === 'Unique') {
                    if (!$this->validateUnique($field, $object, $form)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                }
                //
                // Max length of strings
                elseif ($validator === 'MaxLength') {
                    if (!$this->validateMaxLength($field)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                }
                //
                // Field value is integer
                elseif ($validator === 'Integer') {
                    if (!$this->validateInteger($field)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                }
                //
                // Field value is float
                elseif ($validator === 'Float') {
                    if (!$this->validateFloat($field)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                } //
                elseif ($validator === 'FileType') {
                    if (!$this->validateFileType($field)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                } //
                elseif ($validator === 'FileSize') {
                    if (!$this->validateFileSize($field)) {
                        $field['messages']['error'] = $errorMessage;
                    }
                }
                /**
                 * @todo check max files
                 */
                // Add error css class
                if (isset($field['messages']['error']) && !empty($field['messages']['error'])) {
                    $field['css']['class']['wrapper'] .= ' is-invalid-field ';
                    $field['css']['class']['field'] .= ' is-invalid ';
                    $field['valid'] = 0;
                }
            }
        }
        //
        // Prepare message
        if (isset($field['notices']) && count($field['notices']) > 0) {
            $field['message'] = implode('<br />', $field['notices']);
        }
        //
        // don't show the used validators in publicity
        unset($field['validation']);
        return $field;
    }

    /**
     * @param array $field
     * @return array
     */
    protected function prepareSelect(array $field)
    {
        foreach ($field['options'] as $optionKey => $optionData) {
            $field['options'][$optionKey]['selected'] = ((string)$optionData['value'] === $field['value']);
        }
        return $field;
    }

    /**
     * @param array $field
     * @param array $arguments
     * @return array
     */
    protected function prepareCheckboxes(array $field, array $arguments)
    {
        if (is_array($arguments[$field['key']])) {
            foreach ($field['options'] as $optionKey => $optionData) {
                $field['options'][$optionKey]['checked'] = in_array((string)$optionData['value'], $arguments[$field['key']]);
            }
        }
        return $field;
    }

    /**
     * @param array $field
     * @return array
     */
    protected function prepareCheckbox(array $field)
    {
        if ($field['value'] === '1') {
            $field['checked'] = true;
        } else {
            $field['checked'] = false;
            // Ensure checkbox HTML value is still 1
            $field['value'] = '1';
        }
        return $field;
    }

    /**
     * @param array $field
     * @param array $arguments
     * @return array
     */
    protected function prepareTextarea(array $field, array $arguments)
    {
        if ($field['stripTags'] === '1') {
            $field['value'] = strip_tags($arguments[$field['key']]);
        }
        return $field;
    }

    /**
     * @param array $field
     * @param array $arguments
     * @return array
     */
    protected function prepareDateTime(array $field, array $arguments): array
    {
        if (trim($field['value']) === 'NaN') {
            $field['value'] = '';
        }
        return $field;
    }

    /**
     * @param array $field
     * @param array $arguments
     * @return array
     */
    protected function prepareFiles(array $field, array $arguments)
    {
        $field['value'] = [];
        $field['update'] = [];
        $field['delete'] = [];
        $field['upload'] = [];
        //
        // Prepare parameter
        $prefix = $field['key'] . '-';
        foreach ($arguments as $argumentKey => $argumentValue) {
            if (substr($argumentKey, 0, strlen($prefix)) === $prefix) {
                $argumentKeyParts = explode('-', $argumentKey);
                if (in_array($argumentKeyParts[1], ['title', 'alternative', 'description'])) {
                    $field['update'][$argumentKeyParts[2]][$argumentKeyParts[1]] = $argumentValue;
                }
                if ($argumentKeyParts[1] === 'delete') {
                    if ((bool)$argumentValue) {
                        $field['delete'][$argumentKeyParts[2]] = $argumentKeyParts[2];
                    }
                }
                if ($argumentKeyParts[1] === 'upload') {
                    if ($argumentValue[0]['error'] !== 4) {
                        $field['upload'] = $argumentValue;
                    }
                }
            }
        }
        return $field;
    }

    /**
     * @param array $field
     * @param string $additionalCompare
     * @return bool
     */
    protected function validateNotEmpty(array $field, string $additionalCompare = '')
    {
        if ($field['value'] === '') {
            return false;
        }
        if (trim($additionalCompare) !== '' && $field['value'] === $additionalCompare) {
            return false;
        }
        return true;
    }

    /**
     * @param array $field
     * @return bool
     */
    protected function validateEmpty(array $field)
    {
        if ($field['value'] !== '') {
            return false;
        }
        return true;
    }

    /**
     * @param array $field
     * @return bool
     */
    protected function validateMaxLength(array $field)
    {
        $maxLength = (int)$field['maxLength'];
        if ($maxLength > 0 && strlen($field['value']) > $maxLength) {
            return false;
        }
        return true;
    }

    /**
     * @param array $field
     * @return bool
     */
    protected function validateInteger(array $field)
    {
        return ctype_digit($field['value']);
    }

    /**
     * @param array $field
     * @return bool
     */
    protected function validateFloat(array $field): bool
    {
        $filtered = filter_var($field['value'], FILTER_VALIDATE_FLOAT);
        return is_bool($filtered) ? $filtered : true;
    }

    /**
     * @param array $field
     * @return bool
     * @throws ObjectException
     */
    protected function validateEmail(array $field)
    {
        /** @var EmailAddressValidator $emailValidator */
        $emailValidator = GeneralUtility::makeInstance(EmailAddressValidator::class);
        $validateEmail = $emailValidator->validate($field['value']);
        if ($validateEmail->hasErrors()) {
            return false;
        }
        return true;
    }

    /**
     * @param array $field
     * @return bool
     */
    protected function validateSlug(array $field)
    {
        $valueFiltered = preg_replace("/[^A-Za-z0-9\-]/", '', $field['value']);
        if ('/' . $valueFiltered !== $field['value']) {
            return false;
        }
        return true;
    }

    /**
     * @param array $field
     * @param AbstractEntity|null $object
     * @return bool
     * @throws ObjectException
     */
    protected function validateSlugUnique(array $field, AbstractEntity $object = null)
    {
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable($field['table']);
        //
        // Remove all restrictions but add DeletedRestriction again
        /** @var DeletedRestriction $deletedRestriction */
        $deletedRestriction = GeneralUtility::makeInstance(DeletedRestriction::class);
        $queryBuilder
            ->getRestrictions()
            ->removeAll()
            ->add($deletedRestriction);
        //
        // Build query for checking duplicates
        $queryBuilder->count('uid')
            ->from($field['table'])
            ->where(
                $queryBuilder->expr()->eq(
                    $field['key'],
                    $queryBuilder->createNamedParameter($field['value'], PDO::PARAM_STR)
                )
            );
        //
        // In case of object is already persisted, ignore self object!
        if ($object instanceof AbstractEntity) {
            $queryBuilder->andWhere(
                $queryBuilder->expr()->neq(
                    'uid',
                    $queryBuilder->createNamedParameter($object->getUid(), PDO::PARAM_STR)
                )
            );
        }
        // Attention: Don't use fetchOne(), it's not available in older versions of Doctrine DBAL
        if ($queryBuilder->execute()->fetchColumn() > 0) {
            return false;
        }
        return true;
    }

    /**
     * @param array $field
     * @param AbstractEntity|null $object
     * @param array $form
     * @return bool
     * @throws ObjectException
     */
    protected function validateUnique(array $field, AbstractEntity $object = null, array $form = [])
    {
        $fieldName = GeneralUtility::camelCaseToLowerCaseUnderscored($field['key']);
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable($form['table']);
        //
        // Remove all restrictions but add DeletedRestriction again
        /** @var DeletedRestriction $deletedRestriction */
        $deletedRestriction = GeneralUtility::makeInstance(DeletedRestriction::class);
        $queryBuilder
            ->getRestrictions()
            ->removeAll()
            ->add($deletedRestriction);
        //
        // Build query for checking duplicates
        $queryBuilder->count('uid')
            ->from($form['table'])
            ->where(
                $queryBuilder->expr()->eq(
                    $fieldName,
                    $queryBuilder->createNamedParameter($field['value'], PDO::PARAM_STR)
                )
            );
        //
        // In case of object is already persisted, ignore self object!
        if ($object instanceof AbstractEntity) {
            $queryBuilder->andWhere(
                $queryBuilder->expr()->neq(
                    'uid',
                    $queryBuilder->createNamedParameter($object->getUid(), PDO::PARAM_STR)
                )
            );
        }
        // Attention: Don't use fetchOne(), it's not available in older versions of Doctrine DBAL
        if ($queryBuilder->execute()->fetchColumn() > 0) {
            return false;
        }
        return true;
    }

    /**
     * @param array $field
     * @return bool
     */
    protected function validateFileType(array $field)
    {
        foreach ($field['upload'] as $upload) {
            $validFileExtension = false;
            foreach ($field['file']['types'] as $fileExtension => $mimeType) {
                $fileInfo = pathinfo($upload['name']);
                $fileExtension = strtolower($fileInfo['extension']);
                if (strtolower($upload['type']) === strtolower($mimeType) &&
                    strtolower($fileExtension) === strtolower($fileInfo['extension'])) {
                    $validFileExtension = true;
                    break;
                }
            }
            if (!$validFileExtension) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param array $field
     * @return bool
     */
    protected function validateFileSize(array $field)
    {
        foreach ($field['upload'] as $upload) {
            $maxFileSize = (int)$field['file']['maxSize'] * 1024 * 1024;
            if ($upload['size'] > $maxFileSize) {
                return false;
            }
        }
        return true;
    }

    protected function validateFiles(array $field, AbstractEntity $object = null)
    {
        /**
         * @todo check allowed files min/max amount
         */
    }
}
