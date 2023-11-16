<?php

namespace SGalinski\DfTabs\Service;

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

use SGalinski\DfTabs\Controller\PluginController;
use SGalinski\DfTabs\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Handles configuration related stuff
 */
class ConfigurationService {
	/**
	 * @var PluginController
	 */
	protected $controllerContext;

	/**
	 * Injects the controller context
	 *
	 * @param PluginController $context
	 * @return void
	 */
	public function injectControllerContext(PluginController $context) {
		$this->controllerContext = $context;
	}

	/**
	 * Returns the plugin configuration that contains configurations from
	 * different sources in the following order. The last available property
	 * wins!
	 *
	 * - Extension Configuration
	 * - TypoScript Configuration
	 * - Flexform Configuration
	 *
	 * @return array
	 */
	public function getConfiguration() {
		$configuration = \array_merge(
			$this->getExtensionConfiguration(),
			$this->getTypoScriptConfiguration(),
			$this->getFlexformConfiguration()
		);

		if (isset($configuration['autoPlayInterval'])) {
			$configuration['autoPlayInterval'] = (int)$configuration['autoPlayInterval'];
		}

		if (isset($configuration['pollingInterval'])) {
			$configuration['pollingInterval'] = (int)$configuration['pollingInterval'];
		}

		if (isset($configuration['animationSpeed'])) {
			$configuration['animationSpeed'] = (int)$configuration['animationSpeed'];
		}

		return $configuration;
	}

	/**
	 * Returns the extension configuration
	 *
	 * @return array
	 */
	protected function getExtensionConfiguration() {
		$configuration = ExtensionUtility::getExtensionConfiguration();
		if (!\is_array($configuration)) {
			return [];
		}

		return $configuration;
	}

	/**
	 * Returns the prepared typoscript configuration
	 *
	 * @return array
	 */
	protected function getTypoScriptConfiguration() {
		$configuration = (array) $this->controllerContext->conf;
		foreach ($configuration as $key => &$option) {
			if ($key[\strlen($key) - 1] !== '.' && isset($configuration[$key . '.'])) {
				$option = $this->controllerContext->cObj->stdWrap($option, $configuration[$key . '.']);
			}
		}

		if (isset($configuration['titles'])) {
			$configuration['titles'] = GeneralUtility::trimExplode(',', $configuration['titles'], TRUE);
		}

		return $configuration;
	}

	/**
	 * Returns the flexform configuration with fallback values
	 *
	 * @return array
	 */
	protected function getFlexformConfiguration() {
		$data = &$this->controllerContext->cObj->data['pi_flexform'];
		$configuration = [];

		$value = \trim($this->controllerContext->pi_getFFvalue($data, 'enableAutoPlay'));
		if ($value !== '') {
			$configuration['enableAutoPlay'] = $value;
		}

		$value = \trim($this->controllerContext->pi_getFFvalue($data, 'enableMouseOver'));
		if ($value !== '') {
			$configuration['enableMouseOver'] = $value;
		}

		$value = \trim($this->controllerContext->pi_getFFvalue($data, 'autoPlayInterval'));
		if ($value !== '') {
			$configuration['autoPlayInterval'] = (int)$value;
		}
		// this has to be a try catch for now, since animationSpeed was never a Setting inside of our flexform.
		// when the Plugin has not been updated, this will stay, throwing an error in php8+
		try {
			$value = \trim($this->controllerContext->pi_getFFvalue($data, 'animationSpeed'));
			if ($value !== '') {
				$configuration['animationSpeed'] = (int) $value;
			}
		} catch (\Exception $e) {
			$configuration['animationSpeed'] = 0;
		}

		$value = \trim($this->controllerContext->pi_getFFvalue($data, 'mode'));
		if ($value !== '') {
			$configuration['mode'] = $value;
		}

		$value = \trim($this->controllerContext->pi_getFFvalue($data, 'titles'));
		if ($value !== '') {
			$configuration['titles'] = \explode(\chr(10), $value);
		}

		### BEGIN Compatibility Code ###
		// try catch for reasons explained above
		try {
			$value = \trim($this->controllerContext->pi_getFFvalue($data, 'pages'));
			if ($value !== '') {
				$configuration['data'] = $value;
			}
		} catch (\Exception $e) {
			$configuration['data'] = '';
		}

		try {
			$value = \trim($this->controllerContext->pi_getFFvalue($data, 'tt_content'));
			if ($value !== '') {
				$configuration['data'] = $value;
			}
		} catch (\Exception $e) {
			$configuration['data'] = '';
		}
		### END Compatibility Code ###

		$value = \trim($this->controllerContext->pi_getFFvalue($data, 'data'));
		if ($value !== '') {
			$configuration['data'] = $value;
		}

		$value = \trim($this->controllerContext->pi_getFFvalue($data, 'hashName'));
		if ($value !== '') {
			$configuration['hashName'] = $value;
		}

		$configuration['renderer'] = 'Fluid';

		return $configuration;
	}
}
