<?php
/**
 * Compiled ext_tables.php cache file
 */

/**
 * Extension: core
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/core/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

/**
 * $GLOBALS['PAGES_TYPES'] defines the various types of pages (field: doktype) the system
 * can handle and what restrictions may apply to them.
 * Here you can define which tables are allowed on a certain pagetype (doktype)
 * NOTE: The 'default' entry in the $GLOBALS['PAGES_TYPES'] array is the 'base' for all
 * types, and for every type the entries simply overrides the entries in the 'default' type!
 */
$GLOBALS['PAGES_TYPES'] = [
    (string)PageRepository::DOKTYPE_BE_USER_SECTION => [
        'allowedTables' => '*',
    ],
    (string)PageRepository::DOKTYPE_SYSFOLDER => [
        //  Doktype 254 is a 'Folder' - a general purpose storage folder for whatever you like.
        // In CMS context it's NOT a viewable page. Can contain any element.
        'allowedTables' => '*',
    ],
    (string)PageRepository::DOKTYPE_RECYCLER => [
        // Doktype 255 is a recycle-bin.
        'allowedTables' => '*',
    ],
    'default' => [
        'allowedTables' => 'pages,sys_category,sys_file_reference,sys_file_collection',
        'onlyAllowedTables' => false,
    ],
];

/**
 * $TBE_MODULES contains the structure of the backend modules as they are
 * arranged in main- and sub-modules. Every entry in this array represents a
 * menu item on either first (key) or second level (value from list) in the
 * left menu in the TYPO3 backend
 * For information about adding modules to TYPO3 you should consult the
 * documentation found in "Inside TYPO3"
 */
ExtensionManagementUtility::addModule(
    'web',
    '',
    '',
    null,
    [
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_web.xlf',
        'name' => 'web',
        'iconIdentifier' => 'modulegroup-web',
    ]
);
// workaround to add web->list by default
$GLOBALS['TBE_MODULES']['web'] = 'list';

ExtensionManagementUtility::addModule(
    'site',
    '',
    '',
    null,
    [
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_site.xlf',
        'name' => 'site',
        'workspaces' => 'online',
        'iconIdentifier' => 'modulegroup-site',
    ]
);
ExtensionManagementUtility::addModule(
    'file',
    '',
    '',
    null,
    [
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_file.xlf',
        'name' => 'file',
        'workspaces' => 'online,custom',
        'iconIdentifier' => 'modulegroup-file',
    ]
);
ExtensionManagementUtility::addModule(
    'user',
    '',
    '',
    null,
    [
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_usertools.xlf',
        'name' => 'user',
        'iconIdentifier' => 'modulegroup-user',
    ]
);
ExtensionManagementUtility::addModule(
    'tools',
    '',
    '',
    null,
    [
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_admintools.xlf',
        'name' => 'tools',
        'iconIdentifier' => 'modulegroup-tools',
    ]
);
ExtensionManagementUtility::addModule(
    'system',
    '',
    '',
    null,
    [
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_system.xlf',
        'name' => 'system',
        'iconIdentifier' => 'modulegroup-system',
    ]
);
ExtensionManagementUtility::addModule(
    'help',
    '',
    '',
    null,
    [
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_help.xlf',
        'name' => 'help',
        'iconIdentifier' => 'modulegroup-help',
    ]
);

// Register the page tree core navigation component
ExtensionManagementUtility::addCoreNavigationComponent('web', 'TYPO3/CMS/Backend/PageTree/PageTreeElement');

/**
 * $TBE_STYLES configures backend styles and colors; Basically this contains
 * all the values that can be used to create new skins for TYPO3.
 * For information about making skins to TYPO3 you should consult the
 * documentation found at https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/Configuration/GlobalVariables.html#confval-TBE_STYLES
 */
$GLOBALS['TBE_STYLES'] = [];

/**
 * Setting up $TCA_DESCR - Context Sensitive Help (CSH)
 * For information about using the CSH API in TYPO3 you should consult the
 * documentation found in "Inside TYPO3"
 */
