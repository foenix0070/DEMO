<?php

namespace CodingMs\FluidForm\Domain\Model;

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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * FluidForm
 */
class Form extends AbstractEntity
{
    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var string
     */
    protected $formKey = '';

    /**
     * @var string
     */
    protected $formUid = '';

    /**
     * @var string
     */
    protected $uniqueId = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\FluidForm\Domain\Model\Field>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $fields;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     */
    protected function initStorageObjects()
    {
        $this->fields = new ObjectStorage();
    }

    /**
     * @return \DateTime $creationDate
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * Returns the formKey
     *
     * @return string $formKey
     */
    public function getFormKey()
    {
        return $this->formKey;
    }

    /**
     * Sets the formKey
     *
     * @param string $formKey
     */
    public function setFormKey($formKey)
    {
        $this->formKey = $formKey;
    }

    /**
     * Returns the formUid
     *
     * @return string $formUid
     */
    public function getFormUid()
    {
        return $this->formUid;
    }

    /**
     * Sets the formUid
     *
     * @param string $formUid
     */
    public function setFormUid($formUid)
    {
        $this->formUid = $formUid;
    }

    /**
     * Returns the uniqueId
     *
     * @return string $uniqueId
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * Sets the uniqueId
     *
     * @param string $uniqueId
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

    /**
     * Adds a Field
     *
     * @param \CodingMs\FluidForm\Domain\Model\Field $field
     */
    public function addField(Field $field)
    {
        $this->fields->attach($field);
    }

    /**
     * Removes a Field
     *
     * @param \CodingMs\FluidForm\Domain\Model\Field $fieldToRemove The Field to be removed
     */
    public function removeField(Field $fieldToRemove)
    {
        $this->fields->detach($fieldToRemove);
    }

    /**
     * Returns the fields
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\FluidForm\Domain\Model\Field> $fields
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Sets the fields
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\CodingMs\FluidForm\Domain\Model\Field> $fields
     */
    public function setFields(ObjectStorage $fields)
    {
        $this->fields = $fields;
    }
}
