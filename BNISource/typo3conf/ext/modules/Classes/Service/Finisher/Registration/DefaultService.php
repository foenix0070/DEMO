<?php

namespace CodingMs\Modules\Service\Finisher\Registration;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Deuling <typo3@coding.ms>, coding.ms
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
use CodingMs\Modules\Domain\Model\FrontendUserGroup;
use CodingMs\Modules\Domain\Repository\FrontendUserGroupRepository;
use CodingMs\Modules\Domain\Repository\FrontendUserRepository;
use CodingMs\Modules\Utility\FrontendUserUtility;
use DateTime;
use Exception;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\Exception as ObjectException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Validation\Validator\EmailAddressValidator;

/**
 * Registration default finisher
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class DefaultService
{
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
     * @var FrontendUserUtility
     */
    protected FrontendUserUtility $frontendUserUtility;

    /**
     * @var EmailAddressValidator
     */
    protected EmailAddressValidator $emailAddressValidator;

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
        $this->emailAddressValidator = GeneralUtility::makeInstance(EmailAddressValidator::class);
    }

    /**
     * Finish the default registration
     *
     * @param array<string, mixed> $settings
     * @return bool
     * @throws Exception
     */
    public function finish($settings): bool
    {
        //
        // Save user
        $fields = $settings['registration']['fields'];
        $frontendUser = $this->createFrontendUser($fields, $settings);
        if (!($frontendUser instanceof FrontendUser)) {
            throw new Exception('Can\' create frontend user');
        }
        //
        // From email and name
        $fromName = trim($settings['registration']['email']['fromName']);
        $fromEmail = trim($settings['registration']['email']['fromEmail']);
        if ($this->validateEmail($fromEmail) === false) {
            throw new Exception('From email invalid');
        }
        $fromAddress = new Address($fromEmail, $fromName);
        //
        // To email
        if ($this->validateEmail($frontendUser->getEmail()) === false) {
            throw new Exception('User email invalid');
        }
        $toAddress = new Address($frontendUser->getEmail());
        //
        // BCC email
        $bccEmail = trim($settings['registration']['email']['bccEmail']);
        if (trim($bccEmail) !== '' && $this->validateEmail($bccEmail) === false) {
            throw new Exception('BCC email invalid');
        }
        //
        // Render email content
        /** @var FluidEmail $mail */
        $mail = GeneralUtility::makeInstance(FluidEmail::class);
        $mail->format('html')
            ->from($fromAddress)
            ->to($toAddress)
            ->subject($settings['registration']['email']['subject'])
            ->setTemplate('FrontendUser/ActivateRegistration')
            ->assignMultiple([
                'subject' => $settings['registration']['email']['subject'],
                'settings' => $settings,
                'frontendUser' => $frontendUser,
            ]);
        //
        if (trim($bccEmail) !== '') {
            $mail->bcc(new Address($bccEmail));
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
        return $success;
    }

    /**
     * @param string $hash
     * @param array<string, mixed> $settings
     * @return bool
     * @throws Exception
     */
    public function askAdminForPermission(string $hash, array $settings = []): bool
    {
        $success = false;
        // Search for a frontend user with that hash
        $frontendUser = $this->frontendUserRepository->findByHash($hash, 'both');
        if ($frontendUser instanceof FrontendUser) {
            //
            // From email and name
            $fromEmail = trim($settings['registration']['emailAdminActivation']['fromEmail']);
            if ($this->validateEmail($fromEmail) === false) {
                throw new Exception('From email invalid');
            }
            $fromAddress = new Address($fromEmail);
            //
            // To email
            $toEmail = trim($settings['registration']['emailAdminActivation']['toEmail']);
            if ($this->validateEmail($toEmail) === false) {
                throw new Exception('To email invalid');
            }
            $toAddress = new Address($toEmail);
            //
            // BCC email
            $bccEmail = trim($settings['registration']['emailAdminActivation']['bccEmail']);
            if (trim($bccEmail) !== '' && $this->validateEmail($bccEmail) === false) {
                throw new Exception('BCC email invalid');
            }
            //
            // Render email content
            /** @var FluidEmail $mail */
            $mail = GeneralUtility::makeInstance(FluidEmail::class);
            $mail->format('html')
                ->from($fromAddress)
                ->to($toAddress)
                ->subject($settings['registration']['emailAdminActivation']['subject'])
                ->setTemplate('FrontendUser/ActivateRegistrationAdmin')
                ->assignMultiple([
                    'subject' => $settings['registration']['emailAdminActivation']['subject'],
                    'settings' => $settings,
                    'frontendUser' => $frontendUser,
                ]);
            //
            if (trim($bccEmail) !== '') {
                $mail->bcc(new Address($bccEmail));
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
        }
        return $success;
    }

    /**
     * @param string $hash
     * @param array $settings
     * @param bool $calledByAdmin
     * @param bool $rejected
     * @return bool
     * @throws Exception
     * @throws IllegalObjectTypeException
     * @throws ObjectException
     * @throws UnknownObjectException
     * @noinspection PhpUnused
     */
    public function processHash(string $hash, array $settings = [], $calledByAdmin = false, $rejected = false): bool
    {
        $success = false;
        // Search for a frontend user with that hash
        $frontendUser = $this->frontendUserRepository->findByHash($hash, 'both');
        if ($frontendUser instanceof FrontendUser) {
            //
            // Hash is set
            // Frontend user is disabled
            // lastlogin is 0
            // -> Activate registration
            if ($frontendUser->getDisable()) {
                $lastLogin = $frontendUser->getLastlogin();
                // Frontend user never logged in
                // lastlogin = 0 -> results not a DateTime, rather NULL
                if ($lastLogin === null) {
                    if (!$calledByAdmin || !$rejected) {
                        $frontendUser->setHash('');
                        $frontendUser->setDisable(false);
                        $this->frontendUserRepository->update($frontendUser);
                        $this->persistenceManager->persistAll();
                    }
                    //
                    // Send activation confirmation mail
                    if ($settings['registration']['emailOnActivation']['active'] || $settings['registration']['enableAdminConfirmation']) {
                        if ($calledByAdmin) {
                            if ($rejected) {
                                $fromEmail = $settings['registration']['emailAdminRejection']['fromEmail'];
                                $fromName = $settings['registration']['emailAdminRejection']['fromName'];
                                $template = 'FrontendUser/ActivateAdminRejection';
                                $subject = trim($settings['registration']['emailAdminRejection']['subject']);
                                $bccEmail = trim($settings['registration']['emailAdminRejection']['bccEmail']);
                            } else {
                                $fromEmail = $settings['registration']['emailAdminConfirmation']['fromEmail'];
                                $fromName = $settings['registration']['emailAdminConfirmation']['fromName'];
                                $template = 'FrontendUser/ActivateAdminConfirmation';
                                $subject = trim($settings['registration']['emailAdminConfirmation']['subject']);
                                $bccEmail = trim($settings['registration']['emailAdminConfirmation']['bccEmail']);
                            }
                        } else {
                            $fromEmail = $settings['registration']['emailOnActivation']['fromEmail'];
                            $fromName = $settings['registration']['emailOnActivation']['fromName'];
                            $template = 'FrontendUser/Activation';
                            $subject = trim($settings['registration']['emailOnActivation']['subject']);
                            $bccEmail = trim($settings['registration']['emailOnActivation']['bccEmail']);
                        }
                        //
                        // From email and name
                        if ($this->validateEmail($fromEmail) === false) {
                            throw new Exception('From email invalid');
                        }
                        $fromAddress = new Address($fromEmail, $fromName);
                        //
                        // To email
                        $toAddress = new Address($frontendUser->getEmail());
                        //
                        // BCC email
                        if (trim($bccEmail) !== '' && $this->validateEmail($bccEmail) === false) {
                            throw new Exception('BCC email invalid');
                        }
                        //
                        // Render email content
                        /** @var FluidEmail $mail */
                        $mail = GeneralUtility::makeInstance(FluidEmail::class);
                        $mail->format('html')
                            ->from($fromAddress)
                            ->to($toAddress)
                            ->subject($subject)
                            ->setTemplate($template)
                            ->assignMultiple([
                                'subject' => $subject,
                                'settings' => $settings,
                                'frontendUser' => $frontendUser,
                            ]);
                        //
                        if (trim($bccEmail) !== '') {
                            $mail->bcc(new Address($bccEmail));
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
                    } else {
                        // Is successful, because emailOnActivation is deactivated
                        $success = true;
                    }
                    //
                }
            }
        }
        return $success;
    }

    /**
     * @param string $email
     * @return bool|string
     */
    public function validateEmail(string $email = '')
    {
        $validateEmailResult = $this->emailAddressValidator->validate($email);
        if (trim($email) == '' || $validateEmailResult->hasErrors()) {
            $email = false;
        }
        return $email;
    }

    /**
     * @param array $fields
     * @param array $settings
     * @return FrontendUser
     * @throws Exception
     */
    protected function createFrontendUser($fields = [], $settings = [])
    {
        /** @var FrontendUser $frontendUser */
        $frontendUser = new FrontendUser();
        if (isset($fields['gender']['value']) && trim($fields['gender']['value']) !== '') {
            $frontendUser->setGender($fields['gender']['value']);
        }
        if (isset($fields['username']['value']) && trim($fields['username']['value']) !== '') {
            $frontendUser->setUsername($fields['username']['value']);
        } else {
            throw new Exception('Frontend user username invalid');
        }
        // Encrypt and save password
        if (isset($fields['password']['value']) && trim($fields['password']['value']) !== '') {
            $passwordEncryption = $settings['registration']['passwordEncryption'];
            $password = $this->frontendUserUtility->hashPassword($fields['password']['value'], $passwordEncryption);
            $frontendUser->setPassword($password);
        } else {
            throw new Exception('Frontend user password invalid');
        }
        if (isset($fields['email']['value']) && trim($fields['email']['value']) !== '') {
            if ($this->validateEmail($fields['email']['value']) === false) {
                throw new Exception('Frontend user email invalid');
            }
            $frontendUser->setEmail($fields['email']['value']);
        }
        if (isset($fields['name']['value']) && trim($fields['name']['value']) !== '') {
            $frontendUser->setName($fields['name']['value']);
        }
        if (isset($fields['first_name']['value']) && trim($fields['first_name']['value']) !== '') {
            $frontendUser->setFirstName($fields['first_name']['value']);
        }
        if (isset($fields['last_name']['value']) && trim($fields['last_name']['value']) !== '') {
            $frontendUser->setLastName($fields['last_name']['value']);
        }
        if (isset($fields['address']['value']) && trim($fields['address']['value']) !== '') {
            $frontendUser->setAddress($fields['address']['value']);
        }
        if (isset($fields['company']['value']) && trim($fields['company']['value']) !== '') {
            $frontendUser->setCompany($fields['company']['value']);
        }
        if (isset($fields['zip']['value']) && trim($fields['zip']['value']) !== '') {
            $frontendUser->setZip($fields['zip']['value']);
        }
        if (isset($fields['city']['value']) && trim($fields['city']['value']) !== '') {
            $frontendUser->setCity($fields['city']['value']);
        }
        if (isset($fields['country']['value']) && trim($fields['country']['value']) !== '') {
            $frontendUser->setCountry($fields['country']['value']);
        }
        if (isset($fields['telephone']['value']) && trim($fields['telephone']['value']) !== '') {
            $frontendUser->setTelephone($fields['telephone']['value']);
        }
        if (isset($fields['fax']['value']) && trim($fields['fax']['value']) !== '') {
            $frontendUser->setFax($fields['fax']['value']);
        }
        if (isset($fields['mobile']['value']) && trim($fields['mobile']['value']) !== '') {
            $frontendUser->setMobile($fields['mobile']['value']);
        }
        if (isset($fields['terms_confirmed']['value']) && trim($fields['terms_confirmed']['value']) !== '') {
            $termsConfirmed = ($fields['terms_confirmed']['value'] === 'terms_confirmed');
            $frontendUser->setTermsConfirmed($termsConfirmed);
        }
        if (isset($fields['privacy_confirmed']['value']) && trim($fields['privacy_confirmed']['value']) !== '') {
            $privacyConfirmed = ($fields['privacy_confirmed']['value'] === 'privacy_confirmed');
            $frontendUser->setPrivacyConfirmed($privacyConfirmed);
        }
        if (isset($fields['disclaimer_confirmed']['value']) && trim($fields['disclaimer_confirmed']['value']) !== '') {
            $disclaimerConfirmed = ($fields['disclaimer_confirmed']['value'] === 'disclaimer_confirmed');
            $frontendUser->setDisclaimerConfirmed($disclaimerConfirmed);
        }
        if (isset($fields['newsletter']['value']) && trim($fields['newsletter']['value']) !== '') {
            $newsletter = ($fields['newsletter']['value'] === 'newsletter');
            $frontendUser->setNewsletter($newsletter);
        }
        if (isset($fields['profession']['value']) && trim($fields['profession']['value']) !== '') {
            $frontendUser->setProfession($fields['profession']['value']);
        }
        if (isset($fields['marital_status']['value']) && trim($fields['marital_status']['value']) !== '') {
            $frontendUser->setMaritalStatus($fields['marital_status']['value']);
        }
        if (isset($fields['children']['value']) && trim($fields['children']['value']) !== '') {
            $frontendUser->setChildren($fields['children']['value']);
        }
        if (isset($fields['bank_account_owner_name']['value']) && trim($fields['bank_account_owner_name']['value']) !== '') {
            $frontendUser->setBankAccountOwnerName($fields['bank_account_owner_name']['value']);
        }
        if (isset($fields['bank_account_bank_name']['value']) && trim($fields['bank_account_bank_name']['value']) !== '') {
            $frontendUser->setBankAccountBankName($fields['bank_account_bank_name']['value']);
        }
        if (isset($fields['bank_account_bic']['value']) && trim($fields['bank_account_bic']['value']) !== '') {
            $frontendUser->setBankAccountBic($fields['bank_account_bic']['value']);
        }
        if (isset($fields['bank_account_iban']['value']) && trim($fields['bank_account_iban']['value']) !== '') {
            $frontendUser->setBankAccountIban($fields['bank_account_iban']['value']);
        }
        if (isset($fields['accounting_type']['value']) && trim($fields['accounting_type']['value']) !== '') {
            $frontendUser->setAccountingType($fields['accounting_type']['value']);
        }
        if (isset($fields['vat_number']['value']) && trim($fields['vat_number']['value']) !== '') {
            $frontendUser->setVatNumber($fields['vat_number']['value']);
        }
        if (isset($fields['birthday']['value']) && trim($fields['birthday']['value']) !== '') {
            $dateValues = explode('-', $fields['birthday']['value']);
            $year = (int)$dateValues[0];
            $month = (int)$dateValues[1];
            $day = (int)$dateValues[2];
            $valueTimestamp = mktime(0, 0, 0, $month, $day, $year);
            if ($valueTimestamp === false) {
                throw new Exception('Frontend user birthday invalid');
            }
            $birthday = new DateTime();
            $birthday->setTimestamp($valueTimestamp);
            $frontendUser->setBirthday($birthday);
        }
        if (isset($fields['year_of_birth']['value']) && trim($fields['year_of_birth']['value']) !== '') {
            $year = (int)$fields['year_of_birth']['value'];
            $valueTimestamp = mktime(0, 0, 0, 1, 1, $year);
            if ($valueTimestamp === false) {
                throw new Exception('Frontend user year of birth invalid');
            }
            $birthday = new DateTime();
            $birthday->setTimestamp($valueTimestamp);
            $frontendUser->setBirthday($birthday);
        }
        //
        // Insert required user groups
        //
        // Get user groups from main configuration,
        // This is the fallback for the invitation codes as well.
        $frontendUserGroups = $settings['registration']['frontendUserGroups'];
        if ($settings['registration']['invitationRequired']) {
            //
            // Get User groups from invitation code
            $pageUid = (int)$settings['container']['frontendUser'];
            $invitationCode = FrontendUserUtility::getInvitationCode($fields['invitation_code']['value'], $pageUid);
            if (isset($invitationCode['used']) && !$invitationCode['used']) {
                $frontendUserGroups = $invitationCode['usergroups'];
                //
                // Transfer default values from invitation code record
                if (trim($invitationCode['first_name']) !== '') {
                    $frontendUser->setFirstName($invitationCode['first_name']);
                }
                if (trim($invitationCode['last_name']) !== '') {
                    $frontendUser->setLastName($invitationCode['last_name']);
                }
                if (trim($invitationCode['company']) !== '') {
                    $frontendUser->setCompany($invitationCode['company']);
                }
                if ((int)$invitationCode['birthday'] > 0) {
                    $birthday = new DateTime();
                    $birthday->setTimestamp((int)$invitationCode['birthday']);
                    $frontendUser->setBirthday($birthday);
                }
                if ((int)$invitationCode['starttime'] > 0) {
                    $starttime = new DateTime();
                    $starttime->setTimestamp((int)$invitationCode['starttime']);
                    $frontendUser->setStarttime($starttime);
                }
                if ((int)$invitationCode['endtime'] > 0) {
                    $endtime = new DateTime();
                    $endtime->setTimestamp((int)$invitationCode['endtime']);
                    $frontendUser->setEndtime($endtime);
                }
                //
                // Mark invitation code as used!!
                FrontendUserUtility::invalidateInvitationCode($fields['invitation_code']['value'], $pageUid);
            }
        }
        $frontendUserGroups = GeneralUtility::trimExplode(',', $frontendUserGroups, true);
        if (!empty($frontendUserGroups)) {
            foreach ($frontendUserGroups as $groupUid) {
                $group = $this->frontendUserGroupRepository->findByUid((int)$groupUid);
                if ($group instanceof FrontendUserGroup) {
                    $frontendUser->addUsergroup($group);
                } else {
                    throw new Exception('Frontend user group with uid:' . $groupUid . ' not found or accessible!');
                }
            }
        } else {
            throw new Exception('Frontend user groups not found!');
        }
        //
        // Set record type
        $frontendUser->setRecordType($settings['registration']['recordType']);
        //
        // Disable user
        $frontendUser->setDisable(true);
        $frontendUser->setHash($this->frontendUserUtility->generateHash());
        $this->frontendUserRepository->add($frontendUser);
        $this->persistenceManager->persistAll();
        return $frontendUser;
    }
}
