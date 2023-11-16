<?php

namespace CodingMs\FluidForm\Controller;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2020 Thomas Deuling <typo3@coding.ms>
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

use CodingMs\FluidForm\Domain\Repository\FormRepository;
use CodingMs\FluidForm\Service\BackendService;
use CodingMs\FluidForm\Service\TypoScriptService;
use CodingMs\Modules\Controller\BackendController as BackendBaseController;
use Exception;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Exception\SiteNotFoundException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * BackendController
 */
class BackendController extends BackendBaseController
{
    /**
     * @var FormRepository
     */
    protected $formRepository;

    /**
     * @param FormRepository $formRepository
     */
    public function injectFormRepository(FormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
    }

    /**
     * @var BackendService
     */
    protected $backendService;

    /**
     * @param BackendService $backendService
     */
    public function injectBackendService(BackendService $backendService)
    {
        $this->backendService = $backendService;
    }

    /**
     * Set up the doc header properly here
     *
     * @param ViewInterface $view
     * @throws Exception
     */
    protected function initializeView(ViewInterface $view)
    {
        $this->extensionName = 'FluidForm';
        $this->moduleSettings = 'mod.web_fluidform';
        $this->moduleName = 'web_FluidFormFluidform';
        $this->modulePrefix = 'tx_fluidform_web_fluidform';
        /** @var BackendTemplateView $view */
        parent::initializeView($view);
        //
        if (isset($this->page['module']) && $this->page['module'] !== 'mails') {
            return;
        }
        if ($this->view->getModuleTemplate() !== null) {
            $this->createMenu();
            $this->createButtons();
        }
    }

    /**
     * Create action menu
     */
    protected function createMenu()
    {
        $actions = [
            [
                'action' => 'overview',
                'label' => LocalizationUtility::translate('tx_fluidform_label.menu_overview', 'FluidForm')
            ]
        ];
        $this->createMenuActions($actions);
    }

    /**
     * Add menu buttons for specific actions
     *
     * @throws Exception
     */
    protected function createButtons()
    {
        $buttonBar = $this->view->getModuleTemplate()->getDocHeaderComponent()->getButtonBar();
        switch ($this->request->getControllerActionName()) {
            case 'overview':
                $this->getButton($buttonBar, 'refresh', [
                    'translationKey' => 'list_overview_mails_refresh'
                ]);
                $this->getButton($buttonBar, 'bookmark', [
                    'translationKey' => 'list_overview_mails_bookmark'
                ]);
                break;
        }
    }

    /**
     * Mail overview
     *
     * @throws NoSuchArgumentException
     * @throws SiteNotFoundException
     * @throws InvalidQueryException
     */
    public function overviewAction()
    {
        $pages = $this->backendService->getMailsPages();
        if (isset($this->page['module']) && $this->page['module'] !== 'mails') {
            $this->addFlashMessage('Please select a mail container', 'Error', AbstractMessage::ERROR);
            $this->view->assign('pages', $pages);
            $this->view->assign('restrictedContext', true);
        } else {
            //
            // Fetch form configurations for current page
            $typoScript = TypoScriptService::getTypoScript($this->pageUid);
            $forms = $typoScript['plugin']['tx_fluidform']['settings']['forms'];
            //
            // Build list
            $list = $this->backendListUtility->initList(
                $this->settings['lists']['mails'],
                $this->request,
                ['dateFrom', 'dateTo', 'page', 'form', 'searchWord']
            );
            //
            // Selected page
            $list['page']['items'] = $pages;
            $list['page']['selected'] = $this->pageUid;
            if ($this->request->hasArgument('page')) {
                $list['page']['selected'] = (int)$this->request->getArgument('page');
            }
            //
            // Form selection
            foreach (array_keys($forms) as $formKey) {
                $formLabel = GeneralUtility::camelCaseToLowerCaseUnderscored($formKey);
                $list['form']['items'][$formKey] = str_replace('_', ' ', $formLabel);
                if (!isset($list['form']['selected'])) {
                    $list['form']['selected'] = $formKey;
                }
            }
            if ($this->request->hasArgument('form')) {
                $list['form']['selected'] = trim($this->request->getArgument('form'));
            }
            //
            // Date range
            if ($this->request->hasArgument('dateFrom')) {
                $list['dateFrom'] = $this->request->getArgument('dateFrom');
            }
            if (!isset($list['dateFrom']) || trim($list['dateFrom']) === '') {
                $list['dateFrom'] = date('d-m-Y', (time() - 60 * 60 * 24 * 7));
            }
            if ($this->request->hasArgument('dateTo')) {
                $list['dateTo'] = $this->request->getArgument('dateTo');
            }
            if (!isset($list['dateTo']) || trim($list['dateTo']) === '') {
                $list['dateTo'] = date('d-m-Y');
            }
            //
            // Get search word
            if ($this->request->hasArgument('searchWord')) {
                $list['searchWord'] = trim($this->request->getArgument('searchWord'));
            }
            //
            // Store settings
            $this->backendListUtility->writeSettings($list['id'], $list);
            //
            // Remove list columns not in form fields
            $dontRemove = ['creationDate', 'formKey'];
            foreach ($forms[$list['form']['selected']]['fieldsets'] as $fieldset) {
                foreach ($fieldset['fields'] as $fieldKey => $fieldData) {
                    $dontRemove[] = $fieldKey;
                }
            }
            $removedColumns = 0;
            foreach ($list['fields'] as $listFieldKey => $listFieldData) {
                if (!in_array($listFieldKey, $dontRemove)) {
                    $removedColumns++;
                    unset($list['fields'][$listFieldKey]);
                }
            }
            $list['columnsInList'] -= $removedColumns;
            $list['columnsInExport'] -= $removedColumns;
            //
            // Export Result as CSV!?
            if ($this->request->hasArgument('csv')) {
                $list['limit'] = 0;
                $list['offset'] = 0;
                $list['pid'] = $this->pageUid;
                $mails = $this->formRepository->findAllForBackendList($list);
                $list['countAll'] = $this->formRepository->findAllForBackendList($list, true);
                $this->backendListUtility->exportAsCsv($mails, $list);
            } else {
                $list['pid'] = $this->pageUid;
                $mails = $this->formRepository->findAllForBackendList($list);
                $list['countAll'] = $this->formRepository->findAllForBackendList($list, true);
            }
            //
            $this->view->assign('list', $list);
            $this->view->assign('mails', $mails);
            $this->view->assign('actionMethodName', $this->actionMethodName);
        }
        $this->view->assign('currentPage', $this->pageUid);
    }
}
