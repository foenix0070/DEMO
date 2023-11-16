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

use CodingMs\Modules\Domain\DataTransferObject\FrontendUserActionPermission;
use CodingMs\Modules\Domain\DataTransferObject\FrontendUserGroupActionPermission;
use CodingMs\Modules\Domain\DataTransferObject\FrontendUserInvitationCodeActionPermission;
use CodingMs\Modules\Domain\Model\FrontendUserGroup;
use CodingMs\Modules\Domain\Model\Traits\SearchWordTrait;
use CodingMs\Modules\Domain\Repository\FrontendUserGroupRepository;
use CodingMs\Modules\Domain\Repository\FrontendUserRepository;
use CodingMs\Modules\Domain\Repository\InvitationCodeRepository;
use CodingMs\Modules\Utility\BackendListUtility;
use CodingMs\Modules\Utility\FrontendUserUtility;
use DateTime;
use Exception;
use TYPO3\CMS\Backend\Routing\UriBuilder as UriBuilderBackend;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Frontend user controller
 */
class FrontendUserBackendController extends BackendController
{
    use SearchWordTrait;

    /**
     * @var FrontendUserRepository
     */
    protected FrontendUserRepository $frontendUserRepository;

    /**
     * @var FrontendUserGroupRepository
     */
    protected FrontendUserGroupRepository $frontendUserGroupRepository;

    /**
     * @var InvitationCodeRepository
     */
    protected InvitationCodeRepository $invitationCodeRepository;

