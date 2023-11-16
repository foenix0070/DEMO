<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

return [
    'fluid_form:report' => [
        'class' => \CodingMs\FluidForm\Command\ReportCommand::class
    ],
];
