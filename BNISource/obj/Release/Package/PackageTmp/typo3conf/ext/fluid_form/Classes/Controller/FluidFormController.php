<?php

namespace CodingMs\FluidForm\Controller;

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

use CodingMs\FluidForm\Domain\Session\SessionHandler;
use CodingMs\FluidForm\Service\FinishingService;
use CodingMs\FluidForm\Service\ValidationService;
use Exception;
use MathGuard;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;

/**
 * FluidFormController
 */
class FluidFormController extends ActionController
{
    /**
     * @var ValidationService
     */
    protected $validationService;

    /**
     * @param ValidationService $validationService
     * @noinspection PhpUnused
     */
    public function injectValidationService(ValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    /**
     * @var FinishingService
     */
    protected $finishingService;

    /**
     * @param FinishingService $finishingService
     * @noinspection PhpUnused
     */
    public function injectFinishingService(FinishingService $finishingService)
    {
        $this->finishingService = $finishingService;
    }

    /**
     * @var string Form key of this form (settings index/key)
     */
    protected $formKey = '';

    /**
     * @var string Form identifier of this form
     */
    protected $formUid = '';

    /**
     * @var string Page uid of this form
     */
    protected $pageUid = '';

    /**
     * @var bool Form identifier and request form identifier matches
     */
    protected $formUidMatches = false;

    /**
     * @var array Form data
     */
    protected $form;

    /**
     * @var SessionHandler
     */
    protected $sessionHandler;

    /**
     * @param SessionHandler $sessionHandler
     * @noinspection PhpUnused
     */
    public function injectSessionHandler(SessionHandler $sessionHandler)
    {
        $this->sessionHandler = $sessionHandler;
    }

    /**
     * @var array
     */
    protected $session = [];

    /**
     * Initialize the form engine
     * @throws NoSuchArgumentException
     */
    public function initializeAction()
    {
        // Get Session data
        $this->session = $this->sessionHandler->restoreFromSession();

        // Try to find the selected form (key)
        if (isset($this->settings['form'])) {
            $this->formKey = $this->settings['form'];
            if (isset($this->settings['forms'][$this->formKey]) && is_array($this->settings['forms'][$this->formKey])) {
                $this->form = $this->settings['forms'][$this->formKey];
                $this->form['key'] = $this->formKey;
                // Form is an AJAX form?!
                if ($this->isAjaxForm()) {
                    if (!isset($this->form['css']['class']['form'])) {
                        $this->form['css']['class']['form'] = '';
                    }
                    $this->form['css']['class']['form'] = $this->addCssClassToArrayNode(
                        $this->form['css']['class']['form'],
                        'ajax'
                    );
                }
                // Validate add query string
                $this->form['configuration']['addQueryString'] = (int)($this->form['configuration']['addQueryString'] ?? 0);
                /*
                // Get max file upload size
                $maxSizes = array();
                $maxSizes[] = (int)ini_get('upload_max_filesize');
                $maxSizes[] = (int)ini_get('post_max_size');
                $maxSize = min($maxSizes);
                $this->form['upload']['maxSize'] = $maxSize;
                */
                // Form identifier is passed by setting.
                // In case of execution by TypoScript
                if (isset($this->settings['formUid'])) {
                    $this->formUid = trim($this->settings['formUid']);
                } // Otherwise it will be set to content elements uid
                else {
                    $contentObject = $this->configurationManager->getContentObject();
                    $this->formUid = $contentObject->data['uid'];
                }
                $this->form['uid'] = $this->formUid;
                // Form data was passed to this action?
                // Form was submitted!?
                if ($this->request->hasArgument('formUid')) {
                    $requestFormUid = $this->request->getArgument('formUid');
                    // Only process data, in case of form uid is equal!
                    if ($requestFormUid == $this->formUid) {
                        $this->formUidMatches = true;
                    }
                }
            }
        }
    }

    /**
     * Show fluid form
     *
     * @noinspection PhpUnused
     */
    public function showAction()
    {
        $showForm = true;
        // Check if there's a valid form selected
        if ($this->form === null) {
            $message = [];
            $message['title'] = 'Form configuration not found!';
            $message['message'] = 'Do you have included the static template for \'' . $this->formKey . '\' form?!';
            $this->addMessage($message, AbstractMessage::ERROR);
            $showForm = false;
        } else {
            $this->identifyFormActionPageUid();
            // Only process data, in case of form uid is equal!
            // That means, the form was submitted!
            if ($this->formUidMatches) {
                $arguments = $this->request->getArguments();
                // Start validation of the form data
                $this->form = $this->validationService->validateForm($this->form, $arguments);
                // Validation was successful?
                if ($this->form['valid'] == 1) {
                    // Finishers configured?
                    if (isset($this->form['finisher']) && is_array($this->form['finisher']) && !empty($this->form['finisher'])) {
                        // Start finishing..
                        $uriBuilder = $this->controllerContext->getUriBuilder();
                        if ($this->finishingService->finishForm($this->form, $uriBuilder, $this->session)) {
                            $this->addMessage($this->form['messages']['successfullySent'], AbstractMessage::OK);
                            $showForm = false;
                            $this->form['finished'] = 1;
                        } else {
                            $message = [];
                            $message['title'] = 'Form finishing failed!';
                            $message['message'] = 'An error happened while executing the finishers. Be sure there\'s at least one active finisher available.';
                            //
                            // Are there error messages from finisher?
                            if (isset($this->session['error'])) {
                                $message['message'] = $this->session['error']['messages'];
                                // Mark field as invalid
                                $fieldsetKey = $this->session['error']['fieldset'];
                                $fieldKey = $this->session['error']['field'];
                                $this->form['fieldsets'][$fieldsetKey]['valid'] = 0;
                                $this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey]['valid'] = 0;
                                $this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey]['message'] = $this->session['error']['messages'];
                            }
                            // Mark form as invalid
                            $this->form['valid'] = 0;
                            $this->addMessage($message, AbstractMessage::ERROR);
                        }
                    // Save session, because there could be a new reminded record uid
                    } else {
                        $message = [];
                        $message['title'] = 'Form finishing failed!';
                        $message['message'] = 'There are no finishers configured.';
                        $this->addMessage($message, AbstractMessage::ERROR);
                    }
                } // Validation failed!
                else {
                    $this->addMessage($this->form['messages']['validationFailed'], AbstractMessage::ERROR);
                }
                // Was an AJAX request? Return JSON!
                if ($this->isAjaxForm()) {
                    $this->returnJson();
                }
            }
            // Save unique-identifier in a clean array
            $this->session = [];
            $this->session['uniqueId'] = uniqid('', true);
            $this->sessionHandler->writeToSession($this->session);
            // Build different upload uris
            if (!empty($this->form['fieldsets'])) {
                foreach ($this->form['fieldsets'] as $fieldsetKey => $fieldset) {
                    if (!empty($fieldset['fields'])) {
                        foreach ($fieldset['fields'] as $fieldKey => $field) {
                            /**
                             * @todo folgendes kann auch weg?!
                             * if ($field['type'] == 'Upload') {
                             * // Build activate link
                             * $uriBuilder = $this->controllerContext->getUriBuilder();
                             * $params = array(
                             * 'fieldUniqueId' => 'form-' . $this->formUid . '-' . $fieldsetKey . '-' . $fieldKey,
                             * 'uniqueId' => $this->session['uniqueId']
                             * );
                             * $uploadUri = $uriBuilder->reset()
                             * ->setCreateAbsoluteUri(true)
                             * ->setUseCacheHash(false)
                             * ->setTargetPageUid($this->pageUid)
                             * ->uriFor("upload", $params, "FluidForm");
                             *
                             * $this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey]['upload']['uri'] = $uploadUri;
                             * } else {
                             */
                            if ($field['type'] == 'Captcha') {
                                // Insert new captcha
                                if ($field['captcha']['type'] == 'MathGuard') {
                                    $inputId = 'form-' . $this->formUid . '-' . $fieldsetKey . '-' . $fieldKey;
                                    $this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey]['captcha']['html'] = MathGuard::insertQuestion($field['captcha']['prime'], $inputId);
                                }
                            } elseif ($field['type'] == 'Upload') {
                                // Check if required upload finisher is available
                                if (!isset($this->form['finisher']['upload']) || $this->form['finisher']['upload'] == 0) {
                                    $messageTitle = 'Form finisher missed!';
                                    $messageBody = 'It seems that you want to use an upload, but the required finisher isn\' configured.';
                                    $this->addFlashMessage($messageBody, $messageTitle, AbstractMessage::WARNING);
                                }
                            }
                            //}
                        }
                    }
                }
            }
        }
        //
        // JavaScript
        if (isset($this->form['finisher']['javascript'])) {
            $javaScript = "FluidForm.functions['" . $this->formUid . "'] = {};\n";
            foreach ($this->form['finisher']['javascript']['functions'] as $function => $code) {
                $javaScript .= "FluidForm.functions['" . $this->formUid . "']['" . $function . "'] = function(formUid, data) {\n";
                $javaScript .= $code . LF;
                $javaScript .= "};\n";
            }
            /** @var $pageRenderer PageRenderer */
            $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
            $pageRenderer->addJsFooterInlineCode('FluidForm_' . $this->formUid, $javaScript);
        }
        //
        $this->view->assign('pageUid', $this->pageUid);
        $this->view->assign('form', $this->form);
        $this->view->assign('formKey', $this->formKey);
        $this->view->assign('formUid', $this->formUid);
        $this->view->assign('showForm', $showForm);
        $this->view->assign('settings', $this->settings);
    }

    /**
     * @throws NoSuchArgumentException
     * @noinspection PhpUnused
     */
    public function downloadAction()
    {
        // Validate field unique id
        $fieldUniqueId = '';
        $fieldConfiguration = [];
        if ($this->request->hasArgument('fieldUniqueId')) {
            $fieldUniqueId = $this->request->getArgument('fieldUniqueId');
            $fieldConfiguration = $this->getFieldConfigurationFromFieldUniqueId($fieldUniqueId);
        }
        // Validate unique-identifier
        $uniqueId = '';
        if ($this->request->hasArgument('uniqueId')) {
            $uniqueId = $this->request->getArgument('uniqueId');
        }
        if (trim($uniqueId) == '') {
            $this->form['messages']['error'][] = $this->form['messages']['validating_unique_id_failed'];
        }
        // Get storage from storage uid
        $storage = null;
        $uploadFolderObject = null;
        if (empty($this->form['messages']['error'])) {
            $storage = $this->getStorageByFieldConfiguration($fieldConfiguration);
        }
        if (empty($this->form['messages']['error'])) {
            try {
                // Get folder
                /** @var Folder $uploadFolderObject */
                $uploadFolderObject = $storage->getFolder($fieldConfiguration['upload']['folder']);
                foreach ($storage->getFilesInFolder($uploadFolderObject) as $file) {
                    // Filename is equal?
                    if ($file->getNameWithoutExtension() == $uniqueId . '-' . $fieldUniqueId) {
                        header('pragma: cache');
                        header('pragma: public');
                        header('Cache-Control: max-age=0');
                        header('Cache-Control: private', false); // required for certain browsers
                        header('Content-Type: ' . $file->getMimeType());
                        header('Expires: 0');
                        header('Content-Disposition: attachment; filename=' . $file->getName());
                        header('Content-Transfer-Encoding: binary');
                        header('Content-Length: ' . $file->getSize());
                        echo $file->getContents();
                        exit;
                    }
                }
            } catch (Exception $exception) {
                $this->form['messages']['error'][] = $this->form['messages']['please_select_a_valid_upload_folder_from_storage'];
            }
        }
        $this->addFlashMessage('', 'File download failed', AbstractMessage::ERROR);
    }

    /**
     * @param $fieldUniqueId string
     * @return array
     */
    protected function getFieldConfigurationFromFieldUniqueId($fieldUniqueId)
    {
        $fieldConfiguration = [];
        $fieldUniqueIdParts = explode('-', $fieldUniqueId);
        if (count($fieldUniqueIdParts) != 4) {
            $this->form['messages']['error'][] = $this->form['messages']['validating_field_unique_id_length_failed'];
        } else {
            if ($fieldUniqueIdParts[0] == 'form' && (int)$fieldUniqueIdParts[1] > 0) {
                $fieldConfiguration = $this->form['fieldsets'][$fieldUniqueIdParts[2]]['fields'][$fieldUniqueIdParts[3]];
            } else {
                $this->form['messages']['error'][] = $this->form['messages']['validating_field_unique_id_structure_failed'];
            }
        }
        return $fieldConfiguration;
    }

    /**
     * @param $fieldConfiguration array
     * @return ResourceStorage|null
     */
    protected function getStorageByFieldConfiguration($fieldConfiguration)
    {
        $storage = null;
        $storageUid = (int)$fieldConfiguration['upload']['storage'];
        if ($storageUid > 0) {
            /** @var StorageRepository $storageRepository */
            $storageRepository = $this->objectManager->get(StorageRepository::class);
            /** @var ResourceStorage $storage */
            $storage = $storageRepository->findByUid($storageUid);
            if (!($storage instanceof ResourceStorage)) {
                $this->form['messages']['error'][] = $this->form['messages']['please_select_a_valid_upload_file_storage'];
            }
        } else {
            $this->form['messages']['error'][] = $this->form['messages']['please_select_an_upload_file_storage'];
        }
        return $storage;
    }

    /**
     * @param array $data
     * @param $severity
     */
    protected function addMessage(array $data, $severity)
    {
        $title = '';
        if (isset($data['title'])) {
            $title = trim($data['title']);
        }
        $message = '';
        if (isset($data['message'])) {
            $message = trim($data['message']);
        }
        if ($title != '' || $message != '') {
            if ($this->isAjaxForm()) {
                if ($severity == AbstractMessage::ERROR) {
                    $this->form['messages']['error'][] = $data;
                } else {
                    if ($severity == AbstractMessage::OK) {
                        $this->form['messages']['ok'][] = $data;
                    }
                }
            } else {
                $this->addFlashMessage($message, $title, $severity);
            }
        }
    }

    /**
     * Check if the selected form is an AJAX form
     * @return bool
     */
    protected function isAjaxForm()
    {
        $ajax = false;
        if (isset($this->form['configuration']['ajax']) && (int)$this->form['configuration']['ajax'] > 0) {
            $ajax = true;
        }
        return $ajax;
    }

    /**
     * Check if the selected form is an AJAX form
     */
    protected function identifyFormActionPageUid()
    {
        $this->pageUid = (int)$GLOBALS['TSFE']->id;
        if ($this->isAjaxForm()) {
            if (isset($this->form['configuration']['ajaxActionPid']) && (int)$this->form['configuration']['ajaxActionPid'] > 0) {
                $this->pageUid = (int)$this->form['configuration']['ajaxActionPid'];
            }
        }
        $this->form['pageUid'] = $this->pageUid;
    }

    /**
     * @param string $cssClassesString String with CSS classes
     * @param string $cssClass CSS class which should be added
     * @return string String with CSS classes
     */
    protected function addCssClassToArrayNode($cssClassesString, $cssClass)
    {
        $formClassesArray = explode(' ', $cssClassesString);
        if (!in_array($cssClass, $formClassesArray)) {
            $formClassesArray[] = $cssClass;
        }
        $cssClassesString = implode(' ', $formClassesArray);
        return $cssClassesString;
    }

    /**
     * Returns the form as JSON
     */
    protected function returnJson()
    {
        if (!isset($this->form['debug']) || (int)$this->form['debug'] === 0) {
            unset($this->form['css']);
            unset($this->form['debug']);
            unset($this->form['configuration']);
            unset($this->form['finisher']);
            // Remove message templates
            foreach ($this->form['messages'] as $key => $messages) {
                if ($key != 'ok' && $key != 'error') {
                    unset($this->form['messages'][$key]);
                }
            }
            // Cleanup fieldsets and fields
            $validFieldsetKeys = ['valid', 'fields', 'key']; // , 'css', 'label'
            $validFieldKeys = ['valid', 'key', 'message']; // , 'css', 'label', 'notices', 'messages'
            if (isset($this->form['fieldsets'])) {
                foreach ($this->form['fieldsets'] as $fieldsetKey => $fieldset) {
                    // Cleanup fieldset data
                    foreach ($fieldset as $fieldsetIndex => $fieldsetEntry) {
                        if (!in_array($fieldsetIndex, $validFieldsetKeys)) {
                            unset($this->form['fieldsets'][$fieldsetKey][$fieldsetIndex]);
                        }
                    }
                    // Cleanup field data
                    foreach ($this->form['fieldsets'][$fieldsetKey]['fields'] as $fieldKey => $field) {
                        foreach ($field as $fieldIndex => $fieldEntry) {
                            if (!in_array($fieldIndex, $validFieldKeys)) {
                                unset($this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey][$fieldIndex]);
                            }
                            if (empty($this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey])) {
                                unset($this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey]);
                            }
                            //
                            // Resend new Captcha
                            if ($fieldKey === 'captcha' && !$this->form['valid']) {
                                $this->form['fieldsets'][$fieldsetKey]['fields'][$fieldKey]['html'] = MathGuard::insertQuestion(
                                    $field['captcha']['prime'],
                                    'form-' . $this->formUid . '-' . $fieldsetKey . '-' . $fieldKey
                                );
                            }
                        }
                        if (empty($this->form['fieldsets'][$fieldsetKey]['fields'])) {
                            unset($this->form['fieldsets'][$fieldsetKey]);
                        }
                    }
                }
            }
        }
        $json = json_encode($this->form);
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Transfer-Encoding: 8bit');
        header('Content-Length: ' . strlen($json));
        echo $json;
        exit;
    }
}
