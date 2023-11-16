<?php

namespace SGalinski\DfTabs\Controller;

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

use SGalinski\DfTabs\DataProvider\AbstractBaseDataProvider;
use SGalinski\DfTabs\Domain\Repository\TabRepository;
use SGalinski\DfTabs\Service\ConfigurationService;
use SGalinski\DfTabs\View\FluidView;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Plugin\AbstractPlugin;

/**
 * Plugin for the 'df_tabs' extension
 */
class PluginController extends AbstractPlugin {
	/**
	 * @var string
	 */
	public $prefixId = 'tx_dftabs_plugin1';

	/**
	 * @var string
	 */
	public $scriptRelPath = 'Resources/Private/Language/locallang.xlf';

	/**
	 * @var string
	 */
	public $extKey = 'df_tabs';

	/**
	 * @var bool
	 */
	public $pi_checkCHash = TRUE;

	/**
	 * @var ContentObjectRenderer
	 */
	public $cObj;

	/**
	 * Data Provider Instance
	 *
	 * @var AbstractBaseDataProvider
	 */
	protected $dataProvider;

	/**
	 * Plugin configuration
	 *
	 * @var array
	 */
	protected $pluginConfiguration = [];

	/**
	 * Returns an instance of the renderer
	 *
	 * @param string $tabId
	 * @return FluidView
	 */
	protected function getRenderer($tabId) {
		/** @var FluidView $renderer */
		$renderer = GeneralUtility::makeInstance(FluidView::class, $this->pluginConfiguration);
		return $renderer;
	}

	/**
	 * Returns an instance of the configuration manager
	 *
	 * @return ConfigurationService
	 */
	protected function getConfigurationManager() {
		/** @var ConfigurationService $configurationManager */
		$configurationManager = GeneralUtility::makeInstance(ConfigurationService::class);
		$configurationManager->injectControllerContext($this);

		return $configurationManager;
	}

	/**
	 * Returns an instance of the tab repository
	 *
	 * @return TabRepository
	 */
	protected function getTabRepository() {
		/** @var TabRepository $repository */
		$repository = GeneralUtility::makeInstance(TabRepository::class);
		$repository->injectContentObject($this->cObj);
		$repository->injectPluginConfiguration($this->pluginConfiguration);

		return $repository;
	}

	/**
	 * Controls the data flow from the repository to the view to render
	 * the tab menus
	 *
	 * @param string $content
	 * @param array $configuration
	 * @return string
	 */
	public function main($content, $configuration) {
		$tabId = sha1(microtime());

		try {
			$this->conf = $configuration;
			$this->pi_setPiVarDefaults();
			$this->pi_loadLL();
			$this->pi_initPIflexForm();

			$this->pluginConfiguration = $this->getConfigurationManager()->getConfiguration();

			$repository = $this->getTabRepository();
			$renderer = $this->getRenderer($tabId);

			$records = $repository->getRecords();
			$tabElements = $repository->buildTabElements($this->pluginConfiguration['titles'] ?? [], $records);
			$content .= $renderer->renderTabs($tabElements, $tabId);
		} catch (\Exception $exception) {
			$content = $exception->getMessage();
		}

		if (isset($this->pluginConfiguration['classPrefix'])) {
			$this->prefixId = $this->pluginConfiguration['classPrefix'] . 'plugin1';
		} else {
			$this->prefixId = 'plugin1';
		}
		return $this->pi_wrapInBaseClass($content);
	}
}
