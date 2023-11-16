<?php

defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {
        //
        // Registers a Backend Module
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'FluidForm',
            'web',
            'FluidForm',
            '',
            [
                \CodingMs\FluidForm\Controller\BackendController::class => 'overview',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:fluid_form/Resources/Public/Icons/module-fluid-form.svg',
                'iconIdentifier' => 'module-fluid-form',
                'labels' => 'LLL:EXT:fluid_form/Resources/Private/Language/locallang_fluid_form.xlf',
            ]
        );
        //
        // Table configuration arrays
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_fluidform_domain_model_form');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_fluidform_domain_model_field');
    }
);
