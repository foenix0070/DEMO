<?php

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'modules',
    'Configuration/TypoScript/Frontend',
    'FE-Modules (third-party modules)'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'modules',
    'Configuration/TypoScript/Stylesheet',
    'FE-Default stylesheets'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'modules',
    'Configuration/TypoScript/Registration',
    'FE-Registration & Profile'
);