ExtensionManagementUtility::addLLrefForTCAdescr('pages', 'EXT:core/Resources/Private/Language/locallang_csh_pages.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('be_users', 'EXT:core/Resources/Private/Language/locallang_csh_be_users.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('be_groups', 'EXT:core/Resources/Private/Language/locallang_csh_be_groups.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('sys_filemounts', 'EXT:core/Resources/Private/Language/locallang_csh_sysfilem.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('sys_file_reference', 'EXT:core/Resources/Private/Language/locallang_csh_sysfilereference.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('sys_file_storage', 'EXT:core/Resources/Private/Language/locallang_csh_sysfilestorage.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('sys_language', 'EXT:core/Resources/Private/Language/locallang_csh_syslang.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('sys_news', 'EXT:core/Resources/Private/Language/locallang_csh_sysnews.xlf');
// General Core
ExtensionManagementUtility::addLLrefForTCAdescr('xMOD_csh_corebe', 'EXT:core/Resources/Private/Language/locallang_csh_corebe.xlf');
}

/**
 * Extension: scheduler
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/scheduler/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Scheduler\Controller\SchedulerModuleController;

defined('TYPO3') or die();

// Add module
ExtensionManagementUtility::addModule(
    'system',
    'txschedulerM1',
    '',
    '',
    [
        'routeTarget' => SchedulerModuleController::class . '::mainAction',
        'access' => 'admin',
        'name' => 'system_txschedulerM1',
        'iconIdentifier' => 'module-scheduler',
        'labels' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang_mod.xlf',
    ]
);

// Add context sensitive help (csh) to the backend module
ExtensionManagementUtility::addLLrefForTCAdescr(
    '_MOD_system_txschedulerM1',
    'EXT:scheduler/Resources/Private/Language/locallang_csh_scheduler.xlf'
);
}

/**
 * Extension: frontend
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/frontend/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

// Add allowed records to pages
ExtensionManagementUtility::allowTableOnStandardPages('tt_content,sys_template,backend_layout');

ExtensionManagementUtility::addLLrefForTCAdescr('_MOD_web_layout', 'EXT:frontend/Resources/Private/Language/locallang_csh_weblayout.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('fe_groups', 'EXT:frontend/Resources/Private/Language/locallang_csh_fe_groups.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('fe_users', 'EXT:frontend/Resources/Private/Language/locallang_csh_fe_users.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('sys_template', 'EXT:frontend/Resources/Private/Language/locallang_csh_systmpl.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('tt_content', 'EXT:frontend/Resources/Private/Language/locallang_csh_ttcontent.xlf');
}

/**
 * Extension: filelist
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/filelist/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Filelist\Controller\FileListController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'file',
    'FilelistList',
    '',
    '',
    [
        'routeTarget' => FileListController::class . '::handleRequest',
        'access' => 'user,group',
        'workspaces' => 'online,custom',
        'name' => 'file_FilelistList',
        'iconIdentifier' => 'module-filelist',
        'labels' => 'LLL:EXT:filelist/Resources/Private/Language/locallang_mod_file_list.xlf',
    ]
);
}

/**
 * Extension: impexp
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/impexp/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addLLrefForTCAdescr('xMOD_tx_impexp', 'EXT:impexp/Resources/Private/Language/locallang_csh.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('tx_impexp_presets', 'EXT:impexp/Resources/Private/Language/locallang_csh_tx_impexp_presets.xlf');
}

/**
 * Extension: form
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/form/ext_tables.php
 */

namespace {




use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Form\Controller\FormEditorController;
use TYPO3\CMS\Form\Controller\FormManagerController;

defined('TYPO3') or die();

// Register the backend module Web->Forms
ExtensionUtility::registerModule(
    'Form',
    'web',
    'formbuilder',
    '',
    [
        FormManagerController::class => 'index, show, create, duplicate, references, delete',
        FormEditorController::class => 'index, saveForm, renderFormPage, renderRenderableOptions',
    ],
    [
        'access' => 'user,group',
        'iconIdentifier' => 'module-form',
        'labels' => 'LLL:EXT:form/Resources/Private/Language/locallang_module.xlf',
        'navigationComponentId' => '',
        'inheritNavigationComponentFromMainModule' => false,
    ]
);
}

/**
 * Extension: install
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/install/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Install\Controller\BackendModuleController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'tools',
    'toolsmaintenance',
    '',
    '',
    [
        'routeTarget' => BackendModuleController::class . '::maintenanceAction',
        'access' => 'systemMaintainer',
        'name' => 'tools_toolsmaintenance',
        'iconIdentifier' => 'module-install-maintenance',
        'labels' => 'LLL:EXT:install/Resources/Private/Language/ModuleInstallMaintenance.xlf',
    ]
);
ExtensionManagementUtility::addModule(
    'tools',
    'toolssettings',
    '',
    '',
    [
        'routeTarget' => BackendModuleController::class . '::settingsAction',
        'access' => 'systemMaintainer',
        'name' => 'tools_toolssettings',
        'iconIdentifier' => 'module-install-settings',
        'labels' => 'LLL:EXT:install/Resources/Private/Language/ModuleInstallSettings.xlf',
    ]
);
ExtensionManagementUtility::addModule(
    'tools',
    'toolsupgrade',
    '',
    '',
    [
        'routeTarget' => BackendModuleController::class . '::upgradeAction',
        'access' => 'systemMaintainer',
        'name' => 'tools_toolsupgrade',
        'iconIdentifier' => 'module-install-upgrade',
        'labels' => 'LLL:EXT:install/Resources/Private/Language/ModuleInstallUpgrade.xlf',
    ]
);
ExtensionManagementUtility::addModule(
    'tools',
    'toolsenvironment',
    '',
    '',
    [
        'routeTarget' => BackendModuleController::class . '::environmentAction',
        'access' => 'systemMaintainer',
        'name' => 'tools_toolsenvironment',
        'iconIdentifier' => 'module-install-environment',
        'labels' => 'LLL:EXT:install/Resources/Private/Language/ModuleInstallEnvironment.xlf',
    ]
);
}

/**
 * Extension: reports
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/reports/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Reports\Controller\ReportController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'system',
    'reports',
    '',
    '',
    [
        'routeTarget' => ReportController::class . '::handleRequest',
        'access' => 'admin',
        'name' => 'system_reports',
        'iconIdentifier' => 'module-reports',
        'labels' => 'LLL:EXT:reports/Resources/Private/Language/locallang.xlf',
    ]
);
}

/**
 * Extension: redirects
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/redirects/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Redirects\Controller\ManagementController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'site',
    'redirects',
    '',
    '',
    [
        'routeTarget' => ManagementController::class . '::handleRequest',
        'access' => 'group,user',
        'name' => 'site_redirects',
        'iconIdentifier' => 'module-redirects',
        'labels' => 'LLL:EXT:redirects/Resources/Private/Language/locallang_module_redirect.xlf',
    ]
);
}

/**
 * Extension: recordlist
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/recordlist/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Recordlist\Controller\RecordListController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'web',
    'list',
    '',
    '',
    [
        'routeTarget' => RecordListController::class . '::mainAction',
        'access' => 'user,group',
        'name' => 'web_list',
        'iconIdentifier' => 'module-list',
        'labels' => 'LLL:EXT:core/Resources/Private/Language/locallang_mod_web_list.xlf',
    ]
);
}

/**
 * Extension: backend
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/backend/ext_tables.php
 */

namespace {




use TYPO3\CMS\Backend\Controller\AboutController;
use TYPO3\CMS\Backend\Controller\HelpController;
use TYPO3\CMS\Backend\Controller\PageLayoutController;
use TYPO3\CMS\Backend\Controller\SiteConfigurationController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

// Register as a skin
$GLOBALS['TBE_STYLES']['skins']['backend']['stylesheetDirectories']['css'] = 'EXT:backend/Resources/Public/Css/';

ExtensionManagementUtility::addModule(
    'web',
    'layout',
    'top',
    '',
    [
        'routeTarget' => PageLayoutController::class . '::mainAction',
        'access' => 'user,group',
        'name' => 'web_layout',
        'iconIdentifier' => 'module-page',
        'labels' => 'LLL:EXT:backend/Resources/Private/Language/locallang_mod.xlf',
    ]
);

ExtensionManagementUtility::addModule(
    'site',
    'configuration',
    'top',
    '',
    [
        'routeTarget' => SiteConfigurationController::class . '::handleRequest',
        'access' => 'admin',
        'name' => 'site_configuration',
        'iconIdentifier' => 'module-sites',
        'labels' => 'LLL:EXT:backend/Resources/Private/Language/locallang_siteconfiguration_module.xlf',
    ]
);

// "Sort sub pages" csh
ExtensionManagementUtility::addLLrefForTCAdescr(
    'pages_sort',
    'EXT:backend/Resources/Private/Language/locallang_pages_sort_csh.xlf'
);
// "Create multiple pages" csh
ExtensionManagementUtility::addLLrefForTCAdescr(
    'pages_new',
    'EXT:backend/Resources/Private/Language/locallang_pages_new_csh.xlf'
);

// Csh manual
ExtensionManagementUtility::addModule(
    'help',
    'cshmanual',
    'top',
    '',
    [
        'routeTarget' => HelpController::class . '::handleRequest',
        'name' => 'help_cshmanual',
        'access' => 'user,group',
        'iconIdentifier' => 'module-cshmanual',
        'labels' => 'LLL:EXT:backend/Resources/Private/Language/locallang_mod_help_cshmanual.xlf',
    ]
);

ExtensionManagementUtility::addModule(
    'help',
    'AboutAbout',
    'top',
    null,
    [
        'routeTarget' => AboutController::class . '::indexAction',
        'access' => 'user,group',
        'name' => 'help_AboutAbout',
        'iconIdentifier' => 'module-about',
        'labels' => 'LLL:EXT:backend/Resources/Private/Language/Modules/about.xlf',
    ]
);

// Register the folder tree core navigation component
ExtensionManagementUtility::addCoreNavigationComponent('file', 'TYPO3/CMS/Backend/Tree/FileStorageTreeContainer');
}

/**
 * Extension: setup
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/setup/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Setup\Controller\SetupModuleController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'user',
    'setup',
    'after:task',
    '',
    [
        'routeTarget' => SetupModuleController::class . '::mainAction',
        'access' => 'group,user',
        'name' => 'user_setup',
        'iconIdentifier' => 'module-setup',
        'labels' => 'LLL:EXT:setup/Resources/Private/Language/locallang_mod.xlf',
    ]
);
ExtensionManagementUtility::addLLrefForTCAdescr(
    '_MOD_user_setup',
    'EXT:setup/Resources/Private/Language/locallang_csh_mod.xlf'
);

$GLOBALS['TYPO3_USER_SETTINGS'] = [
    'columns' => [
        'realName' => [
            'type' => 'text',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:beUser_realName',
            'table' => 'be_users',
            'csh' => 'beUser_realName',
            'max' => 80,
        ],
        'email' => [
            'type' => 'email',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:beUser_email',
            'table' => 'be_users',
            'csh' => 'beUser_email',
            'max' => 255,
        ],
        'emailMeAtLogin' => [
            'type' => 'check',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:emailMeAtLogin',
            'csh' => 'emailMeAtLogin',
        ],
        'password' => [
            'type' => 'password',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:newPassword',
            'table' => 'be_users',
            'csh' => 'newPassword',
        ],
        'password2' => [
            'type' => 'password',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:newPasswordAgain',
            'table' => 'be_users',
            'csh' => 'newPasswordAgain',
        ],
        'passwordCurrent' => [
            'type' => 'password',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:passwordCurrent',
            'table' => 'be_users',
            'csh' => 'passwordCurrent',
        ],
        'avatar' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:be_users.avatar',
            'type' => 'avatar',
            'table' => 'be_users',
            'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            'csh' => 'avatar',
        ],
        'lang' => [
            'type' => 'language',
            'table' => 'be_users',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:language',
            'csh' => 'language',
        ],
        'startModule' => [
            'type' => 'select',
            'itemsProcFunc' => SetupModuleController::class . '->renderStartModuleSelect',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:startModule',
            'csh' => 'startModule',
        ],
        'titleLen' => [
            'type' => 'number',
            'class' => 'form-control-adapt',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:maxTitleLen',
            'csh' => 'maxTitleLen',
        ],
        'edit_RTE' => [
            'type' => 'check',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:edit_RTE',
            'csh' => 'edit_RTE',
        ],
        'edit_docModuleUpload' => [
            'type' => 'check',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:edit_docModuleUpload',
            'csh' => 'edit_docModuleUpload',
        ],
        'showHiddenFilesAndFolders' => [
            'type' => 'check',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:showHiddenFilesAndFolders',
            'csh' => 'showHiddenFilesAndFolders',
        ],
        'copyLevels' => [
            'type' => 'number',
            'class' => 'form-control-adapt',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:copyLevels',
            'csh' => 'copyLevels',
        ],
        'resetConfiguration' => [
            'type' => 'button',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:resetConfiguration',
            'buttonlabel' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:resetConfigurationButton',
            'csh' => 'reset',
            'confirm' => true,
            'confirmData' => [
                'message' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:setToStandardQuestion',
                'eventName' => 'setup:confirmation:response',
            ],
        ],
        'resizeTextareas_MaxHeight' => [
            'type' => 'number',
            'class' => 'form-control-adapt',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:flexibleTextareas_MaxHeight',
            'csh' => 'flexibleTextareas_MaxHeight',
        ],
        'mfaProviders' => [
            'type' => 'mfa',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:mfaProviders',
            'csh' => 'mfaProviders',
        ],
        'backendTitleFormat' => [
            'type' => 'select',
            'label' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:backendTitleFormat',
            'csh' => 'backendTitleFormat',
            'items' => [
                'titleFirst' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:backendTitleFormat.titleFirst',
                'sitenameFirst' => 'LLL:EXT:setup/Resources/Private/Language/locallang.xlf:backendTitleFormat.sitenameFirst',
            ],
        ],
    ],
    'showitem' => '--div--;LLL:EXT:setup/Resources/Private/Language/locallang.xlf:personal_data,realName,email,emailMeAtLogin,avatar,lang,
            --div--;LLL:EXT:setup/Resources/Private/Language/locallang.xlf:accountSecurity,passwordCurrent,password,password2,mfaProviders,
            --div--;LLL:EXT:setup/Resources/Private/Language/locallang.xlf:opening,startModule,
            --div--;LLL:EXT:setup/Resources/Private/Language/locallang.xlf:editFunctionsTab,edit_RTE,resizeTextareas_MaxHeight,titleLen,backendTitleFormat,edit_docModuleUpload,showHiddenFilesAndFolders,copyLevels,resetConfiguration',
];
}

/**
 * Extension: belog
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/belog/ext_tables.php
 */

namespace {




use TYPO3\CMS\Belog\Controller\BackendLogController;
use TYPO3\CMS\Belog\Module\BackendLogModuleBootstrap;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Module Web->Info->Log
ExtensionManagementUtility::insertModuleFunction(
    'web_info',
    BackendLogModuleBootstrap::class,
    '',
    'Log'
);

// Module Tools->Log
ExtensionUtility::registerModule(
    'Belog',
    'system',
    'log',
    '',
    [
        BackendLogController::class => 'list,deleteMessage',
    ],
    [
        'access' => 'admin',
        'iconIdentifier' => 'module-belog',
        'labels' => 'LLL:EXT:belog/Resources/Private/Language/locallang_mod.xlf',
    ]
);
}

/**
 * Extension: beuser
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/beuser/ext_tables.php
 */

namespace {




use TYPO3\CMS\Beuser\Controller\BackendUserController;
use TYPO3\CMS\Beuser\Controller\PermissionController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Module System > Backend Users
ExtensionUtility::registerModule(
    'Beuser',
    'system',
    'tx_Beuser',
    'top',
    [
        BackendUserController::class => 'index, show, addToCompareList, removeFromCompareList, removeAllFromCompareList, compare, online, terminateBackendUserSession, initiatePasswordReset, groups, addGroupToCompareList, removeGroupFromCompareList, removeAllGroupsFromCompareList, compareGroups',
    ],
    [
        'access' => 'admin',
        'iconIdentifier' => 'module-beuser',
        'labels' => 'LLL:EXT:beuser/Resources/Private/Language/locallang_mod.xlf',
    ]
);

ExtensionManagementUtility::addModule(
    'system',
    'BeuserTxPermission',
    'top',
    '',
    [
        'routeTarget' => PermissionController::class . '::handleRequest',
        'name' => 'system_BeuserTxPermission',
        'access' => 'admin',
        'iconIdentifier' => 'module-permission',
        'labels' => 'LLL:EXT:beuser/Resources/Private/Language/locallang_mod_permission.xlf',
        'navigationComponentId' => 'TYPO3/CMS/Backend/PageTree/PageTreeElement',
    ]
);
}

/**
 * Extension: dashboard
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/dashboard/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Dashboard\Controller\DashboardController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'dashboard',
    '',
    'top',
    '',
    [
        'routeTarget' => DashboardController::class . '::handleRequest',
        'access' => 'user,group',
        'name' => 'dashboard',
        'iconIdentifier' => 'module-dashboard',
        'navigationComponentId' => '',
        'inheritNavigationComponentFromMainModule' => false,
        'labels' => 'LLL:EXT:dashboard/Resources/Private/Language/locallang_mod.xlf',
        'standalone' => true,
    ]
);

$GLOBALS['TBE_STYLES']['skins']['dashboard']['stylesheetDirectories']['modal'] = 'EXT:dashboard/Resources/Public/Css/Modal/';
}

/**
 * Extension: extensionmanager
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/extensionmanager/ext_tables.php
 */

namespace {




use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Extensionmanager\Controller\ActionController;
use TYPO3\CMS\Extensionmanager\Controller\DistributionController;
use TYPO3\CMS\Extensionmanager\Controller\DownloadController;
use TYPO3\CMS\Extensionmanager\Controller\ExtensionComposerStatusController;
use TYPO3\CMS\Extensionmanager\Controller\ListController;
use TYPO3\CMS\Extensionmanager\Controller\UpdateFromTerController;
use TYPO3\CMS\Extensionmanager\Controller\UploadExtensionFileController;

defined('TYPO3') or die();

ExtensionUtility::registerModule(
    'Extensionmanager',
    'tools',
    'extensionmanager',
    '',
    [
        ListController::class => 'index,unresolvedDependencies,ter,showAllVersions,distributions',
        ActionController::class => 'toggleExtensionInstallationState,installExtensionWithoutSystemDependencyCheck,removeExtension,downloadExtensionZip,reloadExtensionData',
        DownloadController::class => 'checkDependencies,installFromTer,installExtensionWithoutSystemDependencyCheck,installDistribution,updateExtension,updateCommentForUpdatableVersions',
        UpdateFromTerController::class => 'updateExtensionListFromTer',
        UploadExtensionFileController::class => 'form,extract',
        DistributionController::class => 'show',
        ExtensionComposerStatusController::class => 'list,detail',
    ],
    [
        'access' => 'systemMaintainer',
        'iconIdentifier' => 'module-extensionmanager',
        'labels' => 'LLL:EXT:extensionmanager/Resources/Private/Language/locallang_mod.xlf',
    ]
);
}

/**
 * Extension: info
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/info/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Info\Controller\InfoModuleController;
use TYPO3\CMS\Info\Controller\InfoPageTyposcriptConfigController;
use TYPO3\CMS\Info\Controller\PageInformationController;
use TYPO3\CMS\Info\Controller\TranslationStatusController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'web',
    'info',
    '',
    '',
    [
        'routeTarget' => InfoModuleController::class . '::mainAction',
        'access' => 'user,group',
        'name' => 'web_info',
        'iconIdentifier' => 'module-info',
        'labels' => 'LLL:EXT:info/Resources/Private/Language/locallang_mod_web_info.xlf',
    ]
);
ExtensionManagementUtility::addLLrefForTCAdescr('_MOD_web_info', 'EXT:info/Resources/Private/Language/locallang_csh_web_info.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('_MOD_web_infotsconfig', 'EXT:info/Resources/Private/Language/locallang_csh_tsconfigInfo.xlf');

ExtensionManagementUtility::insertModuleFunction(
    'web_info',
    PageInformationController::class,
    '',
    'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:mod_tx_cms_webinfo_page'
);
ExtensionManagementUtility::insertModuleFunction(
    'web_info',
    TranslationStatusController::class,
    '',
    'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:mod_tx_cms_webinfo_lang'
);
ExtensionManagementUtility::insertModuleFunction(
    'web_info',
    InfoPageTyposcriptConfigController::class,
    '',
    'LLL:EXT:info/Resources/Private/Language/InfoPageTsConfig.xlf:mod_pagetsconfig'
);
}

/**
 * Extension: lowlevel
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/lowlevel/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Lowlevel\Controller\ConfigurationController;
use TYPO3\CMS\Lowlevel\Controller\DatabaseIntegrityController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'system',
    'dbint',
    '',
    '',
    [
        'routeTarget' => DatabaseIntegrityController::class . '::mainAction',
        'access' => 'admin',
        'name' => 'system_dbint',
        'workspaces' => 'online',
        'iconIdentifier' => 'module-dbint',
        'labels' => 'LLL:EXT:lowlevel/Resources/Private/Language/locallang_mod.xlf',
    ]
);
ExtensionManagementUtility::addModule(
    'system',
    'config',
    '',
    '',
    [
        'routeTarget' => ConfigurationController::class . '::mainAction',
        'access' => 'admin',
        'name' => 'system_config',
        'workspaces' => 'online',
        'iconIdentifier' => 'module-config',
        'labels' => 'LLL:EXT:lowlevel/Resources/Private/Language/locallang_mod_configuration.xlf',
    ]
);
}

/**
 * Extension: sys_note
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/sys_note/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::allowTableOnStandardPages('sys_note');
ExtensionManagementUtility::addLLrefForTCAdescr('sys_note', 'EXT:sys_note/Resources/Private/Language/locallang_csh_sysnote.xlf');
}

/**
 * Extension: tstemplate
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/tstemplate/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Tstemplate\Controller\TemplateAnalyzerModuleFunctionController;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateConstantEditorModuleFunctionController;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateInformationModuleFunctionController;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateObjectBrowserModuleFunctionController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'web',
    'ts',
    '',
    '',
    [
        'routeTarget' => TypoScriptTemplateModuleController::class . '::mainAction',
        'access' => 'admin',
        'name' => 'web_ts',
        'iconIdentifier' => 'module-tstemplate',
        'labels' => 'LLL:EXT:tstemplate/Resources/Private/Language/locallang_mod.xlf',
    ]
);

ExtensionManagementUtility::insertModuleFunction(
    'web_ts',
    TypoScriptTemplateConstantEditorModuleFunctionController::class,
    '',
    'LLL:EXT:tstemplate/Resources/Private/Language/locallang.xlf:constantEditor'
);

ExtensionManagementUtility::insertModuleFunction(
    'web_ts',
    TypoScriptTemplateInformationModuleFunctionController::class,
    '',
    'LLL:EXT:tstemplate/Resources/Private/Language/locallang.xlf:infoModify'
);

ExtensionManagementUtility::insertModuleFunction(
    'web_ts',
    TypoScriptTemplateObjectBrowserModuleFunctionController::class,
    '',
    'LLL:EXT:tstemplate/Resources/Private/Language/locallang.xlf:objectBrowser'
);

ExtensionManagementUtility::insertModuleFunction(
    'web_ts',
    TemplateAnalyzerModuleFunctionController::class,
    '',
    'LLL:EXT:tstemplate/Resources/Private/Language/locallang.xlf:templateAnalyzer'
);
}

/**
 * Extension: viewpage
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/viewpage/ext_tables.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Viewpage\Controller\ViewModuleController;

defined('TYPO3') or die();

ExtensionManagementUtility::addModule(
    'web',
    'ViewpageView',
    'after:layout',
    null,
    [
        'routeTarget' => ViewModuleController::class . '::showAction',
        'access' => 'user,group',
        'name' => 'web_ViewpageView',
        'iconIdentifier' => 'module-viewpage',
        'labels' => 'LLL:EXT:viewpage/Resources/Private/Language/locallang_mod.xlf',
    ]
);
}

/**
 * Extension: additional_tca
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/additional_tca/ext_tables.php
 */

namespace {


if (!defined('TYPO3')) {
    die('Access denied.');
}

call_user_func(
    function ($extKey) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem'][]
            = CodingMs\AdditionalTca\Hooks\DrawItem::class;
        //
        // Add some backend stylesheets and javascript
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][]
            = \CodingMs\AdditionalTca\Hooks\PageRendererHook::class . '->addJavaScriptAndStylesheets';
    },
    'additional_tca'
);
}

/**
 * Extension: modules
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/modules/ext_tables.php
 */

namespace {


if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
if (TYPO3_MODE === 'BE') {
    //
    // Extension configuration
    $configuration = \CodingMs\Modules\Utility\ExtensionUtility::getExtensionConfiguration('modules');
    //
    // Page type
    $GLOBALS['PAGES_TYPES'][1659186453] = [
        'type' => 'web',
        // ATTENTION: Don't insert line breaks into the "allowedTables" - this will break this functionality!
        'allowedTables' => implode(
            ',',
            [
                'fe_users',
                'fe_groups',
                'sys_file_reference',
                'pages',
            ]
        ),
    ];
    //
    // Registers a Backend Module
    if (!(bool)$configuration['module']['frontendUser']['disable']) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Modules',
            'web',
            'frontenduser',
            '',
            [
                \CodingMs\Modules\Controller\FrontendUserBackendController::class => 'list,listFrontendUserGroups,listInvitationCodes,importInvitationCodes',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:modules/Resources/Public/Icons/module-frontenduser.svg',
                'iconIdentifier' => 'module-frontenduser',
                'labels' => 'LLL:EXT:modules/Resources/Private/Language/locallang_frontenduser.xlf',
            ]
        );
    }
    //
    // Registers a Backend Module
    if (!(bool)$configuration['module']['backendUser']['disable']) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Modules',
            'system',
            'backenduser',
            'top',
            [
                \CodingMs\Modules\Controller\BackendUserBackendController::class => 'list',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:modules/Resources/Public/Icons/module-backenduser.svg',
                'iconIdentifier' => 'module-backenduser',
                'labels' => 'LLL:EXT:modules/Resources/Private/Language/locallang_backenduser.xlf',
            ]
        );
    }
}
//
// register svg icons: identifier and filename
$iconsSvg = [
    'module-frontenduser' => 'Resources/Public/Icons/module-frontenduser.svg',
    'module-backenduser' => 'Resources/Public/Icons/module-backenduser.svg',
    'mimetypes-x-content-profile' => 'Resources/Public/Icons/iconmonstr-user-20.svg',
    'mimetypes-x-content-modules-invitationcode' => 'Resources/Public/Icons/iconmonstr-key-13.svg',
];
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($iconsSvg as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:modules/' . $path]
    );
}
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_modules_domain_model_invitationcode'
);
//
// Authorizations in backend
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_backend_user_action_permissions'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\BackendUserActionPermission::class
    );
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_frontend_user'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\FrontendUserActionPermission::class
    );
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_frontend_user_group'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\FrontendUserGroupActionPermission::class
    );
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions']['modules_frontend_user_invitation_code'] =
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \CodingMs\Modules\Domain\DataTransferObject\FrontendUserInvitationCodeActionPermission::class
    );
}

