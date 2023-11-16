<?php

/***************************************************************
 *  Copyright notice
 *  (c) sgalinski Internet Services (https://www.sgalinski.de)
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
namespace SGalinski\DfTabs\Preview;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * small helper class, aslong as we use PageLayout hook + Previewrenderer....
 */
class PreviewService {
	public const RETURNTYPE_ARR = 'array';

	public function getPluginView(array $row): StandaloneView {
		$view = GeneralUtility::makeInstance(StandaloneView::class);
		$view->setPartialRootPaths(['EXT:df_tabs/Resources/Private/Partials/Backend']);
		$view->setTemplateRootPaths(['EXT:df_tabs/Resources/Private/Templates/Backend']);
		$view->setTemplate('Tabs.html');

		$view->assign('uid', $row['uid']);

		// Get available plugin settings and their values from flexform
		$templateData = [];

		// Get available plugin settings and their values from flexform
		$pluginConfiguration = GeneralUtility::xml2array(
			$row['pi_flexform'],
			'T3DataStructure'
		)['data']['sDEF']['lDEF'];

		$tabElements = GeneralUtility::trimExplode(',', $this->passVDefOnKeyToTemplate($pluginConfiguration, 'data'), TRUE);
		$tabs = [];

		foreach ($tabElements as $tabElement) {
			// Each $tabElement is either 'pages_<id>' or 'tt_content_<id>'.
			$recordTable = substr($tabElement, 0, strrpos($tabElement, '_'));
			$recordId = substr($tabElement, strrpos($tabElement, '_') + 1);

			if ($recordTable === 'pages') {
				$recordTitle = BackendUtility::getRecord($recordTable, $recordId, 'title')['title'];
				$recordType = 'page';
			} elseif ($recordTable === 'tt_content') {
				$recordTitle = BackendUtility::getRecord($recordTable, $recordId, 'header')['header'];
				$recordType = 'content';
			} else {
				$recordTitle = $tabElement;
				$recordType = 'unknown';
			}

			$tabs[] = [
				'type' => $recordType,
				'title' => $recordTitle,
				'uid' => $recordId
			];
		}

		$titles = GeneralUtility::trimExplode("\n", $this->passVDefOnKeyToTemplate($pluginConfiguration, 'titles'));
		// Remove first item if it is empty to mimic what is actually saved to the DB and frontend behaviour.
		// This gets done automatically on a second save of the plugin anyways but it should happen every time.
		if ($titles[0] === '') {
			array_shift($titles);
		}

		$templateData = [
			'mode' => $this->passVDefOnKeyToTemplate($pluginConfiguration, 'mode'),
			'tabs' => $tabs,
			//'titles' => $titles,
			'enableAutoPlay' => $this->passVDefOnKeyToTemplate($pluginConfiguration, 'enableAutoPlay'),
			'autoPlayInterval' => $this->passVDefOnKeyToTemplate($pluginConfiguration, 'autoPlayInterval'),
			'enableMouseOver' => $this->passVDefOnKeyToTemplate($pluginConfiguration, 'enableMouseOver'),
			'hashName' => $this->passVDefOnKeyToTemplate($pluginConfiguration, 'hashName')
		];

		$view->assign('data', $templateData);
		return $view;
	}

	/**
	 * @param array $conf
	 * @param string $key
	 * @param string $returnType
	 * @return array|mixed|string
	 */
	private function passVDefOnKeyToTemplate(array $conf, string $key, string $returnType = '') {
		if (isset($conf[$key])) {
			return $conf[$key]['vDEF'];
		}

		// check if we got a possible returntype:
		if ($returnType === self::RETURNTYPE_ARR) {
			return [];
		}

		return '';
	}
}
