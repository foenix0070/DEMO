<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

call_user_func(static function () {
    $GLOBALS['TCA']['fe_groups']['columns']['description']['exclude'] = true;
});
