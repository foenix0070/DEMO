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
use CodingMs\Modules\Domain\Repository\FrontendUserRepository;
use CodingMs\Modules\Service\PersistenceService;
use CodingMs\Modules\Service\ValidationService;
use CodingMs\Modules\Utility\FrontendUserUtility;
use DateTime;
use Exception;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Frontend controller
 */
class FrontendController extends ActionController
{
    /**
     * @var FrontendUser
     */
    protected FrontendUser $frontendUser;

    /**
     * @var ?FrontendUserUtility
     */
    protected ?FrontendUserUtility $frontendUserUtility = null;

    /**
     * @var int
     */
    protected int $pageUid;

    /**
     * @var FrontendUserRepository
     */
    protected FrontendUserRepository $frontendUserRepository;

    /**
     * @var ValidationService
     */
    protected ValidationService $validationService;

    /**
     * @var PersistenceManager
     */
    protected PersistenceManager $persistenceManager;

    /**
     * @var PersistenceService
     */
    protected PersistenceService $persistenceService;

    /**
     * @var array
     */
    protected $list = [];

    /**
     * @var array
     */
    protected $form = [];

    /**
     * @var AbstractEntity
     */
    protected $object;

    /**
     * @var Repository
     */
    protected $objectRepository;

    /**
     * @var AbstractEntity
     */
    protected $parentObject;

    /**
     * @var Repository
     */
    protected $parentObjectRepository;

    /**
     * @var array
     */
    protected $objectRequiredActions = ['edit', 'delete', 'activate', 'deactivate'];

    /**
     * @param FrontendUserRepository $frontendUserRepository
     * @param FrontendUserUtility $frontendUserUtility
     * @param ValidationService $validationService
     * @param PersistenceManager $persistenceManager
     * @param PersistenceService $persistenceService
     */
    public function __construct(
        FrontendUserRepository $frontendUserRepository,
        FrontendUserUtility $frontendUserUtility,
        ValidationService $validationService,
        PersistenceManager $persistenceManager,
        PersistenceService $persistenceService
    ) {
        $this->frontendUserRepository = $frontendUserRepository;
        $this->frontendUserUtility = $frontendUserUtility;
        $this->validationService = $validationService;
        $this->persistenceManager = $persistenceManager;
        $this->persistenceService = $persistenceService;
    }

    /**
     * Initialize
     * @throws StopActionException
     */
    protected function initializeAction()
    {
        $this->pageUid = (int)GeneralUtility::_GP('id');
    }

    /**
     * @throws NoSuchArgumentException
     * @throws Exception
     */
    protected function prepareAction()
    {
        // Login/Frontend user is always required!
        $this->frontendUser = $this->frontendUserUtility->getCurrentFrontendUser();
        if (!($this->frontendUser instanceof FrontendUser)) {
            $this->addFlashMessage('Login required!', 'Error', FlashMessage::ERROR);
            $this->forward('error');
        }
        //
        // On this actions an object is required!
        $action = $this->request->getControllerActionName();
        if (in_array($action, $this->objectRequiredActions)) {
            if ($this->request->hasArgument('object')) {
                $objectUid = (int)$this->request->getArgument('object');
                if (method_exists($this->objectRepository, 'findByIdentifierFrontend')) {
                    if ($this->parentObject !== null) {
                        /** @var AbstractEntity $object */
                        $this->object = $this->objectRepository->findByIdentifierFrontend($objectUid, $this->parentObject->getUid());
                    } else {
                        /** @var AbstractEntity $object */
                        $this->object = $this->objectRepository->findByIdentifierFrontend($objectUid, $this->frontendUser->getUid());
                    }
                } else {
                    throw new Exception('ObjectRepository method \'findByIdentifierFrontend\' not found!');
                }
                if ($this->object === null) {
                    $this->addFlashMessage('Object not found (code:2)', 'Error', FlashMessage::ERROR);
                    $this->forward('list');
                }
            } else {
                $this->addFlashMessage('Object not found (code:1)', 'Error', FlashMessage::ERROR);
                $this->forward('list');
            }
        }
    }

    /**
     * Display errors
     */
    public function errorAction()
    {
    }

    /**
     * List of records
     * @noinspection PhpUnused
     */
    public function listAction()
    {
    }

    /**
     * Edit record
     * @noinspection PhpUnused
     */
    public function editAction()
    {
    }

