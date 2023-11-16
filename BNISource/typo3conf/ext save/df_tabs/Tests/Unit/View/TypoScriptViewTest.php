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

/**
 * Test case for class Tx_DfTabs_View_TypoScriptView.
 */
class Tx_DfTabs_View_TypoScriptViewTest extends Tx_DfTabs_BaseTestCase {
	/**
	 * @var Tx_DfTabs_View_TypoScriptView
	 */
	protected $fixture;

	/**
	 * @var tslib_cObj
	 */
	protected $contentObject = NULL;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->fixture = $this->getAccessibleMock('Tx_DfTabs_View_TypoScriptView', ['dummy']);

		/** @noinspection PhpParamsInspection */
		$this->contentObject = $this->getMock('tslib_cObj', ['typoLink']);
		$this->fixture->injectContentObject($this->contentObject);
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
		$configuration = ['123' => ['foo' => 'bar', 'counter' => 1]];
		$this->fixture->injectPluginConfiguration(['foo' => 'bar'], '123');
		/** @noinspection PhpUndefinedMethodInspection */
		$this->assertSame($configuration, $this->fixture->_get('pluginConfiguration'));
	}

	/**
	 * @test
	 * @return void
	 */
	public function pageRendererCanBeInjected() {
		$pageRenderer = new t3lib_PageRenderer();
		$this->fixture->injectPageRenderer($pageRenderer);
		/** @noinspection PhpUndefinedMethodInspection */
		$this->assertSame($pageRenderer, $this->fixture->_get('pageRenderer'));
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
	public function addInlineJavaScriptCodeAddsJsCodeToTheFooter() {
		$configuration = ['enableJavascript' => '1'];
		$this->fixture->injectPluginConfiguration($configuration, '123');

		$pageRenderer = $this->getMock('t3lib_pageRenderer');
		/** @noinspection PhpParamsInspection */
		$this->fixture->injectPageRenderer($pageRenderer);

		$pageRenderer->expects($this->once())->method('addJsFooterInlineCode');
		$this->fixture->addInlineJavaScriptCode([1, 2, 3], 'combined', '123');
	}

	/**
	 * @test
	 * @return void
	 */
	public function addInlineJavaScriptCodeDoesNotAddJsCodeIfItIsPermittedByConfiguration() {
		$pageRenderer = $this->getMock('t3lib_pageRenderer');
		/** @noinspection PhpParamsInspection */
		$this->fixture->injectPageRenderer($pageRenderer);

		$pageRenderer->expects($this->never())->method('addJsFooterInlineCode');
		$this->fixture->addInlineJavaScriptCode([1, 2, 3], 'combined', '123');
	}

	/**
	 * @return array
	 */
	public function renderTabsReturnsPluginContentWithTabElementDataProvider() {
		$tabElement = new Tx_DfTabs_Domain_Model_Tab('Foo', 12);
		$tabElement->setContent('Bar');
		$tabElement->setLink(['header_link' => '15 _blank']);

		$pluginConfigurationWithMostSubstitutionTerms = [
			'linkField' => 'header_link',
			'stdWrap.' => [
				'tabTitle.' => [
					'wrap' => '<h4 class="###CLASSES###">|</h4>',
				],
				'tabContents.' => [
					'wrap' => '<div class="###CLASSES###" id="###ID###">|</div>',
				],
				'tabContent.' => [
					'wrap' => '<div class="###CLASSES###" id="###ID###">|</div>',
				],
				'tabMenu.' => [
					'wrap' => '<ul class="###CLASSES###" id="###ID###">|</ul>',
				],
				'tabMenuEntry.' => [
					'wrap' => '<li id="###ID###" class="###CLASSES###"><a href="###LINK_ANCHOR###" id="###LINK_ID###">|</a></li>',
				],
			],
		];

		$pluginConfigurationWithLinkedTabMenuEntry = $pluginConfigurationWithMostSubstitutionTerms;
		$pluginConfigurationWithLinkedTabMenuEntry['stdWrap.']['tabMenuEntry.']['wrap'] =
			'<li id="###ID###" class="###CLASSES###"><a href="###LINK###" target="###TARGET###" id="###LINK_ID###">|</a></li>';

		$pluginConfigurationWithClassPrefix = $pluginConfigurationWithMostSubstitutionTerms;
		$pluginConfigurationWithClassPrefix['classPrefix'] = 'prefix-';

		/** @var language $language */
		$language = $GLOBALS['LANG'];

		return [
			'basic element' => [
				[$tabElement], $pluginConfigurationWithMostSubstitutionTerms,
				'<ul class="tabMenu" id="tabMenu-1"><li id="tabMenuEntry0" class="tabMenuEntry tabMenuEntrySelected"><a href="http://www.google.de" id="0">Foo</a></li></ul>' . chr(
					10
				) .
				'<div class="tabContents" id="tabContents-1"><h4 class="tabTitle">Foo</h4>' . chr(10) .
				'<div class="tabContent tabContentSelected" id="tabContent0">Bar</div></div>' . chr(10)
			],
			'basic element with linked tab menu' => [
				[$tabElement], $pluginConfigurationWithLinkedTabMenuEntry,
				'<ul class="tabMenu" id="tabMenu-1"><li id="tabMenuEntry0" class="tabMenuEntry tabMenuEntrySelected"><a href="http://www.google.de" target="http://www.google.de" id="0">Foo</a></li></ul>' . chr(
					10
				) .
				'<div class="tabContents" id="tabContents-1"><h4 class="tabTitle">Foo</h4>' . chr(10) .
				'<div class="tabContent tabContentSelected" id="tabContent0">Bar</div></div>' . chr(10)
			],
			'basic element with class prefix' => [
				[$tabElement], $pluginConfigurationWithClassPrefix,
				'<ul class="prefix-tabMenu" id="prefix-tabMenu-1"><li id="prefix-tabMenuEntry0" class="prefix-tabMenuEntry prefix-tabMenuEntrySelected"><a href="http://www.google.de" id="0">Foo</a></li></ul>' . chr(
					10
				) .
				'<div class="prefix-tabContents" id="prefix-tabContents-1"><h4 class="prefix-tabTitle">Foo</h4>' . chr(
					10
				) .
				'<div class="prefix-tabContent prefix-tabContentSelected" id="prefix-tabContent0">Bar</div></div>' . chr(
					10
				)
			],
			'basic element * 2' => [
				[$tabElement, $tabElement], $pluginConfigurationWithMostSubstitutionTerms,
				'<ul class="tabMenu" id="tabMenu-1"><li id="tabMenuEntry0" class="tabMenuEntry tabMenuEntrySelected"><a href="http://www.google.de" id="0">Foo</a></li><li id="tabMenuEntry1" class="tabMenuEntry"><a href="http://www.google.de" id="1">Foo</a></li></ul>' . chr(
					10
				) .
				'<div class="tabContents" id="tabContents-1"><h4 class="tabTitle">Foo</h4>' . chr(10) .
				'<div class="tabContent tabContentSelected" id="tabContent0">Bar</div><h4 class="tabTitle">Foo</h4>' . chr(
					10
				) .
				'<div class="tabContent" id="tabContent1">Bar</div></div>' . chr(10)
			],
			'no tab elements' => [
				[],
				$pluginConfigurationWithMostSubstitutionTerms,
				$language->sL('LLL:EXT:df_tabs/Resources/Private/Language/locallang.xlf:noContentFound')
			],
		];
	}

	/**
	 * @dataProvider renderTabsReturnsPluginContentWithTabElementDataProvider
	 * @test
	 * @param array $tabElements
	 * @param array $pluginConfiguration
	 * @param string $expectedContent
	 * @return void
	 */
	public function renderTabsReturnsPluginContentWithTabElement(
		array $tabElements,
		array $pluginConfiguration,
		$expectedContent
	) {
		/** @noinspection PhpUndefinedMethodInspection */
		$this->contentObject->expects($this->any())->method('typoLink')
			->will($this->returnValue('http://www.google.de'));

		$this->fixture->injectPluginConfiguration($pluginConfiguration, '123');
		$this->assertSame($expectedContent, $this->fixture->renderTabs($tabElements, '123'));
	}
}
