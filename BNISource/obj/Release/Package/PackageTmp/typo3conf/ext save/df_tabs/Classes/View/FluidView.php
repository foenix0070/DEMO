<?php

namespace SGalinski\DfTabs\View;

/***************************************************************
 *  Copyright notice
 *
 *  (c) sgalinski Internet Services (https://www.sgalinski.de)
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

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Renders the content
 */
class FluidView implements SingletonInterface {
	/**
	 * @var array
	 */
	protected $settings = [
		'templateRootPaths' => ['EXT:df_tabs/Resources/Private/Templates/'],
		'partialRootPaths' => ['EXT:df_tabs/Resources/Private/Partials/'],
		'layoutRootPaths' => ['EXT:df_tabs/Resources/Private/Layouts/']
	];

	/**
	 * FluidView constructor.
	 * @param array $settings
	 */
	public function __construct(array $settings = []) {
		if (!empty($settings['view.']['templateRootPaths.'])) {
			$this->settings['templateRootPaths'] = $settings['view.']['templateRootPaths.'];
		}
		if (!empty($settings['view.']['partialRootPaths.'])) {
			$this->settings['partialRootPaths'] = $settings['view.']['partialRootPaths.'];
		}
		if (!empty($settings['view.']['layoutRootPaths.'])) {
			$this->settings['layoutRootPaths'] = $settings['view.']['layoutRootPaths.'];
		}
	}

	/**
	 * Renders the tabs
	 *
	 * @param array $tabElements
	 * @param string $tabId
	 * @return string
	 */
	public function renderTabs($tabElements, $tabId) {
		$fluidView = GeneralUtility::makeInstance(\TYPO3\CMS\Fluid\View\StandaloneView::class);
		$fluidView->setTemplateRootPaths($this->settings['templateRootPaths']);
		$fluidView->setPartialRootPaths($this->settings['partialRootPaths']);
		$fluidView->setLayoutRootPaths($this->settings['layoutRootPaths']);
		$fluidView->setTemplate('Standard/Tabs.html');
		$fluidView->assignMultiple([
			'tabElements' => $tabElements,
			'tabId' => $tabId
		]);
		return $fluidView->render();
	}
}
