<?php

namespace CodingMs\FluidForm\Service\Finisher;

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

use CodingMs\FluidForm\Domain\Repository\FormRepository;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * PDF finishing service
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class PdfService extends AbstractService
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
     * @var PersistenceManager
     */
    protected $persistenceManager;

    /**
     * @param PersistenceManager $persistenceManager
     */
    public function injectPersistenceManager(PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Validates all fields within a fieldset
     *
     * @param array $form
     * @param array $finisher
     * @param UriBuilder $uriBuilder
     * @param array $session
     * @return mixed
     */
    public function finish($form, $finisher, UriBuilder $uriBuilder, array &$session = [])
    {
        $success = true;
        return $success;
    }
}
