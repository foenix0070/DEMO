<?php

namespace SGalinski\DfTabs\Hooks\PageLayoutView;

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

use SGalinski\DfTabs\Preview\PreviewService;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class PluginRenderer - Renders backend previews for plugins.
 *
 * @package SGalinski\DfTabs\Hooks\PageLayoutView
 */
class PluginRenderer implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface {
	/**
	 * @var PreviewService $previewService
	 */
	protected $previewService;

	public function init() {
		$this->previewService = GeneralUtility::makeInstance(PreviewService::class);
	}


	/**
	 * @inheritDoc
	 * @noinspection ReferencingObjectsInspection
	 */
	public function preProcess(
		PageLayoutView &$parentObject,
		&$drawItem,
		&$headerContent,
		&$itemContent,
		array &$row
	): void {
		$this->init();
		if ($row['list_type'] === 'df_tabs_plugin1') {
			$drawItem = FALSE;

			$this->adaptPluginHeaderContent($headerContent, $row);

			$view = $this->previewService->getPluginView($row);

			$itemContent .= $view->render();
		}
	}

	/**
	 * Adapts the given $headerContent.
	 * To be used in all plugin previews so the Header Contents appear similarly.
	 *
	 * @param string $headerContent
	 * @param array $row
	 */
	protected function adaptPluginHeaderContent(string &$headerContent, array $row): void {
		$headerContent = '<h4>' . $this->getPluginNameForHeaderContent(
			(int) $row['pid'],
			$row['list_type']
		) . $headerContent . '</h4>';
	}

	/**
	 * Finds the label of the given $listType element on the page with the given $pid
	 * and returns it wrapped for use in the backend preview's header content.
	 *
	 * @param int $pid
	 * @param string $listType
	 * @return string
	 */
	protected function getPluginNameForHeaderContent(int $pid, string $listType): string {
		$languageService = GeneralUtility::makeInstance(LanguageService::class);

		$pluginName = $languageService->sL(
			BackendUtility::getLabelFromItemListMerged(
				$pid,
				'tt_content',
				'list_type',
				$listType
			)
		);
		return '<span class="label label-primary">' . $pluginName . '</span>&nbsp;';
	}
}