/**
 * Extension: fluid_form
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/fluid_form/ext_tables.php
 */

namespace {


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
}

/**
 * Extension: news
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/news/ext_tables.php
 */

namespace {


defined('TYPO3_MODE') or die();

$boot = static function (): void {

    // CSH - context sensitive help
    foreach (['news', 'media', 'tag', 'link'] as $table) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_news_domain_model_' . $table);
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
            'tx_news_domain_model_' . $table,
            'EXT:news/Resources/Private/Language/locallang_csh_' . $table . '.xlf'
        );
    }

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'tt_content.pi_flexform.news_pi1.list',
        'EXT:news/Resources/Private/Language/locallang_csh_flexforms.xlf'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'sys_file_reference',
        'EXT:news/Resources/Private/Language/locallang_csh_sys_file_reference.xlf'
    );

    $configuration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\GeorgRinger\News\Domain\Model\Dto\EmConfiguration::class);

    if (TYPO3_MODE === 'BE') {
        // Extend user settings
        $GLOBALS['TYPO3_USER_SETTINGS']['columns']['newsoverlay'] = [
            'label' => 'LLL:EXT:news/Resources/Private/Language/locallang_be.xlf:usersettings.overlay',
            'type' => 'select',
            'itemsProcFunc' => \GeorgRinger\News\Hooks\ItemsProcFunc::class . '->user_categoryOverlay',
        ];
        if (!isset($GLOBALS['TYPO3_USER_SETTINGS']['showitem'])) {
            $GLOBALS['TYPO3_USER_SETTINGS']['showitem'] = '';
        }
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings('--div--;LLL:EXT:news/Resources/Private/Language/locallang_be.xlf:pi1_title,newsoverlay');

        // Add tables to livesearch (e.g. "#news:fo" or "#newscat:fo")
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['news'] = 'tx_news_domain_model_news';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['newstag'] = 'tx_news_domain_model_tag';

        /* ===========================================================================
            Register BE-Modules
        =========================================================================== */
        if ($configuration->getShowImporter()) {
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'News',
                'system',
                'tx_news_m1',
                '',
                [\GeorgRinger\News\Controller\ImportController::class => 'index, runJob, jobInfo'],
                [
                    'access' => 'user,group',
                    'icon' => 'EXT:news/Resources/Public/Icons/module_import.svg',
                    'labels' => 'LLL:EXT:news/Resources/Private/Language/locallang_mod.xlf',
                ]
            );
        }

        /* ===========================================================================
            Register BE-Module for Administration
        =========================================================================== */
        if ($configuration->getShowAdministrationModule()) {
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'News',
                'web',
                'administration',
                '',
                [\GeorgRinger\News\Controller\AdministrationController::class => 'index,newNews,newCategory,newTag,newsPidListing,donate'],
                [
                    'access' => 'user,group',
                    'icon' => 'EXT:news/Resources/Public/Icons/module_administration.svg',
                    'labels' => 'LLL:EXT:news/Resources/Private/Language/locallang_modadministration.xlf',
                    'navigationComponentId' => $configuration->getHidePageTreeForAdministrationModule() ? '' : 'TYPO3/CMS/Backend/PageTree/PageTreeElement',
                    'inheritNavigationComponentFromMainModule' => false,
                    'path' => '/module/web/NewsAdministration/'
                ]
            );
        }
    }

    /* ===========================================================================
        Default configuration
    =========================================================================== */
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['orderByCategory'] = 'uid,title,tstamp,sorting';
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['orderByNews'] = 'tstamp,datetime,crdate,title' . ($configuration->getManualSorting() ? ',sorting' : '');
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['orderByTag'] = 'tstamp,crdate,title';
};

