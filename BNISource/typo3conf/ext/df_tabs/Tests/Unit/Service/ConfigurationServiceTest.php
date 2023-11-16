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
 * Test case for class Tx_DfTabs_Service_ConfigurationService.
 */
class Tx_DfTabs_Service_ConfigurationServiceTest extends Tx_DfTabs_BaseTestCase {
	/**
	 * @var Tx_DfTabs_Service_ConfigurationService
	 */
	protected $fixture;

	/**
	 * @var array
	 */
	protected $backupTypo3ConfigurationVars;

	/** @var tx_dftabs_plugin1 */
	protected $context = NULL;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->backupTypo3ConfigurationVars = $GLOBALS['TYPO3_CONF_VARS'];
		$this->fixture = $this->getAccessibleMock('Tx_DfTabs_Service_ConfigurationService', ['dummy']);

		$this->context = new tx_dftabs_plugin1();
		$this->fixture->injectControllerContext($this->context);
	}

	/**
	 * @return void
	 */
	public function tearDown() {
		$GLOBALS['TYPO3_CONF_VARS'] = $this->backupTypo3ConfigurationVars;
		unset($this->fixture);
	}

	/**
	 * @test
	 * @return void
	 */
	public function controllerContextCanBeInjected() {
		/** @var $context tx_dftabs_plugin1 */
		$context = $this->getMock('tx_dftabs_plugin1');
		$this->fixture->injectControllerContext($context);

		/** @noinspection PhpUndefinedMethodInspection */
		$this->assertSame($context, $this->fixture->_get('controllerContext'));
	}

	/**
	 * @test
	 * @return void
	 */
	public function getConfigurationReturnsCombinedConfigurationArray() {
		$expectedConfiguration = [
			'conf1' => 'foo',
			'conf2' => 'foo',
			'mode' => 'mode',
		];

		$extensionConfiguration = ['conf1' => 'foo', 'conf2' => 'bar'];
		\SGalinski\DfTabs\Utility\ExtensionUtility::setExtensionConfiguration($extensionConfiguration);

		$this->context->conf = ['conf2' => 'foo'];

		$this->context->cObj->data['pi_flexform'] = [
			'data' => [
				'sDEF' => [
					'lDEF' => [
						'mode' => ['vDEF' => 'mode'],
					],
				],
			],
		];

		$this->assertSame($expectedConfiguration, $this->fixture->getConfiguration());
	}

	/**
	 * @test
	 * @return void
	 */
	public function getConfigurationIgnoresUndefinedEntriesInFlexformConfiguration() {
		$expectedConfiguration = [
			'useJQuery' => '1',
			'mode' => 'mode',
		];

		$this->context->cObj->data['pi_flexform'] = [
			'data' => [
				'sDEF' => [
					'lDEF' => [
						'mode' => ['vDEF' => 'mode'],
						'conf1' => ['vDEF' => 'foo'],
					],
				],
			],
		];

		$this->assertSame($expectedConfiguration, $this->fixture->getConfiguration());
	}

	/**
	 * @test
	 * @return void
	 */
	public function getConfigurationHandlesSpecialTitlesPropertyInFlexformSource() {
		$expectedConfiguration = [
			'useJQuery' => '1',
			'titles' => ['foo', 'bar'],
		];

		$this->context->cObj->data['pi_flexform'] = [
			'data' => [
				'sDEF' => [
					'lDEF' => [
						'titles' => ['vDEF' => 'foo' . chr(10) . 'bar'],
					],
				],
			],
		];

		$this->assertSame($expectedConfiguration, $this->fixture->getConfiguration());
	}

	/**
	 * @test
	 * @return void
	 */
	public function getConfigurationHandlesSpecialTitlesPropertyInTypoScriptSource() {
		$expectedConfiguration = [
			'useJQuery' => '1',
			'titles' => ['foo', 'bar'],
		];

		$this->context->conf = ['titles' => 'foo,bar'];

		$this->assertSame($expectedConfiguration, $this->fixture->getConfiguration());
	}
}
