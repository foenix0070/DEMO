<?php
/**
 * Compiled ext_localconf.php cache file
 */

/**
 * Extension: core
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/core/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Authentication\AuthenticationService;
use TYPO3\CMS\Core\Controller\FileDumpController;
use TYPO3\CMS\Core\Controller\RequireJsController;
use TYPO3\CMS\Core\Hooks\BackendUserGroupIntegrityCheck;
use TYPO3\CMS\Core\Hooks\BackendUserPasswordCheck;
use TYPO3\CMS\Core\Hooks\CreateSiteConfiguration;
use TYPO3\CMS\Core\Hooks\DestroySessionHook;
use TYPO3\CMS\Core\Hooks\PagesTsConfigGuard;
use TYPO3\CMS\Core\MetaTag\EdgeMetaTagManager;
use TYPO3\CMS\Core\MetaTag\Html5MetaTagManager;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Resource\Index\ExtractorRegistry;
use TYPO3\CMS\Core\Resource\OnlineMedia\Metadata\Extractor;
use TYPO3\CMS\Core\Resource\Rendering\AudioTagRenderer;
use TYPO3\CMS\Core\Resource\Rendering\RendererRegistry;
use TYPO3\CMS\Core\Resource\Rendering\VideoTagRenderer;
use TYPO3\CMS\Core\Resource\Rendering\VimeoRenderer;
use TYPO3\CMS\Core\Resource\Rendering\YouTubeRenderer;
use TYPO3\CMS\Core\Resource\Security\FileMetadataPermissionsAspect;
use TYPO3\CMS\Core\Resource\Security\SvgHookHandler;
use TYPO3\CMS\Core\Resource\TextExtraction\PlainTextExtractor;
use TYPO3\CMS\Core\Resource\TextExtraction\TextExtractorRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][GeneralUtility::class]['moveUploadedFile'][] = SvgHookHandler::class . '->processMoveUploadedFile';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = FileMetadataPermissionsAspect::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = BackendUserGroupIntegrityCheck::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = BackendUserPasswordCheck::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/alt_doc.php']['makeEditForm_accessCheck'][] = FileMetadataPermissionsAspect::class . '->isAllowedToShowEditForm';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms_inline.php']['checkAccess'][] = FileMetadataPermissionsAspect::class . '->isAllowedToShowEditForm';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['checkModifyAccessList'][] = FileMetadataPermissionsAspect::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = DestroySessionHook::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = PagesTsConfigGuard::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][CreateSiteConfiguration::class] = CreateSiteConfiguration::class;
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['dumpFile'] = FileDumpController::class . '::dumpAction';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['requirejs'] = RequireJsController::class . '::retrieveConfiguration';

$rendererRegistry = GeneralUtility::makeInstance(RendererRegistry::class);
$rendererRegistry->registerRendererClass(AudioTagRenderer::class);
$rendererRegistry->registerRendererClass(VideoTagRenderer::class);
$rendererRegistry->registerRendererClass(YouTubeRenderer::class);
$rendererRegistry->registerRendererClass(VimeoRenderer::class);
unset($rendererRegistry);

$textExtractorRegistry = GeneralUtility::makeInstance(TextExtractorRegistry::class);
$textExtractorRegistry->registerTextExtractor(PlainTextExtractor::class);
unset($textExtractorRegistry);

$extractorRegistry = GeneralUtility::makeInstance(ExtractorRegistry::class);
$extractorRegistry->registerExtractionService(Extractor::class);
unset($extractorRegistry);

// Register base authentication service
ExtensionManagementUtility::addService(
    'core',
    'auth',
    AuthenticationService::class,
    [
        'title' => 'User authentication',
        'description' => 'Authentication with username/password.',
        'subtype' => 'getUserBE,getUserFE,authUserBE,authUserFE,processLoginDataBE,processLoginDataFE',
        'available' => true,
        'priority' => 50,
        'quality' => 50,
        'os' => '',
        'exec' => '',
        'className' => TYPO3\CMS\Core\Authentication\AuthenticationService::class,
    ]
);

// add default notification options to every page
ExtensionManagementUtility::addPageTSConfig(
    'TCEMAIN.translateToMessage = Translate to %s:'
);

$metaTagManagerRegistry = GeneralUtility::makeInstance(MetaTagManagerRegistry::class);
$metaTagManagerRegistry->registerManager(
    'html5',
    Html5MetaTagManager::class
);
$metaTagManagerRegistry->registerManager(
    'edge',
    EdgeMetaTagManager::class
);
unset($metaTagManagerRegistry);

// Add module configuration
ExtensionManagementUtility::addTypoScriptSetup(
    'config.pageTitleProviders.record.provider = TYPO3\CMS\Core\PageTitle\RecordPageTitleProvider'
);

// Register preset for sys_news
if (empty($GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sys_news'])) {
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sys_news'] = 'EXT:core/Configuration/RTE/SysNews.yaml';
}
}


/**
 * Extension: scheduler
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/scheduler/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Example\SleepTask;
use TYPO3\CMS\Scheduler\Example\SleepTaskAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Example\TestTask;
use TYPO3\CMS\Scheduler\Example\TestTaskAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\CachingFrameworkGarbageCollectionAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\CachingFrameworkGarbageCollectionTask;
use TYPO3\CMS\Scheduler\Task\ExecuteSchedulableCommandAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\ExecuteSchedulableCommandTask;
use TYPO3\CMS\Scheduler\Task\FileStorageExtractionAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\FileStorageExtractionTask;
use TYPO3\CMS\Scheduler\Task\FileStorageIndexingAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\FileStorageIndexingTask;
use TYPO3\CMS\Scheduler\Task\IpAnonymizationAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\IpAnonymizationTask;
use TYPO3\CMS\Scheduler\Task\OptimizeDatabaseTableAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\OptimizeDatabaseTableTask;
use TYPO3\CMS\Scheduler\Task\RecyclerGarbageCollectionAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\RecyclerGarbageCollectionTask;
use TYPO3\CMS\Scheduler\Task\TableGarbageCollectionAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Task\TableGarbageCollectionTask;

defined('TYPO3') or die();

// Get the extensions's configuration
$showSampleTasks = (bool)GeneralUtility::makeInstance(
    ExtensionConfiguration::class
)->get('scheduler', 'showSampleTasks');
// If sample tasks should be shown,
// register information for the test and sleep tasks
if ($showSampleTasks) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TestTask::class] = [
        'extension' => 'scheduler',
        'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:testTask.name',
        'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:testTask.description',
        'additionalFields' => TestTaskAdditionalFieldProvider::class,
    ];
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][SleepTask::class] = [
        'extension' => 'scheduler',
        'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:sleepTask.name',
        'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:sleepTask.description',
        'additionalFields' => SleepTaskAdditionalFieldProvider::class,
    ];
}
unset($showSampleTasks);

// Add caching framework garbage collection task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][CachingFrameworkGarbageCollectionTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:cachingFrameworkGarbageCollection.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:cachingFrameworkGarbageCollection.description',
    'additionalFields' => CachingFrameworkGarbageCollectionAdditionalFieldProvider::class,
];

// Add task to index file in a storage
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][FileStorageIndexingTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:fileStorageIndexing.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:fileStorageIndexing.description',
    'additionalFields' => FileStorageIndexingAdditionalFieldProvider::class,
];

// Add task for extracting metadata from files in a storage
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][FileStorageExtractionTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:fileStorageExtraction.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:fileStorageExtraction.description',
    'additionalFields' => FileStorageExtractionAdditionalFieldProvider::class,

];

// Add recycler directory cleanup task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][RecyclerGarbageCollectionTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:recyclerGarbageCollection.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:recyclerGarbageCollection.description',
    'additionalFields' => RecyclerGarbageCollectionAdditionalFieldProvider::class,
];

// Add execute schedulable command task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][ExecuteSchedulableCommandTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:executeSchedulableCommandTask.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:executeSchedulableCommandTask.name',
    'additionalFields' => ExecuteSchedulableCommandAdditionalFieldProvider::class,
];

// Save any previous option array for table garbage collection task
// to temporary variable so it can be pre-populated by other
// extensions and LocalConfiguration/AdditionalConfiguration
$garbageCollectionTaskOptions = $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TableGarbageCollectionTask::class]['options'] ?? [];
$garbageCollectionTaskOptions['tables'] = $garbageCollectionTaskOptions['tables'] ?? [];
// Add table garbage collection task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TableGarbageCollectionTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:tableGarbageCollection.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:tableGarbageCollection.description',
    'additionalFields' => TableGarbageCollectionAdditionalFieldProvider::class,
    'options' => $garbageCollectionTaskOptions,
];
unset($garbageCollectionTaskOptions);

// Register sys_log and sys_history table in table garbage collection task
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TableGarbageCollectionTask::class]['options']['tables']['sys_log'] ?? false)) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TableGarbageCollectionTask::class]['options']['tables']['sys_log'] = [
        'dateField' => 'tstamp',
        'expirePeriod' => 180,
    ];
}

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TableGarbageCollectionTask::class]['options']['tables']['sys_history'] ?? false)) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][TableGarbageCollectionTask::class]['options']['tables']['sys_history'] = [
        'dateField' => 'tstamp',
        'expirePeriod' => 30,
    ];
}

// Save any previous option array for ip anonymization task
// to temporary variable so it can be pre-populated by other
// extensions and LocalConfiguration/AdditionalConfiguration
$ipAnonymizeCollectionTaskOptions = $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][IpAnonymizationTask::class]['options'] ?? [];
$ipAnonymizeCollectionTaskOptions['tables'] = $ipAnonymizeCollectionTaskOptions['tables'] ?? [];
// Add ip anonymization task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][IpAnonymizationTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:ipAnonymization.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:ipAnonymization.description',
    'additionalFields' => IpAnonymizationAdditionalFieldProvider::class,
    'options' => $ipAnonymizeCollectionTaskOptions,
];
unset($ipAnonymizeCollectionTaskOptions);

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][IpAnonymizationTask::class]['options']['tables']['sys_log'] ?? false)) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][IpAnonymizationTask::class]['options']['tables']['sys_log'] = [
        'dateField' => 'tstamp',
        'ipField' => 'IP',
    ];
}

// Add task for optimizing database tables
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][OptimizeDatabaseTableTask::class] = [
    'extension' => 'scheduler',
    'title' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:optimizeDatabaseTable.name',
    'description' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:optimizeDatabaseTable.description',
    'additionalFields' => OptimizeDatabaseTableAdditionalFieldProvider::class,

];

// Available frequency options
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['frequencyOptions'] = [
    '0 9,15 * * 1-5' => 'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:command.example1',
    '0 */2 * * *' =>  'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:command.example2',
    '*/20 * * * *' =>  'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:command.example3',
    '0 7 * * 2' =>  'LLL:EXT:scheduler/Resources/Private/Language/locallang.xlf:command.example4',
];
}


