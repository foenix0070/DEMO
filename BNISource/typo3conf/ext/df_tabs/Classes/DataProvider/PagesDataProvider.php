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

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Data Provider for the pages table
 */
class PagesDataProvider extends AbstractDataBaseDataProvider {
	/**
	 * Related database table
	 *
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * Returns an array of tt_content ids that are related to the given page id. The result is
	 * filtered by some typoscript configuration options.
	 *
	 * @param int $uid
	 * @return array
	 */
	public function getContentUids($uid) {
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
		$queryBuilder->select('uid')
			->from('tt_content')
			->where(
				'pid = ' . ((int) $uid) .
				' ' . $this->pluginConfiguration['pages.']['additionalWhere'] .
				' AND sys_language_uid IN (0,-1)'
			);
		if ($this->pluginConfiguration['pages.']['limit']) {
			$queryBuilder->setMaxResults($this->pluginConfiguration['pages.']['limit']);
		}

		if ($this->pluginConfiguration['pages.']['orderBy']) {
			$orderings = \explode(',', $this->pluginConfiguration['pages.']['orderBy']);
			foreach ($orderings as $order) {
				$queryBuilder->addOrderBy(\trim($order));
			}
		}

		$contentElements = $queryBuilder->execute()->fetchAll();
		return \array_column($contentElements, 'uid');
	}
}
