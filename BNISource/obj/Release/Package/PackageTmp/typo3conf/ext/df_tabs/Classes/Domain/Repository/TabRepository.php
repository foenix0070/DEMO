<?php

namespace SGalinski\DfTabs\Domain\Repository;

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
use SGalinski\DfTabs\DataProvider\FactoryDataProvider;
use SGalinski\DfTabs\Domain\Model\Tab;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Tab Repository
 */
class TabRepository {
	/**
	 * @var array
	 */
	protected $pluginConfiguration = [];

	/**
	 * @var ContentObjectRenderer
	 */
	protected $contentObject;

	/**
	 * Injects an instance of the content object
	 *
	 * @param ContentObjectRenderer $contentObject
	 * @return void
	 */
	public function injectContentObject(ContentObjectRenderer $contentObject) {
		$this->contentObject = $contentObject;
	}

	/**
	 * Injects the plugin configuration
	 *
	 * @param array $configuration
	 * @return void
	 */
	public function injectPluginConfiguration(array $configuration) {
		$this->pluginConfiguration = $configuration;
	}

	/**
	 * Returns a data provider instance
	 *
	 * @param string $type
	 * @return AbstractBaseDataProvider
	 */
	protected function getDataProvider($type) {
		return FactoryDataProvider::getDataProvider(
			$type,
			$this->pluginConfiguration,
			$this->contentObject
		);
	}

	/**
	 * Returns the configured records
	 *
	 * @return array
	 */
	public function getRecords() {
		$records = $this->pluginConfiguration['data'];
		$stdWrap = $this->pluginConfiguration['stdWrap.'][$this->pluginConfiguration['mode'] . '.'];
		if (is_array($stdWrap)) {
			$GLOBALS['TSFE']->register['dftabs_pluginElement'] = $this->contentObject->data;
			$records = $this->contentObject->stdWrap($records, $stdWrap);
		}

		// access protection checks for the given records
		$configuration = [
			'tables' => $this->pluginConfiguration['mode'],
			'source' => $records,
			'dontCheckPid' => 1,
			'conf.' => [
				'pages' => 'TEXT',
				'pages.' => [
					'data' => 'field:uid',
					'wrap' => 'pages_|,',
				],
				'tt_content' => 'TEXT',
				'tt_content.' => [
					'data' => 'field:uid',
					'wrap' => 'tt_content_|,',
				],
			],
		];
		$records = $this->contentObject->render($this->contentObject->getContentObject('RECORDS'), $configuration);

		return GeneralUtility::trimExplode(',', $records, TRUE);
	}

	/**
	 * Returns an array of tab elements
	 *
	 * @param array $preferredTitles
	 * @param array $records
	 * @return array
	 */
	public function buildTabElements(array $preferredTitles, array $records) {
		$tabElements = [];
		$amountOfTabs = max(count($preferredTitles), count($records));
		for ($index = 0; $index < $amountOfTabs; ++$index) {
			$recordId = $records[$index];
			$type = $this->pluginConfiguration['mode'];
			if (strrpos($recordId, '_') !== FALSE) {
				$type = substr($recordId, 0, strrpos($recordId, '_'));
				$recordId = substr($recordId, strrpos($recordId, '_') + 1);
			}

			$recordId = (!$recordId ? $index + 1 : $recordId);
			$dataProvider = $this->getDataProvider($type);

			$overrideTitle = trim($preferredTitles[$index]);
			if ($overrideTitle === '' || $overrideTitle === 'DEFAULT') {
				$title = $dataProvider->getTitle($recordId);
			} else {
				$title = $overrideTitle;
			}

			if ($title === '') {
				$title = $this->pluginConfiguration['defaultTabTitle'];
			}

			if ($this->pluginConfiguration['removeFromTitle']) {
				$title = \trim(\preg_replace(
					'/' . $this->pluginConfiguration['removeFromTitle'] . '/',
					'',
					$title
				));
			}

			/** @var Tab $tabElement */
			$tabElement = GeneralUtility::makeInstance(Tab::class, htmlspecialchars($title), $recordId);
			$tabElement->setLink($dataProvider->getLinkData($recordId));
			$tabElement->setContent($dataProvider->getTabContent($recordId));
			$tabElements[] = $tabElement;
		}

		return $tabElements;
	}
}