/**
 * Extension: extbase
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/extbase/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Extbase\Hook\DataHandler\CheckFlexFormValue;
use TYPO3\CMS\Extbase\Property\TypeConverter\ArrayConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\BooleanConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\CoreTypeConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\FileConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\FileReferenceConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\FloatConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\FolderConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\IntegerConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\ObjectConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\ObjectStorageConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;
use TYPO3\CMS\Extbase\Property\TypeConverter\StringConverter;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Register type converters
ExtensionUtility::registerTypeConverter(ArrayConverter::class);
ExtensionUtility::registerTypeConverter(BooleanConverter::class);
ExtensionUtility::registerTypeConverter(DateTimeConverter::class);
ExtensionUtility::registerTypeConverter(FloatConverter::class);
ExtensionUtility::registerTypeConverter(IntegerConverter::class);
ExtensionUtility::registerTypeConverter(ObjectStorageConverter::class);
ExtensionUtility::registerTypeConverter(PersistentObjectConverter::class);
ExtensionUtility::registerTypeConverter(ObjectConverter::class);
ExtensionUtility::registerTypeConverter(StringConverter::class);
ExtensionUtility::registerTypeConverter(CoreTypeConverter::class);
// Experimental FAL<->extbase converters
ExtensionUtility::registerTypeConverter(FileConverter::class);
ExtensionUtility::registerTypeConverter(FileReferenceConverter::class);
ExtensionUtility::registerTypeConverter(FolderConverter::class);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['checkFlexFormValue'][] = CheckFlexFormValue::class;
}


/**
 * Extension: frontend
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/frontend/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Frontend\ContentObject\CaseContentObject;
use TYPO3\CMS\Frontend\ContentObject\ContentContentObject;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectArrayContentObject;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectArrayInternalContentObject;
use TYPO3\CMS\Frontend\ContentObject\EditPanelContentObject;
use TYPO3\CMS\Frontend\ContentObject\FilesContentObject;
use TYPO3\CMS\Frontend\ContentObject\FluidTemplateContentObject;
use TYPO3\CMS\Frontend\ContentObject\HierarchicalMenuContentObject;
use TYPO3\CMS\Frontend\ContentObject\ImageContentObject;
use TYPO3\CMS\Frontend\ContentObject\ImageResourceContentObject;
use TYPO3\CMS\Frontend\ContentObject\LoadRegisterContentObject;
use TYPO3\CMS\Frontend\ContentObject\RecordsContentObject;
use TYPO3\CMS\Frontend\ContentObject\RestoreRegisterContentObject;
use TYPO3\CMS\Frontend\ContentObject\ScalableVectorGraphicsContentObject;
use TYPO3\CMS\Frontend\ContentObject\TextContentObject;
use TYPO3\CMS\Frontend\ContentObject\UserContentObject;
use TYPO3\CMS\Frontend\ContentObject\UserInternalContentObject;
use TYPO3\CMS\Frontend\Controller\ShowImageController;
use TYPO3\CMS\Frontend\Hooks\TreelistCacheUpdateHooks;

defined('TYPO3') or die();

// Register all available content objects
$GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'] = array_merge($GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'], [
    'TEXT'             => TextContentObject::class,
    'CASE'             => CaseContentObject::class,
    'COA'              => ContentObjectArrayContentObject::class,
    'COA_INT'          => ContentObjectArrayInternalContentObject::class,
    'USER'             => UserContentObject::class,
    'USER_INT'         => UserInternalContentObject::class,
    'FILES'            => FilesContentObject::class,
    'IMAGE'            => ImageContentObject::class,
    'IMG_RESOURCE'     => ImageResourceContentObject::class,
    'CONTENT'          => ContentContentObject::class,
    'RECORDS'          => RecordsContentObject::class,
    'HMENU'            => HierarchicalMenuContentObject::class,
    'LOAD_REGISTER'    => LoadRegisterContentObject::class,
    'RESTORE_REGISTER' => RestoreRegisterContentObject::class,
    'FLUIDTEMPLATE'    => FluidTemplateContentObject::class,
    'SVG'              => ScalableVectorGraphicsContentObject::class,
    // @deprecated since v12: content object EDITPANEL will be removed in v12.
    'EDITPANEL'        => EditPanelContentObject::class,
]);

// Register eID provider for showpic
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['tx_cms_showpic'] = ShowImageController::class . '::processRequest';

ExtensionManagementUtility::addUserTSConfig('
  options.saveDocView = 1
  options.saveDocNew = 1
  options.saveDocNew.pages = 0
  options.saveDocNew.sys_file = 0
  options.saveDocNew.sys_file_metadata = 0
  options.disableDelete.sys_file = 1
');

ExtensionManagementUtility::addTypoScriptSetup(
    '
# Content selection
styles.content.get = CONTENT
styles.content.get {
    table = tt_content
    select {
        orderBy = sorting
        where = {#colPos}=0
    }
}


# Content element rendering
tt_content = CASE
tt_content {
    key {
        field = CType
    }
    default = TEXT
    default {
        field = CType
        htmlSpecialChars = 1
        wrap = <p style="background-color: yellow; padding: 0.5em 1em;"><strong>ERROR:</strong> Content Element with uid "{field:uid}" and type "|" has no rendering definition!</p>
        wrap.insertData = 1
    }
}
    '
);

// Registering hooks for the tree list cache
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = TreelistCacheUpdateHooks::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] = TreelistCacheUpdateHooks::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['moveRecordClass'][] = TreelistCacheUpdateHooks::class;

// Register search key shortcuts
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['content'] = 'tt_content';

// Include new content elements to modWizards
ExtensionManagementUtility::addPageTSConfig(
    "@import 'EXT:frontend/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig'"
);
// Include FormEngine adjustments
ExtensionManagementUtility::addPageTSConfig(
    "@import 'EXT:frontend/Configuration/TsConfig/Page/TCEFORM.tsconfig'"
);
}


/**
 * Extension: fluid_styled_content
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/fluid_styled_content/ext_localconf.php
 */

namespace {




defined('TYPO3') or die();

// Define TypoScript as content rendering template
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'fluidstyledcontent/Configuration/TypoScript/';
}


