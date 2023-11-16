<?php

declare(strict_types=1);

use CodingMs\FluidForm\Domain\Model\FileReference;
use CodingMs\FluidForm\Domain\Model\Form;

return [
    FileReference::class => [
        'tableName' => 'sys_file_reference',
        'properties' => [
            'originalFileIdentifier' => [
                'fieldName' => 'uid_local'
            ],
            'downloadFilename' => [
                'fieldName' => 'downloadname'
            ],
        ],
    ],
    Form::class => [
        'tableName' => 'tx_fluidform_domain_model_form',
        'properties' => [
            'creationDate' => [
                'fieldName' => 'crdate'
            ],
        ],
    ],
];