$boot();
unset($boot);
}

/**
 * Extension: bootstrap_package
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/bootstrap_package/ext_tables.php
 */

namespace {


/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Allow Custom Records on Standard Pages
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_accordion_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_card_group_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_carousel_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_icon_group_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_tab_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_timeline_item');
}

/**
 * Extension: fluid_new_site_bni
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/fluid_new_site_bni/ext_tables.php
 */

namespace {

defined('TYPO3') or die('Access denied.');
}

/**
 * Extension: fs_media_gallery
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/fs_media_gallery/ext_tables.php
 */

namespace {

defined('TYPO3_MODE') || die();

$boot = function ($packageKey) {

    // Add CSH
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'tt_content.pi_flexform.fsmediagallery_mediagallery.list',
        'EXT:' . $packageKey . '/Resources/Private/Language/locallang_csh_flexforms.xlf'
    );

    /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'apps-pagetree-folder-contains-mediagal',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:' . $packageKey . '/Resources/Public/Icons/mediagallery.svg',
        ]
    );
    $iconRegistry->registerIcon(
        'tcarecords-sys_file_collection-folder',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:' . $packageKey . '/Resources/Public/Icons/mediagallery.svg',
        ]
    );
    $iconRegistry->registerIcon(
        'action-edit-album',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:' . $packageKey . '/Resources/Public/Icons/mediagallery-edit.svg',
        ]
    );
    $iconRegistry->registerIcon(
        'action-add-album',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:' . $packageKey . '/Resources/Public/Icons/mediagallery-add.svg',
        ]
    );
    $iconRegistry->registerIcon(
        'content-mediagallery',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:' . $packageKey . '/Resources/Public/Icons/mediagallery.svg',
        ]
    );
};
$boot('fs_media_gallery');
unset($boot);
}