/**
 * Extension: filelist
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/filelist/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Filelist\ContextMenu\ItemProviders\FileProvider;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['BE']['ContextMenu']['ItemProviders'][1486418731] = FileProvider::class;
}


/**
 * Extension: impexp
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/impexp/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Impexp\ContextMenu\ItemProvider;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['BE']['ContextMenu']['ItemProviders'][1486418735] = ItemProvider::class;
}


/**
 * Extension: form
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/form/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Form\Controller\FormFrontendController;
use TYPO3\CMS\Form\Hooks\DataStructureIdentifierHook;
use TYPO3\CMS\Form\Hooks\FormElementHooks;
use TYPO3\CMS\Form\Hooks\FormFileProvider;
use TYPO3\CMS\Form\Hooks\ImportExportHook;
use TYPO3\CMS\Form\Mvc\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Form\Mvc\Property\TypeConverter\FormDefinitionArrayConverter;

defined('TYPO3') or die();

call_user_func(static function () {
    if (ExtensionManagementUtility::isLoaded('filelist')) {
        // Context menu item handling for form files
        $GLOBALS['TYPO3_CONF_VARS']['BE']['ContextMenu']['ItemProviders'][1530637161]
            = FormFileProvider::class;
    }

    if (ExtensionManagementUtility::isLoaded('impexp')) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/impexp/class.tx_impexp.php']['before_addSysFileRecord'][1530637161]
            = ImportExportHook::class . '->beforeAddSysFileRecordOnImport';
    }

    // Hook to enrich tt_content form flex element with finisher settings and form list drop down
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][FlexFormTools::class]['flexParsing'][
        DataStructureIdentifierHook::class
    ] = DataStructureIdentifierHook::class;

    // Add new content element wizard entry
    ExtensionManagementUtility::addPageTSConfig(
        "@import 'EXT:form/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig'"
    );

    // Add module configuration
    ExtensionManagementUtility::addTypoScriptSetup(
        'module.tx_form {
    settings {
        yamlConfigurations {
            10 = EXT:form/Configuration/Yaml/FormSetup.yaml
        }
    }
    view {
        templateRootPaths.10 = EXT:form/Resources/Private/Backend/Templates/
        partialRootPaths.10 = EXT:form/Resources/Private/Backend/Partials/
        layoutRootPaths.10 = EXT:form/Resources/Private/Backend/Layouts/
    }
}'
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterSubmit'][1489772699]
        = FormElementHooks::class;

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['beforeRendering'][1489772699]
        = FormElementHooks::class;

    // FE file upload processing
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterBuildingFinished'][1489772699]
        = PropertyMappingConfiguration::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterFormStateInitialized'][1613296803]
        = PropertyMappingConfiguration::class;

    ExtensionUtility::registerTypeConverter(
        FormDefinitionArrayConverter::class
    );

    // Register "formvh:" namespace
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['formvh'][] = 'TYPO3\\CMS\\Form\\ViewHelpers';

    // Register FE plugin
    ExtensionUtility::configurePlugin(
        'Form',
        'Formframework',
        [FormFrontendController::class => 'render, perform'],
        [FormFrontendController::class => 'perform'],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
});
}


/**
 * Extension: install
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/install/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Install\Report\EnvironmentStatusReport;
use TYPO3\CMS\Install\Report\InstallStatusReport;
use TYPO3\CMS\Install\Report\SecurityStatusReport;
use TYPO3\CMS\Install\Updates\BackendUserLanguageMigration;
use TYPO3\CMS\Install\Updates\CollectionsExtractionUpdate;
use TYPO3\CMS\Install\Updates\DatabaseRowsUpdateWizard;
use TYPO3\CMS\Install\Updates\FeeditExtractionUpdate;
use TYPO3\CMS\Install\Updates\ShortcutRecordsMigration;
use TYPO3\CMS\Install\Updates\SvgFilesSanitization;
use TYPO3\CMS\Install\Updates\SysActionExtractionUpdate;
use TYPO3\CMS\Install\Updates\SysLogChannel;
use TYPO3\CMS\Install\Updates\TaskcenterExtractionUpdate;

defined('TYPO3') or die();

// v9->v10 wizards below this line
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['feeditExtension']
    = FeeditExtractionUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['taskcenterExtension']
    = TaskcenterExtractionUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['sysActionExtension']
    = SysActionExtractionUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['svgFilesSanitization']
    = SvgFilesSanitization::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['shortcutRecordsMigration']
    = ShortcutRecordsMigration::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['databaseRowsUpdateWizard']
    = DatabaseRowsUpdateWizard::class;

// v10->v11 wizards below this line
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['legacyCollectionsExtension']
    = CollectionsExtractionUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['backendUserLanguage']
    = BackendUserLanguageMigration::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['sysLogChannel']
    = SysLogChannel::class;

// Register report module additions
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['typo3'][] = InstallStatusReport::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['security'][] = SecurityStatusReport::class;

// Only add the environment status report if not in CLI mode
if (!Environment::isCli()) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['system'][] = EnvironmentStatusReport::class;
}
}


/**
 * Extension: reports
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/reports/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Reports\Report\ServicesListReport;
use TYPO3\CMS\Reports\Report\Status\ConfigurationStatus;
use TYPO3\CMS\Reports\Report\Status\FalStatus;
use TYPO3\CMS\Reports\Report\Status\SecurityStatus;
use TYPO3\CMS\Reports\Report\Status\Status;
use TYPO3\CMS\Reports\Report\Status\SystemStatus;
use TYPO3\CMS\Reports\Report\Status\Typo3Status;
use TYPO3\CMS\Reports\Report\Status\WarningMessagePostProcessor;
use TYPO3\CMS\Reports\Task\SystemStatusUpdateTask;
use TYPO3\CMS\Reports\Task\SystemStatusUpdateTaskNotificationEmailField;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][SystemStatusUpdateTask::class] = [
    'extension' => 'reports',
    'title' => 'LLL:EXT:reports/Resources/Private/Language/locallang_reports.xlf:status_updateTaskTitle',
    'description' => 'LLL:EXT:reports/Resources/Private/Language/locallang_reports.xlf:status_updateTaskDescription',
    'additionalFields' => SystemStatusUpdateTaskNotificationEmailField::class,
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['displayWarningMessages']['tx_reports_WarningMessagePostProcessor'] = WarningMessagePostProcessor::class;

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'] = [];
}
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'] = array_merge(
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status'],
    [
        'title' => 'LLL:EXT:reports/Resources/Private/Language/locallang_reports.xlf:status_report_title',
        'icon' => 'module-reports',
        'description' => 'LLL:EXT:reports/Resources/Private/Language/locallang_reports.xlf:status_report_description',
        'report' => Status::class,
    ]
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['typo3'][] = Typo3Status::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['system'][] = SystemStatus::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['security'][] = SecurityStatus::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['configuration'][] = ConfigurationStatus::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['fal'][] = FalStatus::class;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['sv']['services'] = [
    'title' => 'LLL:EXT:reports/Resources/Private/Language/locallang_servicereport.xlf:report_title',
    'description' => 'LLL:EXT:reports/Resources/Private/Language/locallang_servicereport.xlf:report_description',
    'icon' => 'EXT:reports/Resources/Public/Images/service-reports.png',
    'report' => ServicesListReport::class,
];
}


/**
 * Extension: redirects
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/redirects/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Backend\Form\FormDataProvider\TcaInputPlaceholders;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Redirects\Evaluation\SourceHost;
use TYPO3\CMS\Redirects\FormDataProvider\ValuePickerItemDataProvider;
use TYPO3\CMS\Redirects\Hooks\BackendControllerHook;
use TYPO3\CMS\Redirects\Hooks\DataHandlerCacheFlushingHook;
use TYPO3\CMS\Redirects\Hooks\DataHandlerSlugUpdateHook;
use TYPO3\CMS\Redirects\Hooks\DispatchNotificationHook;
use TYPO3\CMS\Redirects\Report\Status\RedirectStatus;

defined('TYPO3') or die();

// Rebuild cache in DataHandler on changing / inserting / adding redirect records
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['redirects'] = DataHandlerCacheFlushingHook::class . '->rebuildRedirectCacheIfNecessary';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['redirects'] = DataHandlerSlugUpdateHook::class;

// Inject sys_domains into valuepicker form
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord']
[ValuePickerItemDataProvider::class] = [
    'depends' => [
        TcaInputPlaceholders::class,
    ],
];

// Add validation call for form field source_host and source_path
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][SourceHost::class] = '';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['constructPostProcess'][]
    = BackendControllerHook::class . '->registerClientSideEventHandler';

// Register update signal to send delayed notifications
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['updateSignalHook']['redirects:slugChanged'] = DispatchNotificationHook::class . '->dispatchNotification';

if (ExtensionManagementUtility::isLoaded('reports')) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['LLL:EXT:redirects/Resources/Private/Language/locallang_reports.xlf:statusProvider'][] = RedirectStatus::class;
}
}


/**
 * Extension: recordlist
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/recordlist/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Recordlist\Browser\DatabaseBrowser;
use TYPO3\CMS\Recordlist\Browser\FileBrowser;
use TYPO3\CMS\Recordlist\Browser\FolderBrowser;

defined('TYPO3') or die();

// Register element browsers
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ElementBrowsers']['db'] = DatabaseBrowser::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ElementBrowsers']['file'] = FileBrowser::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ElementBrowsers']['file_reference'] = FileBrowser::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ElementBrowsers']['folder'] = FolderBrowser::class;

// Register default link handlers
ExtensionManagementUtility::addPageTSConfig('
TCEMAIN.linkHandler {
  page {
    handler = TYPO3\\CMS\\Recordlist\\LinkHandler\\PageLinkHandler
    label = LLL:EXT:recordlist/Resources/Private/Language/locallang_browse_links.xlf:page
  }
  file {
    handler = TYPO3\\CMS\\Recordlist\\LinkHandler\\FileLinkHandler
    label = LLL:EXT:recordlist/Resources/Private/Language/locallang_browse_links.xlf:file
    displayAfter = page
    scanAfter = page
  }
  folder {
    handler = TYPO3\\CMS\\Recordlist\\LinkHandler\\FolderLinkHandler
    label = LLL:EXT:recordlist/Resources/Private/Language/locallang_browse_links.xlf:folder
    displayAfter = page,file
    scanAfter = page,file
  }
  url {
    handler = TYPO3\\CMS\\Recordlist\\LinkHandler\\UrlLinkHandler
    label = LLL:EXT:recordlist/Resources/Private/Language/locallang_browse_links.xlf:extUrl
    displayAfter = page,file,folder
    scanAfter = telephone
  }
  mail {
    handler = TYPO3\\CMS\\Recordlist\\LinkHandler\\MailLinkHandler
    label = LLL:EXT:recordlist/Resources/Private/Language/locallang_browse_links.xlf:email
    displayAfter = page,file,folder,url
    scanBefore = url
  }
  telephone {
    handler = TYPO3\\CMS\\Recordlist\\LinkHandler\\TelephoneLinkHandler
    label = LLL:EXT:recordlist/Resources/Private/Language/locallang_browse_links.xlf:telephone
    displayAfter = page,file,folder,url,mail
    scanBefore = url
  }
}
');
}


/**
 * Extension: backend
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/backend/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Backend\Backend\Avatar\DefaultAvatarProvider;
use TYPO3\CMS\Backend\Backend\ToolbarItems\ClearCacheToolbarItem;
use TYPO3\CMS\Backend\Backend\ToolbarItems\HelpToolbarItem;
use TYPO3\CMS\Backend\Backend\ToolbarItems\LiveSearchToolbarItem;
use TYPO3\CMS\Backend\Backend\ToolbarItems\ShortcutToolbarItem;
use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;
use TYPO3\CMS\Backend\Backend\ToolbarItems\UserToolbarItem;
use TYPO3\CMS\Backend\LoginProvider\UsernamePasswordLoginProvider;
use TYPO3\CMS\Backend\Preview\StandardPreviewRendererResolver;
use TYPO3\CMS\Backend\Provider\PageTsBackendLayoutDataProvider;
use TYPO3\CMS\Backend\Security\EmailLoginNotification;
use TYPO3\CMS\Backend\Security\FailedLoginAttemptNotification;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][1435433106] = ClearCacheToolbarItem::class;
$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][1435433107] = HelpToolbarItem::class;
$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][1435433108] = LiveSearchToolbarItem::class;
$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][1435433109] = ShortcutToolbarItem::class;
$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][1435433110] = SystemInformationToolbarItem::class;
$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems'][1435433111] = UserToolbarItem::class;

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['loginProviders'][1433416747] = [
    'provider' => UsernamePasswordLoginProvider::class,
    'sorting' => 50,
    'iconIdentifier' => 'actions-key',
    'label' => 'LLL:EXT:backend/Resources/Private/Language/locallang.xlf:login.link',
];

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['avatarProviders']['defaultAvatarProvider'] = [
    'provider' => DefaultAvatarProvider::class,
];

// Register search key shortcuts
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['page'] = 'pages';

// Register standard preview renderer resolver implementation.
// Resolves PreviewRendererInterface implementations for a given table and record.
// Can be replaced with custom implementation by overriding this value in extensions.
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['previewRendererResolver'] = StandardPreviewRendererResolver::class;

// Include base TSconfig setup
ExtensionManagementUtility::addPageTSConfig(
    "@import 'EXT:backend/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig'"
);

// Register BackendLayoutDataProvider for PageTs
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['BackendLayoutDataProvider']['pagets'] = PageTsBackendLayoutDataProvider::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_userauthgroup.php']['backendUserLogin']['sendEmailOnLogin'] = EmailLoginNotification::class . '->emailAtLogin';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_userauth.php']['postLoginFailureProcessing']['sendEmailOnFailedLoginAttempt'] = FailedLoginAttemptNotification::class . '->sendEmailOnLoginFailures';
}


/**
 * Extension: rte_ckeditor
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/rte_ckeditor/ext_localconf.php
 */

