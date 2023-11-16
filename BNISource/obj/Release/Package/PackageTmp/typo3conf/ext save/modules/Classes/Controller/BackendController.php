<?php

namespace CodingMs\Modules\Controller;

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

use CodingMs\Modules\Utility\BackendListUtility;
use Exception;
use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder as UriBuilderBackend;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Backend base controller
 */
class BackendController extends ActionController
{
    /**
     * @var UriBuilderBackend
     */
    protected UriBuilderBackend $uriBuilderBackend;

    /**
     * @var BackendListUtility
     */
    protected BackendListUtility $backendListUtility;

    /**
     * @var BackendTemplateView
     */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /**
     * @var IconFactory
     */
    protected IconFactory $iconFactory;

    /**
     * @var int
     */
    protected int $pageUid;

    /**
     * @var array
     */
    protected array $page;

    /**
     * Extension name must be overridden in child classes!
     * @var string
     */
    protected string $extensionName = 'Modules';

    /**
     * Settings node in page/user TypoScript
     *
     * @var string
     */
    protected string $moduleSettings = 'mod.web_frontenduser';

    /**
     * Example:
     * web_OpenimmoProOpenimmo
     * web_AddressManagerAddressmanager
     *
     * @var string
     */
    protected string $moduleName = 'web_ModulesFrontenduser';

    /**
     * Example:
     * tx_openimmopro_web_openimmoproopenimmo
     * tx_addressmanager_web_addressmanager
     *
     * @var string
     */
    protected string $modulePrefix = 'tx_modules_web_modulesfrontenduser';

    /**
     * @var TypoScriptService
     */
    protected TypoScriptService $typoScriptService;

    /**
     * @param TypoScriptService $typoScriptService
     * @param BackendListUtility $backendListUtility
     * @param UriBuilderBackend $uriBuilderBackend
     */
    public function __construct(
        TypoScriptService $typoScriptService,
        BackendListUtility $backendListUtility,
        UriBuilderBackend $uriBuilderBackend
    ) {
        $this->typoScriptService = $typoScriptService;
        $this->backendListUtility = $backendListUtility;
        $this->uriBuilderBackend = $uriBuilderBackend;
        //
        $this->pageUid = (int)GeneralUtility::_GP('id');
        $this->page = BackendUtility::getRecord('pages', $this->pageUid) ?? [];
    }

    /**
     * Set up the doc header properly here
     *
     * @param ViewInterface $view
     * @throws Exception
     */
    protected function initializeView(ViewInterface $view)
    {
        //
        // Identify the extension name
        $this->extensionName = GeneralUtility::underscoredToUpperCamelCase(
            $this->controllerContext->getRequest()->getControllerExtensionKey()
        );
        //
        // Check authorization
        $this->mergeModuleSettings($this->moduleSettings);
        $action = substr($this->actionMethodName, 0, -6);
        if (isset($this->settings[$action]['disable']) && $this->settings[$action]['disable']) {
            throw new Exception('Feature is disabled!');
        }
        //
        /** @var BackendTemplateView $view */
        if ($this->view->getModuleTemplate() !== null) {
            $pageRenderer = $this->view->getModuleTemplate()->getPageRenderer();

            // Include Stylesheets
            $extRealPath = PathUtility::getAbsoluteWebPath('../typo3conf/ext/modules/');
            // Include JavaScripts
            $contribPath = 'Resources/Public/Contrib/';
            $contribPath = ExtensionManagementUtility::extPath('modules', $contribPath);

            $pageRenderer->addRequireJsConfiguration([
                'paths' => [
                    'bootstrap-select' => $extRealPath . 'Resources/Public/Contrib/BootstrapSelect/js/bootstrap-select.min',
                ],
                'bootstrap' => [
                    'bootstrap-select' => ['jquery', 'bootstrap'],
                ],
                'shim' => [
                    'bootstrap-select' => [
                        'deps' => ['bootstrap'],
                    ],
                ],
            ]);
            $pageRenderer->addCssFile($extRealPath . 'Resources/Public/Contrib/BootstrapSelect/css/bootstrap-select.min.css');
            $pageRenderer->loadRequireJsModule('TYPO3/CMS/Modules/Backend/Select');
            $pageRenderer->addCssFile('EXT:modules/Resources/Public/Stylesheets/Modules.css');
            $pageRenderer->loadRequireJsModule('TYPO3/CMS/Backend/Modal');
            $pageRenderer->loadRequireJsModule('TYPO3/CMS/Modules/Backend/Modal');
        }
        // Initialize icon factory
        $this->iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        parent::initializeView($view);
    }

