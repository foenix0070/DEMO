<?php return array (
  'HDNET\\Autoloader\\Loader\\Hooks' => 
  array (
    0 => 
    array (
      'locations' => 
      array (
        0 => 'TYPO3_CONF_VARS|SC_OPTIONS|BackendLayoutDataProvider',
      ),
      'configuration' => 'HDNET\\Autoloader\\Hooks\\BackendLayoutProvider',
    ),
    1 => 
    array (
      'locations' => 
      array (
        0 => 'TYPO3_CONF_VARS|SC_OPTIONS|cms/layout/class.tx_cms_layout.php|tt_content_drawItem',
      ),
      'configuration' => 'HDNET\\Autoloader\\Hooks\\ElementBackendPreview',
    ),
  ),
  'HDNET\\Autoloader\\Loader\\StaticTyposcript' => 
  array (
    0 => 
    array (
      'path' => 'Configuration/TypoScript/BackendLayouts/',
      'title' => 'Autoloader - BackendLayouts',
    ),
  ),
);