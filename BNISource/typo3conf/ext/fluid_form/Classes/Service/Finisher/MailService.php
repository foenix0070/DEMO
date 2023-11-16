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
use CodingMs\FluidForm\Service\PdfService;
use Exception;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Validation\Validator\EmailAddressValidator;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Mail finishing service
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class MailService extends AbstractService
{
    /**
     * @var PdfService
     */
    protected $pdfService;

    /**
     * @param PdfService $pdfService
     * @noinspection PhpUnused
     */
    public function injectPdfService(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
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
     * Validates all fields within a fieldset
     *
     * @param array $form
     * @param array $finisher
     * @param UriBuilder $uriBuilder
     * @param array $session
     * @return mixed
     * @throws Exception
     */
    public function finish($form, $finisher, UriBuilder $uriBuilder, array &$session = [])
    {
        //
        // Get data summary from form
        [$rows, $attachments] = $this->buildSummary($finisher, $form, $session, $uriBuilder);
        //
        // Recipients of the mail
        $to = [];
        foreach ($finisher['to'] as $finisherTo) {
            if ($this->validateEmailNode($finisherTo)) {
                $to[] = new Address($finisherTo['email'], $finisherTo['name']);
            }
        }
        $cc = [];
        if (isset($finisher['cc']) && is_array($finisher['cc']) && !empty($finisher['cc'])) {
            foreach ($finisher['cc'] as $finisherCc) {
                if ($this->validateEmailNode($finisherCc)) {
                    $cc[] = new Address($finisherCc['email'], $finisherCc['name']);
                }
            }
        }
        $bcc = [];
        // Get configuration
        $configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('fluid_form');
        $emailBcc = $configuration['emailBcc'];
        $emailBcc = $this->validateEmail($emailBcc);
        if ($emailBcc !== false) {
            $bcc[] = new Address($emailBcc);
        }
        if (isset($finisher['bcc']) && is_array($finisher['bcc']) && !empty($finisher['bcc'])) {
            foreach ($finisher['bcc'] as $finisherBcc) {
                if ($this->validateEmailNode($finisherBcc)) {
                    $bcc[] = new Address($finisherBcc['email'], $finisherBcc['name']);
                }
            }
        }
        //
        // Render email content
        /** @var FluidEmail $mail */
        $mail = GeneralUtility::makeInstance(FluidEmail::class);
        $mail->format('html')
            ->from(new Address($finisher['from']['email'], $finisher['from']['name']))
            ->to(...$to)
            ->subject($finisher['subject'])
            ->setTemplate($finisher['receiver']['template'])
            ->assignMultiple([
                'subject' => $finisher['subject'],
                'finisher' => $finisher,
                'form' => $form,
                'rows' => $rows,
            ]);
        if (count($cc)) {
            $mail->cc(...$cc);
        }
        if (count($bcc)) {
            $mail->bcc(...$bcc);
        }
        //
        // Set the reply to
        if ((int)$finisher['reply']['active'] === 1) {
            $addressFieldset = $finisher['reply']['addressFieldset'];
            $addressField = $finisher['reply']['addressField'];
            if (isset($form['fieldsets'][$addressFieldset]['fields'][$addressField])) {
                $mail->replyTo(new Address($form['fieldsets'][$addressFieldset]['fields'][$addressField]['value']));
            }
        }
        //
        // Receiver needs PDF attached?
        if ($finisher['receiver']['pdf']['attach']) {
            $filename = $finisher['receiver']['pdf']['filename'];
            $filename = str_replace('{formObjectUid}', $session['formObjectUid'], $filename);
            $content = $this->pdfService->createReceiverPdf($form, $session['formObjectUid']);
            $contentType = 'application/pdf';
            $mail->attach($content, $filename, $contentType);
        }
        if (count($attachments['receiver']) > 0) {
            /** @var FileReference $file */
            foreach ($attachments['receiver'] as $file) {
                $mail->attach(
                    $file->getOriginalResource()->getContents(),
                    $file->getDownloadFilename(),
                    $file->getOriginalResource()->getMimeType()
                );
            }
        }
        //
        /** @var Mailer $mailer */
        $mailer = GeneralUtility::makeInstance(Mailer::class);
        try {
            $mailer->send($mail);
            $success = true;
        } catch (Exception $exception) {
            $success = false;
        }
        //
        // Sender gets a copy
        if ($finisher['sender']['sendCopy'] && $success) {
            //
            // Sender email address
            $addressFieldset = $finisher['sender']['addressFieldset'];
            $addressField = $finisher['sender']['addressField'];
            //
            // Render email content
            /** @var FluidEmail $mailSender */
            $mailSender = GeneralUtility::makeInstance(FluidEmail::class);
            $mailSender->format('html')
                ->from(new Address($finisher['from']['email'], $finisher['from']['name']))
                ->to(new Address($form['fieldsets'][$addressFieldset]['fields'][$addressField]['value']))
                ->subject($finisher['subject'])
                ->setTemplate($finisher['sender']['template'])
                ->assignMultiple([
                    'subject' => $finisher['subject'],
                    'finisher' => $finisher,
                    'form' => $form,
                    'rows' => $rows,
                ]);
            if (count($bcc)) {
                $mailSender->bcc(...$bcc);
            }
            //
            // Attach files
            if ($finisher['sender']['pdf']['attach']) {
                $filename = $finisher['sender']['pdf']['filename'];
                $filename = str_replace('{formObjectUid}', $session['formObjectUid'], $filename);
                $content = $this->pdfService->createSenderPdf($form, $session['formObjectUid']);
                $contentType = 'application/pdf';
                $mailSender->attach($content, $filename, $contentType);
            }
            if (count($attachments['sender']) > 0) {
                /** @var FileReference $file */
                foreach ($attachments['sender'] as $file) {
                    $mailSender->attach(
                        $file->getOriginalResource()->getContents(),
                        $file->getDownloadFilename(),
                        $file->getOriginalResource()->getMimeType()
                    );
                }
            }
            //
            /** @var Mailer $mailer */
            $mailer = GeneralUtility::makeInstance(Mailer::class);
            try {
                $mailer->send($mailSender);
                $success = true;
            } catch (Exception $exception) {
                $success = false;
            }
        }
        return $success;
    }

    /**
     * @param $node
     * @return bool
     */
    protected function validateEmailNode($node)
    {
        if (is_array($node)) {
            if (isset($node['email']) && isset($node['name'])) {
                if (trim($node['email']) != '' && trim($node['name']) != '') {
                    $validateEmailResult = $this->emailAddressValidator->validate($node['email']);
                    if (!$validateEmailResult->hasErrors()) {
                        return true;
                    }
                }
            }
        }
        return false;
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
     * @param string $fieldKey
     * @param int $formObjectUid
     * @return FileReference|null
     */
    protected function getFileReferenceFromField(string $fieldKey, int $formObjectUid=0)
    {
        $fileUpload = null;
        /** @var Form $formObject */
        $formObject = $this->formRepository->findByIdentifier($formObjectUid);
        if ($formObject instanceof Form) {
            /** @var Field $formObjectField */
            foreach ($formObject->getFields() as $formObjectField) {
                if ($formObjectField->getFieldKey() == $fieldKey) {
                    $fileUpload = $formObjectField->getFieldUpload();
                }
            }
        }
        return $fileUpload;
    }

    /**
     * @param $finisher
     * @param $form
     * @param $session
     * @param UriBuilder $uriBuilder
     * @return array<mixed>
     */
    protected function buildSummary($finisher, $form, $session, UriBuilder $uriBuilder)
    {
        $rows = [];
        $attachments = [
            'sender' => [],
            'receiver' => []
        ];
        foreach ($form['fieldsets'] as $fieldsetKey => $fieldset) {
            foreach ($fieldset['fields'] as $fieldKey => $field) {
                // Don't print field in mail?!
                if (isset($field['excludeFromMail']) && (int)$field['excludeFromMail'] === 1) {
                    continue;
                }
                // Print field depending on field type
                switch ($field['type']) {
                    case 'Hidden':
                        $rows[] = $field['label'] . ': ' . $field['value'];
                        break;
                    case 'Input':
                        // Input
                        $rows[] = $field['label'] . ': ' . $field['value'];
                        break;
                    case 'DateTime':
                        // DateTime
                        $rows[] = $field['label'] . ': ' . $field['value'];
                        break;
                    case 'Textarea':
                        // Textarea
                        $rows[] = $field['label'] . ':<br />' . $field['value'];
                        break;
                    case 'Select':
                        if (isset($field['multiple'])) {
                            $selectValues = [];
                            if (count($field['value']) > 0) {
                                foreach ($field['value'] as $selectValue) {
                                    if (isset($field['options'][$selectValue])) {
                                        $selectValues[] = $field['options'][$selectValue];
                                    }
                                }
                            }
                            if (count($selectValues) > 0) {
                                $rows[] = $field['label'] . ': ' . implode(', ', $selectValues);
                            } else {
                                $rows[] = $field['label'] . ': -/-';
                            }
                        } else {
                            $rows[] = $field['label'] . ': ' . $field['options'][$field['value']];
                        }
                        break;
                    case 'Radio':
                        $rows[] = $field['label'] . ': ' . $field['options'][$field['value']];
                        break;
                    case 'Checkbox':
                        $prefix = '';
                        if (isset($field['label']) && trim($field['label']) != '') {
                            $prefix = strip_tags($field['label']) . ':<br />';
                        }
                        $rows[] = $prefix . $field['options'][(int)$field['value']];
                        break;
                    case 'Upload':
                        $fieldUniqueId = 'form-' . $form['uid'] . '-' . $fieldsetKey . '-' . $fieldKey;
                        if (isset($session['uploads'][$fieldUniqueId])) {
                            // Build download link
                            $params = [
                                'fieldUniqueId' => $fieldUniqueId,
                                'uniqueId' => str_replace('..', '.', $session['uniqueId'])
                                // prevent mysterious double dots in download link
                            ];
                            $formUri = $uriBuilder->reset()
                                ->setCreateAbsoluteUri(true)
                                ->setTargetPageUid($form['pageUid'])
                                ->uriFor('download', $params, 'FluidForm');
                            $formUri = str_replace('..', '.', $formUri);
                            $link = '<a href="' . $formUri . '" target="_blank">' . $field['value']['name'] . '</a>';
                            $rows[] = $field['label'] . ': ' . $link . ' (uniqueId: ' . $session['uniqueId'] . ')';
                            //
                            // Get file object for mail attachments
                            $fileUpload = $this->getFileReferenceFromField(
                                $fieldKey,
                                $session['formObjectUid'] ?? 0
                            );
                            if ($fileUpload instanceof FileReference) {
                                // Uploaded file found
                                if (isset($field['upload']['attachToSenderMail']) && (int)$field['upload']['attachToSenderMail'] === 1) {
                                    $attachments['sender'][] = $fileUpload;
                                }
                                if (isset($field['upload']['attachToReceiverMail']) && (int)$field['upload']['attachToReceiverMail'] === 1) {
                                    $attachments['receiver'][] = $fileUpload;
                                }
                            }
                            //
                        } else {
                            $rows[] = $field['label'] . ': Wurde nicht hochgeladen!';
                        }
                        break;
                }
            }
        }
        return [$rows, $attachments];
    }
}
