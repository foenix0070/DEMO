<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') || defined('TYPO3') or die();
$extKey = '';
ExtensionManagementUtility::addStaticFile(
    'ns_cookieyes',
    'Configuration/TypoScript',
    '[NITSAN] Cookieyes'
);
