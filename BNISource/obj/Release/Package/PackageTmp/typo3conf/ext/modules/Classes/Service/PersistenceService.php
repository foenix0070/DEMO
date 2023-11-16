<?php

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

use DateTime;
use Exception;
use PDO;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Services for persist form data into object
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class PersistenceService
{
    /**
     * @var ResourceFactory
     */
    protected ResourceFactory $resourceFactory;

    /**
     * @var PersistenceManager
     */
    protected PersistenceManager $persistenceManager;

    /**
     * @param ResourceFactory $resourceFactory
     * @param PersistenceManager $persistenceManager
     */
    public function __construct(
        ResourceFactory $resourceFactory,
        PersistenceManager $persistenceManager
    ) {
        $this->resourceFactory = $resourceFactory;
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * @param array $form
     * @param AbstractEntity $object
     * @param AbstractEntity $parentObject
     * @return Exception|AbstractEntity
     */
    public function persistForm(array &$form, AbstractEntity $object, AbstractEntity $parentObject=null)
    {
        try {
            foreach ($form['fieldsets'] as $fieldsetName => $fieldsetData) {
                foreach ($fieldsetData['fields'] as $fieldName => $fieldData) {
                    if (!isset($fieldData['readonly'])) {
                        $fieldData['readonly'] = false;
                    } elseif ($fieldData['readonly']) {
                        // Don't process readonly fields at all
                        continue;
                    }
                    $type = $fieldData['type'];
                    if (in_array($fieldData['type'], ['Textarea', 'Slug'])) {
                        $type = 'Input';
                    }
                    switch ($type) {
                        case 'Checkbox':
                            $object = $this->persistCheckbox($fieldName, $fieldData, $object);
                            break;
                        case 'Input':
                            $object = $this->persistInput($fieldName, $fieldData, $object);
                            break;
                        case 'DateTime':
                            $object = $this->persistDateTime($fieldName, $fieldData, $object);
                            break;
                        case 'Select':
                            $object = $this->persistSelect($fieldName, $fieldData, $object);
                            break;
                        case 'Checkboxes':
                            $object = $this->persistCheckboxes($fieldName, $fieldData, $object);
                            break;
                        case 'Files':
                            $object = $this->persistFiles($fieldName, $fieldData, $object, $parentObject);
                            $form['fieldsets'][$fieldsetName]['fields'][$fieldName] = $fieldData;
                            break;
                    }
                }
            }
        } catch (Exception $exception) {
            return $exception;
        }
        return $object;
    }

    /**
     * @param AbstractEntity $object
     * @param string $method
     * @return bool
     * @throws Exception
     */
    protected function methodExists(AbstractEntity $object, string $method): bool
    {
        if (!method_exists($object, $method)) {
            throw new Exception('Method \'' . $method . '\' not found!');
        }
        return true;
    }

    /**
     * @param $fieldName
     * @param $fieldData
     * @param AbstractEntity $object
     * @return AbstractEntity
     * @throws Exception
     */
    protected function persistCheckbox($fieldName, $fieldData, AbstractEntity $object)
    {
        $setter = 'set' . ucfirst($fieldName);
        $fieldData['value'] = $fieldData['options']['0'];
        if ($fieldData['checked']) {
            $fieldData['value'] = $fieldData['options']['1'];
        } else {
            $fieldData['value'] = $fieldData['options']['0'];
        }
        if ($this->methodExists($object, $setter)) {
            $object->$setter($fieldData['value']);
        }
        return $object;
    }

    /**
     * @param $fieldName
     * @param $fieldData
     * @param AbstractEntity $object
     * @return AbstractEntity
     * @throws Exception
     */
    protected function persistInput($fieldName, $fieldData, AbstractEntity $object)
    {
        $setter = 'set' . ucfirst($fieldName);
        if ($this->methodExists($object, $setter)) {
            $object->$setter((string)$fieldData['value']);
        }
        return $object;
    }

    /**
     * @param $fieldName
     * @param $fieldData
     * @param AbstractEntity $object
     * @return AbstractEntity
     * @throws Exception
     */
    protected function persistDateTime($fieldName, $fieldData, AbstractEntity $object)
    {
        $setter = 'set' . ucfirst($fieldName);
        if ($this->methodExists($object, $setter)) {
            if ($fieldData['parameterType'] === 'DateTime') {
                $dateTime = new DateTime();
                $dateTime->setTimestamp((int)$fieldData['value']);
                $object->$setter($dateTime);
            } else {
                $object->$setter((string)$fieldData['value']);
            }
        }
        return $object;
    }

    /**
     * @param $fieldName
     * @param $fieldData
     * @param AbstractEntity $object
     * @return AbstractEntity
     * @throws Exception
     */
    protected function persistSelect($fieldName, $fieldData, AbstractEntity $object)
    {
        //
        // Select box with static values.
        // - Options from a static TypoScript list
        // - Single value written as varchar or similar
        if (!isset($fieldData['optionsTable'])) {
            $setter = 'set' . ucfirst($fieldName);
            if ($this->methodExists($object, $setter)) {
                $object->$setter($fieldData['value']);
            }
        }
        //
        // Select box with dynamic values are written as relation
        // - Options from another table/model
        // - Single value selection only!!!
        // - Attention: Object property can be a single (setValue) or multiple value (addValue in ObjectStorage)
        else {
            $repositoryName = $fieldData['optionsTable']['repository'];
            /** @var Repository $repository */
            $repository = GeneralUtility::makeInstance($repositoryName);
            if ($fieldData['optionsTable']['relationType'] === 'multiple') {
                //
                // Write in a multiple value (ObjectStorage) by resetting (setValues([])) and adding (addValue())
                $setMethod = $fieldData['optionsTable']['setMethod'];
                $addMethod = $fieldData['optionsTable']['addMethod'];
                // Reset selection
                if ($this->methodExists($object, $setMethod)) {
                    $object->$setMethod(new ObjectStorage());
                }
                // Set a single value
                $selectObject = $repository->findByIdentifier((int)$fieldData['value']);
                if ($selectObject instanceof AbstractEntity && $this->methodExists($object, $addMethod)) {
                    $object->$addMethod($selectObject);
                } else {
                    throw new Exception('Select relation not found! [' . (int)$fieldData['value'] . ']');
                }
            } else {
                //
                // Write in a single value by using "setValue"
                $setter = $fieldData['optionsTable']['setMethod'];
                $selectObject = $repository->findByIdentifier((int)$fieldData['value']);
                if ($selectObject instanceof AbstractEntity && $this->methodExists($object, $setter)) {
                    $object->$setter($selectObject);
                } else {
                    throw new Exception('Select relation not found! [' . (int)$fieldData['value'] . ']');
                }
            }
        }
        return $object;
    }

    /**
     * @param $fieldName
     * @param $fieldData
     * @param AbstractEntity $object
     * @return AbstractEntity
     * @throws Exception
     */
    protected function persistCheckboxes($fieldName, $fieldData, AbstractEntity $object)
    {
        //
        // Checkboxes
        // - Multiple values possible
        // - Options from another table/model
        if (isset($fieldData['optionsTable']) && is_array($fieldData['value'])) {
            $repositoryName = $fieldData['optionsTable']['repository'];
            /** @var Repository $repository */
            $repository = GeneralUtility::makeInstance($repositoryName);
            //
            $setMethod = $fieldData['optionsTable']['setMethod'];
            $addMethod = $fieldData['optionsTable']['addMethod'];
            // Reset selection
            if ($this->methodExists($object, $setMethod)) {
                $object->$setMethod(new ObjectStorage());
            }
            foreach ($fieldData['value'] as $checkboxValue) {
                $checkboxObject = $repository->findByIdentifier((int)$checkboxValue);
                if ($checkboxObject instanceof AbstractEntity && $this->methodExists($object, $addMethod)) {
                    $object->$addMethod($checkboxObject);
                } else {
                    throw new Exception('Checkbox relation not found! [' . (int)$checkboxValue . ']');
                }
            }
        }
        return $object;
    }

    /**
     * @param $fieldName
     * @param $fieldData
     * @param AbstractEntity $object
     * @param AbstractEntity $parentObject
     * @return AbstractEntity
     * @throws Exception
     */
    protected function persistFiles($fieldName, &$fieldData, AbstractEntity $object, AbstractEntity $parentObject=null)
    {
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        //
        // Get file array
        $files = [];
        $getter = 'get' . ucfirst($fieldName);
        if (method_exists($object, $getter)) {
            //
            // Multiple files in ObjectStorage
            if ((int)$fieldData['multiple'] === 1) {
                $files = [];
                /** @var ObjectStorage $filesObjectStorage */
                $filesObjectStorage = $object->$getter();
                if ($filesObjectStorage !== null) {
                    $files = $filesObjectStorage->toArray();
                }
            } else {
                //
                // Single file with FileReference direct in object model
                /** @var FileReference $fileReference */
                $fileReference = $object->$getter();
                if ($fileReference !== null) {
                    $files = [$fileReference];
                }
            }
        } else {
            throw new Exception('Getter ' . $getter . ' not found for field ' . $fieldName);
        }
        //
        // Perform actions on files
        /** @var FileReference $file */
        foreach ($files as $file) {
            //
            // Update files
            $queryBuilder = $connectionPool->getQueryBuilderForTable('sys_file_reference');
            $queryBuilder->update('sys_file_reference')
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($file->getUid(), PDO::PARAM_INT)
                    )
                );
            $setSomeValue = false;
            if ($fieldData['subFields']['title']['active'] === '1') {
                if (isset($fieldData['update'][$file->getUid()]['title']) && $fieldData['subFields']['title']['active']) {
                    $queryBuilder->set('title', $fieldData['update'][$file->getUid()]['title']);
                    $setSomeValue = true;
                }
            }
            if ($fieldData['subFields']['alternative']['active'] === '1') {
                if (isset($fieldData['update'][$file->getUid()]['alternative']) && $fieldData['subFields']['alternative']['active']) {
                    $queryBuilder->set('alternative', $fieldData['update'][$file->getUid()]['alternative']);
                    $setSomeValue = true;
                }
            }
            if ($fieldData['subFields']['description']['active'] === '1') {
                if (isset($fieldData['update'][$file->getUid()]['description']) && $fieldData['subFields']['description']['active']) {
                    $queryBuilder->set('description', $fieldData['update'][$file->getUid()]['description']);
                    $setSomeValue = true;
                }
            }
            if ($setSomeValue) {
                $queryBuilder->execute();
            }
            //
            // Remove files
            if (isset($fieldData['delete'][$file->getUid()])) {
                //
                // Prefix file with deleted-
                /** @var \TYPO3\CMS\Core\Resource\FileReference $originalResource */
                $originalResource = $file->getOriginalResource();
                /** @var File $file */
                $originalFile = $originalResource->getOriginalFile();
                $originalFile->rename('deleted-' . $originalFile->getName());
                //
                $removeMethod = $fieldData['removeMethod'];
                //
                // Multiple files in ObjectStorage
                if ((int)$fieldData['multiple'] === 1) {
                    $object->$removeMethod($file);
                } else {
                    //
                    // Single file with FileReference direct in object model
                    //
                    // Remove FileReference from object model
                    $object->$removeMethod();
                    //
                    // Remove file from configuration array
                    $fieldData['files'] = [];
                    //
                    // Delete FileReference from database
                    $queryBuilder = $connectionPool->getQueryBuilderForTable('sys_file_reference');
                    $queryBuilder->delete('sys_file_reference')
                        ->from('sys_file_reference')
                        ->where('uid=' . (int)$file->getUid())
                        ->set('deleted', 1)
                        ->execute();
                }
            }
        }
        //
        // Add files
        if (count($fieldData['upload']) > 0) {
            //
            // Prepare target folder
            // First parameter %1$d is uid
            // Second parameter %2$s is field key
            // Third parameter %3$d is parentObject->uid (if available)
            if ($parentObject !== null) {
                $folderIdentifier = sprintf($fieldData['file']['folder'], $object->getUid(), $fieldName, $parentObject->getUid());
            } else {
                $folderIdentifier = sprintf($fieldData['file']['folder'], $object->getUid(), $fieldName);
            }
            //
            /** @var ResourceStorage $storage */
            $storage = $this->resourceFactory->getStorageObjectFromCombinedIdentifier($folderIdentifier);
            //
            // Ensure folder exists
            $baseFolder = (string)$storage->getPublicUrl($storage->getFolder('/'));
            if (substr($baseFolder, 0, 1) === '/') {
                $baseFolder = substr($baseFolder, 1);
            }
            $absoluteBaseFolder = GeneralUtility::getFileAbsFileName($baseFolder);
            $folderIdentifierParts = explode(':', $folderIdentifier);
            $targetFolder = $absoluteBaseFolder . $folderIdentifierParts[1];
            if (!file_exists($targetFolder)) {
                GeneralUtility::mkdir_deep($targetFolder);
                GeneralUtility::fixPermissions($targetFolder);
            }
            //
            // Get target folder object
            /** @var Folder $folder */
            $folder = $this->resourceFactory->getFolderObjectFromCombinedIdentifier($folderIdentifier);
            //
            foreach ($fieldData['upload'] as $upload) {
                //
                // Create file in folder and ensure a clean filename
                /** @var File $file */
                $file = $folder->createFile($upload['name']);
                $file->setContents(file_get_contents($upload['tmp_name']));
                $file->rename('file-' . $file->getUid() . '.' . $file->getExtension());
                $this->persistenceManager->persistAll();
                //
                $falFileReference = $this->resourceFactory->createFileReferenceObject(
                    [
                        'uid_local' => $file->getUid(),
                        'uid_foreign' => uniqid('NEW_'),
                        'uid' => uniqid('NEW_'),
                        'crop' => null,
                    ]
                );
                /** @var FileReference $fileReference */
                $fileReference = GeneralUtility::makeInstance($fieldData['fileReference']);
                $fileReference->setOriginalResource($falFileReference);
                $fileReference->setPid($object->getPid());
                //
                // Add file reference into object
                $addMethod = $fieldData['addMethod'];
                $object->$addMethod($fileReference);
                //
                // Add file from configuration array
                if ((int)$fieldData['multiple'] === 0) {
                    $fieldData['files'][] = $fileReference;
                }
            }
            //
            // Multiple files in ObjectStorage
            // Refresh files in configuration array
            if ((int)$fieldData['multiple'] === 1) {
                $getter = 'get' . ucfirst($fieldName);
                if (method_exists($object, $getter)) {
                    /** @var ObjectStorage $filesObjectStorage */
                    $filesObjectStorage = $object->$getter();
                    $fieldData['files'] = $filesObjectStorage->toArray();
                }
            }
            //
        }
        return $object;
    }
}
