<?php

/**
 * Extension Manager/Repository config file for ext "fluid_new_site_bni".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Fluid New Site BNI',
    'description' => 'The New Site of BNI Bank',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
            'fluid_styled_content' => '11.5.0-11.5.99',
            'rte_ckeditor' => '11.5.0-11.5.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'ImayaSarl\\FluidNewSiteBni\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Fawaz Bouraima',
    'author_email' => 'fbouraima@outlook.com',
    'author_company' => 'IMAYA Sarl',
    'version' => '1.0.0',
];