namespace {




use TYPO3\CMS\RteCKEditor\Form\Resolver\RichTextNodeResolver;
use TYPO3\CMS\RteCKEditor\Hook\PageRendererRenderPreProcess;

defined('TYPO3') or die();

// Register FormEngine node type resolver hook to render RTE in FormEngine if enabled
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeResolver'][1480314091] = [
    'nodeName' => 'text',
    'priority' => 50,
    'class' => RichTextNodeResolver::class,
];

// Hook to add rte_ckeditor requirejs config to PageRenderer in backend
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] =
    PageRendererRenderPreProcess::class . '->addRequireJsConfiguration';

// Register the presets
if (empty($GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default'])) {
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default'] = 'EXT:rte_ckeditor/Configuration/RTE/Default.yaml';
}
if (empty($GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['minimal'])) {
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['minimal'] = 'EXT:rte_ckeditor/Configuration/RTE/Minimal.yaml';
}
if (empty($GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['full'])) {
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['full'] = 'EXT:rte_ckeditor/Configuration/RTE/Full.yaml';
}
}


/**
 * Extension: adminpanel
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/adminpanel/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Adminpanel\Controller\AjaxController;
use TYPO3\CMS\Adminpanel\Log\InMemoryLogWriter;
use TYPO3\CMS\Adminpanel\Modules\CacheModule;
use TYPO3\CMS\Adminpanel\Modules\Debug\Events;
use TYPO3\CMS\Adminpanel\Modules\Debug\Log;
use TYPO3\CMS\Adminpanel\Modules\Debug\PageTitle;
use TYPO3\CMS\Adminpanel\Modules\Debug\QueryInformation;
use TYPO3\CMS\Adminpanel\Modules\DebugModule;
use TYPO3\CMS\Adminpanel\Modules\Info\GeneralInformation;
use TYPO3\CMS\Adminpanel\Modules\Info\PhpInformation;
use TYPO3\CMS\Adminpanel\Modules\Info\RequestInformation;
use TYPO3\CMS\Adminpanel\Modules\Info\UserIntInformation;
use TYPO3\CMS\Adminpanel\Modules\InfoModule;
use TYPO3\CMS\Adminpanel\Modules\PreviewModule;
use TYPO3\CMS\Adminpanel\Modules\TsDebug\TypoScriptWaterfall;
use TYPO3\CMS\Adminpanel\Modules\TsDebugModule;
use TYPO3\CMS\Core\Log\LogLevel;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['adminpanel']['modules'] = [
    'preview' => [
        'module' => PreviewModule::class,
        'before' => ['cache'],
    ],
    'cache' => [
        'module' => CacheModule::class,
        'after' => ['preview'],
    ],
    'tsdebug' => [
        'module' => TsDebugModule::class,
        'after' => ['edit'],
        'submodules' => [
            'ts-waterfall' => [
                'module' => TypoScriptWaterfall::class,
            ],
        ],
    ],
    'info' => [
        'module' => InfoModule::class,
        'after' => ['tsdebug'],
        'submodules' => [
            'general' => [
                'module' => GeneralInformation::class,
            ],
            'request' => [
                'module' => RequestInformation::class,
            ],
            'phpinfo' => [
                'module' => PhpInformation::class,
            ],
            'userint' => [
                'module' => UserIntInformation::class,
            ],
        ],
    ],
    'debug' => [
        'module' => DebugModule::class,
        'after' => ['info'],
        'submodules' => [
            'log' => [
                'module' => Log::class,
            ],
            'queryInformation' => [
                'module' => QueryInformation::class,
            ],
            'pageTitle' => [
                'module' => PageTitle::class,
            ],
            'events' => [
                'module' => Events::class,
            ],
        ],
    ],
];

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['adminPanel_save']
    = AjaxController::class . '::saveDataAction';

// The admin panel has a module to show log messages. Register a debug logger to gather those.
$GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][LogLevel::DEBUG][InMemoryLogWriter::class] = [];

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['adminpanel_requestcache'] ?? null)) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['adminpanel_requestcache'] = [];
}
}


/**
 * Extension: dashboard
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/dashboard/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Cache\Backend\FileBackend;
use TYPO3\CMS\Core\Cache\Frontend\VariableFrontend;

defined('TYPO3') or die();

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['dashboard_rss'] ?? null)) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['dashboard_rss'] = [
        'frontend' => VariableFrontend::class,
        'backend' => FileBackend::class,
        'options' => [
            'defaultLifetime' => 900,
        ],
    ];
}
}


/**
 * Extension: extensionmanager
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/extensionmanager/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extensionmanager\Report\ExtensionComposerStatus;
use TYPO3\CMS\Extensionmanager\Report\ExtensionStatus;
use TYPO3\CMS\Extensionmanager\Task\UpdateExtensionListTask;

defined('TYPO3') or die();

// Register extension list update task
if (!(bool)GeneralUtility::makeInstance(
    ExtensionConfiguration::class
)->get('extensionmanager', 'offlineMode')) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][UpdateExtensionListTask::class] = [
        'extension' => 'extensionmanager',
        'title' => 'LLL:EXT:extensionmanager/Resources/Private/Language/locallang.xlf:task.updateExtensionListTask.name',
        'description' => 'LLL:EXT:extensionmanager/Resources/Private/Language/locallang.xlf:task.updateExtensionListTask.description',
        'additionalFields' => '',
    ];
}

// Register extension status report system
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['Extension Manager'][] =
    ExtensionStatus::class;

// Register extension composer status report
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['Composer Manifest'][] =
    ExtensionComposerStatus::class;
}


/**
 * Extension: felogin
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/felogin/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\FrontendLogin\Controller\LoginController;
use TYPO3\CMS\FrontendLogin\Controller\PasswordRecoveryController;
use TYPO3\CMS\FrontendLogin\Updates\MigrateFeloginPlugins;
use TYPO3\CMS\FrontendLogin\Updates\MigrateFeloginPluginsCtype;

defined('TYPO3') or die();

// Add default TypoScript
ExtensionManagementUtility::addTypoScriptConstants(
    "@import 'EXT:felogin/Configuration/TypoScript/constants.typoscript'"
);
ExtensionManagementUtility::addTypoScriptSetup(
    "@import 'EXT:felogin/Configuration/TypoScript/setup.typoscript'"
);

ExtensionUtility::configurePlugin(
    'Felogin',
    'Login',
    [
        LoginController::class => 'login, overview',
        PasswordRecoveryController::class => 'recovery,showChangePassword,changePassword',
    ],
    [
        LoginController::class => 'login, overview',
        PasswordRecoveryController::class => 'recovery,showChangePassword,changePassword',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Add login form to new content element wizard
ExtensionManagementUtility::addPageTSConfig(
    "@import 'EXT:felogin/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig'"
);

// Add migration wizards
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['TYPO3\\CMS\\Felogin\\Updates\\MigrateFeloginPlugins']
    = MigrateFeloginPlugins::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][MigrateFeloginPluginsCtype::class]
    = MigrateFeloginPluginsCtype::class;
}


/**
 * Extension: seo
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/seo/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Seo\Canonical\CanonicalGenerator;
use TYPO3\CMS\Seo\MetaTag\MetaTagGenerator;
use TYPO3\CMS\Seo\MetaTag\OpenGraphMetaTagManager;
use TYPO3\CMS\Seo\MetaTag\TwitterCardMetaTagManager;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['TYPO3\CMS\Frontend\Page\PageGenerator']['generateMetaTags']['metatag'] =
    MetaTagGenerator::class . '->generate';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['TYPO3\CMS\Frontend\Page\PageGenerator']['generateMetaTags']['canonical'] =
    CanonicalGenerator::class . '->generate';

$metaTagManagerRegistry = GeneralUtility::makeInstance(MetaTagManagerRegistry::class);
$metaTagManagerRegistry->registerManager(
    'opengraph',
    OpenGraphMetaTagManager::class
);
$metaTagManagerRegistry->registerManager(
    'twitter',
    TwitterCardMetaTagManager::class
);
unset($metaTagManagerRegistry);

// Add module configuration
ExtensionManagementUtility::addTypoScriptSetup(trim('
    config.pageTitleProviders {
        seo {
            provider = TYPO3\CMS\Seo\PageTitle\SeoTitlePageTitleProvider
            before = record
        }
    }
'));

ExtensionManagementUtility::addPageTSConfig(trim('
mod.web_info.fieldDefinitions {
  seo {
    label = LLL:EXT:seo/Resources/Private/Language/locallang_webinfo.xlf:seo
    fields = title,uid,slug,seo_title,description,no_index,no_follow,canonical_link,sitemap_changefreq,sitemap_priority
  }
  social_media {
    label = LLL:EXT:seo/Resources/Private/Language/locallang_webinfo.xlf:social_media
    fields = title,uid,og_title,og_description,twitter_title,twitter_description
  }
}
'));
}


/**
 * Extension: sys_note
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/sys_note/ext_localconf.php
 */

namespace {




use TYPO3\CMS\SysNote\Hook\ButtonBarHook;
use TYPO3\CMS\SysNote\Hook\InfoModuleHook;
use TYPO3\CMS\SysNote\Hook\PageHook;

defined('TYPO3') or die();

// Hook into the page modules
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/db_layout.php']['drawHeaderHook']['sys_note'] = PageHook::class . '->renderInHeader';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/db_layout.php']['drawFooterHook']['sys_note'] = PageHook::class . '->renderInFooter';
// Hook into the info module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/web_info/class.tx_cms_webinfo.php']['drawFooterHook']['sys_note'] = InfoModuleHook::class . '->render';
// Hook into the button bar
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Backend\Template\Components\ButtonBar']['getButtonsHook']['sys_note'] = ButtonBarHook::class . '->getButtons';
}


/**
 * Extension: t3editor
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/t3editor/ext_localconf.php
 */

namespace {




use TYPO3\CMS\T3editor\Form\Element\T3editorElement;
use TYPO3\CMS\T3editor\Hook\FileEditHook;
use TYPO3\CMS\T3editor\Hook\PageRendererRenderPreProcess;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/file_edit.php']['preOutputProcessingHook'][] =
    FileEditHook::class . '->preOutputProcessingHook';

// Hook to add t3editor requirejs config to PageRenderer in backend
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] =
    PageRendererRenderPreProcess::class . '->addRequireJsConfiguration';

