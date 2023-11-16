<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "fs_media_gallery"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Media Gallery',
    'description' => 'A media gallery based on the FAL integration of TYPO3.
Show your media assets from your local or remote storage as a gallery of albums.',
    'category' => 'plugin',
    'author' => 'Frans Saris',
    'author_email' => 'franssaris@gmail.com',
    'author_company' => '',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'lockType' => '',
    'version' => '3.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '11.4.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
