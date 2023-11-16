<?php
/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

/**
 * Extension Manager/Repository config file for ext "gridgallery".
 */

/** @noinspection PhpUndefinedVariableInspection */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Grid Gallery',
    'description' => 'Adds a modern gridgallery content element to the website.',
    'category' => 'plugin',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-11.5.99',
            'php' => '7.1.0-7.4.99'
        ],
        'conflicts' => [],
        'suggests' => [
            'fancybox' => '1.0.0-1.99.99'
        ]
    ],
    'autoload' => [
        'psr-4' => [
            'Lavitto\\Gridgallery\\' => 'Classes'
        ],
    ],
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'author' => 'Philipp Mueller',
    'author_email' => 'philipp.mueller@lavitto.ch',
    'author_company' => 'lavitto ag',
    'version' => '1.0.16',
];