// Register backend FormEngine node
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1433089350] = [
    'nodeName' => 't3editor',
    'priority' => 40,
    'class' => T3editorElement::class,
];
}


/**
 * Extension: tstemplate
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3/sysext/tstemplate/ext_localconf.php
 */

namespace {




use TYPO3\CMS\Tstemplate\Hooks\DataHandlerClearCachePostProcHook;

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['tstemplate'] = DataHandlerClearCachePostProcHook::class . '->clearPageCacheIfNecessary';
}


/**
 * Extension: additional_tca
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/additional_tca/ext_localconf.php
 */

namespace {


if (!defined('TYPO3')) {
    die('Access denied.');
}

//
// Register form engine fields
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1585222848] = [
    'nodeName' => 'Information',
    'priority' => '80',
    'class' => \CodingMs\AdditionalTca\Form\Element\Information::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1599211190] = [
    'nodeName' => 'Currency',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Currency::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1599211204] = [
    'nodeName' => 'Percent',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Percent::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1646140789] = [
    'nodeName' => 'Notice',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Notice::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1650378895] = [
    'nodeName' => 'BadgeSuggested',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\BadgeSuggested::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1646140790] = [
    'nodeName' => 'Duration',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Duration::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1599211191] = [
    'nodeName' => 'DateTime',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\DateTime::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1599211192] = [
    'nodeName' => 'Date',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Date::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1599211193] = [
    'nodeName' => 'Email',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\Email::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1669029099] = [
    'nodeName' => 'ExpandableTextarea',
    'priority' => '70',
    'class' => \CodingMs\AdditionalTca\Form\Element\ExpandableTextarea::class
];
}


/**
 * Extension: modules
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/modules/ext_localconf.php
 */

namespace {


if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Modules',
    'Registration',
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'registration,invitationCodeAvailable'],
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'registration,invitationCodeAvailable']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Modules',
    'Profile',
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'profile'],
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'profile']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Modules',
    'LoginFromBackend',
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'loginFromBackend'],
    [\CodingMs\Modules\Controller\FrontendUserController::class => 'loginFromBackend']
);
//
// Provide icon for page tree, list view, ...
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry
    ->registerIcon(
        'apps-pagetree-frontend-user',
        TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:modules/Resources/Public/Icons/iconmonstr-user-20.svg',
        ]
    );
//
// Allow backend users to drag and drop the new page type:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
    'options.pageTree.doktypesToShowInNewPageDragArea := addToList(1659186453)'
);
//
// Page TypoScript
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:modules/Configuration/PageTS/tsconfig.typoscript">'
);
//
// Handle authorizations
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['checkModifyAccessList']['modules'] =
    \CodingMs\Modules\Hook\DataHandlerCheckModifyAccessListHook::class;
//
// Override Mail template paths
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['templateRootPaths'][1659186453] = 'EXT:modules/Resources/Private/Templates/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['layoutRootPaths'][1659186453] = 'EXT:modules/Resources/Private/Layouts/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['partialRootPaths'][1659186453] = 'EXT:modules/Resources/Private/Partials/Email/';
}


/**
 * Extension: fluid_form
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/fluid_form/ext_localconf.php
 */

namespace {


if (!defined('TYPO3')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'FluidForm',
    'Form',
    [
        \CodingMs\FluidForm\Controller\FluidFormController::class => 'show,download'
    ],
    // non-cacheable actions
    [
        \CodingMs\FluidForm\Controller\FluidFormController::class => 'show,download'
    ]
);

$tsConfig = '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fluid_form/Configuration/PageTS/tsconfig.typoscript">';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($tsConfig);

if (!class_exists('\MathGuard')) {
    include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('fluid_form') . '/Resources/Private/Php/MathGuard/MathGuard.php');
}

// Register for hook to show preview in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['fluid_form'] =
    \CodingMs\FluidForm\Hooks\PageLayoutView\FormContentElementPreviewRenderer::class;
//
// Override Mail template paths
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['templateRootPaths'][1661595067] = 'EXT:fluid_form/Resources/Private/Templates/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['layoutRootPaths'][1661595067] = 'EXT:fluid_form/Resources/Private/Layouts/Email/';
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['partialRootPaths'][1661595067] = 'EXT:fluid_form/Resources/Private/Partials/Email/';
//
// register svg icons: identifier and filename
$iconsSvg = [
    'contains-mails' => 'ext_icon.svg',
    'apps-pagetree-folder-contains-mails' => 'ext_icon.svg',
    'mimetypes-x-content-fluid-form-mail' => 'Resources/Public/Icons/iconmonstr-email-9.svg',
    'mimetypes-x-content-fluid-form-field' => 'Resources/Public/Icons/iconmonstr-email-9.svg',
    'module-fluid-form' => 'Resources/Public/Icons/module-fluid-form.svg',
];
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($iconsSvg as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:fluid_form/' . $path]
    );
}
}


/**
 * Extension: news
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/news/ext_localconf.php
 */

namespace {


defined('TYPO3_MODE') or die();

$boot = static function (): void {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'News',
        'Pi1',
        [
            \GeorgRinger\News\Controller\NewsController::class => 'list,detail,selectedList,dateMenu,searchForm,searchResult',
            \GeorgRinger\News\Controller\CategoryController::class => 'list',
            \GeorgRinger\News\Controller\TagController::class => 'list',
        ],
        [
            \GeorgRinger\News\Controller\NewsController::class => 'searchForm,searchResult',
        ]
    );

    // Page module hook
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['news' . '_pi1']['news'] =
        \GeorgRinger\News\Hooks\PageLayoutView::class . '->getExtensionSummary';

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['news_clearcache'] =
        \GeorgRinger\News\Hooks\DataHandler::class . '->clearCachePostProc';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['moveRecordClass']['news_clearcache'] =
        \GeorgRinger\News\Hooks\DataHandler::class;

    // Edit restriction for news records
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['news'] =
        \GeorgRinger\News\Hooks\DataHandler::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['news'] =
        \GeorgRinger\News\Hooks\DataHandler::class;

    // Modify flexform values
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools::class]['flexParsing']['news']
        = \GeorgRinger\News\Hooks\BackendUtility::class;

    // Modify flexform fields since core 8.5 via formEngine: Inject a data provider between TcaFlexPrepare and TcaFlexProcess
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][\GeorgRinger\News\Backend\FormDataProvider\NewsFlexFormManipulation::class] = [
        'depends' => [
            \TYPO3\CMS\Backend\Form\FormDataProvider\TcaFlexPrepare::class,
        ],
        'before' => [
            \TYPO3\CMS\Backend\Form\FormDataProvider\TcaFlexProcess::class,
        ],
    ];

    // Hide content elements in list module & filter in administration module
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList::class]['modifyQuery'][]
        = \GeorgRinger\News\Hooks\Backend\RecordListQueryHook::class;

    // Hide content elements in page module
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Backend\View\PageLayoutView::class]['modifyQuery'][] = \GeorgRinger\News\Hooks\Backend\PageViewQueryHook::class;

    // Inline records hook
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms_inline.php']['tceformsInlineHook']['news'] =
        \GeorgRinger\News\Hooks\InlineElementHook::class;

    // Xclass InlineRecordContainer
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Backend\Form\Container\InlineRecordContainer::class] = [
        'className' => \GeorgRinger\News\Xclass\InlineRecordContainerForNews::class,
    ];

    /* ===========================================================================
        Custom cache, done with the caching framework
    =========================================================================== */
    if (empty($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['news_category'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['news_category'] = [];
    }
    // Define string frontend as default frontend, this must be set with TYPO3 4.5 and below
    // and overrides the default variable frontend of 4.6
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['news_category']['frontend'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['news_category']['frontend'] = \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class;
    }

    /* ===========================================================================
        Add TSconfig
    =========================================================================== */
    // For linkvalidator
    if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('linkvalidator')) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import \'EXT:news/Configuration/TSconfig/Page/mod.linkvalidator.tsconfig\'');
    }
    if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('guide')) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import \'EXT:news/Configuration/TSconfig/Tours/AdministrationModule.tsconfig\'');
    }

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
    @import \'EXT:news/Configuration/TSconfig/ContentElementWizard.tsconfig\'
    @import \'EXT:news/Configuration/TSconfig/Administration.tsconfig\'
    ');

    /* ===========================================================================
        Hooks
    =========================================================================== */
    // Register cache frontend for proxy class generation
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['news'] = [
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\PhpFrontend::class,
        'backend' => \TYPO3\CMS\Core\Cache\Backend\FileBackend::class,
        'groups' => [
            'all',
            'system',
        ],
        'options' => [
            'defaultLifetime' => 0,
        ]
    ];

    if (class_exists(\GeorgRinger\News\Utility\ClassLoader::class)) {
        \GeorgRinger\News\Utility\ClassLoader::registerAutoloader();
    }
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] =
        \GeorgRinger\News\Utility\ClassCacheManager::class . '->reBuild';

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][\GeorgRinger\News\Backend\FormDataProvider\NewsRowInitializeNew::class] = [
        'depends' => [
            \TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowInitializeNew::class,
        ]
    ];

    if (TYPO3_MODE === 'BE') {
        $icons = [
            'apps-pagetree-folder-contains-news' => 'ext-news-folder-tree.svg',
            'apps-pagetree-page-contains-news' => 'ext-news-page-tree.svg',
            'ext-news-wizard-icon' => 'plugin_wizard.svg',
            'ext-news-type-default' => 'news_domain_model_news.svg',
            'ext-news-type-internal' => 'news_domain_model_news_internal.svg',
            'ext-news-type-external' => 'news_domain_model_news_external.svg',
            'ext-news-tag' => 'news_domain_model_tag.svg',
            'ext-news-link' => 'news_domain_model_link.svg',
            'ext-news-donation' => 'donation.svg',
            'ext-news-paypal' => 'donation_paypal.svg',
            'ext-news-patreon' => 'donation_patreon.svg',
            'ext-news-amazon' => 'donation_amazon.svg',
        ];
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        foreach ($icons as $identifier => $path) {
            if (!$iconRegistry->isRegistered($identifier)) {
                $iconRegistry->registerIcon(
                    $identifier,
                    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                    ['source' => 'EXT:news/Resources/Public/Icons/' . $path]
                );
            }
        }
    }

    // Slug helpers
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['realurlAliasNewsSlug']
        = \GeorgRinger\News\Updates\RealurlAliasNewsSlugUpdater::class; // Recommended before 'newsSlug'
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['newsSlug']
        = \GeorgRinger\News\Updates\NewsSlugUpdater::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['sysCategorySlugs']
        = \GeorgRinger\News\Updates\PopulateCategorySlugs::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['txNewsTagSlugs']
        = \GeorgRinger\News\Updates\PopulateTagSlugs::class;

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1552726986] = [
        'nodeName' => 'NewsStaticText',
        'priority' => 70,
        'class' => \GeorgRinger\News\Backend\FieldInformation\StaticText::class
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
    config.pageTitleProviders {
        news {
            provider = GeorgRinger\News\Seo\NewsTitleProvider
            before = altPageTitle,record,seo
        }
    }
'));
};

