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
 * Test case for class Tx_DfTabs_Domain_Repository_TabRepository.
 */
class Tx_DfTabs_Domain_Repository_TabRepositoryTest extends Tx_DfTabs_BaseTestCase {
	/**
	 * @var Tx_DfTabs_Domain_Repository_TabRepository
	 */
	protected $fixture;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->fixture = $this->getAccessibleMock(
			'Tx_DfTabs_Domain_Repository_TabRepository',
			['getDataProvider']
		);
	}

	/**
	 * @return void
	 */
	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 * @return void
	 */
	public function pluginConfigurationCanBeInjected() {
		$configuration = ['foo'];
		$this->fixture->injectPluginConfiguration($configuration);
		/** @noinspection PhpUndefinedMethodInspection */
		$this->assertSame($configuration, $this->fixture->_get('pluginConfiguration'));
	}

	/**
	 * @test
	 * @return void
	 */
	public function contentObjectCanBeInjected() {
		$contentObject = new tslib_cObj();
		$this->fixture->injectContentObject($contentObject);
		/** @noinspection PhpUndefinedMethodInspection */
		$this->assertSame($contentObject, $this->fixture->_get('contentObject'));
	}

	/**
	 * @test
	 * @return void
	 */
	public function buildTabElementsReturnsATabElementCollectionWithPreferredAndDefaultTitle() {
		$this->fixture->injectPluginConfiguration(['defaultTabTitle' => 'Title2']);

		$dataProvider = $this->getMock('Tx_DfTabs_DataProvider_AbstractBaseDataProvider');
		/** @noinspection PhpUndefinedMethodInspection */
		$this->fixture->expects($this->exactly(2))->method('getDataProvider')->will($this->returnValue($dataProvider));
		$dataProvider->expects($this->exactly(2))->method('getTabContent')->will($this->returnValue('Foo'));
		$dataProvider->expects($this->exactly(2))->method('getLinkData')->will($this->returnValue(''));
		$dataProvider->expects($this->once())->method('getTitle')->will($this->returnValue(''));

		$tab1 = new Tx_DfTabs_Domain_Model_Tab('Title1', 1);
		$tab1->setContent('Foo');

		$tab2 = new Tx_DfTabs_Domain_Model_Tab('Title2', 2);
		$tab2->setContent('Foo');

		$collection = $this->fixture->buildTabElements(['Title1', ''], []);
		$this->assertEquals([$tab1, $tab2], $collection);
	}

	/**
	 * @test
	 * @return void
	 */
	public function buildTabElementsReturnsATabElementCollectionDefinedByRecordsWithCalculatedTitles() {
		$dataProvider = $this->getMock('Tx_DfTabs_DataProvider_AbstractBaseDataProvider');
		/** @noinspection PhpUndefinedMethodInspection */
		$this->fixture->expects($this->exactly(2))->method('getDataProvider')->will($this->returnValue($dataProvider));
		$dataProvider->expects($this->exactly(2))->method('getTabContent')->will($this->returnValue('Foo'));
		$dataProvider->expects($this->exactly(2))->method('getLinkData')->will($this->returnValue(''));
		$dataProvider->expects($this->exactly(2))->method('getTitle')->will($this->returnValue('TITLE'));

		$tab1 = new Tx_DfTabs_Domain_Model_Tab('TITLE', 1);
		$tab1->setContent('Foo');

		$tab2 = new Tx_DfTabs_Domain_Model_Tab('TITLE', 2);
		$tab2->setContent('Foo');

		$collection = $this->fixture->buildTabElements([], ['pages_1', '2']);
		$this->assertEquals([$tab1, $tab2], $collection);
	}

	/**
	 * @test
	 * @return void
	 */
	public function buildTabElementsReturnsATabElementCollectionWithMixedProviders() {
		$dataProvider = $this->getMock('Tx_DfTabs_DataProvider_AbstractBaseDataProvider');
		/** @noinspection PhpUndefinedMethodInspection */
		$this->fixture->expects($this->exactly(2))->method('getDataProvider')->will($this->returnValue($dataProvider));
		$dataProvider->expects($this->exactly(2))->method('getTabContent')->will($this->returnValue('Foo'));
		$dataProvider->expects($this->exactly(2))->method('getLinkData')->will($this->returnValue(''));
		$dataProvider->expects($this->exactly(2))->method('getTitle')->will($this->returnValue('Bar'));

		$tab1 = new Tx_DfTabs_Domain_Model_Tab('Bar', 2);
		$tab1->setContent('Foo');

		$tab2 = new Tx_DfTabs_Domain_Model_Tab('Bar', 2);
		$tab2->setContent('Foo');

		$collection = $this->fixture->buildTabElements([], ['pages_2', 'tt_content_2']);
		$this->assertEquals([$tab1, $tab2], $collection);
	}

	/**
	 * @test
	 * @return void
	 */
	public function getRecordsWithoutStdWrap() {
		$this->fixture->injectPluginConfiguration(['data' => '1,2,3']);
		$contentObject = $this->getMock('tslib_cObj');
		$contentObject->expects($this->once())->method('RECORDS');
		$contentObject->expects($this->never())->method('stdWrap');
		/** @noinspection PhpParamsInspection */
		$this->fixture->injectContentObject($contentObject);
		$this->fixture->getRecords();
	}

	/**
	 * @test
	 * @return void
	 */
	public function getRecordsWithStdWrap() {
		$pluginConfiguration = [
			'mode' => 'test',
			'stdWrap.' => ['test.' => ['foo' => 'bar']],
		];
		$this->fixture->injectPluginConfiguration($pluginConfiguration);

		$contentObject = $this->getMock('tslib_cObj');
		/** @noinspection PhpParamsInspection */
		$this->fixture->injectContentObject($contentObject);
		$contentObject->expects($this->once())->method('stdWrap');
		$contentObject->expects($this->once())->method('RECORDS');
		$this->fixture->getRecords();
	}
}
