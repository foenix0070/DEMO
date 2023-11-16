<?php

$EM_CONF['modules'] = [
    'title' => 'Modules',
    'description' => 'Modules - Little helper for creating frontend and backend modules in TYPO3',
    'category' => 'be',
    'author' => 'Thomas Deuling',
    'author_email' => 'typo3@coding.ms',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '5.6.0',
    'constraints' => [
        'depends' => [
            'php' => '7.4.0-8.1.99',
            'typo3' => '10.4.0-11.5.99',
            'additional_tca' => '1.11.0-1.99.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