$boot();
unset($boot);
}


/**
 * Extension: bootstrap_package
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/bootstrap_package/ext_localconf.php
 */

namespace {


/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Define TypoScript as content rendering template
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'bootstrappackage/Configuration/TypoScript/';
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'bootstrappackage/Configuration/TypoScript/ContentElement/';

// Make the extension configuration accessible
$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
);
$bootstrapPackageConfiguration = $extensionConfiguration->get('bootstrap_package');

// PageTS

// Add Content Elements
if (!(bool) $bootstrapPackageConfiguration['disablePageTsContentElements']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_package/Configuration/TsConfig/Page/ContentElement/All.tsconfig">');
}

// Add BackendLayouts for the BackendLayout DataProvider
if (!(bool) $bootstrapPackageConfiguration['disablePageTsBackendLayouts']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_package/Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts.tsconfig">');
}

// RTE
if (!(bool) $bootstrapPackageConfiguration['disablePageTsRTE']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_package/Configuration/TsConfig/Page/RTE.tsconfig">');
}

// TCADefaults
if (!(bool) $bootstrapPackageConfiguration['disablePageTsTCADefaults']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_package/Configuration/TsConfig/Page/TCADefaults.tsconfig">');
}

// TCEMAIN
if (!(bool) $bootstrapPackageConfiguration['disablePageTsTCEMAIN']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_package/Configuration/TsConfig/Page/TCEMAIN.tsconfig">');
}

// TCEFORM
if (!(bool) $bootstrapPackageConfiguration['disablePageTsTCEFORM']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_package/Configuration/TsConfig/Page/TCEFORM.tsconfig">');
}

// Register custom EXT:form configuration
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
        module.tx_form {
            settings {
                yamlConfigurations {
                    110 = EXT:bootstrap_package/Configuration/Form/Setup.yaml
                }
            }
        }
        plugin.tx_form {
            settings {
                yamlConfigurations {
                    110 = EXT:bootstrap_package/Configuration/Form/Setup.yaml
                }
            }
        }
    '));
}

// Register google font hook
if (!(bool) $bootstrapPackageConfiguration['disableGoogleFontCaching']) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][\BK2K\BootstrapPackage\Hooks\PageRenderer\GoogleFontHook::class]
        = \BK2K\BootstrapPackage\Hooks\PageRenderer\GoogleFontHook::class . '->execute';
}

// Register css processing parser
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'][\BK2K\BootstrapPackage\Parser\ScssParser::class] =
    \BK2K\BootstrapPackage\Parser\ScssParser::class;

// Register css processing hooks
if (!(bool) $bootstrapPackageConfiguration['disableCssProcessing']) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][\BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook::class]
        = \BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook::class . '->execute';
}

// Register icon provider
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/icons']['provider'][\BK2K\BootstrapPackage\Icons\IoniconsProvider::class]
    = \BK2K\BootstrapPackage\Icons\IoniconsProvider::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/icons']['provider'][\BK2K\BootstrapPackage\Icons\GlyphiconsProvider::class]
    = \BK2K\BootstrapPackage\Icons\GlyphiconsProvider::class;

// Add default RTE configuration for bootstrap package
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['bootstrap'] = 'EXT:bootstrap_package/Configuration/RTE/Default.yaml';

// Extend TYPO3 upgrade wizards to handle bootstrap package specific upgrades
if (isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\TYPO3\CMS\Install\Updates\SectionFrameToFrameClassUpdate::class])) {
    unset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\TYPO3\CMS\Install\Updates\SectionFrameToFrameClassUpdate::class]);
}
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\AccordionContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\AccordionContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\AccordionMediaOrientUpdate::class]
    = \BK2K\BootstrapPackage\Updates\AccordionMediaOrientUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\BackendLayoutUpdate::class]
    = \BK2K\BootstrapPackage\Updates\BackendLayoutUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\BulletContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\BulletContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\CarouselContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\CarouselContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\CarouselItemTypeUpdate::class]
    = \BK2K\BootstrapPackage\Updates\CarouselItemTypeUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\CarouselItemLayoutUpdate::class]
    = \BK2K\BootstrapPackage\Updates\CarouselItemLayoutUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\ExternalMediaContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\ExternalMediaContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\FrameClassUpdate::class]
    = \BK2K\BootstrapPackage\Updates\FrameClassUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\FrameClassToBackgroundUpdate::class]
    = \BK2K\BootstrapPackage\Updates\FrameClassToBackgroundUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\ListGroupContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\ListGroupContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\PanelContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\PanelContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TabContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TabContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TabMediaOrientUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TabMediaOrientUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TableContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TableContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TexticonContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonSizeUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TexticonSizeUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonTypeUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TexticonTypeUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonIconUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TexticonIconUpdate::class;

// Register "bk2k" as global fluid namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bk2k'][] = 'BK2K\\BootstrapPackage\\ViewHelpers';

// Register Icons
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'systeminformation-bootstrappackage',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/SystemInformation/bootstrappackage.svg']
);
$icons = [
    'accordion',
    'accordion-item',
    'card-group',
    'card-group-item',
    'carousel',
    'carousel-item',
    'carousel-item-backgroundimage',
    'carousel-item-calltoaction',
    'carousel-item-header',
    'carousel-item-html',
    'carousel-item-image',
    'carousel-item-text',
    'carousel-item-textandimage',
    'beside-text-img-centered-left',
    'beside-text-img-centered-right',
    'csv',
    'externalmedia',
    'gallery',
    'icon-group',
    'icon-group-item',
    'listgroup',
    'menu-card',
    'social-links',
    'tab',
    'tab-item',
    'texticon',
    'timeline',
    'timeline-item'
];
foreach ($icons as $icon) {
    $iconRegistry->registerIcon(
        'content-bootstrappackage-' . $icon,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/' . $icon . '.svg']
    );
}
}


/**
 * Extension: df_tabs
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/df_tabs/ext_localconf.php
 */

namespace {


defined('TYPO3') or die();
/**
 *
 * Copyright notice
 *
 * (c) sgalinski Internet Services (https://www.sgalinski.de)
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

call_user_func(
	function () {
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43(
			'df_tabs',
			'',
			'_plugin1',
			'list_type',
			TRUE
		);
		// we correct the classname of the plugin controller
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
			'plugin.tx_dftabs_plugin1.userFunc=' . \SGalinski\DfTabs\Controller\PluginController::class . '->main'
		);

		// Backend preview for plugin
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['df_tabs']
			= \SGalinski\DfTabs\Hooks\PageLayoutView\PluginRenderer::class;

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
			'@import "EXT:df_tabs/Configuration/TsConfig/Page/NewContentElementWizard.tsconfig"'
		);

		/**
		 * Register icons
		 */
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
			\TYPO3\CMS\Core\Imaging\IconRegistry::class
		);
		$iconRegistry->registerIcon(
			'extension-df_tabs-content-element',
			\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
			['source' => 'EXT:df_tabs/Resources/Public/Images/contentElementWizard.png']
		);

		$GLOBALS['TCA']['tt_content']['types']['list']['previewRenderer']['df_tabs_plugin1'] = \SGalinski\DfTabs\Preview\PreviewRenderer::class;
	}
);
}


/**
 * Extension: fluid_new_site_bni
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/fluid_new_site_bni/ext_localconf.php
 */

namespace {

defined('TYPO3') or die('Access denied.');

/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['fluid_new_site_bni'] = 'EXT:fluid_new_site_bni/Configuration/RTE/Default.yaml';

/***************
 * PageTS */
 
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '@import "EXT:fluid_new_site_bni/Configuration/page.tsconfig"'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import "EXT:fluid_new_site_bni/Configuration/TsConfig/Page/All.tsconfig"');


/***************
 *
ExtensionManagementUtility::addPageTSConfig('
    @import "EXT:site_package/Configuration/page.tsconfig",
    @import "EXT:fluid_new_site_bni/Configuration/TsConfig/Page/All.tsconfig"
');
*/
}


/**
 * Extension: fs_media_gallery
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/fs_media_gallery/ext_localconf.php
 */

namespace {

defined('TYPO3_MODE') || die();

$boot = function ($packageKey) {

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        $packageKey,
        'Mediagallery',
        [
            \MiniFranske\FsMediaGallery\Controller\MediaAlbumController::class => 'index,nestedList,flatList,showAlbum,showAlbumByConfig,showAsset,random',
        ],
        // non-cacheable actions
        [
            \MiniFranske\FsMediaGallery\Controller\MediaAlbumController::class => 'random',
        ]
    );

    // Page TSConfig
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $packageKey . '/Configuration/TSConfig/Page.ts">');

    // Module header bar buttons
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Backend\Template\Components\ButtonBar']['getButtonsHook']['FsMediaGallery'] =
        'MiniFranske\\FsMediaGallery\\Hooks\\DocHeaderButtonsHook->moduleTemplateDocHeaderGetButtons';

    // refresh file tree after changen in media album recored (sys_file_collection)
    $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] =
        \MiniFranske\FsMediaGallery\Hooks\ProcessDatamapHook::class;
    $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] =
        \MiniFranske\FsMediaGallery\Hooks\ProcessDatamapHook::class;

    // Page module hook
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['fsmediagallery_mediagallery']['fs_media_gallery'] =
        'MiniFranske\\FsMediaGallery\\Hooks\\PageLayoutView->getExtensionSummary';

    $GLOBALS['TYPO3_CONF_VARS']['BE']['ContextMenu']['ItemProviders'][1547740001] = \MiniFranske\FsMediaGallery\ContextMenu\ItemProviders\FsMediaGalleryProvider::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['constructPostProcess'][] = \MiniFranske\FsMediaGallery\Hooks\BackendControllerHook::class . '->addJavaScript';

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['realurlAliasMediaAlbumsSlug']
        = \MiniFranske\FsMediaGallery\Updates\RealurlAliasMediaAlbumsSlug::class; // Recommended before 'populateMedialAlbumsSlug'

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['populateMedialAlbumsSlug']
        = \MiniFranske\FsMediaGallery\Updates\PopulateMedialAlbumsSlug::class;
};
$boot('fs_media_gallery');
unset($boot);
}