/**
 * Extension: gridgallery
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/gridgallery/ext_tables.php
 */

namespace {

/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'ext-gridgallery-gallery',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:gridgallery/Resources/Public/Icons/ContentElements/gridgallery_gallery.svg']
);
}

/**
 * Extension: ke_search
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/ke_search/ext_tables.php
 */

namespace {


defined('TYPO3') or die();

(function () {
    // add help file
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'tx_kesearch_filters',
        'EXT:ke_search/locallang_csh.xml'
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'KeSearch',
        'web',
        'backend_module',
        '',
        [
            \Tpwd\KeSearch\Controller\BackendModuleController::class => 'startIndexing, indexedContent, indexTableInformation, searchwordStatistics, clearSearchIndex, lastIndexingReport, alert',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:ke_search/Resources/Public/Icons/moduleicon.svg',
            'labels' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_mod.xlf',
        ]
    );

    if ((new \TYPO3\CMS\Core\Information\Typo3Version())->getMajorVersion() === 10) {
        // This icon registration can be deleted once compatibility with TYPO3 v10 is removed
        // see also: Configuration/Icons.php for the new way
        /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            'ext-kesearch-wizard-icon',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:ke_search/Resources/Public/Icons/moduleicon.svg']
        );
    }
})();
}

/**
 * Extension: ns_youtube
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/ns_youtube/ext_tables.php
 */

