<?php

namespace CodingMs\FluidForm\Utility;

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

use Exception;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Validation\Validator\EmailAddressValidator;

/**
 * FileUpload
 */
class FileUpload
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
     * Upload file
     *
     * @param array $file Files-Array ($_FILES)
     * @param ResourceStorage $storage
     * @param Folder $folder
     * @param string $allowedExtensions Comma separated list of allowed file extensions (* allows all file extensions)
     * @return FileInterface
     * @throws ExistingTargetFileNameException
     * @throws Exception
     */
    public function uploadFile($file, $storage, $folder, $allowedExtensions = '')
    {
        // Check file extension
        if (!self::checkExtension($file['name'], $allowedExtensions)) {
            throw new Exception('Invalid file type/extension');
        }
        if (empty($file)) {
            throw new Exception('file_upload_failed');
        }
        return $storage->addFile($file['tmp_name'], $folder, $file['name']);
    }

    /**
     * Check extension of given filename
     *
     * @param string Filename like (upload.png)
     * @param string $allowedExtensions Comma separated list of allowed file extensions (* allows all file extensions)
     * @return bool If Extension is allowed
     */
    public static function checkExtension($filename, $allowedExtensions)
    {
        // Allow all file extensions
        if ($allowedExtensions == '*') {
            return true;
        }
        $fileInfo = pathinfo($filename);
        $fileExtension = strtolower($fileInfo['extension']);
        $allowedExtensions = GeneralUtility::trimExplode(',', strtolower($allowedExtensions));
        if (!empty($fileInfo['extension']) && in_array($fileExtension, $allowedExtensions)) {
            return true;
        }
        return false;
    }

    /**
     * @var EmailAddressValidator
     */
    protected $emailAddressValidator;

    /**
     * @param EmailAddressValidator $emailAddressValidator
     * @noinspection PhpUnused
     */
    public function injectEmailAddressValidator(EmailAddressValidator $emailAddressValidator)
    {
        $this->emailAddressValidator = $emailAddressValidator;
    }

    /**
     * @param string $email
     * @return bool|string
     */
    public function validateEmail($email = '')
    {
        $validateEmailResult = $this->emailAddressValidator->validate($email);
        if (trim($email) == '' || $validateEmailResult->hasErrors()) {
            $email = false;
        }
        return $email;
    }

    /**
     * Send email alert on upload
     * @param $form
     * @param FileInterface $file
     * @return int
     * @noinspection PhpUnused
     */
    public function emailOnUpload($form, $file)
    {
        $success = false;
        $finisher = $form['finisher']['upload'];
        // Get configuration
        $configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('fluid_form');
        if (is_array($configuration) && isset($configuration['emailOnUpload'])) {
            $emailOnUpload = $this->validateEmail($configuration['emailOnUpload']);
            if ($emailOnUpload !== false) {
                /** @var FluidEmail $mail */
                $mail = GeneralUtility::makeInstance(FluidEmail::class);
                $mail->format('html')
                    ->from(
                        new Address(
                            $finisher['emailOnUpload']['from']['email'],
                            $finisher['emailOnUpload']['from']['name']
                        )
                    )
                    ->to(new Address($emailOnUpload))
                    ->subject($finisher['emailOnUpload']['subject'])
                    ->setTemplate('Form/FileUpload')
                    ->attach(
                        $file->getContents(),
                        $file->getName(),
                        $file->getMimeType()
                    )
                    ->assignMultiple([
                        'subject' => $finisher['emailOnUpload']['subject'],
                        'finisher' => $finisher,
                        'file' => $file,
                    ]);
                /** @var Mailer $mailer */
                $mailer = GeneralUtility::makeInstance(Mailer::class);
                try {
                    $mailer->send($mail);
                    $success = true;
                } catch (Exception $exception) {
                    $success = false;
                }
            }
        }
        return $success;
    }
}
