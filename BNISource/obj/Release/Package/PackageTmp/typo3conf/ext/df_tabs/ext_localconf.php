<?php

defined('TYPO3') or die();
/**
 *
 * Copyright notice
 *
 * (c) sgalinski Internet Services (https://www.sgalinski.de)
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

call_user_func(
	function () {
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43(
			'df_tabs',
			'',
			'_plugin1',
			'list_type',
			TRUE
		);
		// we correct the classname of the plugin controller
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
			'plugin.tx_dftabs_plugin1.userFunc=' . \SGalinski\DfTabs\Controller\PluginController::class . '->main'
		);

		// Backend preview for plugin
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['df_tabs']
			= \SGalinski\DfTabs\Hooks\PageLayoutView\PluginRenderer::class;

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
			'@import "EXT:df_tabs/Configuration/TsConfig/Page/NewContentElementWizard.tsconfig"'
		);

		/**
		 * Register icons
		 */
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
			\TYPO3\CMS\Core\Imaging\IconRegistry::class
		);
		$iconRegistry->registerIcon(
			'extension-df_tabs-content-element',
			\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
			['source' => 'EXT:df_tabs/Resources/Public/Images/contentElementWizard.png']
		);

		$GLOBALS['TCA']['tt_content']['types']['list']['previewRenderer']['df_tabs_plugin1'] = \SGalinski\DfTabs\Preview\PreviewRenderer::class;
	}
);