/**
 * Extension: gridgallery
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/gridgallery/ext_localconf.php
 */

namespace {

/**
 * This file is part of the "gridgallery" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:gridgallery/Configuration/TSconfig/page.tsconfig">
');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['gridgallery_gallery'] =
    \Lavitto\Gridgallery\Hooks\PageLayoutView\GridGalleryPreviewRenderer::class;
}


/**
 * Extension: ke_search
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/ke_search/ext_localconf.php
 */

namespace {


defined('TYPO3') or die();

(function () {
    // add Searchbox Plugin, override class name with namespace
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('ke_search', '', '_pi1');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
        'tx_kesearch',
        'setup',
        'plugin.tx_kesearch_pi1.userFunc = Tpwd\KeSearch\Plugins\SearchboxPlugin->main'
    );

    // add Resultlist Plugin, override class name with namespace
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('ke_search', '', '_pi2');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
        'tx_kesearch',
        'setup',
        'plugin.tx_kesearch_pi2.userFunc = Tpwd\KeSearch\Plugins\ResultlistPlugin->main'
    );

    // add cachable Searchbox Plugin, override class name with namespace
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('ke_search', '', '_pi3', 'list_type', 1);
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
        'tx_kesearch',
        'setup',
        'plugin.tx_kesearch_pi3.userFunc = Tpwd\KeSearch\Plugins\SearchboxPlugin->main'
    );

    // add page TSconfig (Content element wizard icons, hide index table)
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ke_search/Configuration/TSconfig/Page/pageTSconfig.tsconfig">'
    );

    // use hooks for generation of sortdate values
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerAdditionalFields'][] =
        \Tpwd\KeSearch\Hooks\AdditionalFields::class;

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyPagesIndexEntry'][] =
        \Tpwd\KeSearch\Hooks\AdditionalFields::class;

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyContentIndexEntry'][] =
        \Tpwd\KeSearch\Hooks\AdditionalFields::class;

    // Custom validators for TCA (eval)
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']
    ['Tpwd\\KeSearch\\UserFunction\\CustomFieldValidation\\FilterOptionTagValidator'] =
        'EXT:ke_search/Classes/UserFunction/CustomFieldValidation/FilterOptionTagValidator.php';

    // logging
    $extConf = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
    )->get('ke_search');
    $loglevel = strtolower($extConf['loglevel'] ?? 'ERROR');
    $GLOBALS['TYPO3_CONF_VARS']['LOG']['Tpwd']['KeSearch']['writerConfiguration'] = [
        $loglevel => [
            \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
                'logFileInfix' => 'kesearch',
            ],
        ],
    ];

    // register "after save" hook
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']
    ['ke_search-filter-option'] = \Tpwd\KeSearch\Hooks\FilterOptionHook::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']
    ['ke_search-filter-option'] = \Tpwd\KeSearch\Hooks\FilterOptionHook::class;

    // Upgrade Wizards
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['keSearchMakeTagsAlphanumericUpgradeWizard']
        = \Tpwd\KeSearch\Updates\MakeTagsAlphanumericUpgradeWizard::class;
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['keSearchPopulateFilterOptionsSlugsUpgradeWizard']
        = \Tpwd\KeSearch\Updates\PopulateFilterOptionSlugsUpgradeWizard::class;

    // Custom aspects for routing
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['aspects']['KeSearchUrlEncodeMapper'] =
        \Tpwd\KeSearch\Routing\Aspect\KeSearchUrlEncodeMapper::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['aspects']['KeSearchTagToSlugMapper'] =
        \Tpwd\KeSearch\Routing\Aspect\KeSearchTagToSlugMapper::class;
})();
}


/**
 * Extension: ke_search_hooks
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/ke_search_hooks/ext_localconf.php
 */

