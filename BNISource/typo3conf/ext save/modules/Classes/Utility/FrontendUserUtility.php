<?php

namespace CodingMs\Modules\Utility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Thomas Deuling <typo3@coding.ms>
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
use CodingMs\Modules\Domain\Repository\FrontendUserRepository;
use Doctrine\DBAL\Result;
use PDO;
use ReflectionException;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\UserAspect;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;
use TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility;

/**
 * Utility for building lists
 */
class FrontendUserUtility
{
    /**
     * @var FrontendUserRepository
     */
    protected FrontendUserRepository $frontendUserRepository;

    /**
     * @param FrontendUserRepository $frontendUserRepository
     */
    public function __construct(FrontendUserRepository $frontendUserRepository)
    {
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * @param string $username
     * @param string $disable Possible values: no, yes, both
     * @return bool
     */
    public function usernameExists(string $username, string $disable='no'): bool
    {
        $exists = false;
        $frontendUser = $this->frontendUserRepository->findByUsername($username, $disable);
        if ($frontendUser instanceof FrontendUser) {
            $exists = true;
        }
        return $exists;
    }

    /**
     * Generates a hash
     *
     * @param int $length
     * @return string
     */
    public function generateHash(int $length = 32): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Hash a password
     *
     * @param string $password
     * @param string $method none, md5, sha1 or saltedpasswords
     * @return string
     */
    public function hashPassword(string $password, string $method): string
    {
        switch ($method) {
            case 'default':
                /** @var PasswordHashFactory $passwordHashFactory */
                $passwordHashFactory = GeneralUtility::makeInstance(PasswordHashFactory::class);
                $hashInstance = $passwordHashFactory->getDefaultHashInstance('FE');
                $password = $hashInstance->getHashedPassword($password);
                break;
            case 'none':
                break;
            case 'md5':
                $password = md5($password);
                break;
            case 'sha1':
                $password = sha1($password);
                break;
            default:
                if (ExtensionManagementUtility::isLoaded('saltedpasswords')) {
                    if (SaltedPasswordsUtility::isUsageEnabled('FE')) {
                        $objInstanceSaltedPw = SaltFactory::getSaltingInstance();
                        $password = $objInstanceSaltedPw->getHashedPassword($password);
                    }
                }
        }
        return $password;
    }

    /**
     * Frontend user logout
     */
    public function logout(): void
    {
        $this->getTypoScriptFrontendController()->fe_user->logoff();
    }

    /**
     * Returns the current logged in frontend user
     * @return FrontendUser|null
     */
    public function getCurrentFrontendUser(): ?FrontendUser
    {
        /** @var Context $context */
        $context = GeneralUtility::makeInstance(Context::class);
        $frontendUser = null;
        if ($context->getPropertyFromAspect('frontend.user', 'isLoggedIn')) {
            /** @var UserAspect $frontendUserAspect */
            $frontendUserAspect = $context->getAspect('frontend.user');
            /** @var FrontendUser $frontendUser */
            $frontendUser = $this->frontendUserRepository->findByUid($frontendUserAspect->get('id'));
        }
        return $frontendUser;
    }

    /**
     * Login frontend user by backend admin
     *
     * @param FrontendUser $user
     * @param null $storagePageUids
     * @return bool
     * @throws ReflectionException
     */
    public function loginByBackend(FrontendUser $user, $storagePageUids = null): bool
    {
        //
        // Only admin users!
        // Or if configured non admins as well!
        $configuration = ExtensionUtility::getExtensionConfiguration('modules');
        $allowNonAdmin = (bool)$configuration['module']['frontendUser']['allowNonAdminUsersToLoginAsFrontendUser'];
        //
        $success = false;
        $userAuthentication = self::getBackendUserAuthentication();
        if ($userAuthentication->user['admin'] === 1 || $allowNonAdmin) {
            // Log in user
            $GLOBALS['TSFE']->fe_user->createUserSession(['uid' => (int)$user->getUid()]);
            $GLOBALS['TSFE']->fe_user->loginSessionStarted = 1;
            $GLOBALS['TSFE']->fe_user->forceSetCookie = true;
            $GLOBALS['TSFE']->fe_user->dontSetCookie = false;
            $GLOBALS['TSFE']->fe_user->start();
            $GLOBALS['TSFE']->fe_user->setAndSaveSessionData('dummy', true);
            $GLOBALS['TSFE']->fe_user->loginUser = 1;
            $success = true;
        }
        return $success;
    }

    /**
     * Checks if the current logged-in frontend user has a user group assigned
     *
     * @param int $userGroup
     * @return bool
     */
    public static function hasGroupUid($userGroup): bool
    {
        $valid = false;
        /** @var Context $context */
        $context = GeneralUtility::makeInstance(Context::class);
        if ($context->getPropertyFromAspect('frontend.user', 'isLoggedIn')) {
            /** @var UserAspect $frontendUserAspect */
            $frontendUserAspect = $context->getAspect('frontend.user');
            $valid = in_array($userGroup, $frontendUserAspect->getGroupIds());
        }
        return $valid;
    }

    /**
     * @return TypoScriptFrontendController
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    protected function getTypoScriptFrontendController()
    {
        return $GLOBALS['TSFE'];
    }

    /**
     * @return BackendUserAuthentication
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    protected static function getBackendUserAuthentication()
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * @param string $code
     * @param int $pageUid
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function validateInvitationCode(string $code, int $pageUid): bool
    {
        $invitationCode = self::getInvitationCode($code, $pageUid);
        return isset($invitationCode['used']) && !$invitationCode['used'];
    }

    /**
     * @param string $code
     * @param int $pageUid
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function getInvitationCode(string $code, int $pageUid): array
    {
        $invitationCodeRecord = [];
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_modules_domain_model_invitationcode');
        $queryBuilder->select('*')
            ->from('tx_modules_domain_model_invitationcode')
            ->where(
                $queryBuilder->expr()->eq(
                    'pid',
                    $queryBuilder->createNamedParameter($pageUid, PDO::PARAM_INT)
                )
            )
            ->andWhere(
                $queryBuilder->expr()->eq(
                    'code',
                    $queryBuilder->createNamedParameter(mb_convert_encoding($code, 'UTF-8', 'UTF-8'))
                )
            )
            ->andWhere(
                $queryBuilder->expr()->eq(
                    'used',
                    $queryBuilder->createNamedParameter('0')
                )
            )
            ->setMaxResults(1);
        $result = $queryBuilder->execute();
        if ($result instanceof Result) {
            $record = $result->fetchAssociative();
            if (is_array($record)) {
                $invitationCodeRecord = $record;
            }
        }
        return $invitationCodeRecord;
    }

    /**
     * @param string $code
     * @param int $pageUid
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function invalidateInvitationCode(string $code, int $pageUid): bool
    {
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_modules_domain_model_invitationcode');
        $queryBuilder->update('tx_modules_domain_model_invitationcode')
            ->where(
                $queryBuilder->expr()->eq(
                    'pid',
                    $queryBuilder->createNamedParameter($pageUid, PDO::PARAM_INT)
                )
            )
            ->andWhere(
                $queryBuilder->expr()->eq(
                    'code',
                    $queryBuilder->createNamedParameter($code)
                )
            )
            ->andWhere(
                $queryBuilder->expr()->eq(
                    'used',
                    $queryBuilder->createNamedParameter('0')
                )
            )
            ->set('used', '1')
            ->set('used_at', (new \DateTime())->format('Y-m-d H:i:s'));
        return (bool)$queryBuilder->execute();
    }

    /**
     * @param string $code
     * @param int $pageUid
     * @return ?array
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function getUsergroupByName(string $name, int $pageUid): ?array
    {
        $usergroup = null;
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('fe_groups');
        $queryBuilder->select('*')
            ->from('fe_groups')
            ->where(
                $queryBuilder->expr()->eq(
                    'pid',
                    $queryBuilder->createNamedParameter($pageUid, PDO::PARAM_INT)
                )
            )
            ->andWhere(
                $queryBuilder->expr()->eq(
                    'title',
                    $queryBuilder->createNamedParameter($name)
                )
            )
            ->setMaxResults(1);
        $result = $queryBuilder->execute();
        if ($result instanceof Result) {
            $record = $result->fetchAssociative();
            if (is_array($record)) {
                $usergroup = $record;
            }
        }
        return $usergroup;
    }
}