    /**
     * Merge module settings from page/user TypoScript into settings
     *
     * @param string $node For example mod.web_addressmanager or mod.openimmo
     * @throws Exception
     */
    protected function mergeModuleSettings($node)
    {
        //
        // Get settings by page TypoScript
        $moduleSettings = $this->getBackendUserAuthentication()->getTSConfig(
            $node,
            BackendUtility::getPagesTSconfig($this->pageUid)
        );
        $moduleSettings['properties'] = $moduleSettings['properties'] ?? [];
        // Get settings from page
        if (is_array($moduleSettings['properties']) && count($moduleSettings['properties']) > 0) {
            $moduleSettings = $this->typoScriptService->convertTypoScriptArrayToPlainArray($moduleSettings['properties']);
            ArrayUtility::mergeRecursiveWithOverrule($this->settings, $moduleSettings);
        }
        // Get settings from user
        $moduleSettings = $this->getBackendUserAuthentication()->getTSConfig($node);
        $moduleSettings['properties'] = $moduleSettings['properties'] ?? [];
        if (is_array($moduleSettings['properties']) && count($moduleSettings['properties']) > 0) {
            $moduleSettings = $this->typoScriptService->convertTypoScriptArrayToPlainArray($moduleSettings['properties']);
            ArrayUtility::mergeRecursiveWithOverrule($this->settings, $moduleSettings);
        }
        // Check if action is disabled
        $action = substr($this->actionMethodName, 0, -6);
        if (isset($this->settings[$action]['disable']) && $this->settings[$action]['disable']) {
            throw new Exception('Feature \'' . $action . '\' is disabled!');
        }
    }