    /**
     * @param TypoScriptService $typoScriptService
     * @param BackendListUtility $backendListUtility
     * @param UriBuilderBackend $uriBuilderBackend
     * @param FrontendUserGroupRepository $frontendUserGroupRepository
     * @param InvitationCodeRepository $invitationCodeRepository
     * @param FrontendUserRepository $frontendUserRepository
     */
    public function __construct(
        TypoScriptService $typoScriptService,
        BackendListUtility $backendListUtility,
        UriBuilderBackend $uriBuilderBackend,
        FrontendUserGroupRepository $frontendUserGroupRepository,
        InvitationCodeRepository $invitationCodeRepository,
        FrontendUserRepository $frontendUserRepository
    ) {
        parent::__construct($typoScriptService, $backendListUtility, $uriBuilderBackend);
        //
        $this->moduleSettings = 'mod.web_frontenduser';
        $this->moduleName = 'web_ModulesFrontenduser';
        $this->modulePrefix = 'tx_modules_web_modulesfrontenduser';
        $this->frontendUserGroupRepository = $frontendUserGroupRepository;
        $this->invitationCodeRepository = $invitationCodeRepository;
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * Set up the doc header properly here
     *
     * @param ViewInterface $view
     * @throws Exception
     */
    protected function initializeView(ViewInterface $view)
    {
        /** @var BackendTemplateView $view */
        parent::initializeView($view);
        if ($this->view->getModuleTemplate() !== null) {
            $this->createMenu();
            $this->createButtons();
            //
            // Define storage pid
            $querySettings = $this->frontendUserGroupRepository->createQuery()->getQuerySettings();
            $querySettings->setStoragePageIds([$this->pageUid]);
            $this->frontendUserGroupRepository->setDefaultQuerySettings($querySettings);
            $this->frontendUserRepository->setDefaultQuerySettings($querySettings);
        }
    }

    /**
     * Create action menu
     *
     * @throws Exception
     */
    protected function createMenu(): void
    {
        $actions = [
            [
                'action' => 'list',
                'controller' => 'FrontendUserBackend',
                'label' => $this->translate('tx_modules_label.list_frontend_user')
            ]
        ];
        if (FrontendUserGroupActionPermission::listGroupsAllowed()) {
            $actions[] = [
                'action' => 'listFrontendUserGroups',
                'controller' => 'FrontendUserBackend',
                'label' => $this->translate('tx_modules_label.list_frontend_user_groups'),
            ];
        } elseif (!FrontendUserGroupActionPermission::listGroupsAllowed() && isset($_SERVER['DDEV_HOSTNAME'])) {
            $actions[] = [
                'action' => 'listFrontendUserGroups',
                'controller' => 'FrontendUserBackend',
                'label' => $this->translate('tx_modules_label.list_frontend_user_groups') . ' [disallowed]',
            ];
        }
        if (FrontendUserInvitationCodeActionPermission::manageInvitationCodesAllowed()) {
            $actions[] = [
                'action' => 'listInvitationCodes',
                'controller' => 'FrontendUserBackend',
                'label' => $this->translate('tx_modules_label.list_frontend_user_manage_invitation_codes'),
            ];
        } elseif (!FrontendUserInvitationCodeActionPermission::manageInvitationCodesAllowed() && isset($_SERVER['DDEV_HOSTNAME'])) {
            $actions[] = [
                'action' => 'listInvitationCodes',
                'controller' => 'FrontendUserBackend',
                'label' => $this->translate('tx_modules_label.list_frontend_user_manage_invitation_codes') . ' [disallowed]',
            ];
        }
        if (FrontendUserInvitationCodeActionPermission::importInvitationCodesAllowed()) {
            $actions[] = [
                'action' => 'importInvitationCodes',
                'controller' => 'FrontendUserBackend',
                'label' => $this->translate('tx_modules_label.list_frontend_user_import_invitation_codes'),
            ];
        } elseif (!FrontendUserInvitationCodeActionPermission::importInvitationCodesAllowed() && isset($_SERVER['DDEV_HOSTNAME'])) {
            $actions[] = [
                'action' => 'importInvitationCodes',
                'controller' => 'FrontendUserBackend',
                'label' => $this->translate('tx_modules_label.list_frontend_user_import_invitation_codes') . ' [disallowed]',
            ];
        }
        $this->createMenuActions($actions);
    }

    /**
     * Add menu buttons for specific actions
     *
     * @throws Exception
     */
    protected function createButtons(): void
    {
        $buttonBar = $this->view->getModuleTemplate()->getDocHeaderComponent()->getButtonBar();
        switch ($this->request->getControllerActionName()) {
            case 'list': {
                // New
                $this->getButton(
                    $buttonBar,
                    'new',
                    [
                        'translationKey' => 'new_frontend_user',
                        'table' => 'fe_users'
                    ],
                    !FrontendUserActionPermission::userCreationAllowed()
                );
                // CSV export
                $this->getButton(
                    $buttonBar,
                    'csv',
                    [
                        'translationKey' => 'list_frontend_user_export',
                        'action' => 'list',
                        'controller' => 'FrontendUserBackend',
                    ],
                    !FrontendUserActionPermission::userExportAllowed()
                );
                //
                $this->getButton($buttonBar, 'refresh', [
                    'translationKey' => 'list_frontend_user_refresh'
                ]);
                $this->getButton($buttonBar, 'bookmark', [
                    'translationKey' => 'list_frontend_user_bookmark'
                ]);
                break;
            }
            case 'listFrontendUserGroups':
                // New
                $this->getButton(
                    $buttonBar,
                    'new',
                    [
                        'translationKey' => 'new_frontend_user_group',
                        'table' => 'fe_groups'
                    ],
                    !FrontendUserGroupActionPermission::groupCreationAllowed()
                );
                //
                $this->getButton($buttonBar, 'refresh', [
                    'translationKey' => 'list_frontend_user_groups_refresh'
                ]);
                $this->getButton($buttonBar, 'bookmark', [
                    'translationKey' => 'list_frontend_user_groups_bookmark'
                ]);
                break;
            case 'listInvitationCodes':
                //
                $this->getButton($buttonBar, 'refresh', [
                    'translationKey' => 'list_frontend_user_invitation_codes_refresh'
                ]);
                $this->getButton($buttonBar, 'bookmark', [
                    'translationKey' => 'list_frontend_user_invitation_codes_bookmark'
                ]);
                break;
        }
    }

    /**
     * List for frontend user
     *
     * @throws NoSuchArgumentException
     * @throws InvalidQueryException
     */
    public function listAction(): void
    {
        // Build list
        $list = $this->backendListUtility->initList(
            $this->settings['lists']['frontendUser'],
            $this->request,
            ['searchWord', 'disabled', 'usergroup']
        );
        // Get search word
        if ($this->request->hasArgument('searchWord')) {
            $list['searchWord'] = trim($this->request->getArgument('searchWord'));
        }
        if ($this->request->hasArgument('disabled')) {
            $list['disabled'] = (bool)$this->request->getArgument('disabled');
        }
        $frontendUserGroups = $this->frontendUserGroupRepository->findAll();
        $list['usergroup']['items'] = [];
        /** @var FrontendUserGroup $frontendUserGroup */
        foreach ($frontendUserGroups as $frontendUserGroup) {
            $list['usergroup']['items'][$frontendUserGroup->getUid()] = $frontendUserGroup->getTitle();
        }
        if ($this->request->hasArgument('usergroup')) {
            $list['usergroup']['selected'] = (int)$this->request->getArgument('usergroup');
        } elseif (!isset($list['usergroup']['selected'])) {
            $list['usergroup']['selected'] = -1;
        }
        // Allow delete?!
        if (!FrontendUserActionPermission::userDeletionAllowed()) {
            if ($list['authorization']['isDdev']) {
                $list['actions']['delete']['css'] = 'bg-danger';
            } else {
                $list['actions']['delete']['css'] = 'd-none';
            }
        }
        // Allow disable/enable?!
        if (!FrontendUserActionPermission::userEnableDisableAllowed()) {
            if ($list['authorization']['isDdev']) {
                $list['actions']['disableEnable']['css'] = 'bg-danger';
            } else {
                $list['actions']['disableEnable']['css'] = 'disallowed';
            }
        }

        // Store settings
        $this->backendListUtility->writeSettings($list['id'], $list);
        //
        // Export Result as CSV!?
        if ($this->request->hasArgument('csv') && FrontendUserActionPermission::userExportAllowed()) {
            $list['limit'] = 0;
            $list['offset'] = 0;
            $list['pid'] = $this->pageUid;
            $frontendUser = $this->frontendUserRepository->findAllForBackendList($list);
            $list['countAll'] = $this->frontendUserRepository->findAllForBackendList($list, true);
            $this->backendListUtility->exportAsCsv($frontendUser, $list);
        } else {
            $list['pid'] = $this->pageUid;
            $frontendUser = $this->frontendUserRepository->findAllForBackendList($list);
            $list['countAll'] = $this->frontendUserRepository->findAllForBackendList($list, true);
        }

        $this->view->assign('list', $list);
        $this->view->assign('frontendUser', $frontendUser);
        $this->view->assign('currentPage', $this->pageUid);
        $this->view->assign('actionMethodName', $this->actionMethodName);
    }

    /**
     * List for frontend user groups
     *
     * @throws NoSuchArgumentException
     */
    public function listFrontendUserGroupsAction(): void
    {
        if (!FrontendUserGroupActionPermission::listGroupsAllowed()) {
            $this->redirect('list');
        }
        // Build list
        $list = $this->backendListUtility->initList($this->settings['lists']['frontendUserGroups'], $this->request, ['disabled']);
        if ($this->request->hasArgument('disabled')) {
            $list['disabled'] = (bool)$this->request->getArgument('disabled');
        }
        // Allow delete?!
        if (!FrontendUserGroupActionPermission::groupDeletionAllowed()) {
            if ($list['authorization']['isDdev']) {
                $list['actions']['delete']['css'] = 'bg-danger';
            } else {
                $list['actions']['delete']['css'] = 'd-none';
            }
        }
        // Store settings
        $this->backendListUtility->writeSettings($list['id'], $list);
        // Export Result as CSV!?
        if ($this->request->hasArgument('csv')) {
            $list['limit'] = 0;
            $list['offset'] = 0;
            $list['pid'] = $this->pageUid;
            $frontendUserGroups = $this->frontendUserGroupRepository->findAllForBackendList($list);
            $list['countAll'] = $this->frontendUserGroupRepository->findAllForBackendList($list, true);
            $this->backendListUtility->exportAsCsv($frontendUserGroups, $list);
        } else {
            $list['pid'] = $this->pageUid;
            $frontendUserGroups = $this->frontendUserGroupRepository->findAllForBackendList($list);
            $list['countAll'] = $this->frontendUserGroupRepository->findAllForBackendList($list, true);
        }
        $this->view->assign('list', $list);
        $this->view->assign('frontendUserGroups', $frontendUserGroups);
        $this->view->assign('currentPage', $this->pageUid);
        $this->view->assign('actionMethodName', $this->actionMethodName);
    }

    /**
     * List for frontend user invitation codes
     *
     * @throws NoSuchArgumentException
     */
    public function listInvitationCodesAction(): void
    {
        if (!FrontendUserInvitationCodeActionPermission::manageInvitationCodesAllowed()) {
            $this->redirect('list');
        }
        // Build list
        $list = $this->backendListUtility->initList(
            $this->settings['lists']['invitationCodes'],
            $this->request,
            ['searchWord']
        );
        //
        $list = $this->processSearchWordFilterTrait($list);
        // Allow delete?!
        if (!FrontendUserInvitationCodeActionPermission::manageInvitationCodesAllowed()) {
            if ($list['authorization']['isDdev']) {
                $list['actions']['delete']['css'] = 'bg-danger';
            } else {
                $list['actions']['delete']['css'] = 'd-none';
            }
        }
        // Store settings
        $this->backendListUtility->writeSettings($list['id'], $list);
        // Export Result as CSV!?
        if ($this->request->hasArgument('csv')) {
            $list['limit'] = 0;
            $list['offset'] = 0;
            $list['pid'] = $this->pageUid;
            $invitationCodes = $this->invitationCodeRepository->findAllForBackendList($list);
            $list['countAll'] = $this->invitationCodeRepository->findAllForBackendList($list, true);
            $this->backendListUtility->exportAsCsv($invitationCodes, $list);
        } else {
            $list['pid'] = $this->pageUid;
            $invitationCodes = $this->invitationCodeRepository->findAllForBackendList($list);
            $list['countAll'] = $this->invitationCodeRepository->findAllForBackendList($list, true);
        }
        $this->view->assign('list', $list);
        $this->view->assign('invitationCodes', $invitationCodes);
        $this->view->assign('currentPage', $this->pageUid);
        $this->view->assign('actionMethodName', $this->actionMethodName);
    }

    /**
     * Import for frontend user invitation codes
     *
     * @throws NoSuchArgumentException
     */
    public function importInvitationCodesAction(): void
    {
        if (!FrontendUserInvitationCodeActionPermission::importInvitationCodesAllowed()) {
            $this->redirect('list');
        }
        $csvRows = [];
        if ($this->request->hasArgument('invitationCodes')) {
            $userGroups = [];
            $uploadedFile = $this->request->getArgument('invitationCodes');
            $separator = $this->request->getArgument('separator') ?? ';';
            if ($separator === 'tab') {
                $separator = "\t";
            }
            if (isset($uploadedFile['tmp_name']) &&
                in_array(mime_content_type($uploadedFile['tmp_name']), [
                    'text/plain',
                    'text/csv',
                    'application/csv',
                    'application/x-csv',
                    'text/comma-separated-values',
                    'text/x-comma-separated-values',
                    'text/tab-separated-values'
                ]) && ($h = fopen($uploadedFile['tmp_name'], 'r')) !== false
            ) {
                while (($row = fgetcsv($h, 1000, $separator)) !== false) {
                    $birthday = '';
                    $birthdayTimestamp = (int)strtotime($row[4] ?? 0);
                    if ($birthdayTimestamp > 0) {
                        $birthday = new DateTime();
                        $birthday->setTimestamp($birthdayTimestamp);
                    }
                    $usergroupUids = GeneralUtility::trimExplode(',', $row[5] ?? '', true);
                    $usergroupsValid = [];
                    $usergroupsInvalid = [];
                    if (count($usergroupUids) > 0) {
                        foreach ($usergroupUids as $usergroupUid) {
                            if (!isset($userGroups[$usergroupUid])) {
                                if (ctype_digit($usergroupUid)) {
                                    // Try to find by uid
                                    $userGroups[$usergroupUid] = BackendUtility::getRecord('fe_groups', (int)$usergroupUid);
                                } else {
                                    // Try to find by usergroup name
                                    $userGroups[$usergroupUid] = FrontendUserUtility::getUsergroupByName(
                                        $usergroupUid,
                                        $this->pageUid
                                    );
                                }
                            }
                            if (is_array($userGroups[$usergroupUid]) && $userGroups[$usergroupUid]['pid'] === $this->pageUid) {
                                //
                                // Only for current page!
                                $usergroupsValid[$userGroups[$usergroupUid]['uid']] = $userGroups[$usergroupUid];
                            } else {
                                // Invalid or inaccessible groups
                                $usergroupsInvalid[$usergroupUid] = $usergroupUid;
                            }
                        }
                    }
                    $starttime = '';
                    $starttimeTimestamp = (int)strtotime($row[6] ?? 0);
                    if ($starttimeTimestamp > 0) {
                        $starttime = new DateTime();
                        $starttime->setTimestamp($starttimeTimestamp);
                    }
                    $endtime = '';
                    $endtimeTimestamp = (int)strtotime($row[7] ?? 0);
                    if ($endtimeTimestamp > 0) {
                        $endtime = new DateTime();
                        $endtime->setTimestamp($endtimeTimestamp);
                    }
                    if (!empty($row[0])) {
                        if (!isset($csvRows[$row[0]])) {
                            $csvRows[$row[0]] = [
                                'code' => [
                                    'value' => $row[0],
                                    'exists' => FrontendUserUtility::validateInvitationCode($row[0], $this->pageUid),
                                ],
                                'company' => $row[1] ?? '',
                                'first_name' => $row[2] ?? '',
                                'last_name' => $row[3] ?? '',
                                'birthday' => [
                                    'timestamp' => $birthdayTimestamp,
                                    'object' => $birthday,
                                ],
                                'usergroups' => [
                                    'validUids' => implode(',', array_keys($usergroupsValid)),
                                    'uids' => $usergroupUids,
                                    'valid' => $usergroupsValid,
                                    'invalid' => $usergroupsInvalid,
                                ],
                                'starttime' => [
                                    'timestamp' => $starttimeTimestamp,
                                    'object' => $starttime,
                                ],
                                'endtime' => [
                                    'timestamp' => $endtimeTimestamp,
                                    'object' => $endtime,
                                ],
                            ];
                        } else {
                            $this->addFlashMessage(
                                LocalizationUtility::translate(
                                    'tx_modules_label.list_invitation_codes_row_with_duplicate_code_in_file_found',
                                    'Modules',
                                    [implode(', ', $row)]
                                ),
                                LocalizationUtility::translate('tx_modules_label.error_headline', 'Modules'),
                                FlashMessage::ERROR
                            );
                        }
                    } else {
                        $this->addFlashMessage(
                            LocalizationUtility::translate(
                                'tx_modules_label.list_invitation_codes_row_without_code_found',
                                'Modules',
                                [implode(', ', $row)]
                            ),
                            LocalizationUtility::translate('tx_modules_label.error_headline', 'Modules'),
                            FlashMessage::ERROR
                        );
                    }
                }
                fclose($h);
            }
            $this->addFlashMessage(
                LocalizationUtility::translate(
                    'tx_modules_label.list_invitation_codes_valid_rows_found',
                    'Modules',
                    [count($csvRows)]
                ),
                LocalizationUtility::translate('tx_modules_label.ok_headline', 'Modules')
            );
        }
        if ($this->request->hasArgument('codes')) {
            //
            // Import checked rows now!
            /** @var ConnectionPool $connectionPool */
            $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
            $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_modules_domain_model_invitationcode');
            $insertedCount = 0;
            $codes = $this->request->getArgument('codes');
            foreach ($codes as $code) {
                $birthday = 0;
                if (isset($code['birthday']) && $code['birthday'] !== '') {
                    $birthday = (int)strtotime($code['birthday']);
                }
                $starttime = 0;
                if (isset($code['starttime']) && $code['starttime'] !== '') {
                    $starttime = (int)strtotime($code['starttime']);
                }
                $endtime = 0;
                if (isset($code['endtime']) && $code['endtime'] !== '') {
                    $endtime = (int)strtotime($code['endtime']);
                }
                $fields = [
                    'pid' => $this->pageUid,
                    'code' => $code['code'],
                    'company' => $code['company'],
                    'first_name' => $code['first_name'],
                    'last_name' => $code['last_name'],
                    'birthday' => $birthday,
                    'usergroups' => $code['usergroups'],
                    'starttime' => $starttime,
                    'endtime' => $endtime,
                ];
                $inserted = $queryBuilder->insert('tx_modules_domain_model_invitationcode')
                    ->values($fields)
                    ->execute();
                if ($inserted === 1) {
                    $insertedCount++;
                }
            }
            $this->addFlashMessage(
                LocalizationUtility::translate(
                    'tx_modules_label.list_invitation_codes_successfully_imported',
                    'Modules',
                    [$insertedCount]
                ),
                LocalizationUtility::translate('tx_modules_label.ok_headline', 'Modules')
            );
            if ($insertedCount < count($codes)) {
                $this->addFlashMessage(
                    LocalizationUtility::translate(
                        'tx_modules_label.list_invitation_codes_not_imported',
                        'Modules',
                        [(count($codes) - $insertedCount)]
                    ),
                    LocalizationUtility::translate('tx_modules_label.warning_headline', 'Modules'),
                    FlashMessage::ERROR
                );
            }
        }
        $this->view->assign('csvRows', $csvRows);
        $this->view->assign('currentPage', $this->pageUid);
        $this->view->assign('actionMethodName', $this->actionMethodName);
    }
}
