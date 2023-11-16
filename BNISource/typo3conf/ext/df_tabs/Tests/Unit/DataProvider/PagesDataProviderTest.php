<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) sgalinski Internet Services (https://www.sgalinski.de)
 *
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

require_once(t3lib_extMgm::extPath('df_tabs') . 'Tests/Unit/BaseTestCase.php');
require_once(t3lib_extMgm::extPath('df_tabs') . 'Classes/DataProvider/InterfaceDataProvider.php');

/**
 * Test case for class Tx_DfTabs_DataProvider_PagesDataProvider.
 */
class Tx_DfTabs_DataProvider_PagesDataProviderTest extends Tx_DfTabs_BaseTestCase {
	/**
	 * @var Tx_DfTabs_DataProvider_PagesDataProvider
	 */
	protected $fixture;

	/**
	 * @var t3lib_DB
	 */
	protected $backupDatabase;

	/**
	 * @var t3lib_DB | PHPUnit_Framework_MockObject_MockObject
	 */
	protected $database;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->backupDatabase = $GLOBALS['TYPO3_DB'];
		$GLOBALS['TYPO3_DB'] = $this->database = $this->getMock('t3lib_DB');
		$this->fixture = new Tx_DfTabs_DataProvider_PagesDataProvider();
	}

	/**
	 * @return void
	 */
	public function tearDown() {
		$GLOBALS['TYPO3_DB'] = $this->backupDatabase;
		unset($this->fixture);
	}

	/**
	 * @test
	 * @return void
	 */
	public function getContentUidsReturnsTtContentUids() {
		/** @var $contentObject tslib_cObj */
		$contentObject = $this->getMock('tslib_cObj');
		$this->fixture->injectContentObject($contentObject);

		/** @noinspection PhpUndefinedMethodInspection */
		$this->database->expects($this->once())->method('exec_SELECTgetRows')
			->will($this->returnValue([12 => [], 14 => []]));

		$this->assertSame([12, 14], $this->fixture->getContentUids(2));
	}
}
