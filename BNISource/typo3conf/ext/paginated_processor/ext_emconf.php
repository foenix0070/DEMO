<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Pagination DatabaseQueryProcessor',
    'description' => 'TYPO3 Pagination DatabaseQueryProcessor',
    'category' => 'fe',
    'version' => '1.0.0',
    'state' => 'stable',
    'author' => 'Thomas Löffler',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
            'fluid' => ''
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
