<?php

defined('TYPO3') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fluid_form', 'Configuration/TypoScript', 'Fluid-Form');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fluid_form', 'Configuration/TypoScript/DatePicker/', 'Fluid-Form (DatePicker JS/CSS)');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fluid_form', 'Configuration/TypoScript/Forms/CallBack', 'Fluid-Form - Form: CallBack');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fluid_form', 'Configuration/TypoScript/Forms/ContactBasic', 'Fluid-Form - Form: ContactBasic');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fluid_form', 'Configuration/TypoScript/Forms/FileUpload', 'Fluid-Form - Form: FileUpload');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fluid_form', 'Configuration/TypoScript/Forms/JobApplication', 'Fluid-Form - Form: JobApplication');