namespace {

/***************************************************************
 *  Copyright notice
 *  (c) 2012 Christian Bülter
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

if (!defined("TYPO3")) {
    die("Access denied.");
}
(function () {
    // Register custom indexer.
    // Adjust this to your namespace and class name.
    // Adjust the autoloading information in composer.json, too!
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] =
        \Tpwd\KeSearchHooks\ExampleIndexer::class;
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] =
        \Tpwd\KeSearchHooks\ExampleIndexer::class;

    // Register hooks for indexing additional fields.
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyPageContentFields'][] =
        \Tpwd\KeSearchHooks\AdditionalContentFields::class;
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyContentFromContentElement'][] =
        \Tpwd\KeSearchHooks\AdditionalContentFields::class;

    // Register hook to check if a content element should be indexed
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['contentElementShouldBeIndexed'][] =
        \Tpwd\KeSearchHooks\AdditionalContentFields::class;

    // Register hook to add a custom autosuggest provider (ke_search_premium feature)
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search_premium']['modifyAutocompleWordList'][] =
        \Tpwd\KeSearchHooks\AutosuggestProvider::class;

    // Register hook to add custom values to the result row partial
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['additionalResultMarker'][] =
        \Tpwd\KeSearchHooks\AdditionalResultMarker::class;

    // Register hook to change the sorting
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['getOrdering'][] =
        \Tpwd\KeSearchHooks\Ordering::class;

    // Register hook to modify the values of the record which will be stored in the index
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['modifyFieldValuesBeforeStoring'][] =
        \Tpwd\KeSearchHooks\modifyFieldValuesBeforeStoring::class;

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customFilterRenderer'][] =
        \Tpwd\KeSearchHooks\ExampleFilterRenderer::class;

    // Register hook to register additional fields in the index table
    // Make sure to set the values for the additional fields in *every indexer* you use
    //$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerAdditionalFields'][] =
    //\Tpwd\KeSearchHooks\AdditionalIndexerFields::class;

    // Example for showing images of fe_users if you have implemented a fe_users indexer
    //$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['fileReferenceTypes']['fe_users']['table'] = 'fe_users';
    //$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['fileReferenceTypes']['fe_users']['field'] = 'image';
})();
}


/**
 * Extension: nitsan_hellobar
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/nitsan_hellobar/ext_localconf.php
 */

namespace {

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
$_EXTKEY = 'nitsan_hellobar';
}


/**
 * Extension: ns_youtube
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/ns_youtube/ext_localconf.php
 */

namespace {

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (version_compare(TYPO3_branch, '11.0', '>=')) {
    $moduleClass = \Nitsan\NsYoutube\Controller\YoutubeController::class;
} else {
    $moduleClass = 'Youtube';
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Nitsan.NsYoutube',
    'Youtube',
    [
        $moduleClass => 'list,ajax'
    ],
    // non-cacheable actions
    [
        $moduleClass => 'list,ajax'
    ]
);


if (version_compare(TYPO3_branch, '7.0', '>')) {
    if (TYPO3_MODE === 'BE') {
        $icons = [
            'ext-ns-youtube-icon' => 'user_plugin_youtube.svg',
        ];
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        foreach ($icons as $identifier => $path) {
            $iconRegistry->registerIcon(
                $identifier,
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => 'EXT:ns_youtube/Resources/Public/Icons/' . $path]
            );
        }
    }
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['ns_youtube']
        = \Nitsan\NsYoutube\Hooks\PageLayoutView::class;
}


/**
 * Extension: solr
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/solr/ext_localconf.php
 */

namespace {


defined('TYPO3') || die();

// ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

(function () {
    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #
    // registering Index Queue page indexer helpers
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['solr']['Indexer']['indexPageSubstitutePageDocument'][\ApacheSolrForTypo3\Solr\AdditionalFieldsIndexer::class] = \ApacheSolrForTypo3\Solr\AdditionalFieldsIndexer::class;

    \ApacheSolrForTypo3\Solr\IndexQueue\FrontendHelper\Manager::registerFrontendHelper(
        'findUserGroups',
        \ApacheSolrForTypo3\Solr\IndexQueue\FrontendHelper\UserGroupDetector::class
    );

    \ApacheSolrForTypo3\Solr\IndexQueue\FrontendHelper\Manager::registerFrontendHelper(
        'indexPage',
        \ApacheSolrForTypo3\Solr\IndexQueue\FrontendHelper\PageIndexer::class
    );

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    // page module plugin settings summary

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['solr_pi_results']['solr'] = \ApacheSolrForTypo3\Solr\Controller\Backend\PageModuleSummary::class . '->getSummary';

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    // register search components

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'access',
        \ApacheSolrForTypo3\Solr\Search\AccessComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'relevance',
        \ApacheSolrForTypo3\Solr\Search\RelevanceComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'sorting',
        \ApacheSolrForTypo3\Solr\Search\SortingComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'debug',
        \ApacheSolrForTypo3\Solr\Search\DebugComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'analysis',
        \ApacheSolrForTypo3\Solr\Search\AnalysisComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'highlighting',
        \ApacheSolrForTypo3\Solr\Search\HighlightingComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'spellchecking',
        \ApacheSolrForTypo3\Solr\Search\SpellcheckingComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'faceting',
        \ApacheSolrForTypo3\Solr\Search\FacetingComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'statistics',
        \ApacheSolrForTypo3\Solr\Search\StatisticsComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'lastSearches',
        \ApacheSolrForTypo3\Solr\Search\LastSearchesComponent::class
    );

    \ApacheSolrForTypo3\Solr\Search\SearchComponentManager::registerSearchComponent(
        'elevation',
        \ApacheSolrForTypo3\Solr\Search\ElevationComponent::class
    );

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    // adding scheduler tasks

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\ApacheSolrForTypo3\Solr\Task\OptimizeIndexTask::class] = [
        'extension' => 'solr',
        'title' => 'LLL:EXT:solr/Resources/Private/Language/locallang.xlf:optimizeindex_title',
        'description' => 'LLL:EXT:solr/Resources/Private/Language/locallang.xlf:optimizeindex_description',
        'additionalFields' => \ApacheSolrForTypo3\Solr\Task\OptimizeIndexTaskAdditionalFieldProvider::class,
    ];

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\ApacheSolrForTypo3\Solr\Task\ReIndexTask::class] = [
        'extension' => 'solr',
        'title' => 'LLL:EXT:solr/Resources/Private/Language/locallang.xlf:reindex_title',
        'description' => 'LLL:EXT:solr/Resources/Private/Language/locallang.xlf:reindex_description',
        'additionalFields' => \ApacheSolrForTypo3\Solr\Task\ReIndexTaskAdditionalFieldProvider::class,
    ];

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\ApacheSolrForTypo3\Solr\Task\IndexQueueWorkerTask::class] = [
        'extension' => 'solr',
        'title' => 'LLL:EXT:solr/Resources/Private/Language/locallang.xlf:indexqueueworker_title',
        'description' => 'LLL:EXT:solr/Resources/Private/Language/locallang.xlf:indexqueueworker_description',
        'additionalFields' => \ApacheSolrForTypo3\Solr\Task\IndexQueueWorkerTaskAdditionalFieldProvider::class,
    ];

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\ApacheSolrForTypo3\Solr\Task\EventQueueWorkerTask::class] = [
        'extension' => 'solr',
        'title' => 'LLL:EXT:solr/Resources/Private/Language/locallang_be.xlf:task.eventQueueWorkerTask.title',
        'description' => 'LLL:EXT:solr/Resources/Private/Language/locallang_be.xlf:task.eventQueueWorkerTask.description',
        'additionalFields' => \ApacheSolrForTypo3\Solr\Task\EventQueueWorkerTaskAdditionalFieldProvider::class,
    ];

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\TYPO3\CMS\Scheduler\Task\TableGarbageCollectionTask::class]['options']['tables']['tx_solr_statistics'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\TYPO3\CMS\Scheduler\Task\TableGarbageCollectionTask::class]['options']['tables']['tx_solr_statistics'] = [
            'dateField' => 'tstamp',
            'expirePeriod' => 180,
        ];
    }

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    // registering the eID scripts
    // TODO move to suggest form modifier
    $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['tx_solr_api'] = \ApacheSolrForTypo3\Solr\Eid\ApiEid::class . '::main';

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    // add custom Solr content objects

    $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'][\ApacheSolrForTypo3\Solr\ContentObject\Multivalue::CONTENT_OBJECT_NAME]
        = \ApacheSolrForTypo3\Solr\ContentObject\Multivalue::class;

    $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'][\ApacheSolrForTypo3\Solr\ContentObject\Content::CONTENT_OBJECT_NAME]
        = \ApacheSolrForTypo3\Solr\ContentObject\Content::class;

    $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'][\ApacheSolrForTypo3\Solr\ContentObject\Relation::CONTENT_OBJECT_NAME]
        = \ApacheSolrForTypo3\Solr\ContentObject\Relation::class;

    $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'][\ApacheSolrForTypo3\Solr\ContentObject\Classification::CONTENT_OBJECT_NAME]
        = \ApacheSolrForTypo3\Solr\ContentObject\Classification::class;

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    // Register cache for frequent searches

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr'] = [];
    }
    // Caching framework solr
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration'] = [];
    }

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration']['backend'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration']['backend'] = \TYPO3\CMS\Core\Cache\Backend\Typo3DatabaseBackend::class;
    }

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration']['options'])) {
        // default life time one day
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration']['options'] = ['defaultLifetime' => 60 * 60 * 24];
    }

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration']['groups'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_solr_configuration']['groups'] = ['all'];
    }

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #
    /* @var \ApacheSolrForTypo3\Solr\System\Configuration\ExtensionConfiguration $extensionConfiguration */
    $extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \ApacheSolrForTypo3\Solr\System\Configuration\ExtensionConfiguration::class
    );

    // cacheHash handling
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TYPO3_CONF_VARS'],
        [
            'FE' => [
                'cacheHash' => [
                    'excludedParameters' => $extensionConfiguration->getCacheHashExcludedParameters(),
                ],
            ],
        ]
    );

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['solr']['searchResultClassName '])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['solr']['searchResultClassName '] = \ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Result\SearchResult::class;
    }

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['solr']['searchResultSetClassName '])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['solr']['searchResultSetClassName '] = \ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\SearchResultSet::class;
    }

    if (!isset($GLOBALS['TYPO3_CONF_VARS']['LOG']['ApacheSolrForTypo3']['Solr']['writerConfiguration'])) {
        $context = \TYPO3\CMS\Core\Core\Environment::getContext();
        if ($context->isProduction()) {
            $logLevel = \TYPO3\CMS\Core\Log\LogLevel::ERROR;
        } elseif ($context->isDevelopment()) {
            $logLevel = \TYPO3\CMS\Core\Log\LogLevel::DEBUG;
        } else {
            $logLevel = \TYPO3\CMS\Core\Log\LogLevel::INFO;
        }
        $GLOBALS['TYPO3_CONF_VARS']['LOG']['ApacheSolrForTypo3']['Solr']['writerConfiguration'] = [
            $logLevel => [
                \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
                    'logFileInfix' => 'solr',
                ],
            ],
        ];
    }

    // ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- # ----- #

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Solr',
        'pi_results',
        [
            \ApacheSolrForTypo3\Solr\Controller\SearchController::class => 'results,form,detail',
        ],
        [
            \ApacheSolrForTypo3\Solr\Controller\SearchController::class => 'results',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Solr',
        'pi_search',
        [
            \ApacheSolrForTypo3\Solr\Controller\SearchController::class => 'form',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Solr',
        'pi_frequentlySearched',
        [
            \ApacheSolrForTypo3\Solr\Controller\SearchController::class => 'frequentlySearched',
        ],
        [
            \ApacheSolrForTypo3\Solr\Controller\SearchController::class => 'frequentlySearched',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Solr',
        'pi_suggest',
        [
            \ApacheSolrForTypo3\Solr\Controller\SuggestController::class => 'suggest',
        ],
        [
            \ApacheSolrForTypo3\Solr\Controller\SuggestController::class => 'suggest',
        ]
    );

    // add tsconfig
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import \'EXT:solr/Configuration/TSconfig/Page/Mod/Wizards/NewContentElement.tsconfig\'');

    // register the Fluid namespace 'solr' globally
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['solr'] = ['ApacheSolrForTypo3\\Solr\\ViewHelpers'];

    /*
     * Solr route enhancer configuration
     */
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['enhancers']['SolrFacetMaskAndCombineEnhancer'] =
        \ApacheSolrForTypo3\Solr\Routing\Enhancer\SolrFacetMaskAndCombineEnhancer::class;

    // add solr field to rootline fields
    if ($GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] === '') {
        $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] = 'no_search_sub_entries';
    } else {
        $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',no_search_sub_entries';
    }
})();

$isComposerMode = defined('TYPO3_COMPOSER_MODE') && TYPO3_COMPOSER_MODE;
if (!$isComposerMode) {
    // we load the autoloader for our libraries
    $dir = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('solr');
    require $dir . '/Resources/Private/Php/ComposerLibraries/vendor/autoload.php';
}
}


/**
 * Extension: tinyaccordion
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/tinyaccordion/ext_localconf.php
 */

namespace {

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Tinyaccordion',
            'Pi1',
            [
                \Quizpalme\Tinyaccordion\Controller\SelectionController::class => 'content, content_ui_accordion, news, news_ui_accordion, camaliga, camaliga_ui_accordion, page, page_ui_accordion'
            ],
            [
                \Quizpalme\Tinyaccordion\Controller\SelectionController::class => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
         'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					tinyaccordion {
                        iconIdentifier = ext-tinyaccordion-wizard-icon
						title = LLL:EXT:tinyaccordion/Resources/Private/Language/locallang_be.xml:tinyaccordion_title
						description = LLL:EXT:tinyaccordion/Resources/Private/Language/locallang_be.xml:tinyaccordion_plus_wiz_description
						tt_content_defValues {
							CType = list
							list_type = tinyaccordion_pi1
						}
					}
				}
				show = *
			}
	     }'
        );
    }
);

if (TYPO3_MODE === 'BE') {
    /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'ext-tinyaccordion-wizard-icon',
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:tinyaccordion/Resources/Public/Icons/ce_wiz.png']
    );
}
}


/**
 * Extension: vhs
 * File: C:/Inetpub/vhosts/bni.ci/httpdocs/typo3conf/ext/vhs/ext_localconf.php
 */

namespace {

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (class_exists(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)) {
    $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['vhs'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['vhs']['setup'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
    )->get('vhs');
} else {
    $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['vhs'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['vhs']['setup'] = unserialize($_EXTCONF);
}

if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['vhs']['setup']['disableAssetHandling']) || !$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['vhs']['setup']['disableAssetHandling']) {
    if (version_compare(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version(), '9.5', '<')) {
        // Replaced by RequestMiddlewares on TYPO3 9.5+
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'FluidTYPO3\\Vhs\\Service\\AssetService->buildAllUncached';
    }
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['usePageCache'][] = 'FluidTYPO3\\Vhs\\Service\\AssetService';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] = 'FluidTYPO3\\Vhs\\Service\\AssetService->clearCacheCommand';
}

if (FALSE === is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_main'] ?? null)) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_main'] = [
		'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
		'options' => [
			'defaultLifetime' => 804600
		],
		'groups' => ['pages', 'all']
	];
}

if (FALSE === is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_markdown'] ?? null)) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_markdown'] = [
		'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
		'options' => [
			'defaultLifetime' => 804600
		],
		'groups' => ['pages', 'all']
	];
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['v'] = ['FluidTYPO3\\Vhs\\ViewHelpers'];

// add navigtion hide to fix menu viewHelpers (e.g. breadcrumb)
$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= (TRUE === empty($GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields']) ? '' : ',') . 'nav_hide,shortcut,shortcut_mode';

// add and urltype to fix the rendering of external url doktypes
if (isset($GLOBALS['TCA']['pages']['columns']['urltype'])) {
    $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',url,urltype';
}
}


#