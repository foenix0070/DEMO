<?php

namespace CodingMs\FluidForm\Command;

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

use PDO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageQueue;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Resource\Exception\FileOperationErrorException;
use TYPO3\CMS\Core\Resource\Exception\InsufficientFileAccessPermissionsException;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Reports on form mails
 */
class ReportCommand extends Command
{
    /**
     * @var FlashMessageService $flashMessageService
     */
    protected $flashMessageService;

    /**
     * @var FlashMessageQueue $defaultFlashMessageQueue
     */
    protected $defaultFlashMessageQueue;

    /**
     * @var array
     */
    protected $senderEmail = [];

    /**
     * @var array
     */
    protected $receiverEmail = [];

    /**
     * @var SymfonyStyle
     */
    protected $io;

    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure()
    {
        $this->setDescription(
            'Creates a CSV attachment for form data in the database and sends it via email.'
        );

        $this->setHelp(
            ' IMPORTANT: The report will not include files which have been uploaded in the forms.'
            . ' If you choose to delete all form data after sending, the uploaded files will be deleted nevertheless.'
        );

        $this->addOption(
            'formKeys',
            'k',
            InputOption::VALUE_REQUIRED,
            'One or more form keys (comma separated, eg.: contactBasic,fileUpload)'
        );

        $this->addOption(
            'receiverEmail',
            't',
            InputOption::VALUE_REQUIRED,
            'Receiver address for the report.'
        );

        $this->addOption(
            'senderEmail',
            'f',
            InputOption::VALUE_OPTIONAL,
            'Sender address for the report.',
            'noreply@coding.ms'
        );

        $this->addOption(
            'subject',
            's',
            InputOption::VALUE_OPTIONAL,
            'Subject for the report. You may use the placeholder ###FORM_KEY###.',
            'Fluid-Form: Report for ###FORM_KEY###'
        );

        $this->addOption(
            'delete',
            'd',
            InputOption::VALUE_OPTIONAL,
            'Delete records after processing (yes / no). IMPORTANT: Files will not be included in the mail but will be deleted nevertheless.',
            'no'
        );
    }

