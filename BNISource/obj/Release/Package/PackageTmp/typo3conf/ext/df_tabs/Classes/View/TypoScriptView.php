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

use SGalinski\DfTabs\Domain\Model\Tab;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Renders the content
 */
class TypoScriptView implements SingletonInterface {
	/**
	 * @var array
	 */
	protected $pluginConfiguration = [];

	/**
	 * Page Renderer Instance
	 *
	 * @var PageRenderer
	 */
	protected $pageRenderer;

	/**
	 * @var ContentObjectRenderer
	 */
	protected $contentObject;

	/**
	 * Internal plugin counter
	 *
	 * @var int
	 */
	protected $counter = 1;

	/**
	 * Internal container that holds the used hashes
	 *
	 * @var array
	 */
	protected $usedHashes = [];

	/**
	 * Injects the plugin configuration
	 *
	 * @param array $configuration
	 * @param string $tabId
	 * @return void
	 */
	public function addPluginConfiguration(array $configuration, $tabId) {
		$this->pluginConfiguration[$tabId] = $configuration;

		$this->pluginConfiguration[$tabId]['counter'] = $this->counter;
		if (\in_array($this->pluginConfiguration[$tabId]['hashName'], $this->usedHashes)) {
			$this->pluginConfiguration[$tabId]['hashName'] = 'tab' . $this->counter . '-';
		}
		$this->usedHashes[] = $this->pluginConfiguration[$tabId]['hashName'];

		++$this->counter;
	}

	/**
	 * Injects the page renderer
	 *
	 * @param PageRenderer $pageRenderer
	 * @return void
	 */
	public function injectPageRenderer(PageRenderer $pageRenderer) {
		$this->pageRenderer = $pageRenderer;
	}

	/**
	 * Injects the content object
	 *
	 * @param ContentObjectRenderer $contentObject
	 * @return void
	 */
	public function injectContentObject(ContentObjectRenderer $contentObject) {
		$this->contentObject = $contentObject;
	}

	/**
	 * Adds the inline javascript code for this plugin
	 *
	 * @param array $records
	 * @param string $mode
	 * @param string $tabId
	 * @return void
	 */
	public function addInlineJavaScriptCode($records, $mode, $tabId) {
		$config = &$this->pluginConfiguration[$tabId];
		if ((int) $config['enableJavascript'] !== 1) {
			return;
		}

		$animationCallback = '';
		if ($config['animationCallback'] !== '') {
			$animationCallback = ',animationCallback: ' . $config['animationCallback'];
		}

		\array_shift($records);
		$menuId = $this->addPrefix('tabMenu-' . $config['counter'], $tabId);
		$contentId = $this->addPrefix('tabContents-' . $config['counter'], $tabId);
		$inlineJavaScript = '
			document.documentElement.className = "' . $this->addPrefix('plugin1-hasJS', $tabId) . ' "
				+ document.documentElement.className;
			$(document).ready(function() {
				window.TabBar' . $config['counter'] . ' = new TabBar(
					$("#' . $menuId . ' > ' . $config['menuNodeType'] . '"),
					$("#' . $contentId . ' > ' . $config['contentNodeType'] . '"), {
		';

		$inlineJavaScript .= '
						autoPlayInterval: ' . $config['autoPlayInterval'] . ',
						enableAutoPlay: ' . ($config['enableAutoPlay'] ? 'true' : 'false') . ',
						enableMouseOver: ' . ($config['enableMouseOver'] ? 'true' : 'false') . ',
						classPrefix: "' . $config['classPrefix'] . '",
						hashName: "' . $config['hashName'] . '",
						changeHashOnTabChange: ' . ($config['changeHashOnTabChange'] ? 'true' : 'false') . ',
						pollingInterval: ' . $config['pollingInterval'] . ',
						animationSpeed: ' . ($config['animationSpeed'] ?? 0) . ',
						startIndex: ' . $config['startIndex'] . ',
						onBeforeInitialize: ' . $config['events.']['onBeforeInitialize'] . ',
						onAfterInitialize: ' . $config['events.']['onAfterInitialize'] . ',
						onTabChange: ' . $config['events.']['onTabChange'] . '
						' . $animationCallback . '
					}
				);
			});
		';

		$this->pageRenderer->addJsFooterInlineCode(
			$this->addPrefix('plugin1', $tabId) . 'tx_dftabs_' . $config['counter'],
			$inlineJavaScript
		);
	}

