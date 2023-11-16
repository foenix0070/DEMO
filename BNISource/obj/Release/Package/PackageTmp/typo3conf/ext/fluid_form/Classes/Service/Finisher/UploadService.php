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

use CodingMs\FluidForm\Utility\FileUpload;
use Exception;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

/**
 * Upload finishing service
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class UploadService extends AbstractService
{
    /**
     * Uploads files
     *
     * @param array $form
     * @param array $finisher
     * @param UriBuilder $uriBuilder
     * @param array $session
     * @return mixed
     */
    public function finish($form, $finisher, UriBuilder $uriBuilder, array &$session = [])
    {
        $success = true;
        foreach ($form['fieldsets'] as $fieldsetKey => $fieldset) {
            foreach ($fieldset['fields'] as $fieldKey => $field) {
                if ($field['type'] === 'Upload') {
                    if (!isset($field['value']['error']) || $field['value']['error'] === 0) {
                        try {
                            //
                            // Get target storage
                            $storage = $this->getStorageByFieldConfiguration($field);
                            //
                            // Get folder name
                            if (!$storage->hasFolder($field['upload']['folder'])) {
                                $storage->createFolder($field['upload']['folder']);
                            }
                            if (!$storage->hasFolder($field['upload']['folder'])) {
                                throw new Exception('Folder ' . $field['upload']['folder'] . ' not found!');
                            }
                            /** @var Folder $uploadFolderObject */
                            $uploadFolder = $storage->getFolder($field['upload']['folder']);
                            //
                            // Write .htaccess protection
                            if (!$uploadFolder->hasFile('.htaccess')) {
                                $path = (string)$uploadFolder->getPublicUrl();
                                if (substr($path, 0, 1) === '/') {
                                    $path = substr($path, 1);
                                }
                                $pathAbs = GeneralUtility::getFileAbsFileName($path);
                                file_put_contents($pathAbs . '.htaccess', 'deny from all');
                            }
                            //
                            $upload = $field['value'];
                            $allowedFileTypes = $field['upload']['allowedFileTypes'];
                            $fieldUniqueId = 'form-' . $form['uid'] . '-' . $fieldsetKey . '-' . $fieldKey;
                            //
                            // Overwrite server filename
                            $session['uploads'][$fieldUniqueId]['downloadFilename'] = $upload['name'];
                            $uniqueId = $session['uniqueId'];
                            $fileNameParts = explode('.', $upload['name']);
                            $upload['name'] = $uniqueId . '-' . $fieldUniqueId . '.' . end($fileNameParts);
                            //
                            // Upload/write file
                            /** @var FileUpload $fileUploadUtility */
                            $fileUploadUtility = $this->objectManager->get(FileUpload::class);
                            $file = $fileUploadUtility->uploadFile($upload, $storage, $uploadFolder, $allowedFileTypes);
                            $fileUploadUtility->emailOnUpload($form, $file);
                            $session['uploads'][$fieldUniqueId]['file'] = $file;
                        } catch (Exception $exception) {
                            if (is_array($session) && isset($session['error'])) {
                                $session['error']['messages'] = $exception->getMessage();
                                $session['error']['fieldset'] = $fieldsetKey;
                                $session['error']['field'] = $fieldKey;
                                $success = false;
                            }
                        }
                    }
                }
            }
        }
        return $success;
    }

    /**
     * @param $field
     * @return ResourceStorage|null
     * @throws Exception
     */
    protected function getStorageByFieldConfiguration($field)
    {
        $storage = null;
        $storageUid = (int)$field['upload']['storage'] ?? 0;
        if ($storageUid > 0) {
            /** @var StorageRepository $storageRepository */
            $storageRepository = $this->objectManager->get(StorageRepository::class);
            /** @var ResourceStorage $storage */
            $storage = $storageRepository->findByUid($storageUid);
            if (!($storage instanceof ResourceStorage)) {
                throw new Exception('please_select_a_valid_upload_file_storage');
            }
        } else {
            throw new Exception('please_select_an_upload_file_storage');
        }
        return $storage;
    }
}