    /**
     * Executes the command for showing sys_log entries
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->io->title($this->getDescription());

        $subject = $input->getOption('subject');
        $senderEmail = $input->getOption('senderEmail');
        $receiverEmail = $input->getOption('receiverEmail');
        $delete = strtolower($input->getOption('delete')) === 'yes';

        if (empty($receiverEmail)) {
            $this->log('No receiver email given (option "receiverEmail"). Please specify a receiver email!', 'error');
            return 1;
        }

        $this->senderEmail = [$senderEmail => $senderEmail];
        $this->receiverEmail = [$receiverEmail => $receiverEmail];
        $data = [];

        $formKeys = $input->getOption('formKeys');
        $formKeys = GeneralUtility::trimExplode(',', $formKeys, true);
        if (count($formKeys) === 0) {
            $this->log('No form keys given (option "formKeys"). Please enter one or more form keys!', 'error');
            return 1;
        }

        foreach ($formKeys as $formKey) {
            /** @var ConnectionPool $connectionPool */
            $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
            $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_fluidform_domain_model_form');
            $queryBuilder->select('uid', 'form_key', 'form_uid', 'unique_id', 'crdate')
                ->from('tx_fluidform_domain_model_form')
                ->where(
                    $queryBuilder->expr()->eq(
                        'form_key',
                        $queryBuilder->createNamedParameter($formKey, PDO::PARAM_STR)
                    )
                )
                ->orderBy('uid', 'ASC');
            $formResource = $queryBuilder->execute();
            $data[$formKey] = [];
            while ($formRow = $formResource->fetch(PDO::FETCH_ASSOC)) {
                $dataRow = [
                    'form_key' => $formRow['form_key'],
                    'form_uid' => $formRow['form_uid'],
                    'mail_uid' => $formRow['uid'],
                    'unique_id' => $formRow['unique_id'],
                    'date' => date(DATE_ATOM, $formRow['crdate']),
                ];
                $data[$formKey]['title'] = [
                    'form_key' => 'Form-Key',
                    'form_uid' => 'Form-Uid',
                    'mail_uid' => 'Mail-Uid',
                    'unique_id' => 'Unique-Id',
                    'date' => 'Date',
                ];
                $data[$formKey]['types'] = [
                    'form_key' => 'string',
                    'form_uid' => 'string',
                    'mail_uid' => 'int',
                    'unique_id' => 'string',
                    'date' => 'string',
                ];
                $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_fluidform_domain_model_field');
                $queryBuilder->select('*')
                    ->from('tx_fluidform_domain_model_field')
                    ->where('fluidform = ' . $formRow['uid']);
                $fieldResource = $queryBuilder->execute();
                while ($fieldRow = $fieldResource->fetch(PDO::FETCH_ASSOC)) {
                    $dataRow[$fieldRow['field_key']] = $fieldRow['field_value'];
                    $data[$formKey]['title'][$fieldRow['field_key']] = $fieldRow['field_label'];
                    $data[$formKey]['types'][$fieldRow['field_key']] = $fieldRow['field_type'];
                }
                $data[$formKey]['items'][] = $dataRow;
            }
            if (isset($data[$formKey]['items'])) {
                if (count($data[$formKey]['items']) > 0) {
                    $this->sendMail($formKey, $subject, $data[$formKey]);
                    if ($delete) {
                        $this->deleteFormData($data[$formKey]['items']);
                    }
                }
            } else {
                $this->log('No items found for formKey "' . $formKey . '".', 'notice');
            }
        }
        return 0;
    }

    /**
     * @param array $forms
     */
    public function deleteFormData($forms)
    {
        if (count($forms)) {
            foreach ($forms as $form) {
                // Delete files (includes sys_file and sys_file_reference records)
                /** @var ConnectionPool $connectionPool */
                $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
                $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_fluidform_domain_model_field');
                $fields = $queryBuilder
                    ->select('*')
                    ->from('tx_fluidform_domain_model_field')
                    ->where('fluidform = ' . $form['mail_uid'])
                    ->execute()
                    ->fetchAll();
                if ($fields) {
                    foreach ($fields as $field) {
                        /** @var FileRepository $fileRepository */
                        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
                        $fileReferences = $fileRepository->findByRelation('tx_fluidform_domain_model_field', 'field_upload', $field['uid']);
                        if ($fileReferences) {
                            /** @var FileReference $fileReference */
                            foreach ($fileReferences as $fileReference) {
                                $file = $fileReference->getOriginalFile();
                                try {
                                    $success = $file->getStorage()->deleteFile($file);
                                    if (!$success) {
                                        $this->log('Could not delete "' . $file->getName() . '".', 'error');
                                    }
                                } catch (FileOperationErrorException $e) {
                                    $this->log('Could not delete file ' . $e->getMessage(), 'error');
                                } catch (InsufficientFileAccessPermissionsException $e) {
                                    $this->log('Insufficient file access permission ' . $e->getMessage(), 'error');
                                }
                            }
                        }
                    }
                }

                // Delete field records
                $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_fluidform_domain_model_field');
                $queryBuilder
                    ->delete('tx_fluidform_domain_model_field')
                    ->where('fluidform = ' . $form['mail_uid'])
                    ->execute();

                // Delete form record
                $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_fluidform_domain_model_form');
                $queryBuilder
                    ->delete('tx_fluidform_domain_model_form')
                    ->where('uid = ' . $form['mail_uid'])
                    ->execute();

                $this->log('Data of form ' . $form['form_key'] . ' (UID ' . $form['mail_uid'] . ') deleted.');
            }
        }
    }

    /**
     * @param string $formKey
     * @param string $subject
     * @param array $data
     * @throws Exception
     */
    protected function sendMail(string $formKey, string $subject, array $data)
    {
        //
        // Send one mail for each form key!
        /** @var MailMessage $mail */
        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail->setFrom($this->senderEmail);
        $mail->setTo($this->receiverEmail);
        $mail->setSubject(str_replace('###FORM_KEY###', $formKey, $subject) . ' (' . count($data['items']) . ')');
        $message = 'Please find attached the Fluid-Form mails of the \'' . $formKey . '\' form.';

        // Generate PDF attachment
        $filename = date('Y-m-d') . '_' . $formKey . '.csv';
        $contentType = 'text/csv';
        $csvString = $this->arrayToCsv($data['items']);

        // set text and attachment
        $mail->text($message);
        $mail->attach($csvString, $filename, $contentType);

        // Send report mail
        if ($mail->send()) {
            $this->log('Email for \'' . $formKey . '\' successfully sent!', 'ok');
        } else {
            $this->log('Sending email for \'' . $formKey . '\' failed!', 'error');
        }
    }

    /**
     * @param array $data
     * @return string
     */
    protected function arrayToCsv(array $data = [])
    {
        $csvString = '';
        $csv = fopen('php://temp', 'w');
        if (count($data) > 0) {
            $isFirst = true;
            foreach ($data as $entry) {
                if ($isFirst) {
                    $isFirst = false;
                    fputcsv($csv, array_keys($entry), ';');
                }
                fputcsv($csv, $entry, ';');
            }
        }
        rewind($csv);
        while (!feof($csv)) {
            $csvString .= fread($csv, 8192);
        }
        fclose($csv);
        return $csvString;
    }

    /**
     * Log some messages
     *
     * @param string $message
     * @param string $severity Severity: 0 is info, 1 is notice, 2 is warning, 3 is fatal error, -1 is "OK" message
     * @throws Exception
     */
    protected function log($message, $severity = 'notice')
    {
        // Write to console
        $this->io->writeln($message);

        // Create flash message
        // Executed by scheduler?!
        if (PHP_SAPI !== 'cli' && $severity !== 'log') {
            if ($this->flashMessageService === null) {
                $this->flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
            }
            if ($this->defaultFlashMessageQueue === null) {
                $this->defaultFlashMessageQueue = $this->flashMessageService->getMessageQueueByIdentifier();
            }
            $severityClass = FlashMessage::WARNING;
            switch ($severity) {
                case 'notice':
                    $severityClass = FlashMessage::NOTICE;
                    break;
                case 'info':
                    $severityClass = FlashMessage::INFO;
                    break;
                case 'ok':
                    $severityClass = FlashMessage::OK;
                    break;
                case 'warning':
                    $severityClass = FlashMessage::WARNING;
                    break;
                case 'error':
                    $severityClass = FlashMessage::ERROR;
                    break;
            }
            /** @var FlashMessage $flashMessageInfo */
            $flashMessageInfo = GeneralUtility::makeInstance(
                FlashMessage::class,
                $message,
                '',
                $severityClass
            );
            $this->defaultFlashMessageQueue->enqueue($flashMessageInfo);
        }
    }
}