    /**
     * Mark object as deactivated (hidden=1)
     * Authorization will be checked in prepareAction!
     *
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     * @throws NoSuchArgumentException
     * @noinspection PhpUnused
     */
    public function deactivateAction()
    {
        $this->prepareAction();
        $this->object->setHidden(true);
        $this->objectRepository->update($this->object);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage($this->list['messages']['success']['objectDeactivated'], $this->list['messages']['success']['title'], FlashMessage::OK);
        $this->forward('list');
    }

    /**
     * Mark object as activated (hidden=0)
     * Authorization will be checked in prepareAction!
     *
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     * @throws NoSuchArgumentException
     * @noinspection PhpUnused
     */
    public function activateAction()
    {
        $this->prepareAction();
        $this->object->setHidden(false);
        $this->objectRepository->update($this->object);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage($this->list['messages']['success']['objectActivated'], $this->list['messages']['success']['title'], FlashMessage::OK);
        $this->forward('list');
    }

    /**
     * Mark object as deleted
     * Authorization will be checked in prepareAction!
     *
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     * @throws NoSuchArgumentException
     * @throws Exception
     */
    public function deleteAction()
    {
        $this->prepareAction();
        if (method_exists($this->object, 'setDeleted')) {
            $this->object->setDeleted(true);
        } else {
            throw new Exception('Setter \'setDeleted\' not found!');
        }
        $this->objectRepository->update($this->object);
        $this->persistenceManager->persistAll();
        $this->addFlashMessage($this->list['messages']['success']['objectDeleted'], $this->list['messages']['success']['title'], FlashMessage::OK);
        $this->forward('list');
    }

    /**
     * Write the values of a persisted object into the form configuration
     *
     * @param array $form
     * @return array
     * @throws Exception
     * @noinspection PhpUnused
     */
    protected function objectValuesIntoFormArray(array $form): array
    {
        foreach ($form['fieldsets'] as $fieldsetName => $fieldsetData) {
            if (!isset($fieldsetData['fields']) || count($fieldsetData['fields']) === 0) {
                throw new Exception('Fieldset ' . $fieldsetName . ' has no fields defined!');
            }
            foreach ($fieldsetData['fields'] as $fieldName => $fieldData) {
                //
                // Process only predefined types
                $mapTypes = ['Input', 'Select', 'Textarea', 'DateTime'];
                if (in_array($fieldData['type'], $mapTypes)) {
                    //
                    // Object getter must be available
                    $getter = 'get' . ucfirst($fieldName);
                    if (method_exists($this->object, $getter)) {
                        $types = ['Input', 'Select', 'Textarea'];
                        //
                        // Regular field
                        if (in_array($fieldData['type'], $types) && !isset($fieldData['optionsTable'])) {
                            $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['value'] = $this->object->$getter();
                        }
                        //
                        // DateTime field
                        elseif ($fieldData['type'] === 'DateTime') {
                            if ($fieldData['parameterType'] === 'DateTime') {
                                /** @var DateTime $dateTime */
                                $dateTime = $this->object->$getter();
                                if ($dateTime instanceof DateTime) {
                                    $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['value'] = $dateTime->getTimestamp();
                                }
                            } else {
                                $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['value'] = $this->object->$getter();
                            }
                        }
                        //
                    // Relations will be restored in prepareFormArray if required!
                        //
                    } else {
                        throw new Exception('Getter \'' . $getter . '\' not found!');
                    }
                    //
                }
                //
            }
        }
        return $form;
    }

    /**
     * @param array $form
     * @param AbstractEntity $object
     * @param AbstractEntity $parentObject
     * @throws Exception
     * @noinspection PhpUnused
     */
    protected function persistFormObject(array &$form, AbstractEntity $object, AbstractEntity $parentObject = null)
    {
        $object = $this->persistenceService->persistForm($form, $object, $parentObject);
        if ($object instanceof Exception) {
            $this->addFlashMessage($object->getMessage(), $this->form['messages']['error']['title'], FlashMessage::ERROR);
        } else {
            $this->event('editBeforePersist', ['object' => $object]);
            $this->objectRepository->update($object);
            $this->persistenceManager->persistAll();
            $this->event('editAfterPersist', ['object' => $object]);
        }
    }