    /**
     * @param ButtonBar $buttonBar
     * @param string $type
     * @param array $params
     * @param bool $disabled
     * @return ButtonBar
     * @throws Exception
     */
    protected function getButton(ButtonBar $buttonBar, string $type, array $params = [], bool $disabled=false)
    {
        $translationKey = $params['translationKey'] ?? '';
        $table = $params['table'] ?? '';
        $uid = $params['uid'] ?? '';
        $iconIdentifier = $params['iconIdentifier'] ?? '';
        $action = $params['action'] ?? '';
        $controller = $params['controller'] ?? 'Backend';
        //
        // Extension key (normalized)
        $extensionName = $this->extensionName;
        if (substr($extensionName, -3, 3) === 'Pro') {
            $extensionName = substr($extensionName, 0, -3);
        }
        //
        // Title translation
        $translationPrefix = 'tx_' . strtolower($extensionName) . '_label.';
        $translationKey = $translationPrefix . $translationKey;
        $title = $this->translate($translationKey);
        if ($title === null) {
            throw new Exception('Translation key missing: ' . $translationKey);
        }
        //
        // Prepare css classes
        $classes = '';
        if ($disabled) {
            if (isset($_SERVER['DDEV_HOSTNAME'])) {
                $classes = 'bg-danger';
            } else {
                $classes = 'd-none';
            }
        }
        //
        // Build button
        switch ($type) {
            case 'refresh':
                $button = $buttonBar->makeLinkButton()
                    ->setHref(GeneralUtility::getIndpEnv('REQUEST_URI'))
                    ->setTitle($title)
                    ->setClasses($classes)
                    ->setIcon($this->iconFactory->getIcon('actions-refresh', Icon::SIZE_SMALL));
                $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_RIGHT);
                break;
            case 'bookmark':
                if ((int)GeneralUtility::makeInstance(Typo3Version::class)->getVersion() <= 10) {
                    $button = $buttonBar->makeShortcutButton()
                        ->setGetVariables(['id', 'M', $this->modulePrefix])
                        ->setModuleName($this->moduleName)
                        ->setDisplayName($title);
                } else {
                    $button = $buttonBar->makeShortcutButton()
                        ->setArguments(['id', 'M', $this->modulePrefix])
                        ->setRouteIdentifier($this->moduleName)
                        ->setDisplayName($title);
                }
                $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_RIGHT);
                break;
            case 'new':
                $parameter = [
                    'returnUrl' => $this->getReturnUrl(),
                    'id' => $this->pageUid,
                    'edit' => [
                        $table => [
                            $this->pageUid => 'new'
                        ]
                    ]
                ];
                $button = $buttonBar->makeLinkButton()
                    ->setHref((string)$this->uriBuilderBackend->buildUriFromRoute('record_edit', $parameter))
                    ->setTitle($title)
                    ->setClasses($classes)
                    ->setIcon($this->iconFactory->getIcon('actions-document-new', Icon::SIZE_SMALL));
                $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
                break;
            case 'edit':
                if ($iconIdentifier === '') {
                    $iconIdentifier = 'actions-document-open';
                }
                $parameter = [
                    'returnUrl' => $this->getReturnUrl(),
                    'id' => $this->pageUid,
                    'edit' => [
                        $table => [
                            $uid => 'edit'
                        ]
                    ]
                ];
                $button = $buttonBar->makeLinkButton()
                    ->setHref((string)$this->uriBuilderBackend->buildUriFromRoute('record_edit', $parameter))
                    ->setTitle($title)
                    ->setClasses($classes)
                    ->setIcon($this->iconFactory->getIcon($iconIdentifier, Icon::SIZE_SMALL));
                $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
                break;
            case 'csv':
                $parameter = [
                    'id' => $this->pageUid,
                    $this->modulePrefix => [
                        'action' => $action,
                        'controller' => $controller,
                        'csv' => 1,
                    ]
                ];
                $uri = $this->uriBuilder->setArguments($parameter)->buildBackendUri();
                $button = $buttonBar->makeLinkButton()
                    ->setHref($uri)
                    ->setTitle($title)
                    ->setClasses($classes)
                    ->setIcon($this->iconFactory->getIcon('actions-document-export-csv', Icon::SIZE_SMALL));
                $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
                break;
            case 'action':
                $parameter = [
                    'id' => $this->pageUid,
                    $this->modulePrefix => [
                        'action' => $action,
                        'controller' => $controller,
                    ]
                ];
                $uri = $this->uriBuilder->setArguments($parameter)->buildBackendUri();
                $button = $buttonBar->makeLinkButton()
                    ->setHref($uri)
                    ->setTitle($title)
                    ->setClasses($classes)
                    ->setIcon($this->iconFactory->getIcon($iconIdentifier, Icon::SIZE_SMALL));
                $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
                break;
        }
        return $buttonBar;
    }

    /**
     * @param $table
     * @param $uid
     */
    protected function setMetaInformation($table, $uid)
    {
        $docHeaderComponent = $this->view->getModuleTemplate()->getDocHeaderComponent();
        $metaRecord = BackendUtility::getRecord($table, $uid);
        $docHeaderComponent->setMetaInformation($metaRecord);
    }

    /**
     * Create action menu
     *
     * @param array $actions
     */
    protected function createMenuActions($actions)
    {
        $menu = $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->makeMenu();
        $menu->setIdentifier($this->moduleName);
        foreach ($actions as $action) {
            $controller = isset($action['controller']) ? $action['controller'] : 'Backend';
            $active = (
                $this->request->getControllerActionName() === $action['action']
                && $this->request->getControllerName() === $controller
            );
            $item = $menu->makeMenuItem()
                ->setTitle($action['label'])
                ->setHref($this->uriBuilder->reset()->uriFor($action['action'], [], $controller))
                ->setActive($active);
            $menu->addMenuItem($item);
        }
        $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);
    }

    /**
     * @return string
     * @throws RouteNotFoundException
     */
    protected function getReturnUrl()
    {
        $parameter = [
            'id' => $this->pageUid,
            $this->modulePrefix => [
                'action' => $this->request->getControllerActionName(),
                'controller' => $this->request->getControllerName(),
            ],
        ];
        return (string)$this->uriBuilderBackend->buildUriFromRoute($this->moduleName, $parameter);
    }

    /**
     * @return BackendUserAuthentication
     */
    protected function getBackendUserAuthentication()
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * @return BackendUserAuthentication
     * @deprecated
     */
    protected function getBackendUser()
    {
        return $this->getBackendUserAuthentication();
    }

    /**
     * @param $key
     * @param array $arguments
     * @return string|null
     * @throws Exception
     */
    protected function translate($key, $arguments = [])
    {
        $extensionName = $this->extensionName;
        if (substr($extensionName, -3, 3) === 'Pro') {
            $extensionName = substr($extensionName, 0, -3);
        }
        $extensionNamePro = $extensionName . 'Pro';
        //
        $translation = LocalizationUtility::translate($key, $extensionName, $arguments);
        if ($translation === null) {
            $translation = LocalizationUtility::translate($key, $extensionNamePro, $arguments);
        }
        if ($translation === null) {
            $extensionKey = GeneralUtility::camelCaseToLowerCaseUnderscored($this->extensionName);
            $path = 'EXT:' . $extensionKey . '/Resources/Private/Language/locallang.xlf';
            throw new Exception('Translation ' . $key . ' not found in ' . $path);
        }
        return $translation;
    }

    /**
     * @param $key
     * @return Icon
     */
    protected function getIcon($key)
    {
        return $this->iconFactory->getIcon($key, Icon::SIZE_SMALL);
    }
}