namespace {

defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_youtube/Configuration/TSconfig/ContentElementWizard.tsconfig">'
);
}

/**
 * Extension: solr
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/solr/ext_tables.php
 */

namespace {


defined('TYPO3') || die();

(function () {
    if (TYPO3_MODE == 'BE') {
        $modulePrefix = 'extensions-solr-module';
        $svgProvider = \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class;
        /* @var \ApacheSolrForTypo3\Solr\System\Configuration\ExtensionConfiguration $extensionConfiguration */
        $extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \ApacheSolrForTypo3\Solr\System\Configuration\ExtensionConfiguration::class
        );

        // register all module icons with extensions-solr-module-modulename
        $extIconPath = 'EXT:solr/Resources/Public/Images/Icons/';
        /* @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            $modulePrefix . '-main',
            $svgProvider,
            ['source' => $extIconPath . 'ModuleSolrMain.svg']
        );
        $iconRegistry->registerIcon(
            $modulePrefix . '-solr-core-optimization',
            $svgProvider,
            ['source' => $extIconPath . 'ModuleCoreOptimization.svg']
        );
        $iconRegistry->registerIcon(
            $modulePrefix . '-index-administration',
            $svgProvider,
            ['source' => $extIconPath . 'ModuleIndexAdministration.svg']
        );
        // all connections
        $iconRegistry->registerIcon(
            $modulePrefix . '-initsolrconnections',
            $svgProvider,
            ['source' => $extIconPath . 'InitSolrConnections.svg']
        );
        // single connection - context menu
        $iconRegistry->registerIcon(
            $modulePrefix . '-initsolrconnection',
            $svgProvider,
            ['source' => $extIconPath . 'InitSolrConnection.svg']
        );
        // register plugin icon
        $iconRegistry->registerIcon(
            'extensions-solr-plugin-contentelement',
            $svgProvider,
            ['source' => $extIconPath . 'ContentElement.svg']
        );

        // Add Main module "APACHE SOLR".
        // Acces to a main module is implicit, as soon as a user has access to at least one of its submodules. To make it possible, main module must be registered in that way and without any Actions!
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
            'searchbackend',
            '',
            '',
            null,
            [
                'name' => 'searchbackend',
                'labels' => 'LLL:EXT:solr/Resources/Private/Language/locallang_mod.xlf',
                'iconIdentifier' => 'extensions-solr-module-main',
            ]
        );

        $treeComponentId = 'TYPO3/CMS/Backend/PageTree/PageTreeElement';

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Solr',
            'searchbackend',
            'Info',
            '',
            [
                \ApacheSolrForTypo3\Solr\Controller\Backend\Search\InfoModuleController::class => 'index, switchSite, switchCore, documentsDetails',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:solr/Resources/Public/Images/Icons/ModuleInfo.svg',
                'labels' => 'LLL:EXT:solr/Resources/Private/Language/locallang_mod_info.xlf',
                'navigationComponentId' => $treeComponentId,
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Solr',
            'searchbackend',
            'CoreOptimization',
            '',
            [
                \ApacheSolrForTypo3\Solr\Controller\Backend\Search\CoreOptimizationModuleController::class => 'index, addSynonyms, importSynonymList, deleteAllSynonyms, exportSynonyms, deleteSynonyms, saveStopWords, importStopWordList, exportStopWords, switchSite, switchCore',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:solr/Resources/Public/Images/Icons/ModuleCoreOptimization.svg',
                'labels' => 'LLL:EXT:solr/Resources/Private/Language/locallang_mod_coreoptimize.xlf',
                'navigationComponentId' => $treeComponentId,
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Solr',
            'searchbackend',
            'IndexQueue',
            '',
            [
                \ApacheSolrForTypo3\Solr\Controller\Backend\Search\IndexQueueModuleController::class =>
                    'index, initializeIndexQueue, clearIndexQueue, requeueDocument, resetLogErrors, showError, doIndexingRun, switchSite',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:solr/Resources/Public/Images/Icons/ModuleIndexQueue.svg',
                'labels' => 'LLL:EXT:solr/Resources/Private/Language/locallang_mod_indexqueue.xlf',
                'navigationComponentId' => $treeComponentId,
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Solr',
            'searchbackend',
            'IndexAdministration',
            '',
            [
                \ApacheSolrForTypo3\Solr\Controller\Backend\Search\IndexAdministrationModuleController::class =>
                    'index, emptyIndex, clearIndexQueue, reloadIndexConfiguration, switchSite',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:solr/Resources/Public/Images/Icons/ModuleIndexAdministration.svg',
                'labels' => 'LLL:EXT:solr/Resources/Private/Language/locallang_mod_indexadmin.xlf',
                'navigationComponentId' => $treeComponentId,
            ]
        );

        // registering reports
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['solr'] = [
        \ApacheSolrForTypo3\Solr\Report\SiteHandlingStatus::class,
        \ApacheSolrForTypo3\Solr\Report\SchemaStatus::class,
        \ApacheSolrForTypo3\Solr\Report\SolrConfigStatus::class,
        \ApacheSolrForTypo3\Solr\Report\SolrConfigurationStatus::class,
        \ApacheSolrForTypo3\Solr\Report\SolrStatus::class,
        \ApacheSolrForTypo3\Solr\Report\SolrVersionStatus::class,
        \ApacheSolrForTypo3\Solr\Report\AccessFilterPluginInstalledStatus::class,
        \ApacheSolrForTypo3\Solr\Report\AllowUrlFOpenStatus::class,
        \ApacheSolrForTypo3\Solr\Report\FilterVarStatus::class,
    ];

        // Register Context Sensitive Help (CSH) translation labels
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
            'pages',
            'EXT:solr/Resources/Private/Language/locallang_csh_pages.xlf'
        );
    }

    if ((TYPO3_MODE === 'BE') || (TYPO3_MODE === 'FE' && isset($_POST['TSFE_EDIT']))) {
        // the order of registering the garbage collector and the record monitor is important!
        // for certain scenarios items must be removed by GC first, and then be re-added to to Index Queue

        // hooking into TCE Main to monitor record updates that may require deleting documents from the index
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] = \ApacheSolrForTypo3\Solr\GarbageCollector::class;
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \ApacheSolrForTypo3\Solr\GarbageCollector::class;

        // hooking into TCE Main to monitor record updates that may require reindexing by the index queue
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] = \ApacheSolrForTypo3\Solr\IndexQueue\RecordMonitor::class;
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \ApacheSolrForTypo3\Solr\IndexQueue\RecordMonitor::class;
    }
})();

// ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

$isComposerMode = defined('TYPO3_COMPOSER_MODE') && TYPO3_COMPOSER_MODE;
if (!$isComposerMode) {
    // we load the autoloader for our libraries
    $dir = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('solr');
    require $dir . '/Resources/Private/Php/ComposerLibraries/vendor/autoload.php';
}
}

#