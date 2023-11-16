<?php

namespace CodingMs\FluidForm\Service;

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

use CodingMs\FluidForm\Service\Finisher\DatabaseService;
use CodingMs\FluidForm\Service\Finisher\MailService;
use CodingMs\FluidForm\Service\Finisher\UploadService;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Services for finishing requests
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class FinishingService
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function injectObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Collect all instances of finishers
     * @var array
     */
    protected $finisher = [];

    /**
     * @param array $form
     * @param UriBuilder $uriBuilder
     * @param array $session
     * @return bool Finishing was successful!?
     */
    public function finishForm(array $form, UriBuilder $uriBuilder, array &$session = [])
    {
        $success = true;
        $executeSomeFinisher = false;
        foreach ($form['finisher'] as $finisher) {
            // Finisher type is available?
            if (!isset($finisher['type'])) {
                $success = false;
                break;
            }
            // Previous finisher was successful
            if ($success) {
                // Switch case finisher
                switch ($finisher['type']) {
                    case 'Database':
                        // After this finisher, we have a $session['formObjectUid'] = 123
                        // This uid represents the form object in the database
                        if ((int)$finisher['active'] == 1) {
                            $executeSomeFinisher = true;
                            if (!isset($finisher['database'])) {
                                $this->finisher['database'] = $this->objectManager->get(DatabaseService::class);
                            }
                            $success = $this->finisher['database']->finish($form, $finisher, $uriBuilder, $session);
                            $form['formObjectUid'] = $session['formObjectUid'];
                        }
                        break;
                    case 'Mail':
                        if ((int)$finisher['active'] == 1) {
                            $executeSomeFinisher = true;
                            if (!isset($finisher['mail'])) {
                                $this->finisher['mail'] = $this->objectManager->get(MailService::class);
                            }
                            $success = $this->finisher['mail']->finish($form, $finisher, $uriBuilder, $session);
                        }
                        break;
                    case 'JavaScript':
                        break;
                    case 'Upload':
                        // After this finisher, we have the fileUid in $field['value']
                        if ((int)$finisher['active'] == 1) {
                            $executeSomeFinisher = true;
                            if (!isset($finisher['upload'])) {
                                $this->finisher['upload'] = $this->objectManager->get(UploadService::class);
                            }
                            $success = $this->finisher['upload']->finish($form, $finisher, $uriBuilder, $session);
                        }
                        break;
                    case 'Pdf':
                        // Do nothing
                        break;
                }
            }
        }
        if (!$executeSomeFinisher) {
            $success = false;
        }
        return $success;
    }
}