	/**
	 * Renders the tabs
	 *
	 * @param array $tabElements
	 * @param string $tabId
	 * @return string
	 */
	public function renderTabs($tabElements, $tabId) {
		$config = &$this->pluginConfiguration[$tabId];
		if (!\count($tabElements)) {
			return LocalizationUtility::translate(
				'df_tabs',
				'LLL:EXT:df_tabs/Resources/Private/Language/locallang.xlf:noContentFound'
			);
		}

		$tabContents = $tabMenuEntries = '';
		$tabElementsCount = \count($tabElements);
		for ($index = 0; $index < $tabElementsCount; ++$index) {
			$tabContents .= $this->getTabContent($tabElements[$index], $index, $tabId);
			$tabMenuEntries .= $this->getTabMenuEntry($tabElements[$index], $index, $tabId);
		}

		$tabContents = \str_replace(
			['###CLASSES###', '###ID###'],
			[
				$this->addPrefix('tabContents', $tabId),
				$this->addPrefix('tabContents-' . $config['counter'], $tabId)
			],
			$this->stdWrap($tabContents, 'tabContents', $tabId)
		);

		$tabMenuEntries = \str_replace(
			['###CLASSES###', '###ID###'],
			[
				$this->addPrefix('tabMenu', $tabId),
				$this->addPrefix('tabMenu-' . $config['counter'], $tabId)
			],
			$this->stdWrap($tabMenuEntries, 'tabMenu', $tabId)
		);

		return $tabMenuEntries . PHP_EOL . $tabContents . PHP_EOL;
	}

	/**
	 * Renders a tab menu entry
	 *
	 * @param Tab $tabElement
	 * @param int $index
	 * @param string $tabId
	 * @return string
	 */
	protected function getTabMenuEntry(Tab $tabElement, $index, $tabId) {
		$menuEntry = $this->stdWrap($tabElement->getTitle(), 'tabMenuEntry', $tabId);

		$classes = $this->addPrefix('tabMenuEntry', $tabId) .
			($index === 0 ? ' ' . $this->addPrefix('tabMenuEntrySelected', $tabId) : '');
		$id = $this->addPrefix('tabMenuEntry' . $index, $tabId);
		$linkId = $this->pluginConfiguration[$tabId]['hashName'] . $index;

		$typolink = $target = '';
		if (\strpos($menuEntry, '###LINK###') !== FALSE) {
			$typolink = $this->contentObject->typoLink(
				'',
				[
					'parameter' => $tabElement->getLink(),
					'returnLast' => 'url'
				]
			);

			$target = $this->contentObject->typoLink(
				'',
				[
					'parameter' => $tabElement->getLink(),
					'returnLast' => 'target'
				]
			);
			$target = ($target === '' ? '_self' : $target);
		}

		$linkAnchor = '#' . $linkId;
		$hash = $linkAnchor;
		if (\strpos($menuEntry, '###LINK_ANCHOR###') !== FALSE &&
			$GLOBALS['TSFE']->config['baseURL'] !== ''
		) {
			$linkAnchor = $this->contentObject->typoLink(
				'',
				[
					'parameter' => $GLOBALS['TSFE']->id,
					'section' => $linkId,
					'returnLast' => 'url'
				]
			);
		}

		$menuEntry = \str_replace(
			['###CLASSES###', '###ID###', '###LINK_ANCHOR###', '###LINK_ID###', '###LINK###', '###TARGET###', '###HASH###'],
			[$classes, $id, $linkAnchor, $linkId, $typolink, $target, $hash],
			$menuEntry
		);

		return $menuEntry;
	}

	/**
	 * Returns a rendered content tab without the related menu entry. The markup is completely
	 * configurable by the usage of typoscript. The title parameter is added add the top of the
	 * tab and can be used for fallback purposes (no javascript) and for SEO.
	 *
	 * @param Tab $tabElement
	 * @param int $index
	 * @param string $tabId
	 * @return string
	 */
	protected function getTabContent(Tab $tabElement, $index, $tabId) {
		$tabContent = $this->stdWrap($tabElement->getContent(), 'tabContent', $tabId);
		$classes = $this->addPrefix('tabContent', $tabId) .
			($index === 0 ? ' ' . $this->addPrefix('tabContentSelected', $tabId) : '');
		$tabContent = \str_replace(
			['###CLASSES###', '###ID###'],
			[$classes, $this->addPrefix('tabContent' . $index, $tabId)],
			$tabContent
		);

		$tab = \str_replace(
			'###CLASSES###',
			$this->addPrefix('tabTitle', $tabId),
			$this->stdWrap($tabElement->getTitle(), 'tabTitle', $tabId)
		);

		return $tab . PHP_EOL . $tabContent;
	}

	/**
	 * Adds a prefix to a given string
	 *
	 * @param string $string
	 * @param string $tabId
	 * @return string
	 */
	protected function addPrefix($string, $tabId) {
		return $this->pluginConfiguration[$tabId]['classPrefix'] . $string;
	}

	/**
	 * Returns the given content after applying a stdWrap call
	 *
	 * @param string $content
	 * @param string $wrap name of the stdWrap property
	 * @param string $tabId
	 * @return string
	 */
	protected function stdWrap($content, $wrap, $tabId) {
		if (isset($this->pluginConfiguration[$tabId]['stdWrap.'][$wrap . '.'])) {
			$content = $this->contentObject->stdWrap(
				$content,
				$this->pluginConfiguration[$tabId]['stdWrap.'][$wrap . '.']
			) ?? '';
		}

		return $content;
	}
}
