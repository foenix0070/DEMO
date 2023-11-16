<?php

namespace CodingMs\Modules\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Thomas Deuling <typo3@coding.ms>, coding.ms
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use CodingMs\Modules\Domain\Model\FrontendUser;
use CodingMs\Modules\Domain\Repository\FrontendUserGroupRepository;
use CodingMs\Modules\Domain\Repository\FrontendUserRepository;
use CodingMs\Modules\Utility\FrontendUserUtility;
use DateTime;
use Exception;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Validation\Validator\EmailAddressValidator;

/**
 * Frontend user controller
 */
class FrontendUserController extends ActionController
{
    /**
     * @var int
     */
    protected int $pageUid;

    /**
     * @var FrontendUserUtility
     */
    protected FrontendUserUtility $frontendUserUtility;

    /**
     * @var FrontendUserRepository
     */
    protected FrontendUserRepository $frontendUserRepository;

    /**
     * @var FrontendUserGroupRepository
     */
    protected FrontendUserGroupRepository $frontendUserGroupRepository;

    /**
     * @var PersistenceManager
     */
    protected PersistenceManager $persistenceManager;

    /**
     * @param FrontendUserUtility $frontendUserUtility
     * @param FrontendUserRepository $frontendUserRepository
     * @param FrontendUserGroupRepository $frontendUserGroupRepository
     * @param PersistenceManager $persistenceManager
     */
    public function __construct(
        FrontendUserUtility $frontendUserUtility,
        FrontendUserRepository $frontendUserRepository,
        FrontendUserGroupRepository $frontendUserGroupRepository,
        PersistenceManager $persistenceManager
    ) {
        $this->frontendUserUtility = $frontendUserUtility;
        $this->frontendUserRepository = $frontendUserRepository;
        $this->frontendUserGroupRepository = $frontendUserGroupRepository;
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Initialize
     */
    protected function initializeAction()
    {
        $this->pageUid = (int)GeneralUtility::_GP('id');
    }

    /**
     * Register new frontend user
     * @noinspection PhpUnused
     */
    public function registrationAction()
    {
        $errorMessage = [];
        if ((int)$this->settings['pages']['registration'] === 0) {
            $errorMessage[] = 'Please define the registration page';
        }
        if ((int)$this->settings['pages']['login'] === 0) {
            $errorMessage[] = 'Please define the login page';
        }
        if ((int)$this->settings['pages']['terms'] === 0) {
            $errorMessage[] = 'Please define the terms page';
        }
        if ((int)$this->settings['pages']['privacy'] === 0) {
            $errorMessage[] = 'Please define the privacy protection page';
        }
        if ((int)$this->settings['pages']['disclaimer'] === 0) {
            $errorMessage[] = 'Please define the disclaimer page';
        }
        if ((int)$this->settings['container']['frontendUser'] === 0) {
            $errorMessage[] = 'Please define the frontend user container';
        }
        if (count($errorMessage) > 0) {
            $this->addFlashMessage(implode(', ', $errorMessage) . '.', 'Error', FlashMessage::ERROR);
        }
        //
        if (GeneralUtility::_GP('hash')) {
            $hash = trim(GeneralUtility::_GP('hash'));
            $finisher = GeneralUtility::makeInstance(
                $this->settings['registration']['finisher'],
                $this->frontendUserUtility,
                $this->frontendUserRepository,
                $this->frontendUserGroupRepository,
                $this->persistenceManager
            );
            $this->view->assign('processHash', true);
            try {
                //Adminfreigabeoption
                if ($this->settings['registration']['enableAdminConfirmation']) {
                    if (GeneralUtility::_GP('adminActivation')) {
                        if (GeneralUtility::_GP('confirm')) {
                            // confirm user registration
                            $processHashSuccessful = $finisher->processHash($hash, $this->settings, true);
                            $this->view->assign('processHashSuccessful', $processHashSuccessful);
                            if ($processHashSuccessful) {
                                $translationKey = 'tx_registration_message.admin_confirmation_success_title';
                                $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                                $translationKey = 'tx_registration_message.admin_confirmation_success_body';
                                $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                                $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::OK);
                            } else {
                                $translationKey = 'tx_registration_message.admin_confirmation_error_title';
                                $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                                $translationKey = 'tx_registration_message.admin_confirmation_error_body';
                                $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                                $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::ERROR);
                            }
                        } else {
                            // reject user registration
                            $processHashSuccessful = $finisher->processHash($hash, $this->settings, true, true);
                            if ($processHashSuccessful) {
                                $translationKey = 'tx_registration_message.admin_rejection_success_title';
                                $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                                $translationKey = 'tx_registration_message.admin_rejection_success_body';
                                $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                                $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::OK);
                            } else {
                                $translationKey = 'tx_registration_message.admin_rejection_error_title';
                                $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                                $translationKey = 'tx_registration_message.admin_rejection_error_body';
                                $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                                $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::ERROR);
                            }
                        }
                    } else {
                        $finisher->askAdminForPermission($hash, $this->settings);
                        $translationKey = 'tx_registration_message.request_sent_to_admin_title';
                        $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                        $translationKey = 'tx_registration_message.request_sent_to_admin_body';
                        $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                        $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::OK);
                    }
                } else {
                    $processHashSuccessful = $finisher->processHash($hash, $this->settings);
                    $this->view->assign('processHashSuccessful', $processHashSuccessful);
                    if ($processHashSuccessful) {
                        $translationKey = 'tx_registration_message.ok_activation_successful_title';
                        $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                        $translationKey = 'tx_registration_message.ok_activation_successful_body';
                        $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                        $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::OK);
                    } else {
                        $translationKey = 'tx_registration_message.error_activation_failed_title';
                        $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                        $translationKey = 'tx_registration_message.error_activation_failed_body';
                        $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                        $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::ERROR);
                    }
                }
            } catch (Exception $e) {
                $this->addFlashMessage($e->getMessage(), 'Error', FlashMessage::ERROR);
            }
        }
        //
        // Prepare field data
        $this->prepareFields('registration');
        $emailAsUsername = (bool)$this->settings['registration']['emailAsUsername'];
        //
        // Ensure the required fields are selected!
        if (!in_array('password', $this->settings['registration']['displayFields'])) {
            $this->addFlashMessage('Please select the password field.', 'Error', FlashMessage::ERROR);
            return;
        }
        if (!in_array('email', $this->settings['registration']['displayFields'])) {
            $this->addFlashMessage('Please select the email field.', 'Error', FlashMessage::ERROR);
            return;
        }
        if (!in_array('username', $this->settings['registration']['displayFields']) && !$emailAsUsername) {
            $this->addFlashMessage('Please select the username field or set the emailAsUsername feature.', 'Error', FlashMessage::ERROR);
            return;
        }
        //
        // Finishing in case of valid inout data
        $validationSuccessful = $this->validateRegistrationFields($emailAsUsername);
        if ($validationSuccessful) {
            $finisher = GeneralUtility::makeInstance(
                $this->settings['registration']['finisher'],
                $this->frontendUserUtility,
                $this->frontendUserRepository,
                $this->frontendUserGroupRepository,
                $this->persistenceManager
            );
            try {
                $finishingSuccessful = $finisher->finish($this->settings);
                $this->view->assign('validationSuccessful', $validationSuccessful);
                $this->view->assign('finishingSuccessful', $finishingSuccessful);
                if ($finishingSuccessful) {
                    $translationKey = 'tx_registration_message.ok_registration_successful_title';
                    $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                    $translationKey = 'tx_registration_message.ok_registration_successful_body';
                    $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                    $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::OK);
                } else {
                    $translationKey = 'tx_registration_message.error_registration_failed_title';
                    $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                    $translationKey = 'tx_registration_message.error_registration_failed_body';
                    $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                    $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::ERROR);
                }
            } catch (Exception $e) {
                $this->addFlashMessage($e->getMessage(), 'Error', FlashMessage::ERROR);
            }
        }
        $this->view->assign('settings', $this->settings);
    }

    /**
     * Show and edit profile
     *
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    public function profileAction()
    {
        $loggedIn = false;
        $frontendUser = $this->frontendUserUtility->getCurrentFrontendUser();
        if ($frontendUser instanceof FrontendUser) {
            $loggedIn = true;
            //
            // Save changes!?
            if ($this->request->hasArgument('save')) {
                $this->prepareFields('profile');
                $validationSuccessful = $this->validateProfileFields();
                if ($validationSuccessful) {
                    // Save frontend user
                    foreach ($this->settings['profile']['fields'] as $fieldKey => $field) {
                        $setter = 'set' . GeneralUtility::underscoredToUpperCamelCase($fieldKey);
                        $frontendUser->$setter($field['value']);
                    }
                    $this->frontendUserRepository->update($frontendUser);
                    $this->persistenceManager->persistAll();
                    //
                    // Send admin mail on user profile update
                    if ($this->settings['profile']['emailOnUserUpdate']['active'] ?? false) {
                        /** @var EmailAddressValidator $emailAddressValidator */
                        $emailAddressValidator = GeneralUtility::makeInstance(EmailAddressValidator::class);
                        //
                        // From email and name
                        $fromEmail = trim($this->settings['profile']['emailOnUserUpdate']['fromEmail']);
                        $validateEmailResult = $emailAddressValidator->validate($fromEmail);
                        if (trim($fromEmail) === '' || $validateEmailResult->hasErrors()) {
                            throw new Exception('From email invalid');
                        }
                        $fromAddress = new Address($fromEmail, $this->settings['profile']['emailOnUserUpdate']['fromName']);
                        //
                        // To email
                        $toEmail = trim($this->settings['profile']['emailOnUserUpdate']['toEmail']);
                        $validateEmailResult = $emailAddressValidator->validate($toEmail);
                        if (trim($toEmail) === '' || $validateEmailResult->hasErrors()) {
                            throw new Exception('To email invalid');
                        }
                        $toAddress = new Address($toEmail, $this->settings['profile']['emailOnUserUpdate']['toName']);
                        //
                        // Render email content
                        /** @var FluidEmail $mail */
                        $mail = GeneralUtility::makeInstance(FluidEmail::class);
                        $mail->format('html')
                            ->from($fromAddress)
                            ->to($toAddress)
                            ->subject($this->settings['profile']['emailOnUserUpdate']['subject'])
                            ->setTemplate('FrontendUser/UserUpdate')
                            ->assignMultiple([
                                'subject' => $this->settings['profile']['emailOnUserUpdate']['subject'],
                                'settings' => $this->settings,
                                'frontendUser' => $frontendUser,
                            ]);
                        //
                        // BCC email
                        $bccEmail = trim($this->settings['profile']['emailOnUserUpdate']['bccEmail']);
                        $validateEmailResult = $emailAddressValidator->validate($bccEmail);
                        if (trim($bccEmail) !== '' && !$validateEmailResult->hasErrors()) {
                            $mail->bcc($bccEmail);
                        }
                        //
                        /** @var Mailer $mailer */
                        $mailer = GeneralUtility::makeInstance(Mailer::class);
                        try {
                            $mailer->send($mail);
                        } catch (Exception $exception) {
                            // do nothing!
                        }
                    }
                    //
                    $translationKey = 'tx_profile_message.ok_editing_successful_title';
                    $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                    $translationKey = 'tx_profile_message.ok_editing_successful_body';
                    $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                    $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::OK);
                    // Forward to user profile
                    $this->forward('profile', null, null, []);
                }
            } elseif ($this->request->hasArgument('reset')) {
                // Reset form changes
                $this->forward('profile', null, null, []);
            } else {
                $this->prepareFields('profile', $frontendUser);
            }
        } else {
            $translationKey = 'tx_profile_message.error_profile_please_login_title';
            $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
            $translationKey = 'tx_profile_message.error_profile_please_login_body';
            $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
            $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::ERROR);
        }
        $this->view->assign('loggedIn', $loggedIn);
        $this->view->assign('frontendUser', $frontendUser);
        $this->view->assign('settings', $this->settings);
    }

    /**
     * @param string $index
     * @param FrontendUser $frontendUser
     */
    protected function prepareFields($index = 'registration', $frontendUser = null)
    {
        // Prepare field data
        $translationPrefix = 'tx_' . $index . '_label.';
        $this->settings[$index]['fields'] = [];
        $this->settings[$index]['displayFields'] = GeneralUtility::trimExplode(
            ',',
            $this->settings[$index]['displayFields'],
            true
        );
        $this->settings[$index]['mandatoryFields'] = GeneralUtility::trimExplode(
            ',',
            $this->settings[$index]['mandatoryFields'],
            true
        );
        foreach ($this->settings[$index]['displayFields'] as $fieldKey) {
            $translationKey = $translationPrefix . $index . '_field_' . $fieldKey;
            $field = [
                'key' => $fieldKey,
                'type' => 'input',
                'value' => '',
                'required' => false,
                'label' => LocalizationUtility::translate($translationKey, 'Modules')
            ];
            //
            // Insert user data for editing
            if ($index === 'profile' && $frontendUser instanceof FrontendUser) {
                $getter = 'get' . GeneralUtility::underscoredToUpperCamelCase($fieldKey);
                $field['value'] = $frontendUser->$getter();
            }
            //
            // Mandatory field?
            if (in_array($fieldKey, $this->settings[$index]['mandatoryFields'])) {
                $field['required'] = true;
            }
            if ($fieldKey == 'password') {
                $field['type'] = 'password';
            }
            if ($fieldKey == 'invitation_code') {
                $field['type'] = 'invitationCode';
            }
            if ($fieldKey == 'email') {
                $field['type'] = 'email';
            }
            if ($fieldKey == 'birthday') {
                $field['type'] = 'date';
                $field['placeholder'] = 'YYYY-MM-DD';
                if ($field['value'] instanceof DateTime) {
                    $field['value'] = $field['value']->format('Y-m-d');
                }
            }
            if ($fieldKey == 'year_of_birth') {
                $field['type'] = 'year';
                $field['options'] = [];
                $thisYear = (int)date('Y');
                for ($i = $thisYear; $i >= ($thisYear - 100); $i--) {
                    $field['options'][$i] = $i;
                }
            }
            if ($fieldKey == 'gender') {
                $field['type'] = 'radio';
                $field['value'] = $field['value'] ?? '';
                $field['options'] = [];
                $genders = $this->settings['registration']['gender'] ?? '';
                $genders = GeneralUtility::trimExplode(',', $genders, true);
                foreach ($genders as $gender) {
                    $translationKey = $translationPrefix . $index . '_field_gender_' . $gender;
                    $translation = LocalizationUtility::translate($translationKey, 'Modules');
                    $field['options'][$gender] = $translation;
                }
            }
            if ($fieldKey == 'profession') {
                $field['type'] = 'select';
                $field['value'] = $field['value'] ?? '';
                $field['options'] = [];
                $professions = $this->settings['registration']['professions'] ?? '';
                $professions = GeneralUtility::trimExplode(',', $professions, true);
                foreach ($professions as $profession) {
                    $translationKey = $translationPrefix . $index . '_field_profession_' . $profession;
                    $translation = LocalizationUtility::translate($translationKey, 'Modules');
                    $field['options'][$profession] = $translation;
                }
            }
            if ($fieldKey == 'accounting_type') {
                $field['type'] = 'select';
                $field['value'] = $field['value'] ?? '';
                $field['options'] = [];
                $accountingTypes = $this->settings['registration']['accountingType'] ?? '';
                $accountingTypes = GeneralUtility::trimExplode(',', $accountingTypes, true);
                foreach ($accountingTypes as $accountingType) {
                    $translationKey = $translationPrefix . $index . '_field_accounting_type_' . $accountingType;
                    $translation = LocalizationUtility::translate($translationKey, 'Modules');
                    $field['options'][$accountingType] = $translation;
                }
            }
            if ($fieldKey == 'marital_status') {
                $field['type'] = 'select';
                $field['value'] = $field['value'] ?? '';
                $field['options'] = [];
                $professions = $this->settings['registration']['maritalStatus'] ?? '';
                $professions = GeneralUtility::trimExplode(',', $professions, true);
                foreach ($professions as $profession) {
                    $translationKey = $translationPrefix . $index . '_field_marital_status_' . $profession;
                    $translation = LocalizationUtility::translate($translationKey, 'Modules');
                    $field['options'][$profession] = $translation;
                }
            }
            if ($fieldKey == 'children') {
                $field['type'] = 'select';
                $field['value'] = $field['value'] ?? '0';
                $field['options'] = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            }
            if ($fieldKey == 'newsletter') {
                $field['type'] = 'checkbox';
                $field['value'] = $field['value'] ?? false;
                $field['label'] = LocalizationUtility::translate($translationKey, 'Modules');
            }
            /** @var UriBuilder */
            $uriBuilder = $this->controllerContext->getUriBuilder();
            if ($fieldKey == 'terms_confirmed') {
                $field['type'] = 'checkbox';
                $field['value'] = $field['value'] ?? false;
                // Build terms link
                $termsUri = $uriBuilder->reset()
                    ->setCreateAbsoluteUri(true)
                    ->setTargetPageUid((int)$this->settings['pages']['terms'])
                    ->uriFor(); // Don't forget the: uriFor!!
                $field['label'] = LocalizationUtility::translate($translationKey, 'Modules', [0 => $termsUri]);
            }
            if ($fieldKey == 'privacy_confirmed') {
                $field['type'] = 'checkbox';
                $field['value'] = $field['value'] ?? false;
                // Build privacy link
                $termsUri = $uriBuilder->reset()
                    ->setCreateAbsoluteUri(true)
                    ->setTargetPageUid((int)$this->settings['pages']['privacy'])
                    ->uriFor(); // Don't forget the: uriFor!!
                $field['label'] = LocalizationUtility::translate($translationKey, 'Modules', [0 => $termsUri]);
            }
            if ($fieldKey == 'disclaimer_confirmed') {
                $field['type'] = 'checkbox';
                $field['value'] = $field['value'] ?? false;
                // Build disclaimer link
                $disclaimerUri = $uriBuilder->reset()
                    ->setCreateAbsoluteUri(true)
                    ->setTargetPageUid((int)$this->settings['pages']['disclaimer'])
                    ->uriFor(); // Don't forget the: uriFor!!
                $field['label'] = LocalizationUtility::translate($translationKey, 'Modules', [0 => $disclaimerUri]);
            }
            $this->settings[$index]['fields'][$fieldKey] = $field;
            // Duplicate password field
            if ($fieldKey == 'password') {
                $fieldKey = 'password_repeat';
                $field['key'] = $fieldKey;
                $translationKey = $translationPrefix . $index . '_field_' . $fieldKey;
                $field['label'] = LocalizationUtility::translate($translationKey, 'Modules');
                $this->settings[$index]['fields'][$fieldKey] = $field;
            }
        }
    }

    /**
     * Validate registration fields
     * @param bool $emailAsUsername Use email address as username
     * @return bool
     */
    protected function validateRegistrationFields($emailAsUsername)
    {
        $translationPrefix = 'tx_registration_label.';
        $validationSuccessful = true;
        $request = $this->request->getArguments();
        if (count($request) > 0) {
            foreach ($this->settings['registration']['fields'] as $fieldKey => $field) {
                $valid = false;
                $error = '';
                if (isset($request[$fieldKey])) {
                    $value = trim($request[$fieldKey]);
                    if ($field['required']) {
                        if (trim($value) !== '') {
                            $valid = true;
                        } else {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_required';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $validationSuccessful = false;
                        }
                    }
                    // Validate username
                    if ($fieldKey === 'username') {
                        if ($this->frontendUserUtility->usernameExists($value, 'both')) {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_already_exists';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $valid = false;
                        }
                        if ($error === '' && strlen($value) < (int)$this->settings['registration']['usernameMinLength']) {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_too_short';
                            $error = LocalizationUtility::translate(
                                $translationKey,
                                'Modules',
                                [(int)$this->settings['registration']['usernameMinLength']]
                            );
                            $valid = false;
                        }
                    }
                    // Validate invitation code
                    if ($fieldKey === 'invitationCode' && isset($this->settings['registration']['invitationRequired']) && $this->settings['registration']['invitationRequired']) {
                        $pageUid = (int)$this->settings['container']['frontendUser'];
                        if (FrontendUserUtility::validateInvitationCode($value, $pageUid)) {
                            $valid = true;
                        } else {
                            $error = LocalizationUtility::translate(
                                'tx_registration_message.error_invitation_code_invalid',
                                'Modules'
                            );
                            $valid = false;
                        }
                    }
                    // Validate password
                    if ($fieldKey === 'password') {
                        if (trim($value) === '') {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_required';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $valid = false;
                        }
                        if ($error === '' && strlen($value) < (int)$this->settings['registration']['passwordMinLength']) {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_too_short';
                            $error = LocalizationUtility::translate(
                                $translationKey,
                                'Modules',
                                [(int)$this->settings['registration']['passwordMinLength']]
                            );
                            $valid = false;
                        }
                        if ($error === '') {
                            $passwordRepeat = trim($request['password_repeat']);
                            if ($value !== $passwordRepeat) {
                                $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_unequal';
                                $error = LocalizationUtility::translate($translationKey, 'Modules');
                                $valid = false;
                            }
                        }
                        $this->settings['registration']['fields']['password_repeat']['valid'] = $valid;
                    }
                    // Validate year
                    if ($fieldKey === 'year_of_birth') {
                        $value = (int)$value;
                        if ($value < 0) {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_required';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $valid = false;
                        }
                        $minAge = (int)$this->settings['registration']['minAge'];
                        $minAgeYear = (int)date('Y') - $minAge;
                        if ($value > $minAgeYear) {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_too_young';
                            $error = LocalizationUtility::translate($translationKey, 'Modules', [0 => $minAge]);
                            $valid = false;
                        }
                        $this->settings['registration']['fields'][$fieldKey]['valid'] = $valid;
                    }
                    // Validate birthday
                    if ($fieldKey === 'birthday') {
                        $dateValues = explode('-', $value);
                        $year = 0;
                        $month = 0;
                        $day = 0;
                        if (isset($dateValues[0]) && strlen($dateValues[0]) === 4) {
                            $year = (int)$dateValues[0];
                        }
                        if (isset($dateValues[1])) {
                            $month = (int)$dateValues[1];
                        }
                        if (isset($dateValues[2])) {
                            $day = (int)$dateValues[2];
                        }
                        if (!checkdate($month, $day, $year) || $value === '') {
                            $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_required';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $valid = false;
                        } else {
                            $minAge = (int)$this->settings['registration']['minAge'];
                            $minAgeYear = (int)date('Y') - $minAge;
                            $minAgeMonth = (int)date('m');
                            $minAgeDay = (int)date('d');
                            $minAgeTimestamp = mktime(0, 0, 0, $minAgeMonth, $minAgeDay, $minAgeYear);
                            $valueTimestamp = mktime(0, 0, 0, $month, $day, $year);
                            if ($valueTimestamp >= $minAgeTimestamp) {
                                $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_too_young';
                                $error = LocalizationUtility::translate($translationKey, 'Modules', [0 => $minAge]);
                                $valid = false;
                            }
                        }
                        $this->settings['registration']['fields'][$fieldKey]['valid'] = $valid;
                    }
                    // Validate email
                    if ($fieldKey === 'email' && $error === '') {
                        /** @var EmailAddressValidator $emailAddressValidator */
                        $emailAddressValidator = GeneralUtility::makeInstance(EmailAddressValidator::class);
                        $emailValidationResult = $emailAddressValidator->validate($value);
                        if ($emailValidationResult->hasErrors()) {
                            $translationKey = $translationPrefix . 'registration_field_email_invalid';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $valid = false;
                        }
                        //
                        // Use email as username!?
                        if ($emailAsUsername && $valid) {
                            $this->settings['registration']['fields']['username']['value'] = $request['email'];
                            if ($this->frontendUserUtility->usernameExists($request['email'], 'both')) {
                                $translationKey = $translationPrefix . 'registration_field_username_already_exists';
                                $error = LocalizationUtility::translate($translationKey, 'Modules');
                                $valid = false;
                            }
                        }
                    }
                    //
                    $this->settings['registration']['fields'][$fieldKey]['valid'] = $valid;
                    $this->settings['registration']['fields'][$fieldKey]['value'] = $value;
                    if ($error !== '') {
                        $validationSuccessful = false;
                        $this->settings['registration']['fields'][$fieldKey]['error'] = $error;
                    }
                } // Value isn't in request
                else {
                    if ($field['required']) {
                        $this->settings['registration']['fields'][$fieldKey]['valid'] = false;
                        $translationKey = $translationPrefix . 'registration_field_' . $fieldKey . '_required';
                        $error = LocalizationUtility::translate($translationKey, 'Modules');
                        $this->settings['registration']['fields'][$fieldKey]['error'] = $error;
                        $validationSuccessful = false;
                    }
                }
            }
            if (!$validationSuccessful) {
                // Show message about validation errors
                $translationKey = 'tx_registration_message.error_registration_validation_failed_title';
                $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                $translationKey = 'tx_registration_message.error_registration_validation_failed_body';
                $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::ERROR);
            }
        } else {
            // Reset some variables, for initial displaying the form
            $validationSuccessful = false;
            $this->settings['registration']['fields']['password']['valid'] = true;
            $this->settings['registration']['fields']['password_repeat']['valid'] = true;
        }
        return $validationSuccessful;
    }

    /**
     * Validate profile editing fields
     * @return bool
     */
    protected function validateProfileFields()
    {
        $translationPrefix = 'tx_profile_label.';
        $validationSuccessful = true;
        $request = $this->request->getArguments();
        if (count($request) > 0) {
            foreach ($this->settings['profile']['fields'] as $fieldKey => $field) {
                $valid = false;
                $error = '';
                if (isset($request[$fieldKey])) {
                    $value = trim($request[$fieldKey]);
                    if ($field['required']) {
                        if (trim($value) !== '') {
                            $valid = true;
                        } else {
                            $translationKey = $translationPrefix . 'profile_field_' . $fieldKey . '_required';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $validationSuccessful = false;
                        }
                    }
                    // Validate year
                    if ($fieldKey === 'year_of_birth') {
                        $value = (int)$value;
                        if ($value < 0) {
                            $translationKey = $translationPrefix . 'profile_field_' . $fieldKey . '_required';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $valid = false;
                        }
                        if (isset($this->settings['registration'])) {
                            $minAge = (int)$this->settings['registration']['minAge'];
                            $minAgeYear = (int)date('Y') - $minAge;
                            if ($value > $minAgeYear) {
                                $translationKey = $translationPrefix . 'profile_field_' . $fieldKey . '_too_young';
                                $error = LocalizationUtility::translate($translationKey, 'Modules', [0 => $minAge]);
                                $valid = false;
                            }
                        }
                        $this->settings['profile']['fields'][$fieldKey]['valid'] = $valid;
                    }
                    // Validate birthday
                    if ($fieldKey === 'birthday') {
                        $dateValues = explode('-', $value);
                        $year = 0;
                        $month = 0;
                        $day = 0;
                        if (isset($dateValues[0]) && strlen($dateValues[0]) === 4) {
                            $year = (int)$dateValues[0];
                        }
                        if (isset($dateValues[1])) {
                            $month = (int)$dateValues[1];
                        }
                        if (isset($dateValues[2])) {
                            $day = (int)$dateValues[2];
                        }
                        if (!checkdate($month, $day, $year) || $value === '') {
                            $translationKey = $translationPrefix . 'profile_field_' . $fieldKey . '_required';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                            $valid = false;
                        } else {
                            if (isset($this->settings['registration'])) {
                                $minAge = (int)$this->settings['registration']['minAge'];
                                $minAgeYear = (int)date('Y') - $minAge;
                                $minAgeMonth = (int)date('m');
                                $minAgeDay = (int)date('d');
                                $minAgeTimestamp = mktime(0, 0, 0, $minAgeMonth, $minAgeDay, $minAgeYear);
                                $valueTimestamp = mktime(0, 0, 0, $month, $day, $year);
                                if ($valueTimestamp >= $minAgeTimestamp) {
                                    $translationKey = $translationPrefix . 'profile_field_' . $fieldKey . '_too_young';
                                    $error = LocalizationUtility::translate($translationKey, 'Modules', [0 => $minAge]);
                                    $valid = false;
                                }
                            }
                        }
                        $this->settings['profile']['fields'][$fieldKey]['valid'] = $valid;
                    }
                    // Validate email
                    if ($fieldKey === 'email' && $error === '') {
                        /** @var EmailAddressValidator $emailAddressValidator */
                        $emailAddressValidator = GeneralUtility::makeInstance(EmailAddressValidator::class);
                        $emailValidationResult = $emailAddressValidator->validate($value);
                        if ($emailValidationResult->hasErrors()) {
                            $translationKey = $translationPrefix . 'profile_field_email_invalid';
                            $error = LocalizationUtility::translate($translationKey, 'Modules');
                        }
                    }
                    // Validate checkbox
                    if ($field['type'] === 'checkbox') {
                        $value = (bool)$value;
                    }
                    //
                    $this->settings['profile']['fields'][$fieldKey]['valid'] = $valid;
                    $this->settings['profile']['fields'][$fieldKey]['value'] = $value;
                    if ($error !== '') {
                        $validationSuccessful = false;
                        $this->settings['profile']['fields'][$fieldKey]['error'] = $error;
                    }
                } // Value isn't in request
                else {
                    if ($field['required']) {
                        $this->settings['profile']['fields'][$fieldKey]['valid'] = false;
                        $translationKey = $translationPrefix . 'profile_field_' . $fieldKey . '_required';
                        $error = LocalizationUtility::translate($translationKey, 'Modules');
                        $this->settings['profile']['fields'][$fieldKey]['error'] = $error;
                        $validationSuccessful = false;
                    }
                }
            }
            if (!$validationSuccessful) {
                // Show message about validation errors
                $translationKey = 'tx_profile_message.error_profile_validation_failed_title';
                $messageTitle = LocalizationUtility::translate($translationKey, 'Modules');
                $translationKey = 'tx_profile_message.error_profile_validation_failed_body';
                $messageBody = LocalizationUtility::translate($translationKey, 'Modules');
                $this->addFlashMessage($messageBody, $messageTitle, FlashMessage::ERROR);
            }
        } else {
            // Reset some variables, for initial displaying the form
            $validationSuccessful = false;
            $this->settings['profile']['fields']['password']['valid'] = true;
            $this->settings['profile']['fields']['password_repeat']['valid'] = true;
        }
        return $validationSuccessful;
    }

    /**
     * @throws StopActionException
     * @throws NoSuchArgumentException
     * @throws Exception
     */
    public function loginFromBackendAction()
    {
        if ($this->request->hasArgument('user')) {
            $frontendUserUid = (int)$this->request->getArgument('user');
            $frontendUser = $this->frontendUserRepository->findByIdentifier($frontendUserUid);
            if ($frontendUser instanceof FrontendUser) {
                $pageUid = (int)$this->settings['container']['frontendUser'];
                if ($pageUid > 0) {
                    $success = $this->frontendUserUtility->loginByBackend($frontendUser, $pageUid);
                    if ($success) {
                        $this->redirectToUri('/');
                    } else {
                        throw new Exception('Error 4 - If you\'re not logged in as admin user, you might need to activate this feature');
                    }
                } else {
                    throw new Exception('Error 3 - Please define container.frontendUser = x');
                }
            } else {
                throw new Exception('Error 2');
            }
        } else {
            throw new Exception('Error 1');
        }
    }

    /**
     * @return false|string
     * @throws NoSuchArgumentException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function invitationCodeAvailableAction()
    {
        $json = [
            'available' => false,
        ];
        if ($this->request->hasArgument('code')) {
            $code = trim($this->request->getArgument('code'));
            if ($code !== '') {
                $pageUid = (int)$this->settings['container']['frontendUser'];
                if ($pageUid === 0) {
                    $json['error'] = 'No container configured';
                } else {
                    $json['available'] = FrontendUserUtility::validateInvitationCode($code, $pageUid);
                    if (!$json['available']) {
                        $json['error'] = 'Invalid code';
                    }
                }
            } else {
                $json['error'] = 'Empty code giving';
            }
        } else {
            $json['error'] = 'No code giving';
        }
        if (isset($json['error'])) {
            $json['error'] = LocalizationUtility::translate(
                'tx_registration_message.error_invitation_code_invalid',
                'Modules'
            );
        }
        $json = json_encode($json);
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Transfer-Encoding: 8bit');
        header('Content-Length: ' . strlen($json));
        echo $json;
        exit;
    }
}
