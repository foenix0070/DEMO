<?php return array (
  'HDNET\\Autoloader\\Loader\\SmartObjects' => 
  array (
    0 => 'HDNET\\Faq\\Domain\\Model\\Question',
    1 => 'HDNET\\Faq\\Domain\\Model\\QuestionCategory',
    2 => 'HDNET\\Faq\\Domain\\Model\\QuestionCategoryRelation',
  ),
  'HDNET\\Autoloader\\Loader\\ExtensionTypoScriptSetup' => 
  array (
    0 => 'config.tx_extbase.persistence.classes.HDNET\\Faq\\Domain\\Model\\QuestionCategoryRelation.mapping.tableName = tx_faq_mm_question_questioncategory',
  ),
  'HDNET\\Autoloader\\Loader\\Plugins' => 
  array (
    'Faq' => 
    array (
      'cache' => 
      array (
        'HDNET\\Faq\\Controller\\FaqController' => 'index',
      ),
      'noCache' => 
      array (
      ),
    ),
    'FaqAll' => 
    array (
      'cache' => 
      array (
        'HDNET\\Faq\\Controller\\FaqController' => 'all',
      ),
      'noCache' => 
      array (
      ),
    ),
    'FaqSingleCategory' => 
    array (
      'cache' => 
      array (
        'HDNET\\Faq\\Controller\\FaqController' => 'singleCategory',
      ),
      'noCache' => 
      array (
      ),
    ),
    'Question' => 
    array (
      'cache' => 
      array (
        'HDNET\\Faq\\Controller\\QuestionController' => 'index,submit',
      ),
      'noCache' => 
      array (
        'HDNET\\Faq\\Controller\\QuestionController' => 'submit',
      ),
    ),
  ),
  'HDNET\\Autoloader\\Loader\\FlexForms' => 
  array (
    0 => 
    array (
      'pluginSignature' => 'faq_faq',
      'path' => 'FILE:EXT:faq/Configuration/FlexForms/Faq.xml',
    ),
    1 => 
    array (
      'pluginSignature' => 'faq_faqsinglecategory',
      'path' => 'FILE:EXT:faq/Configuration/FlexForms/FaqSingleCategory.xml',
    ),
    2 => 
    array (
      'pluginSignature' => 'faq_question',
      'path' => 'FILE:EXT:faq/Configuration/FlexForms/Question.xml',
    ),
  ),
  'HDNET\\Autoloader\\Loader\\StaticTyposcript' => 
  array (
    0 => 
    array (
      'path' => 'Configuration/TypoScript/',
      'title' => 'Faq',
    ),
  ),
  'HDNET\\Autoloader\\Loader\\ExtensionId' => 
  array (
  ),
);