    /**
     * @param array $form
     * @param AbstractEntity $object
     * @param AbstractEntity $parentObject
     * @throws Exception
     * @noinspection PhpUnused
     */
    protected function persistCreateFormObject(array &$form, AbstractEntity $object, AbstractEntity $parentObject = null)
    {
        $object = $this->persistenceService->persistForm($form, $object, $parentObject);
        if ($object instanceof Exception) {
            $this->addFlashMessage($object->getMessage(), $this->form['messages']['error']['title'], FlashMessage::ERROR);
        } else {
            $this->event('createBeforePersist', ['object' => $object]);
            $this->objectRepository->add($object);
            $this->persistenceManager->persistAll();
            $this->event('createAfterPersist', ['object' => $object]);
        }
    }

    /**
     * @param array $form
     * @return array
     * @throws Exception
     * @noinspection PhpUnused
     */
    protected function prepareCreateFormArray(array $form): array
    {
        foreach ($form['fieldsets'] as $fieldsetName => $fieldsetData) {
            foreach ($fieldsetData['fields'] as $fieldName => $fieldData) {
                //
                // Select box with static values.
                // - Options from a static TypoScript list
                // - Single value written as varchar or similar
                if ($fieldData['type'] === 'Select' && !isset($fieldData['optionsTable'])) {
                    //
                    // Options can be a comma separated list, like: one, two, three
                    // We convert them into:
                    // ['one' => 'one', 'two' => 'two', 'three' => 'three']
                    if (is_string($form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'])) {
                        $options = GeneralUtility::trimExplode(
                            ',',
                            $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'],
                            true
                        );
                        $options = array_combine($options, $options);
                        $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] = $options;
                    }
                    //
                    // The values are already defined in Typoscript
                    // But we need to transform them
                    $convertedOptions = [];
                    if (is_array($form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'])) {
                        foreach ($form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] as $key => $value) {
                            $convertedOptions[$key] = [
                                'value' => $key,
                                'label' => $value,
                                'selected' => false
                            ];
                        }
                    } else {
                        throw new Exception('Invalid options for field ' . $fieldName . ' in fieldset ' . $fieldsetName);
                    }
                    $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] = $convertedOptions;
                }
            }
        }
        return $form;
    }

    /**
     * @param array $form
     * @param AbstractEntity $object
     * @param bool $checkValues
     * @return array
     * @throws Exception
     * @noinspection PhpUnused
     */
    protected function prepareFormArray(array $form, AbstractEntity $object, bool $checkValues = true): array
    {
        if (isset($form['tabs']) && count($form['tabs']) > 0) {
            foreach ($form['tabs'] as $tabName => $tabData) {
                $form['tabs'][$tabName]['fieldsets'] = GeneralUtility::trimExplode(',', $form['tabs'][$tabName]['fieldsets'], true);
            }
        }
        foreach ($form['fieldsets'] as $fieldsetName => $fieldsetData) {
            foreach ($fieldsetData['fields'] as $fieldName => $fieldData) {
                //
                // Select box with static values.
                // - Options from a static TypoScript list
                // - Single value written as varchar or similar
                if ($fieldData['type'] === 'Select' && !isset($fieldData['optionsTable'])) {
                    //
                    // Options can be a comma separated list, like: one, two, three
                    // We convert them into:
                    // ['one' => 'one', 'two' => 'two', 'three' => 'three']
                    if (is_string($form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'])) {
                        $options = GeneralUtility::trimExplode(
                            ',',
                            $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'],
                            true
                        );
                        $options = array_combine($options, $options);
                        $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] = $options;
                    }
                    //
                    // The values are already defined in Typoscript
                    // But we need to transform them
                    $convertedOptions = [];
                    if (is_array($form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'])) {
                        foreach ($form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] as $key => $value) {
                            if (is_array($value)) {
                                // When value is already an array, break foreach!
                                $convertedOptions = $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'];
                                break;
                            }
                            $convertedOptions[$key] = [
                                'value' => $key,
                                'label' => $value,
                                'selected' => false
                            ];
                        }
                    } else {
                        throw new Exception('Invalid options for field ' . $fieldName . ' in fieldset ' . $fieldsetName);
                    }
                    $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] = $convertedOptions;
                    //
                    // Mark selected values, if required
                    if ($checkValues) {
                        foreach ($form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] as $key => $value) {
                            $bool = ((string)$form['fieldsets'][$fieldsetName]['fields'][$fieldName]['value'] === (string)$value['value']);
                            $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'][$key]['selected'] = $bool;
                        }
                    }
                }
                //
                // Select box with dynamic values are written as relation
                // - Options from another table/model
                // - Single value selection only!!!
                // - Attention: Object property can be a single (setValue) or multiple value (addValue in ObjectStorage)
                if ($fieldData['type'] === 'Select' && isset($fieldData['optionsTable'])) {
                    //
                    // Fetch all options from another table
                    $repository = $fieldData['optionsTable']['repository'];
                    $getMethod = $fieldData['optionsTable']['getMethod'];
                    $repository = $this->objectManager->get($repository);
                    $options = $repository->findAll();
                    $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] = [];
                    //
                    if ($checkValues) {
                        $selected = [];
                        if (method_exists($object, $getMethod)) {
                            /** @var AbstractEntity $select */
                            if ($object->$getMethod() !== null) {
                                foreach ($object->$getMethod() as $select) {
                                    $selected[] = (string)$select->getUid();
                                }
                            }
                        } else {
                            throw new Exception('Options getter \'' . $getMethod . '\' on option in \'' . $fieldName . '\' not found!');
                        }
                    }
                    //
                    /** @var AbstractEntity $option */
                    foreach ($options as $option) {
                        $entry = [];
                        // Option title
                        $getter = 'get' . ucfirst($fieldData['optionsTable']['label']);
                        if (method_exists($option, $getter)) {
                            $entry['label'] = $option->$getter();
                        } else {
                            throw new Exception('Title getter \'' . $getter . '\' on option in \'' . $fieldName . '\' not found!');
                        }
                        // Option values
                        $getter = 'get' . ucfirst($fieldData['optionsTable']['value']);
                        if (method_exists($option, $getter)) {
                            $entry['value'] = $option->$getter();
                        } else {
                            throw new Exception('Value getter \'' . $getter . '\' on option in \'' . $fieldName . '\' not found!');
                        }
                        //
                        // Mark selected values, if required
                        if ($checkValues && isset($selected)) {
                            $entry['selected'] = in_array((string)$option->getUid(), $selected);
                        }
                        $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'][] = $entry;
                    }
                }
                //
                // Checkboxes
                // - Multiple values possible
                // - Options from another table/model
                if ($fieldData['type'] === 'Checkboxes' && isset($fieldData['optionsTable'])) {
                    //
                    // Fetch all options from another table
                    $repository = $fieldData['optionsTable']['repository'];
                    $getMethod = $fieldData['optionsTable']['getMethod'];
                    $repository = $this->objectManager->get($repository);
                    $options = $repository->findAll();
                    $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'] = [];
                    //
                    $selected = [];
                    if ($checkValues) {
                        if (method_exists($object, $getMethod)) {
                            if ($object->$getMethod() !== null) {
                                /** @var AbstractEntity $select */
                                foreach ($object->$getMethod() as $select) {
                                    $selected[] = (string)$select->getUid();
                                }
                            }
                        } else {
                            throw new Exception('Options getter \'' . $getMethod . '\' on option in \'' . $fieldName . '\' not found!');
                        }
                    }
                    //
                    /** @var AbstractEntity $option */
                    foreach ($options as $option) {
                        $entry = [];
                        // Option title
                        $getter = 'get' . ucfirst($fieldData['optionsTable']['label']);
                        if (method_exists($option, $getter)) {
                            $entry['label'] = $option->$getter();
                        } else {
                            throw new Exception('Title getter \'' . $getter . '\' on option in \'' . $fieldName . '\' not found!');
                        }
                        // Option values
                        $getter = 'get' . ucfirst($fieldData['optionsTable']['value']);
                        if (method_exists($option, $getter)) {
                            $entry['value'] = $option->$getter();
                        } else {
                            throw new Exception('Value getter \'' . $getter . '\' on option in \'' . $fieldName . '\' not found!');
                        }
                        //
                        // Mark selected values, if required
                        if ($checkValues) {
                            $entry['checked'] = in_array((string)$option->getUid(), $selected);
                        }
                        $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'][] = $entry;
                    }
                }
                //
                // Checkbox values
                if ($fieldData['type'] === 'Checkbox') {
                    if ($checkValues) {
                        $getter = 'get' . ucfirst($fieldName);
                        if (method_exists($object, $getter)) {
                            $checkboxValue = $object->$getter();
                            $checkboxOptions = $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['options'];
                            $checkboxOptionsFlipped = array_flip($checkboxOptions);
                            $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['checked'] = (bool)$checkboxOptionsFlipped[$checkboxValue];
                        } else {
                            throw new Exception('Checkbox getter \'' . $getter . '\' on option in \'' . $fieldName . '\' not found!');
                        }
                    }
                }
                //
                // Files preview
                if ($fieldData['type'] === 'Files') {
                    $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['files'] = [];
                    $getter = 'get' . ucfirst($fieldName);
                    if (method_exists($object, $getter)) {
                        if ((int)$fieldData['multiple'] === 1) {
                            $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['files'] = [];
                            $filesArray = $object->$getter();
                            if ($filesArray !== null) {
                                $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['files'] = $filesArray->toArray();
                            }
                        } else {
                            $fileReference = $object->$getter();
                            if ($fileReference !== null) {
                                $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['files'] = [$fileReference];
                            }
                        }
                    }
                }
                //
                // Textarea
                if ($fieldData['type'] === 'Textarea') {
                    $getter = 'get' . ucfirst($fieldName);
                    if (method_exists($object, $getter) && $fieldData['stripTags'] === '1') {
                        $form['fieldsets'][$fieldsetName]['fields'][$fieldName]['value'] = strip_tags($object->$getter());
                    }
                }
                //
            }
        }
        return $form;
    }

    /**
     * @param $action
     * @param array $arguments
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    protected function event($action, $arguments = [])
    {
        $clearCache = false;
        $generateSlug = false;
        $sendInsertMail = false;
        $sendUpdateMail = false;
        /**
         * @todo activation of Files; new image/files are hidden by default; admin activates them
         */
        switch ($action) {
            case 'createBeforePersist':
                // Do nothing
                break;
            case 'createAfterPersist':
                // After created record is persisted
                $clearCache = true;
                $generateSlug = true;
                $sendInsertMail = true;
                //
                break;
            case 'editBeforePersist':
                // Do nothing more
                break;
            case 'editAfterPersist':
                $clearCache = true;
                $generateSlug = true;
                $sendUpdateMail = true;
                //
                break;
        }
        //
        // Clear cache for specific pages
        if ($clearCache && isset($this->form['clearCachePages']) && $this->form['clearCachePages'] !== '0') {
            /** @var CacheManager $cacheManager */
            $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
            $cachePages = GeneralUtility::trimExplode(',', $this->form['clearCachePages'], true);
            foreach ($cachePages as $cachePage) {
                $cacheManager->flushCachesInGroupByTags('pages', ['pageId_' . $cachePage]);
            }
        }
        //
        // Generate slug value
        if ($generateSlug) {
            /** @var AbstractEntity $object */
            $object = $arguments['object'];
            if (isset($this->form['slug']) && (bool)$this->form['slug']['active']) {
                $this->generateSlugForObject($object);
            }
        }
        //
        // Send update mail
        if ($sendInsertMail && isset($this->form['mailOnSave']) && (bool)$this->form['mailOnSave']['active']) {
            $this->sendSaveNotificationMail();
        }
        //
        // Send update mail
        if ($sendUpdateMail && isset($this->form['mailOnSave']) && (bool)$this->form['mailOnSave']['active']) {
            $this->sendSaveNotificationMail();
        }
        //
    }

    /**
     * @return bool
     */
    protected function sendSaveNotificationMail(): bool
    {
        //
        // From email and name
        $fromAddress = new Address(trim($this->form['mailOnSave']['fromEmail']));
        //
        // To email
        $toAddress = new Address(trim($this->form['mailOnSave']['toEmail']));
        //
        // Prepare rendering email content
        /** @var FluidEmail $mail */
        $mail = GeneralUtility::makeInstance(FluidEmail::class);
        $mail->format('html')
            ->from($fromAddress)
            ->to($toAddress)
            ->subject($this->form['mailOnSave']['subject'])
            ->setTemplate('FrontendUser/ActivateRegistrationAdmin');
        //
        // Prepare message text
        $message = '' . PHP_EOL;
        foreach ($this->form['fieldsets'] as $fieldset) {
            if ($fieldset['type'] !== 'Button') {
                $message .= $fieldset['label'] . PHP_EOL;
                foreach ($fieldset['fields'] as $field) {
                    switch ($field['type']) {
                        case 'Input':
                            $message .= '   ' . $field['label'] . ': ' . $field['value'] . PHP_EOL;
                            break;
                        case 'DateTime':
                            $message .= '   ' . $field['label'] . ': ' . $field['value'] . PHP_EOL;
                            break;
                        case 'Email':
                            $message .= '   ' . $field['label'] . ': ' . $field['value'] . PHP_EOL;
                            break;
                        case 'Textarea':
                            if (trim($field['label']) !== '') {
                                $message .= '   ' . $field['label'] . ': ' . $field['value'] . PHP_EOL . PHP_EOL;
                            } else {
                                $message .= '   ' . $field['value'] . PHP_EOL . PHP_EOL;
                            }
                            break;
                        case 'Select':
                            $selectValue = '';
                            foreach ($field['options'] as $option) {
                                if ($option['selected']) {
                                    $selectValue = $option['label'];
                                    break;
                                }
                            }
                            $message .= '   ' . $field['label'] . ': ' . $selectValue . PHP_EOL;
                            break;
                        case 'Checkbox':
                            $checkboxLabels = [];
                            if (trim($field['label']) !== '') {
                                $checkboxLabels[] = $field['label'];
                            }
                            if (trim($field['checkboxLabel']) !== '') {
                                $checkboxLabels[] = $field['checkboxLabel'];
                            }
                            $checkboxLabel = implode(' ', $checkboxLabels);
                            $message .= '   ' . $checkboxLabel . ': ' . ($field['checked'] ? 'yes' : 'no') . PHP_EOL;
                            break;
                        case 'Checkboxes':
                            $selection = [];
                            foreach ($field['options'] as $option) {
                                if ($option['checked']) {
                                    $selection[] = $option['label'];
                                }
                            }
                            $message .= '   ' . $field['label'] . ': ' . implode(', ', $selection) . PHP_EOL;
                            break;
                        case 'Files':
                            /** @var FileReference $file */
                            foreach ($field['files'] as $file) {
                                //
                                // Attach file
                                $mail->attach(
                                    $file->getOriginalResource()->getContents(),
                                    $file->getOriginalResource()->getName(),
                                    $file->getOriginalResource()->getMimeType()
                                );
                                //
                                // Add file information
                                $message .= '   ' . $file->getOriginalResource()->getName() . ': ' . PHP_EOL;
                                if (isset($field['update'][$file->getUid()])) {
                                    foreach ($field['update'][$file->getUid()] as $subKey => $subField) {
                                        $subFieldLabel = $field['subFields'][$subKey]['label'];
                                        $message .= '     ' . $subFieldLabel . ': ' . $subField . PHP_EOL;
                                    }
                                }
                            }
                            /**
                             * @todo bild löschen in mail anmerken!
                             */
                            break;
                    }
                }
            }
            $message .= PHP_EOL;
        }
        //
        $mail->assignMultiple([
            'subject' => $this->form['mailOnSave']['subject'],
            'settings' => $this->settings,
            'form' => $this->form,
            'message' => $message,
        ]);
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
     * @param AbstractEntity $object
     * @return string
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    protected function generateSlugForObject(AbstractEntity $object): string
    {
        $record = BackendUtility::getRecord($this->form['table'], $object->getUid());
        $fields = GeneralUtility::trimExplode(',', $this->form['slug']['fields'], true);
        $fieldConfig = [
            'generatorOptions' => [
                'fields' => $fields,
                'fieldSeparator' => '-',
                'replacements' => [
                    '/' => '-'
                ],
                'fallbackCharacter' => '-',
                'prependSlash' => true
            ]
        ];
        //
        /** @var SlugHelper $slugHelper */
        $slugHelper = GeneralUtility::makeInstance(
            SlugHelper::class,
            $this->form['table'],
            $this->form['slug']['field'],
            $fieldConfig
        );
        $slug = '/' . $slugHelper->generate($record, $record['pid']);
        //
        $object->_setProperty($this->form['slug']['field'], $slug);
        $this->objectRepository->update($object);
        $this->persistenceManager->persistAll();
        return $slug;
    }
}
