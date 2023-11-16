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

use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 *
 */
class PreviewRenderer implements PreviewRendererInterface {
	public const RETURNTYPE_ARR = 'array';

	/**
	 * @var LanguageService $languageService
	 */
	protected $languageService;

	/**
	 * @var PreviewService $previewService
	 */
	protected $previewService;

	public function __construct(LanguageService $languageService, PreviewService $previewService) {
		$this->languageService = $languageService;
		$this->previewService = $previewService;
	}

	/**
	 * Dedicated method for rendering preview header HTML for
	 * the page module only. Receives $item which is an instance of
	 * GridColumnItem which has a getter method to return the record.
	 *
	 * @param GridColumnItem $item
	 * @return string
	 */
	public function renderPageModulePreviewHeader(GridColumnItem $item): string {
		// @todo: when v12 hits, add header from PluginRenderer
		return '';
	}

	/**
	 * Dedicated method for rendering preview body HTML for
	 * the page module only.
	 *
	 * @param GridColumnItem $item
	 * @return string
	 */
	public function renderPageModulePreviewContent(GridColumnItem $item): string {
		return $this->previewService->getPluginView($item->getRecord())->render();
	}


	/**
	 * Render a footer for the record to display in page module below
	 * the body of the item's preview.
	 *
	 * @param GridColumnItem $item
	 * @return string
	 */
	public function renderPageModulePreviewFooter(GridColumnItem $item): string {
		return '';
	}

	/**
	 * Dedicated method for wrapping a preview header and body HTML.
	 *
	 * @param string $previewHeader
	 * @param string $previewContent
	 * @param GridColumnItem $item
	 * @return string
	 */
	public function wrapPageModulePreview(string $previewHeader, string $previewContent, GridColumnItem $item): string {
		return $previewHeader . $previewContent;
	}
}
