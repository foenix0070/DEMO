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

use CodingMs\Modules\Domain\DataTransferObject\BackendUserActionPermission;
use CodingMs\Modules\Domain\Repository\BackendUserRepository;
use CodingMs\Modules\Utility\BackendListUtility;
use Exception;
use TYPO3\CMS\Backend\Routing\UriBuilder as UriBuilderBackend;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

/**
 * Backend user controller
 */
class BackendUserBackendController extends BackendController
{
    /**
     * @var BackendUserRepository
     */
    protected BackendUserRepository $backendUserRepository;

    /**
     * @param TypoScriptService $typoScriptService
     * @param BackendListUtility $backendListUtility
     * @param UriBuilderBackend $uriBuilderBackend
     * @param BackendUserRepository $backendUserRepository
     */
    public function __construct(
        TypoScriptService $typoScriptService,
        BackendListUtility $backendListUtility,
        UriBuilderBackend $uriBuilderBackend,
        BackendUserRepository $backendUserRepository
    ) {
        parent::__construct($typoScriptService, $backendListUtility, $uriBuilderBackend);
        //
        $this->moduleSettings = 'mod.system_backenduser';
        $this->moduleName = 'system_ModulesBackenduser';
        $this->modulePrefix = 'tx_modules_system_modulesbackenduser';
        //
        $this->backendUserRepository = $backendUserRepository;
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
                'controller' => 'BackendUserBackend',
                'label' => $this->translate('tx_modules_label.list_backend_user')
            ]
        ];
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
                        'translationKey' => 'new_backend_user',
                        'table' => 'be_users',
                        'uid' => 0,
                    ],
                    !BackendUserActionPermission::userCreationAllowed()
                );
                //
                $this->getButton($buttonBar, 'refresh', [
                    'translationKey' => 'list_backend_user_refresh'
                ]);
                $this->getButton($buttonBar, 'bookmark', [
                    'translationKey' => 'list_backend_user_bookmark'
                ]);
                break;
            }
        }
    }

    /**
     * List for backend user
     *
     * @throws NoSuchArgumentException
     * @throws InvalidQueryException
     */
    public function listAction(): void
    {
        // Build list
        $list = $this->backendListUtility->initList(
            $this->settings['lists']['backendUser'],
            $this->request,
            ['searchWord', 'disabled']
        );
        // Get search word
        if ($this->request->hasArgument('searchWord')) {
            $list['searchWord'] = trim($this->request->getArgument('searchWord'));
        }
        if ($this->request->hasArgument('disabled')) {
            $list['disabled'] = (bool)$this->request->getArgument('disabled');
        }
        // Allow delete?!
        if (!BackendUserActionPermission::userDeletionAllowed()) {
            if ($list['authorization']['isDdev']) {
                $list['actions']['delete']['css'] = 'bg-danger';
            } else {
                $list['actions']['delete']['css'] = 'd-none';
            }
        }
        // Allow disable/enable?!
        if (!BackendUserActionPermission::userEnableDisableAllowed()) {
            if ($list['authorization']['isDdev']) {
                $list['actions']['disableEnable']['css'] = 'bg-danger';
            } else {
                $list['actions']['disableEnable']['css'] = 'd-none';
            }
        }

        // Store settings
        $this->backendListUtility->writeSettings($list['id'], $list);
        $list['pid'] = $this->pageUid;
        $backendUser = $this->backendUserRepository->findAllForBackendList($list);
        $list['countAll'] = $this->backendUserRepository->findAllForBackendList($list, true);
        //
        $this->view->assign('list', $list);
        $this->view->assign('backendUser', $backendUser);
        $this->view->assign('currentPage', $this->pageUid);
        $this->view->assign('actionMethodName', $this->actionMethodName);
    }
}
