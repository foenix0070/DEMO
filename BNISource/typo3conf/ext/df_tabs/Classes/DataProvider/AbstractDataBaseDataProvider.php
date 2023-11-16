<?php

namespace SGalinski\DfTabs\DataProvider;

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

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Database Data Provider
 */
abstract class AbstractDataBaseDataProvider extends AbstractBaseDataProvider {
	/**
	 * Related database table
	 *
	 * @var string
	 */
	protected $table = '';

	/**
	 * Internally cached record data
	 *
	 * @var array
	 */
	protected $cachedRecord;

	/**
	 * Returns the internally used record data
	 *
	 * @param int $uid
	 * @return array
	 * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
	 */
	protected function getRecordData($uid) {
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
		$row = $queryBuilder->select('*')
			->from($this->table)
			->where(
				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid, \PDO::PARAM_INT))
			)->execute()->fetch();

		/** @var TypoScriptFrontendController $typoscriptController */
		$typoscriptController = $GLOBALS['TSFE'];
		$context = GeneralUtility::makeInstance(Context::class);
		$languageAspect = $context->getAspect('language');
		$sysLanguageContent = $languageAspect->getContentId();
		$sysLanguageContentOl = $languageAspect->getOverlayType();
		if (\is_array($row) && $row['sys_language_uid'] !== $sysLanguageContent &&
			$sysLanguageContentOl
		) {
			if ($this->table !== 'pages') {
				$row = $typoscriptController->sys_page->getRecordOverlay(
					$this->table,
					$row,
					$sysLanguageContent,
					$sysLanguageContentOl
				);
			} else {
				$row = $typoscriptController->sys_page->getPageOverlay($row);
			}
		}

		return $row;
	}

	/**
	 * Returns the given input as an array
	 *
	 * Override this in your subclasses if required!
	 *
	 * @param int $uid
	 * @return array
	 */
	protected function getContentUids($uid) {
		return [$uid];
	}

	/**
	 * Returns the tab content for given tt_content identifiers
	 *
	 * @param int $uid
	 * @return string
	 * @throws \TYPO3\CMS\Frontend\ContentObject\Exception\ContentRenderingException
	 */
	public function getTabContent($uid) {
		$configuration = [
			'tables' => 'tt_content',
			'source' => \implode(',', $this->getContentUids($uid)),
			'dontCheckPid' => 1
		];

		if (\array_key_exists('records.', $this->pluginConfiguration) && \is_array($this->pluginConfiguration['records.'])) {
			$configuration = \array_merge($configuration, $this->pluginConfiguration['records.']);
		}

		return $this->contentObject->render($this->contentObject->getContentObject('RECORDS'), $configuration);
	}

	/**
	 * Returns the header field of the requested tt_content element
	 *
	 * @param int $uid
	 * @return string
	 * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
	 */
	public function getTitle($uid) {
		if (!isset($this->cachedRecord[$uid])) {
			$this->cachedRecord[$uid] = $this->getRecordData($uid);
		}

		return $this->cachedRecord[$uid][$this->pluginConfiguration[$this->table . '.']['titleField']];
	}

	/**
	 * Returns the link data for this specific id
	 *
	 * @param int $uid
	 * @return string
	 * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
	 */
	public function getLinkData($uid) {
		if (!isset($this->cachedRecord[$uid])) {
			$this->cachedRecord[$uid] = $this->getRecordData($uid);
		}

		return $this->cachedRecord[$uid][$this->pluginConfiguration[$this->table . '.']['linkField']];
	}
}
