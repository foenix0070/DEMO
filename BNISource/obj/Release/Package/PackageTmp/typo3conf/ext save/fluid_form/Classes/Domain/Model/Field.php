<?php

namespace CodingMs\FluidForm\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

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
/**
 * Field
 */
class Field extends AbstractEntity
{
    /**
     * fieldType
     *
     * @var string
     */
    protected $fieldType = '';

    /**
     * fieldLabel
     *
     * @var string
     */
    protected $fieldLabel = '';

    /**
     * fieldKey
     *
     * @var string
     */
    protected $fieldKey = '';

    /**
     * fieldUpload
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $fieldUpload;

    /**
     * fieldValue
     *
     * @var string
     */
    protected $fieldValue = '';

    /**
     * fieldText
     *
     * @var string
     */
    protected $fieldText = '';

    /**
     * Returns the fieldType
     *
     * @return string $fieldType
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Sets the fieldType
     *
     * @param string $fieldType
     */
    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Returns the fieldLabel
     *
     * @return string $fieldLabel
     */
    public function getFieldLabel()
    {
        return $this->fieldLabel;
    }

    /**
     * Sets the fieldLabel
     *
     * @param string $fieldLabel
     */
    public function setFieldLabel($fieldLabel)
    {
        $this->fieldLabel = $fieldLabel;
    }

    /**
     * Returns the fieldKey
     *
     * @return string $fieldKey
     */
    public function getFieldKey()
    {
        return $this->fieldKey;
    }

    /**
     * Sets the fieldKey
     *
     * @param string $fieldKey
     */
    public function setFieldKey($fieldKey)
    {
        $this->fieldKey = $fieldKey;
    }

    /**
     * Returns the fieldUpload
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $fieldUpload
     */
    public function getFieldUpload()
    {
        return $this->fieldUpload;
    }

    /**
     * Sets the fieldUpload
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fieldUpload
     */
    public function setFieldUpload(FileReference $fieldUpload)
    {
        $this->fieldUpload = $fieldUpload;
    }

    /**
     * Returns the fieldValue
     *
     * @return string $fieldValue
     */
    public function getFieldValue()
    {
        return $this->fieldValue;
    }

    /**
     * Sets the fieldValue
     *
     * @param string $fieldValue
     */
    public function setFieldValue($fieldValue)
    {
        $this->fieldValue = $fieldValue;
    }

    /**
     * Returns the fieldText
     *
     * @return string $fieldText
     */
    public function getFieldText()
    {
        return $this->fieldText;
    }

    /**
     * Sets the fieldText
     *
     * @param string $fieldText
     */
    public function setFieldText($fieldText)
    {
        $this->fieldText = $fieldText;
    }
}
