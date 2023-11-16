<?php

class List_action_index_dea31b5220cb7d0c5d0fbbeea1ce44532ed6680b extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getLayoutName(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
return (string) 'main';
}
public function hasLayout() {
return TRUE;
}
public function addCompiledNamespaces(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$renderingContext->getViewHelperResolver()->addNamespaces(array (
  'core' => 
  array (
    0 => 'TYPO3\\CMS\\Core\\ViewHelpers',
  ),
  'f' => 
  array (
    0 => 'TYPO3Fluid\\Fluid\\ViewHelpers',
    1 => 'TYPO3\\CMS\\Fluid\\ViewHelpers',
  ),
  'formvh' => 
  array (
    0 => 'TYPO3\\CMS\\Form\\ViewHelpers',
  ),
  'bk2k' => 
  array (
    0 => 'BK2K\\BootstrapPackage\\ViewHelpers',
  ),
  'solr' => 
  array (
    0 => 'ApacheSolrForTypo3\\Solr\\ViewHelpers',
  ),
  'v' => 
  array (
    0 => 'FluidTYPO3\\Vhs\\ViewHelpers',
  ),
  'em' => 
  array (
    0 => 'TYPO3\\CMS\\Extensionmanager\\ViewHelpers',
  ),
));
}

/**
 * section content
 */
public function section_040f06fd774092478d450774f5ba30c5da78acc8(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '

    <h1>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments1 = array();
$arguments1['key'] = NULL;
$arguments1['id'] = NULL;
$arguments1['default'] = NULL;
$arguments1['arguments'] = NULL;
$arguments1['extensionName'] = NULL;
$arguments1['languageKey'] = NULL;
$arguments1['alternativeLanguageKeys'] = NULL;
$arguments1['key'] = 'installedExtensions';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext)]);

$output0 .= '</h1>
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure4 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments3 = array();
$arguments3['section'] = NULL;
$arguments3['partial'] = NULL;
$arguments3['delegate'] = NULL;
$arguments3['renderable'] = NULL;
$arguments3['arguments'] = array (
);
$arguments3['optional'] = false;
$arguments3['default'] = NULL;
$arguments3['contentAs'] = NULL;
$arguments3['debug'] = true;
$arguments3['partial'] = 'List/UploadForm';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments3, $renderChildrenClosure4, $renderingContext);

$output0 .= '
    <form>
        <div class="row row-cols-auto align-items-end justify-content-between g-3">
            <div class="col">
                <div class="input-group">
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper
$renderChildrenClosure6 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments5 = array();
$arguments5['additionalAttributes'] = NULL;
$arguments5['data'] = NULL;
$arguments5['aria'] = NULL;
$arguments5['name'] = NULL;
$arguments5['value'] = NULL;
$arguments5['property'] = NULL;
$arguments5['autofocus'] = NULL;
$arguments5['disabled'] = NULL;
$arguments5['maxlength'] = NULL;
$arguments5['readonly'] = NULL;
$arguments5['size'] = NULL;
$arguments5['placeholder'] = NULL;
$arguments5['pattern'] = NULL;
$arguments5['errorClass'] = 'f3-form-error';
$arguments5['class'] = NULL;
$arguments5['dir'] = NULL;
$arguments5['id'] = NULL;
$arguments5['lang'] = NULL;
$arguments5['style'] = NULL;
$arguments5['title'] = NULL;
$arguments5['accesskey'] = NULL;
$arguments5['tabindex'] = NULL;
$arguments5['onclick'] = NULL;
$arguments5['required'] = false;
$arguments5['type'] = 'text';
$arguments5['name'] = 'Tx_Extensionmanager_extensionkey';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure8 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments7 = array();
$arguments7['key'] = NULL;
$arguments7['id'] = NULL;
$arguments7['default'] = NULL;
$arguments7['arguments'] = NULL;
$arguments7['extensionName'] = NULL;
$arguments7['languageKey'] = NULL;
$arguments7['alternativeLanguageKeys'] = NULL;
$arguments7['key'] = 'extensionList.search';
$arguments5['placeholder'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments7, $renderChildrenClosure8, $renderingContext);
$arguments5['id'] = 'Tx_Extensionmanager_extensionkey';
$array9 = array (
);$arguments5['value'] = $renderingContext->getVariableProvider()->getByPath('search', $array9);
$arguments5['class'] = 'form-control extension-list-search';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper::renderStatic($arguments5, $renderChildrenClosure6, $renderingContext);

$output0 .= '
                    <button type="submit" class="btn btn-default">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure11 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments10 = array();
$arguments10['identifier'] = NULL;
$arguments10['size'] = 'small';
$arguments10['overlay'] = NULL;
$arguments10['state'] = 'default';
$arguments10['alternativeMarkupIdentifier'] = NULL;
$arguments10['identifier'] = 'actions-search';

$output0 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments10, $renderChildrenClosure11, $renderingContext);

$output0 .= '</button>
                </div>
            </div>
            <div class="col">
                <div class="btn-group">
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure13 = function() use ($renderingContext, $self) {
$output23 = '';

$output23 .= '
                        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure25 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments24 = array();
$arguments24['key'] = NULL;
$arguments24['id'] = NULL;
$arguments24['default'] = NULL;
$arguments24['arguments'] = NULL;
$arguments24['extensionName'] = NULL;
$arguments24['languageKey'] = NULL;
$arguments24['alternativeLanguageKeys'] = NULL;
$arguments24['key'] = 'extensionList.filter.showAll';

$output23 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments24, $renderChildrenClosure25, $renderingContext)]);

$output23 .= '
                    ';
return $output23;
};
$arguments12 = array();
$arguments12['additionalAttributes'] = NULL;
$arguments12['data'] = NULL;
$arguments12['aria'] = NULL;
$arguments12['class'] = NULL;
$arguments12['dir'] = NULL;
$arguments12['id'] = NULL;
$arguments12['lang'] = NULL;
$arguments12['style'] = NULL;
$arguments12['title'] = NULL;
$arguments12['accesskey'] = NULL;
$arguments12['tabindex'] = NULL;
$arguments12['onclick'] = NULL;
$arguments12['name'] = NULL;
$arguments12['rel'] = NULL;
$arguments12['rev'] = NULL;
$arguments12['target'] = NULL;
$arguments12['action'] = NULL;
$arguments12['controller'] = NULL;
$arguments12['extensionName'] = NULL;
$arguments12['pluginName'] = NULL;
$arguments12['pageUid'] = NULL;
$arguments12['pageType'] = NULL;
$arguments12['noCache'] = NULL;
$arguments12['section'] = NULL;
$arguments12['format'] = NULL;
$arguments12['linkAccessRestrictedPages'] = NULL;
$arguments12['additionalParams'] = NULL;
$arguments12['absolute'] = NULL;
$arguments12['addQueryString'] = NULL;
$arguments12['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments12['addQueryStringMethod'] = NULL;
$arguments12['arguments'] = NULL;
$arguments12['action'] = 'index';
$arguments12['controller'] = 'List';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure15 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments14 = array();
$arguments14['key'] = NULL;
$arguments14['id'] = NULL;
$arguments14['default'] = NULL;
$arguments14['arguments'] = NULL;
$arguments14['extensionName'] = NULL;
$arguments14['languageKey'] = NULL;
$arguments14['alternativeLanguageKeys'] = NULL;
$arguments14['key'] = 'extensionList.filter.showAll';
$arguments12['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments14, $renderChildrenClosure15, $renderingContext);
// Rendering Array
$array16 = array();
$array16['filter'] = '';
$arguments12['arguments'] = $array16;
$output17 = '';

$output17 .= 'btn btn-default ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure19 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments18 = array();
$arguments18['then'] = NULL;
$arguments18['else'] = NULL;
$arguments18['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array20 = array();
$array21 = array (
);$array20['0'] = $renderingContext->getVariableProvider()->getByPath('typeFilter', $array21);
$array20['1'] = ' == All';

$expression22 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == "All");};
$arguments18['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression22(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array20)
					),
					$renderingContext
				);
$arguments18['then'] = 'active';

$output17 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments18, $renderChildrenClosure19, $renderingContext);
$arguments12['class'] = $output17;
$arguments12['style'] = 'width: 80px;';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments12, $renderChildrenClosure13, $renderingContext);

$output0 .= '
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure27 = function() use ($renderingContext, $self) {
$output37 = '';

$output37 .= '
                        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure39 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments38 = array();
$arguments38['key'] = NULL;
$arguments38['id'] = NULL;
$arguments38['default'] = NULL;
$arguments38['arguments'] = NULL;
$arguments38['extensionName'] = NULL;
$arguments38['languageKey'] = NULL;
$arguments38['alternativeLanguageKeys'] = NULL;
$arguments38['key'] = 'extensionList.filter.showSystemExtensions';

$output37 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments38, $renderChildrenClosure39, $renderingContext)]);

$output37 .= '
                    ';
return $output37;
};
$arguments26 = array();
$arguments26['additionalAttributes'] = NULL;
$arguments26['data'] = NULL;
$arguments26['aria'] = NULL;
$arguments26['class'] = NULL;
$arguments26['dir'] = NULL;
$arguments26['id'] = NULL;
$arguments26['lang'] = NULL;
$arguments26['style'] = NULL;
$arguments26['title'] = NULL;
$arguments26['accesskey'] = NULL;
$arguments26['tabindex'] = NULL;
$arguments26['onclick'] = NULL;
$arguments26['name'] = NULL;
$arguments26['rel'] = NULL;
$arguments26['rev'] = NULL;
$arguments26['target'] = NULL;
$arguments26['action'] = NULL;
$arguments26['controller'] = NULL;
$arguments26['extensionName'] = NULL;
$arguments26['pluginName'] = NULL;
$arguments26['pageUid'] = NULL;
$arguments26['pageType'] = NULL;
$arguments26['noCache'] = NULL;
$arguments26['section'] = NULL;
$arguments26['format'] = NULL;
$arguments26['linkAccessRestrictedPages'] = NULL;
$arguments26['additionalParams'] = NULL;
$arguments26['absolute'] = NULL;
$arguments26['addQueryString'] = NULL;
$arguments26['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments26['addQueryStringMethod'] = NULL;
$arguments26['arguments'] = NULL;
$arguments26['action'] = 'index';
$arguments26['controller'] = 'List';
// Rendering Array
$array28 = array();
$array28['filter'] = 'System';
$arguments26['arguments'] = $array28;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure30 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments29 = array();
$arguments29['key'] = NULL;
$arguments29['id'] = NULL;
$arguments29['default'] = NULL;
$arguments29['arguments'] = NULL;
$arguments29['extensionName'] = NULL;
$arguments29['languageKey'] = NULL;
$arguments29['alternativeLanguageKeys'] = NULL;
$arguments29['key'] = 'extensionList.filter.showSystemExtensions';
$arguments26['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments29, $renderChildrenClosure30, $renderingContext);
$output31 = '';

$output31 .= 'btn btn-default ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure33 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments32 = array();
$arguments32['then'] = NULL;
$arguments32['else'] = NULL;
$arguments32['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array34 = array();
$array35 = array (
);$array34['0'] = $renderingContext->getVariableProvider()->getByPath('typeFilter', $array35);
$array34['1'] = ' == System';

$expression36 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == "System");};
$arguments32['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression36(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array34)
					),
					$renderingContext
				);
$arguments32['then'] = 'active';

$output31 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments32, $renderChildrenClosure33, $renderingContext);
$arguments26['class'] = $output31;
$arguments26['style'] = 'width: 80px;';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments26, $renderChildrenClosure27, $renderingContext);

$output0 .= '
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure41 = function() use ($renderingContext, $self) {
$output51 = '';

$output51 .= '
                        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure53 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments52 = array();
$arguments52['key'] = NULL;
$arguments52['id'] = NULL;
$arguments52['default'] = NULL;
$arguments52['arguments'] = NULL;
$arguments52['extensionName'] = NULL;
$arguments52['languageKey'] = NULL;
$arguments52['alternativeLanguageKeys'] = NULL;
$arguments52['key'] = 'extensionList.filter.showLocalExtensions';

$output51 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments52, $renderChildrenClosure53, $renderingContext)]);

$output51 .= '
                    ';
return $output51;
};
$arguments40 = array();
$arguments40['additionalAttributes'] = NULL;
$arguments40['data'] = NULL;
$arguments40['aria'] = NULL;
$arguments40['class'] = NULL;
$arguments40['dir'] = NULL;
$arguments40['id'] = NULL;
$arguments40['lang'] = NULL;
$arguments40['style'] = NULL;
$arguments40['title'] = NULL;
$arguments40['accesskey'] = NULL;
$arguments40['tabindex'] = NULL;
$arguments40['onclick'] = NULL;
$arguments40['name'] = NULL;
$arguments40['rel'] = NULL;
$arguments40['rev'] = NULL;
$arguments40['target'] = NULL;
$arguments40['action'] = NULL;
$arguments40['controller'] = NULL;
$arguments40['extensionName'] = NULL;
$arguments40['pluginName'] = NULL;
$arguments40['pageUid'] = NULL;
$arguments40['pageType'] = NULL;
$arguments40['noCache'] = NULL;
$arguments40['section'] = NULL;
$arguments40['format'] = NULL;
$arguments40['linkAccessRestrictedPages'] = NULL;
$arguments40['additionalParams'] = NULL;
$arguments40['absolute'] = NULL;
$arguments40['addQueryString'] = NULL;
$arguments40['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments40['addQueryStringMethod'] = NULL;
$arguments40['arguments'] = NULL;
$arguments40['action'] = 'index';
$arguments40['controller'] = 'List';
// Rendering Array
$array42 = array();
$array42['filter'] = 'Local';
$arguments40['arguments'] = $array42;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure44 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments43 = array();
$arguments43['key'] = NULL;
$arguments43['id'] = NULL;
$arguments43['default'] = NULL;
$arguments43['arguments'] = NULL;
$arguments43['extensionName'] = NULL;
$arguments43['languageKey'] = NULL;
$arguments43['alternativeLanguageKeys'] = NULL;
$arguments43['key'] = 'extensionList.filter.showLocalExtensions';
$arguments40['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments43, $renderChildrenClosure44, $renderingContext);
$output45 = '';

$output45 .= 'btn btn-default ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure47 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments46 = array();
$arguments46['then'] = NULL;
$arguments46['else'] = NULL;
$arguments46['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array48 = array();
$array49 = array (
);$array48['0'] = $renderingContext->getVariableProvider()->getByPath('typeFilter', $array49);
$array48['1'] = ' == Local';

$expression50 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == "Local");};
$arguments46['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression50(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array48)
					),
					$renderingContext
				);
$arguments46['then'] = 'active';

$output45 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments46, $renderChildrenClosure47, $renderingContext);
$arguments40['class'] = $output45;
$arguments40['style'] = 'width: 80px;';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments40, $renderChildrenClosure41, $renderingContext);

$output0 .= '
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="table-fit">
        <table id="typo3-extension-list" class="table table-striped table-hover extension-list">
            <thead>
                <tr>
                    <th ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure55 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments54 = array();
$arguments54['then'] = NULL;
$arguments54['else'] = NULL;
$arguments54['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array56 = array();
$array57 = array (
);$array56['0'] = $renderingContext->getVariableProvider()->getByPath('sortByUpdate', $array57);

$expression58 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments54['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression58(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array56)
					),
					$renderingContext
				);
$arguments54['then'] = 'data-sort-default';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments54, $renderChildrenClosure55, $renderingContext);

$output0 .= ' title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure60 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments59 = array();
$arguments59['key'] = NULL;
$arguments59['id'] = NULL;
$arguments59['default'] = NULL;
$arguments59['arguments'] = NULL;
$arguments59['extensionName'] = NULL;
$arguments59['languageKey'] = NULL;
$arguments59['alternativeLanguageKeys'] = NULL;
$arguments59['key'] = 'extensionList.header.title.update';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments59, $renderChildrenClosure60, $renderingContext)]);

$output0 .= '">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure62 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments61 = array();
$arguments61['key'] = NULL;
$arguments61['id'] = NULL;
$arguments61['default'] = NULL;
$arguments61['arguments'] = NULL;
$arguments61['extensionName'] = NULL;
$arguments61['languageKey'] = NULL;
$arguments61['alternativeLanguageKeys'] = NULL;
$arguments61['key'] = 'extensionList.header.update';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments61, $renderChildrenClosure62, $renderingContext)]);

$output0 .= '</th>
                    <th title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure64 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments63 = array();
$arguments63['key'] = NULL;
$arguments63['id'] = NULL;
$arguments63['default'] = NULL;
$arguments63['arguments'] = NULL;
$arguments63['extensionName'] = NULL;
$arguments63['languageKey'] = NULL;
$arguments63['alternativeLanguageKeys'] = NULL;
$arguments63['key'] = 'extensionList.header.title.activate';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments63, $renderChildrenClosure64, $renderingContext)]);

$output0 .= '">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure66 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments65 = array();
$arguments65['key'] = NULL;
$arguments65['id'] = NULL;
$arguments65['default'] = NULL;
$arguments65['arguments'] = NULL;
$arguments65['extensionName'] = NULL;
$arguments65['languageKey'] = NULL;
$arguments65['alternativeLanguageKeys'] = NULL;
$arguments65['key'] = 'extensionList.header.activate';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments65, $renderChildrenClosure66, $renderingContext)]);

$output0 .= '</th>
                    <th data-filterable>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure68 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments67 = array();
$arguments67['key'] = NULL;
$arguments67['id'] = NULL;
$arguments67['default'] = NULL;
$arguments67['arguments'] = NULL;
$arguments67['extensionName'] = NULL;
$arguments67['languageKey'] = NULL;
$arguments67['alternativeLanguageKeys'] = NULL;
$arguments67['key'] = 'extensionList.header.extensionName';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments67, $renderChildrenClosure68, $renderingContext)]);

$output0 .= '</th>
                    <th ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure70 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments69 = array();
$arguments69['then'] = NULL;
$arguments69['else'] = NULL;
$arguments69['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array71 = array();
$array71['0'] = '!';
$array72 = array (
);$array71['1'] = $renderingContext->getVariableProvider()->getByPath('sortByUpdate', $array72);

$expression73 = function($context) {return !(TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node1"]));};
$arguments69['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression73(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array71)
					),
					$renderingContext
				);
$arguments69['then'] = 'data-sort-default';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments69, $renderChildrenClosure70, $renderingContext);

$output0 .= ' data-filterable>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure75 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments74 = array();
$arguments74['key'] = NULL;
$arguments74['id'] = NULL;
$arguments74['default'] = NULL;
$arguments74['arguments'] = NULL;
$arguments74['extensionName'] = NULL;
$arguments74['languageKey'] = NULL;
$arguments74['alternativeLanguageKeys'] = NULL;
$arguments74['key'] = 'extensionList.header.extensionKey';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments74, $renderChildrenClosure75, $renderingContext)]);

$output0 .= '</th>
                    <th data-sort-method="dotsep">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure77 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments76 = array();
$arguments76['key'] = NULL;
$arguments76['id'] = NULL;
$arguments76['default'] = NULL;
$arguments76['arguments'] = NULL;
$arguments76['extensionName'] = NULL;
$arguments76['languageKey'] = NULL;
$arguments76['alternativeLanguageKeys'] = NULL;
$arguments76['key'] = 'extensionList.header.extensionVersion';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments76, $renderChildrenClosure77, $renderingContext)]);

$output0 .= '</th>
                    <th data-sort-method="none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure79 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments78 = array();
$arguments78['key'] = NULL;
$arguments78['id'] = NULL;
$arguments78['default'] = NULL;
$arguments78['arguments'] = NULL;
$arguments78['extensionName'] = NULL;
$arguments78['languageKey'] = NULL;
$arguments78['alternativeLanguageKeys'] = NULL;
$arguments78['key'] = 'extensionList.header.extensionState';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments78, $renderChildrenClosure79, $renderingContext)]);

$output0 .= '</th>
                    <th>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure81 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments80 = array();
$arguments80['key'] = NULL;
$arguments80['id'] = NULL;
$arguments80['default'] = NULL;
$arguments80['arguments'] = NULL;
$arguments80['extensionName'] = NULL;
$arguments80['languageKey'] = NULL;
$arguments80['alternativeLanguageKeys'] = NULL;
$arguments80['key'] = 'extensionList.header.extensionType';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments80, $renderChildrenClosure81, $renderingContext)]);

$output0 .= '</th>
                    <th data-sort-method="none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure83 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments82 = array();
$arguments82['key'] = NULL;
$arguments82['id'] = NULL;
$arguments82['default'] = NULL;
$arguments82['arguments'] = NULL;
$arguments82['extensionName'] = NULL;
$arguments82['languageKey'] = NULL;
$arguments82['alternativeLanguageKeys'] = NULL;
$arguments82['key'] = 'extensionList.header.extensionActions';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments82, $renderChildrenClosure83, $renderingContext)]);

$output0 .= '</th>
                </tr>
            </thead>
            <tbody>
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure85 = function() use ($renderingContext, $self) {
$output87 = '';

$output87 .= '
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure89 = function() use ($renderingContext, $self) {
$output117 = '';

$output117 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure119 = function() use ($renderingContext, $self) {
$output120 = '';

$output120 .= '
                            <tr role="row" id="';
$array121 = array (
);
$output120 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array121)]);

$output120 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure123 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments122 = array();
$arguments122['then'] = NULL;
$arguments122['else'] = NULL;
$arguments122['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array124 = array();
$array125 = array (
);$array124['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array125);
$array124['1'] = ' == -1';

$expression126 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -1);};
$arguments122['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression126(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array124)
					),
					$renderingContext
				);
$arguments122['then'] = 'insecure';

$output120 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments122, $renderChildrenClosure123, $renderingContext);
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure128 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments127 = array();
$arguments127['then'] = NULL;
$arguments127['else'] = NULL;
$arguments127['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array129 = array();
$array130 = array (
);$array129['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array130);
$array129['1'] = ' == -2';

$expression131 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -2);};
$arguments127['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression131(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array129)
					),
					$renderingContext
				);
$arguments127['then'] = 'outdated';

$output120 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments127, $renderChildrenClosure128, $renderingContext);

$output120 .= ' ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure133 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments132 = array();
$arguments132['then'] = NULL;
$arguments132['else'] = NULL;
$arguments132['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array134 = array();
$array135 = array (
);$array134['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array135);

$expression136 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments132['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression136(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array134)
					),
					$renderingContext
				);
$arguments132['then'] = '';
$arguments132['else'] = 'inactive';

$output120 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments132, $renderChildrenClosure133, $renderingContext);

$output120 .= '">
                        ';
return $output120;
};
$arguments118 = array();

$output117 .= '';

$output117 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure138 = function() use ($renderingContext, $self) {
$output139 = '';

$output139 .= '
                            <tr role="row" id="';
$array140 = array (
);
$output139 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array140)]);

$output139 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure142 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments141 = array();
$arguments141['then'] = NULL;
$arguments141['else'] = NULL;
$arguments141['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array143 = array();
$array144 = array (
);$array143['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array144);

$expression145 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments141['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression145(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array143)
					),
					$renderingContext
				);
$arguments141['then'] = '';
$arguments141['else'] = 'inactive';

$output139 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments141, $renderChildrenClosure142, $renderingContext);

$output139 .= '">
                        ';
return $output139;
};
$arguments137 = array();
$arguments137['if'] = NULL;

$output117 .= '';

$output117 .= '
                    ';
return $output117;
};
$arguments88 = array();
$arguments88['then'] = NULL;
$arguments88['else'] = NULL;
$arguments88['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array114 = array();
$array115 = array (
);$array114['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject', $array115);

$expression116 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments88['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression116(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array114)
					),
					$renderingContext
				);
$arguments88['__thenClosure'] = function() use ($renderingContext, $self) {
$output90 = '';

$output90 .= '
                            <tr role="row" id="';
$array91 = array (
);
$output90 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array91)]);

$output90 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure93 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments92 = array();
$arguments92['then'] = NULL;
$arguments92['else'] = NULL;
$arguments92['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array94 = array();
$array95 = array (
);$array94['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array95);
$array94['1'] = ' == -1';

$expression96 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -1);};
$arguments92['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression96(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array94)
					),
					$renderingContext
				);
$arguments92['then'] = 'insecure';

$output90 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments92, $renderChildrenClosure93, $renderingContext);
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure98 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments97 = array();
$arguments97['then'] = NULL;
$arguments97['else'] = NULL;
$arguments97['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array99 = array();
$array100 = array (
);$array99['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array100);
$array99['1'] = ' == -2';

$expression101 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -2);};
$arguments97['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression101(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array99)
					),
					$renderingContext
				);
$arguments97['then'] = 'outdated';

$output90 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments97, $renderChildrenClosure98, $renderingContext);

$output90 .= ' ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure103 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments102 = array();
$arguments102['then'] = NULL;
$arguments102['else'] = NULL;
$arguments102['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array104 = array();
$array105 = array (
);$array104['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array105);

$expression106 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments102['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression106(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array104)
					),
					$renderingContext
				);
$arguments102['then'] = '';
$arguments102['else'] = 'inactive';

$output90 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments102, $renderChildrenClosure103, $renderingContext);

$output90 .= '">
                        ';
return $output90;
};
$arguments88['__elseClosures'][] = function() use ($renderingContext, $self) {
$output107 = '';

$output107 .= '
                            <tr role="row" id="';
$array108 = array (
);
$output107 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array108)]);

$output107 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure110 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments109 = array();
$arguments109['then'] = NULL;
$arguments109['else'] = NULL;
$arguments109['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array111 = array();
$array112 = array (
);$array111['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array112);

$expression113 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments109['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression113(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array111)
					),
					$renderingContext
				);
$arguments109['then'] = '';
$arguments109['else'] = 'inactive';

$output107 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments109, $renderChildrenClosure110, $renderingContext);

$output107 .= '">
                        ';
return $output107;
};

$output87 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments88, $renderChildrenClosure89, $renderingContext);

$output87 .= '
                    <td data-sort="';
$array146 = array (
);
$output87 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.sortUpdate', $array146)]);

$output87 .= '">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure148 = function() use ($renderingContext, $self) {
$output152 = '';

$output152 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure154 = function() use ($renderingContext, $self) {
$output178 = '';

$output178 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure180 = function() use ($renderingContext, $self) {
$output181 = '';

$output181 .= '
                                    <span class="btn btn-default disabled" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure183 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments182 = array();
$arguments182['key'] = NULL;
$arguments182['id'] = NULL;
$arguments182['default'] = NULL;
$arguments182['arguments'] = NULL;
$arguments182['extensionName'] = NULL;
$arguments182['languageKey'] = NULL;
$arguments182['alternativeLanguageKeys'] = NULL;
$arguments182['key'] = 'extensionList.updateDisabled';

$output181 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments182, $renderChildrenClosure183, $renderingContext)]);

$output181 .= '">
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure185 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments184 = array();
$arguments184['identifier'] = NULL;
$arguments184['size'] = 'small';
$arguments184['overlay'] = NULL;
$arguments184['state'] = 'default';
$arguments184['alternativeMarkupIdentifier'] = NULL;
$arguments184['identifier'] = 'actions-system-extension-update';

$output181 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments184, $renderChildrenClosure185, $renderingContext);

$output181 .= '
                                    </span>
                                ';
return $output181;
};
$arguments179 = array();

$output178 .= '';

$output178 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure187 = function() use ($renderingContext, $self) {
$output188 = '';

$output188 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure190 = function() use ($renderingContext, $self) {
$output200 = '';

$output200 .= '
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure202 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments201 = array();
$arguments201['identifier'] = NULL;
$arguments201['size'] = 'small';
$arguments201['overlay'] = NULL;
$arguments201['state'] = 'default';
$arguments201['alternativeMarkupIdentifier'] = NULL;
$arguments201['identifier'] = 'actions-system-extension-update';

$output200 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments201, $renderChildrenClosure202, $renderingContext);

$output200 .= '
                                    ';
return $output200;
};
$arguments189 = array();
$arguments189['additionalAttributes'] = NULL;
$arguments189['data'] = NULL;
$arguments189['aria'] = NULL;
$arguments189['class'] = NULL;
$arguments189['dir'] = NULL;
$arguments189['id'] = NULL;
$arguments189['lang'] = NULL;
$arguments189['style'] = NULL;
$arguments189['title'] = NULL;
$arguments189['accesskey'] = NULL;
$arguments189['tabindex'] = NULL;
$arguments189['onclick'] = NULL;
$arguments189['name'] = NULL;
$arguments189['rel'] = NULL;
$arguments189['rev'] = NULL;
$arguments189['target'] = NULL;
$arguments189['action'] = NULL;
$arguments189['controller'] = NULL;
$arguments189['extensionName'] = NULL;
$arguments189['pluginName'] = NULL;
$arguments189['pageUid'] = NULL;
$arguments189['pageType'] = NULL;
$arguments189['noCache'] = NULL;
$arguments189['section'] = NULL;
$arguments189['format'] = NULL;
$arguments189['linkAccessRestrictedPages'] = NULL;
$arguments189['additionalParams'] = NULL;
$arguments189['absolute'] = NULL;
$arguments189['addQueryString'] = NULL;
$arguments189['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments189['addQueryStringMethod'] = NULL;
$arguments189['arguments'] = NULL;
$arguments189['action'] = 'updateCommentForUpdatableVersions';
$arguments189['class'] = 'btn btn-default';
// Rendering Array
$array191 = array();
$array191['data-action'] = 'update-extension';
$arguments189['additionalAttributes'] = $array191;
$arguments189['format'] = 'json';
$arguments189['controller'] = 'Download';
// Rendering Array
$array192 = array();
$array193 = array (
);$array192['extension'] = $renderingContext->getVariableProvider()->getByPath('extension.key', $array193);
$array194 = array (
);$array192['integerVersionStart'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.integerVersion', $array194);
$array195 = array (
);$array192['integerVersionStop'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.integerVersion', $array195);
$arguments189['arguments'] = $array192;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure197 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments196 = array();
$arguments196['key'] = NULL;
$arguments196['id'] = NULL;
$arguments196['default'] = NULL;
$arguments196['arguments'] = NULL;
$arguments196['extensionName'] = NULL;
$arguments196['languageKey'] = NULL;
$arguments196['alternativeLanguageKeys'] = NULL;
$arguments196['key'] = 'extensionList.updateToVersion';
// Rendering Array
$array198 = array();
$array199 = array (
);$array198['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.version', $array199);
$arguments196['arguments'] = $array198;
$arguments189['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments196, $renderChildrenClosure197, $renderingContext);

$output188 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments189, $renderChildrenClosure190, $renderingContext);

$output188 .= '
                                ';
return $output188;
};
$arguments186 = array();
$arguments186['if'] = NULL;

$output178 .= '';

$output178 .= '
                            ';
return $output178;
};
$arguments153 = array();
$arguments153['then'] = NULL;
$arguments153['else'] = NULL;
$arguments153['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array175 = array();
$array176 = array (
);$array175['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateIsBlocked', $array176);

$expression177 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments153['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression177(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array175)
					),
					$renderingContext
				);
$arguments153['__thenClosure'] = function() use ($renderingContext, $self) {
$output155 = '';

$output155 .= '
                                    <span class="btn btn-default disabled" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure157 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments156 = array();
$arguments156['key'] = NULL;
$arguments156['id'] = NULL;
$arguments156['default'] = NULL;
$arguments156['arguments'] = NULL;
$arguments156['extensionName'] = NULL;
$arguments156['languageKey'] = NULL;
$arguments156['alternativeLanguageKeys'] = NULL;
$arguments156['key'] = 'extensionList.updateDisabled';

$output155 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments156, $renderChildrenClosure157, $renderingContext)]);

$output155 .= '">
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure159 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments158 = array();
$arguments158['identifier'] = NULL;
$arguments158['size'] = 'small';
$arguments158['overlay'] = NULL;
$arguments158['state'] = 'default';
$arguments158['alternativeMarkupIdentifier'] = NULL;
$arguments158['identifier'] = 'actions-system-extension-update';

$output155 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments158, $renderChildrenClosure159, $renderingContext);

$output155 .= '
                                    </span>
                                ';
return $output155;
};
$arguments153['__elseClosures'][] = function() use ($renderingContext, $self) {
$output160 = '';

$output160 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure162 = function() use ($renderingContext, $self) {
$output172 = '';

$output172 .= '
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure174 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments173 = array();
$arguments173['identifier'] = NULL;
$arguments173['size'] = 'small';
$arguments173['overlay'] = NULL;
$arguments173['state'] = 'default';
$arguments173['alternativeMarkupIdentifier'] = NULL;
$arguments173['identifier'] = 'actions-system-extension-update';

$output172 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments173, $renderChildrenClosure174, $renderingContext);

$output172 .= '
                                    ';
return $output172;
};
$arguments161 = array();
$arguments161['additionalAttributes'] = NULL;
$arguments161['data'] = NULL;
$arguments161['aria'] = NULL;
$arguments161['class'] = NULL;
$arguments161['dir'] = NULL;
$arguments161['id'] = NULL;
$arguments161['lang'] = NULL;
$arguments161['style'] = NULL;
$arguments161['title'] = NULL;
$arguments161['accesskey'] = NULL;
$arguments161['tabindex'] = NULL;
$arguments161['onclick'] = NULL;
$arguments161['name'] = NULL;
$arguments161['rel'] = NULL;
$arguments161['rev'] = NULL;
$arguments161['target'] = NULL;
$arguments161['action'] = NULL;
$arguments161['controller'] = NULL;
$arguments161['extensionName'] = NULL;
$arguments161['pluginName'] = NULL;
$arguments161['pageUid'] = NULL;
$arguments161['pageType'] = NULL;
$arguments161['noCache'] = NULL;
$arguments161['section'] = NULL;
$arguments161['format'] = NULL;
$arguments161['linkAccessRestrictedPages'] = NULL;
$arguments161['additionalParams'] = NULL;
$arguments161['absolute'] = NULL;
$arguments161['addQueryString'] = NULL;
$arguments161['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments161['addQueryStringMethod'] = NULL;
$arguments161['arguments'] = NULL;
$arguments161['action'] = 'updateCommentForUpdatableVersions';
$arguments161['class'] = 'btn btn-default';
// Rendering Array
$array163 = array();
$array163['data-action'] = 'update-extension';
$arguments161['additionalAttributes'] = $array163;
$arguments161['format'] = 'json';
$arguments161['controller'] = 'Download';
// Rendering Array
$array164 = array();
$array165 = array (
);$array164['extension'] = $renderingContext->getVariableProvider()->getByPath('extension.key', $array165);
$array166 = array (
);$array164['integerVersionStart'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.integerVersion', $array166);
$array167 = array (
);$array164['integerVersionStop'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.integerVersion', $array167);
$arguments161['arguments'] = $array164;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure169 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments168 = array();
$arguments168['key'] = NULL;
$arguments168['id'] = NULL;
$arguments168['default'] = NULL;
$arguments168['arguments'] = NULL;
$arguments168['extensionName'] = NULL;
$arguments168['languageKey'] = NULL;
$arguments168['alternativeLanguageKeys'] = NULL;
$arguments168['key'] = 'extensionList.updateToVersion';
// Rendering Array
$array170 = array();
$array171 = array (
);$array170['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.version', $array171);
$arguments168['arguments'] = $array170;
$arguments161['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments168, $renderChildrenClosure169, $renderingContext);

$output160 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments161, $renderChildrenClosure162, $renderingContext);

$output160 .= '
                                ';
return $output160;
};

$output152 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments153, $renderChildrenClosure154, $renderingContext);

$output152 .= '
                        ';
return $output152;
};
$arguments147 = array();
$arguments147['then'] = NULL;
$arguments147['else'] = NULL;
$arguments147['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array149 = array();
$array150 = array (
);$array149['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateAvailable', $array150);

$expression151 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments147['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression151(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array149)
					),
					$renderingContext
				);
$arguments147['__thenClosure'] = $renderChildrenClosure148;

$output87 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments147, $renderChildrenClosure148, $renderingContext);

$output87 .= '
                    </td>
                    <td data-sort="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure204 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments203 = array();
$arguments203['then'] = NULL;
$arguments203['else'] = NULL;
$arguments203['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array205 = array();
$array206 = array (
);$array205['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array206);

$expression207 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments203['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression207(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array205)
					),
					$renderingContext
				);
$arguments203['then'] = 'active';
$arguments203['else'] = 'inactive';

$output87 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments203, $renderChildrenClosure204, $renderingContext);

$output87 .= '">
                        ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\ToggleExtensionInstallationStateViewHelper
$renderChildrenClosure209 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments208 = array();
$arguments208['additionalAttributes'] = NULL;
$arguments208['data'] = NULL;
$arguments208['aria'] = NULL;
$arguments208['class'] = NULL;
$arguments208['dir'] = NULL;
$arguments208['id'] = NULL;
$arguments208['lang'] = NULL;
$arguments208['style'] = NULL;
$arguments208['title'] = NULL;
$arguments208['accesskey'] = NULL;
$arguments208['tabindex'] = NULL;
$arguments208['onclick'] = NULL;
$arguments208['extension'] = NULL;
$array210 = array (
);$arguments208['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array210);

$output87 .= TYPO3\CMS\Extensionmanager\ViewHelpers\ToggleExtensionInstallationStateViewHelper::renderStatic($arguments208, $renderChildrenClosure209, $renderingContext);

$output87 .= '
                    </td>
                    <td>
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure212 = function() use ($renderingContext, $self) {
$output221 = '';

$output221 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure223 = function() use ($renderingContext, $self) {
$output224 = '';

$output224 .= '
                                <img class="extension-icon" src="';
$array225 = array (
);
$output224 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.icon', $array225)]);

$output224 .= '" alt="" />
                            ';
return $output224;
};
$arguments222 = array();

$output221 .= '';

$output221 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure227 = function() use ($renderingContext, $self) {
$output228 = '';

$output228 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure230 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments229 = array();
$arguments229['identifier'] = NULL;
$arguments229['size'] = 'small';
$arguments229['overlay'] = NULL;
$arguments229['state'] = 'default';
$arguments229['alternativeMarkupIdentifier'] = NULL;
$arguments229['identifier'] = 'empty-empty';

$output228 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments229, $renderChildrenClosure230, $renderingContext);

$output228 .= '
                            ';
return $output228;
};
$arguments226 = array();
$arguments226['if'] = NULL;

$output221 .= '';

$output221 .= '
                        ';
return $output221;
};
$arguments211 = array();
$arguments211['then'] = NULL;
$arguments211['else'] = NULL;
$arguments211['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array218 = array();
$array219 = array (
);$array218['0'] = $renderingContext->getVariableProvider()->getByPath('extension.icon', $array219);

$expression220 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments211['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression220(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array218)
					),
					$renderingContext
				);
$arguments211['__thenClosure'] = function() use ($renderingContext, $self) {
$output213 = '';

$output213 .= '
                                <img class="extension-icon" src="';
$array214 = array (
);
$output213 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.icon', $array214)]);

$output213 .= '" alt="" />
                            ';
return $output213;
};
$arguments211['__elseClosures'][] = function() use ($renderingContext, $self) {
$output215 = '';

$output215 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure217 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments216 = array();
$arguments216['identifier'] = NULL;
$arguments216['size'] = 'small';
$arguments216['overlay'] = NULL;
$arguments216['state'] = 'default';
$arguments216['alternativeMarkupIdentifier'] = NULL;
$arguments216['identifier'] = 'empty-empty';

$output215 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments216, $renderChildrenClosure217, $renderingContext);

$output215 .= '
                            ';
return $output215;
};

$output87 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments211, $renderChildrenClosure212, $renderingContext);

$output87 .= '
                        <span title="';
$array231 = array (
);
$output87 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.description', $array231)]);

$output87 .= '">';
$array232 = array (
);
$output87 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.title', $array232)]);

$output87 .= '</span>
                    </td>
                    <td>';
$array233 = array (
);
$output87 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array233)]);

$output87 .= '</td>
                    <td>
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure235 = function() use ($renderingContext, $self) {
$output250 = '';

$output250 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure252 = function() use ($renderingContext, $self) {
$output253 = '';

$output253 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure255 = function() use ($renderingContext, $self) {
$output260 = '';

$output260 .= '
                                    ';
$array261 = array (
);
$output260 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array261)]);

$output260 .= '
                                ';
return $output260;
};
$arguments254 = array();
$arguments254['additionalAttributes'] = NULL;
$arguments254['data'] = NULL;
$arguments254['aria'] = NULL;
$arguments254['class'] = NULL;
$arguments254['dir'] = NULL;
$arguments254['id'] = NULL;
$arguments254['lang'] = NULL;
$arguments254['style'] = NULL;
$arguments254['title'] = NULL;
$arguments254['accesskey'] = NULL;
$arguments254['tabindex'] = NULL;
$arguments254['onclick'] = NULL;
$arguments254['name'] = NULL;
$arguments254['rel'] = NULL;
$arguments254['rev'] = NULL;
$arguments254['target'] = NULL;
$arguments254['action'] = NULL;
$arguments254['controller'] = NULL;
$arguments254['extensionName'] = NULL;
$arguments254['pluginName'] = NULL;
$arguments254['pageUid'] = NULL;
$arguments254['pageType'] = NULL;
$arguments254['noCache'] = NULL;
$arguments254['section'] = NULL;
$arguments254['format'] = NULL;
$arguments254['linkAccessRestrictedPages'] = NULL;
$arguments254['additionalParams'] = NULL;
$arguments254['absolute'] = NULL;
$arguments254['addQueryString'] = NULL;
$arguments254['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments254['addQueryStringMethod'] = NULL;
$arguments254['arguments'] = NULL;
$arguments254['action'] = 'showAllVersions';
// Rendering Array
$array256 = array();
$array257 = array (
);$array256['extensionKey'] = $renderingContext->getVariableProvider()->getByPath('extensionKey', $array257);
$array256['returnTo'] = 'index';
$arguments254['arguments'] = $array256;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure259 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments258 = array();
$arguments258['key'] = NULL;
$arguments258['id'] = NULL;
$arguments258['default'] = NULL;
$arguments258['arguments'] = NULL;
$arguments258['extensionName'] = NULL;
$arguments258['languageKey'] = NULL;
$arguments258['alternativeLanguageKeys'] = NULL;
$arguments258['key'] = 'showAllVersions';
$arguments254['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments258, $renderChildrenClosure259, $renderingContext);

$output253 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments254, $renderChildrenClosure255, $renderingContext);

$output253 .= '
                            ';
return $output253;
};
$arguments251 = array();

$output250 .= '';

$output250 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure263 = function() use ($renderingContext, $self) {
$output264 = '';

$output264 .= '
                                ';
$array265 = array (
);
$output264 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array265)]);

$output264 .= '
                            ';
return $output264;
};
$arguments262 = array();
$arguments262['if'] = NULL;

$output250 .= '';

$output250 .= '
                        ';
return $output250;
};
$arguments234 = array();
$arguments234['then'] = NULL;
$arguments234['else'] = NULL;
$arguments234['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array247 = array();
$array248 = array (
);$array247['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject', $array248);

$expression249 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments234['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression249(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array247)
					),
					$renderingContext
				);
$arguments234['__thenClosure'] = function() use ($renderingContext, $self) {
$output236 = '';

$output236 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure238 = function() use ($renderingContext, $self) {
$output243 = '';

$output243 .= '
                                    ';
$array244 = array (
);
$output243 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array244)]);

$output243 .= '
                                ';
return $output243;
};
$arguments237 = array();
$arguments237['additionalAttributes'] = NULL;
$arguments237['data'] = NULL;
$arguments237['aria'] = NULL;
$arguments237['class'] = NULL;
$arguments237['dir'] = NULL;
$arguments237['id'] = NULL;
$arguments237['lang'] = NULL;
$arguments237['style'] = NULL;
$arguments237['title'] = NULL;
$arguments237['accesskey'] = NULL;
$arguments237['tabindex'] = NULL;
$arguments237['onclick'] = NULL;
$arguments237['name'] = NULL;
$arguments237['rel'] = NULL;
$arguments237['rev'] = NULL;
$arguments237['target'] = NULL;
$arguments237['action'] = NULL;
$arguments237['controller'] = NULL;
$arguments237['extensionName'] = NULL;
$arguments237['pluginName'] = NULL;
$arguments237['pageUid'] = NULL;
$arguments237['pageType'] = NULL;
$arguments237['noCache'] = NULL;
$arguments237['section'] = NULL;
$arguments237['format'] = NULL;
$arguments237['linkAccessRestrictedPages'] = NULL;
$arguments237['additionalParams'] = NULL;
$arguments237['absolute'] = NULL;
$arguments237['addQueryString'] = NULL;
$arguments237['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments237['addQueryStringMethod'] = NULL;
$arguments237['arguments'] = NULL;
$arguments237['action'] = 'showAllVersions';
// Rendering Array
$array239 = array();
$array240 = array (
);$array239['extensionKey'] = $renderingContext->getVariableProvider()->getByPath('extensionKey', $array240);
$array239['returnTo'] = 'index';
$arguments237['arguments'] = $array239;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure242 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments241 = array();
$arguments241['key'] = NULL;
$arguments241['id'] = NULL;
$arguments241['default'] = NULL;
$arguments241['arguments'] = NULL;
$arguments241['extensionName'] = NULL;
$arguments241['languageKey'] = NULL;
$arguments241['alternativeLanguageKeys'] = NULL;
$arguments241['key'] = 'showAllVersions';
$arguments237['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments241, $renderChildrenClosure242, $renderingContext);

$output236 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments237, $renderChildrenClosure238, $renderingContext);

$output236 .= '
                            ';
return $output236;
};
$arguments234['__elseClosures'][] = function() use ($renderingContext, $self) {
$output245 = '';

$output245 .= '
                                ';
$array246 = array (
);
$output245 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array246)]);

$output245 .= '
                            ';
return $output245;
};

$output87 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments234, $renderChildrenClosure235, $renderingContext);

$output87 .= '
                    </td>
                    <td><span class="label label-';
$array266 = array (
);
$output87 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.state', $array266)]);

$output87 .= '">';
$array267 = array (
);
$output87 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.state', $array267)]);

$output87 .= '</span></td>
                    <td>';
$array268 = array (
);
$output87 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.type', $array268)]);

$output87 .= '</td>
                    <td>
                        <div class="btn-group">
                            ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\ProcessAvailableActionsViewHelper
$renderChildrenClosure270 = function() use ($renderingContext, $self) {
$output272 = '';

$output272 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure274 = function() use ($renderingContext, $self) {
$output278 = '';

$output278 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\RemoveExtensionViewHelper
$renderChildrenClosure280 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments279 = array();
$arguments279['additionalAttributes'] = NULL;
$arguments279['data'] = NULL;
$arguments279['aria'] = NULL;
$arguments279['class'] = NULL;
$arguments279['dir'] = NULL;
$arguments279['id'] = NULL;
$arguments279['lang'] = NULL;
$arguments279['style'] = NULL;
$arguments279['title'] = NULL;
$arguments279['accesskey'] = NULL;
$arguments279['tabindex'] = NULL;
$arguments279['onclick'] = NULL;
$arguments279['extension'] = NULL;
$arguments279['class'] = 'removeExtension btn btn-default';
$array281 = array (
);$arguments279['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array281);

$output278 .= TYPO3\CMS\Extensionmanager\ViewHelpers\RemoveExtensionViewHelper::renderStatic($arguments279, $renderChildrenClosure280, $renderingContext);

$output278 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure283 = function() use ($renderingContext, $self) {
$output288 = '';

$output288 .= '
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure290 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments289 = array();
$arguments289['identifier'] = NULL;
$arguments289['size'] = 'small';
$arguments289['overlay'] = NULL;
$arguments289['state'] = 'default';
$arguments289['alternativeMarkupIdentifier'] = NULL;
$arguments289['identifier'] = 'actions-system-extension-download';

$output288 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments289, $renderChildrenClosure290, $renderingContext);

$output288 .= '
                                    ';
return $output288;
};
$arguments282 = array();
$arguments282['additionalAttributes'] = NULL;
$arguments282['data'] = NULL;
$arguments282['aria'] = NULL;
$arguments282['class'] = NULL;
$arguments282['dir'] = NULL;
$arguments282['id'] = NULL;
$arguments282['lang'] = NULL;
$arguments282['style'] = NULL;
$arguments282['title'] = NULL;
$arguments282['accesskey'] = NULL;
$arguments282['tabindex'] = NULL;
$arguments282['onclick'] = NULL;
$arguments282['name'] = NULL;
$arguments282['rel'] = NULL;
$arguments282['rev'] = NULL;
$arguments282['target'] = NULL;
$arguments282['action'] = NULL;
$arguments282['controller'] = NULL;
$arguments282['extensionName'] = NULL;
$arguments282['pluginName'] = NULL;
$arguments282['pageUid'] = NULL;
$arguments282['pageType'] = NULL;
$arguments282['noCache'] = NULL;
$arguments282['section'] = NULL;
$arguments282['format'] = NULL;
$arguments282['linkAccessRestrictedPages'] = NULL;
$arguments282['additionalParams'] = NULL;
$arguments282['absolute'] = NULL;
$arguments282['addQueryString'] = NULL;
$arguments282['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments282['addQueryStringMethod'] = NULL;
$arguments282['arguments'] = NULL;
$arguments282['action'] = 'downloadExtensionZip';
$arguments282['controller'] = 'Action';
// Rendering Array
$array284 = array();
$array285 = array (
);$array284['extension'] = $renderingContext->getVariableProvider()->getByPath('extension.key', $array285);
$arguments282['arguments'] = $array284;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure287 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments286 = array();
$arguments286['key'] = NULL;
$arguments286['id'] = NULL;
$arguments286['default'] = NULL;
$arguments286['arguments'] = NULL;
$arguments286['extensionName'] = NULL;
$arguments286['languageKey'] = NULL;
$arguments286['alternativeLanguageKeys'] = NULL;
$arguments286['key'] = 'extensionList.downloadzip';
$arguments282['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments286, $renderChildrenClosure287, $renderingContext);
$arguments282['class'] = 'btn btn-default';

$output278 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments282, $renderChildrenClosure283, $renderingContext);

$output278 .= '
                                ';
return $output278;
};
$arguments273 = array();
$arguments273['then'] = NULL;
$arguments273['else'] = NULL;
$arguments273['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array275 = array();
$array275['0'] = '!';
$array276 = array (
);$array275['1'] = $renderingContext->getVariableProvider()->getByPath('isComposerMode', $array276);

$expression277 = function($context) {return !(TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node1"]));};
$arguments273['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression277(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array275)
					),
					$renderingContext
				);
$arguments273['__thenClosure'] = $renderChildrenClosure274;

$output272 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments273, $renderChildrenClosure274, $renderingContext);

$output272 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\ReloadSqlDataViewHelper
$renderChildrenClosure292 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments291 = array();
$arguments291['additionalAttributes'] = NULL;
$arguments291['data'] = NULL;
$arguments291['aria'] = NULL;
$arguments291['class'] = NULL;
$arguments291['dir'] = NULL;
$arguments291['id'] = NULL;
$arguments291['lang'] = NULL;
$arguments291['style'] = NULL;
$arguments291['title'] = NULL;
$arguments291['accesskey'] = NULL;
$arguments291['tabindex'] = NULL;
$arguments291['onclick'] = NULL;
$arguments291['extension'] = NULL;
$arguments291['class'] = 'btn btn-default';
$array293 = array (
);$arguments291['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array293);

$output272 .= TYPO3\CMS\Extensionmanager\ViewHelpers\ReloadSqlDataViewHelper::renderStatic($arguments291, $renderChildrenClosure292, $renderingContext);

$output272 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure295 = function() use ($renderingContext, $self) {
$output306 = '';

$output306 .= '
                                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure308 = function() use ($renderingContext, $self) {
$output309 = '';

$output309 .= '
                                        <a href="';
$array310 = array (
);
$output309 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.terObject.documentationLink', $array310)]);

$output309 .= '" target="_blank" rel="noopener noreferrer" class="btn btn-default">
                                            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure312 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments311 = array();
$arguments311['identifier'] = NULL;
$arguments311['size'] = 'small';
$arguments311['overlay'] = NULL;
$arguments311['state'] = 'default';
$arguments311['alternativeMarkupIdentifier'] = NULL;
$arguments311['identifier'] = 'actions-system-extension-documentation';
$arguments311['size'] = 'small';

$output309 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments311, $renderChildrenClosure312, $renderingContext);

$output309 .= '
                                        </a>
                                    ';
return $output309;
};
$arguments307 = array();

$output306 .= '';

$output306 .= '
                                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure314 = function() use ($renderingContext, $self) {
$output315 = '';

$output315 .= '
                                        <span class="btn btn-default disabled">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure317 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments316 = array();
$arguments316['identifier'] = NULL;
$arguments316['size'] = 'small';
$arguments316['overlay'] = NULL;
$arguments316['state'] = 'default';
$arguments316['alternativeMarkupIdentifier'] = NULL;
$arguments316['identifier'] = 'empty-empty';
$arguments316['size'] = 'small';

$output315 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments316, $renderChildrenClosure317, $renderingContext);

$output315 .= '</span>
                                    ';
return $output315;
};
$arguments313 = array();
$arguments313['if'] = NULL;

$output306 .= '';

$output306 .= '
                                ';
return $output306;
};
$arguments294 = array();
$arguments294['then'] = NULL;
$arguments294['else'] = NULL;
$arguments294['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array303 = array();
$array304 = array (
);$array303['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.documentationLink', $array304);

$expression305 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments294['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression305(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array303)
					),
					$renderingContext
				);
$arguments294['__thenClosure'] = function() use ($renderingContext, $self) {
$output296 = '';

$output296 .= '
                                        <a href="';
$array297 = array (
);
$output296 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.terObject.documentationLink', $array297)]);

$output296 .= '" target="_blank" rel="noopener noreferrer" class="btn btn-default">
                                            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure299 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments298 = array();
$arguments298['identifier'] = NULL;
$arguments298['size'] = 'small';
$arguments298['overlay'] = NULL;
$arguments298['state'] = 'default';
$arguments298['alternativeMarkupIdentifier'] = NULL;
$arguments298['identifier'] = 'actions-system-extension-documentation';
$arguments298['size'] = 'small';

$output296 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments298, $renderChildrenClosure299, $renderingContext);

$output296 .= '
                                        </a>
                                    ';
return $output296;
};
$arguments294['__elseClosures'][] = function() use ($renderingContext, $self) {
$output300 = '';

$output300 .= '
                                        <span class="btn btn-default disabled">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure302 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments301 = array();
$arguments301['identifier'] = NULL;
$arguments301['size'] = 'small';
$arguments301['overlay'] = NULL;
$arguments301['state'] = 'default';
$arguments301['alternativeMarkupIdentifier'] = NULL;
$arguments301['identifier'] = 'empty-empty';
$arguments301['size'] = 'small';

$output300 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments301, $renderChildrenClosure302, $renderingContext);

$output300 .= '</span>
                                    ';
return $output300;
};

$output272 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments294, $renderChildrenClosure295, $renderingContext);

$output272 .= '
                            ';
return $output272;
};
$arguments269 = array();
$arguments269['additionalAttributes'] = NULL;
$arguments269['data'] = NULL;
$arguments269['aria'] = NULL;
$arguments269['extension'] = NULL;
$array271 = array (
);$arguments269['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array271);

$output87 .= TYPO3\CMS\Extensionmanager\ViewHelpers\ProcessAvailableActionsViewHelper::renderStatic($arguments269, $renderChildrenClosure270, $renderingContext);

$output87 .= '
                        </div>
                    </td>
                    </tr>
                ';
return $output87;
};
$arguments84 = array();
$arguments84['each'] = NULL;
$arguments84['as'] = NULL;
$arguments84['key'] = NULL;
$arguments84['reverse'] = false;
$arguments84['iteration'] = NULL;
$array86 = array (
);$arguments84['each'] = $renderingContext->getVariableProvider()->getByPath('extensions', $array86);
$arguments84['as'] = 'extension';
$arguments84['key'] = 'extensionKey';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments84, $renderChildrenClosure85, $renderingContext);

$output0 .= '
            </tbody>
        </table>
    </div>

';

return $output0;
}
/**
 * Main Render function
 */
public function render(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output318 = '';

$output318 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\LayoutViewHelper
$renderChildrenClosure320 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments319 = array();
$arguments319['name'] = NULL;
$arguments319['name'] = 'main';

$output318 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [NULL]);

$output318 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\SectionViewHelper
$renderChildrenClosure322 = function() use ($renderingContext, $self) {
$output323 = '';

$output323 .= '

    <h1>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure325 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments324 = array();
$arguments324['key'] = NULL;
$arguments324['id'] = NULL;
$arguments324['default'] = NULL;
$arguments324['arguments'] = NULL;
$arguments324['extensionName'] = NULL;
$arguments324['languageKey'] = NULL;
$arguments324['alternativeLanguageKeys'] = NULL;
$arguments324['key'] = 'installedExtensions';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments324, $renderChildrenClosure325, $renderingContext)]);

$output323 .= '</h1>
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure327 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments326 = array();
$arguments326['section'] = NULL;
$arguments326['partial'] = NULL;
$arguments326['delegate'] = NULL;
$arguments326['renderable'] = NULL;
$arguments326['arguments'] = array (
);
$arguments326['optional'] = false;
$arguments326['default'] = NULL;
$arguments326['contentAs'] = NULL;
$arguments326['debug'] = true;
$arguments326['partial'] = 'List/UploadForm';

$output323 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments326, $renderChildrenClosure327, $renderingContext);

$output323 .= '
    <form>
        <div class="row row-cols-auto align-items-end justify-content-between g-3">
            <div class="col">
                <div class="input-group">
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper
$renderChildrenClosure329 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments328 = array();
$arguments328['additionalAttributes'] = NULL;
$arguments328['data'] = NULL;
$arguments328['aria'] = NULL;
$arguments328['name'] = NULL;
$arguments328['value'] = NULL;
$arguments328['property'] = NULL;
$arguments328['autofocus'] = NULL;
$arguments328['disabled'] = NULL;
$arguments328['maxlength'] = NULL;
$arguments328['readonly'] = NULL;
$arguments328['size'] = NULL;
$arguments328['placeholder'] = NULL;
$arguments328['pattern'] = NULL;
$arguments328['errorClass'] = 'f3-form-error';
$arguments328['class'] = NULL;
$arguments328['dir'] = NULL;
$arguments328['id'] = NULL;
$arguments328['lang'] = NULL;
$arguments328['style'] = NULL;
$arguments328['title'] = NULL;
$arguments328['accesskey'] = NULL;
$arguments328['tabindex'] = NULL;
$arguments328['onclick'] = NULL;
$arguments328['required'] = false;
$arguments328['type'] = 'text';
$arguments328['name'] = 'Tx_Extensionmanager_extensionkey';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure331 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments330 = array();
$arguments330['key'] = NULL;
$arguments330['id'] = NULL;
$arguments330['default'] = NULL;
$arguments330['arguments'] = NULL;
$arguments330['extensionName'] = NULL;
$arguments330['languageKey'] = NULL;
$arguments330['alternativeLanguageKeys'] = NULL;
$arguments330['key'] = 'extensionList.search';
$arguments328['placeholder'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments330, $renderChildrenClosure331, $renderingContext);
$arguments328['id'] = 'Tx_Extensionmanager_extensionkey';
$array332 = array (
);$arguments328['value'] = $renderingContext->getVariableProvider()->getByPath('search', $array332);
$arguments328['class'] = 'form-control extension-list-search';

$output323 .= TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper::renderStatic($arguments328, $renderChildrenClosure329, $renderingContext);

$output323 .= '
                    <button type="submit" class="btn btn-default">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure334 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments333 = array();
$arguments333['identifier'] = NULL;
$arguments333['size'] = 'small';
$arguments333['overlay'] = NULL;
$arguments333['state'] = 'default';
$arguments333['alternativeMarkupIdentifier'] = NULL;
$arguments333['identifier'] = 'actions-search';

$output323 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments333, $renderChildrenClosure334, $renderingContext);

$output323 .= '</button>
                </div>
            </div>
            <div class="col">
                <div class="btn-group">
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure336 = function() use ($renderingContext, $self) {
$output346 = '';

$output346 .= '
                        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure348 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments347 = array();
$arguments347['key'] = NULL;
$arguments347['id'] = NULL;
$arguments347['default'] = NULL;
$arguments347['arguments'] = NULL;
$arguments347['extensionName'] = NULL;
$arguments347['languageKey'] = NULL;
$arguments347['alternativeLanguageKeys'] = NULL;
$arguments347['key'] = 'extensionList.filter.showAll';

$output346 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments347, $renderChildrenClosure348, $renderingContext)]);

$output346 .= '
                    ';
return $output346;
};
$arguments335 = array();
$arguments335['additionalAttributes'] = NULL;
$arguments335['data'] = NULL;
$arguments335['aria'] = NULL;
$arguments335['class'] = NULL;
$arguments335['dir'] = NULL;
$arguments335['id'] = NULL;
$arguments335['lang'] = NULL;
$arguments335['style'] = NULL;
$arguments335['title'] = NULL;
$arguments335['accesskey'] = NULL;
$arguments335['tabindex'] = NULL;
$arguments335['onclick'] = NULL;
$arguments335['name'] = NULL;
$arguments335['rel'] = NULL;
$arguments335['rev'] = NULL;
$arguments335['target'] = NULL;
$arguments335['action'] = NULL;
$arguments335['controller'] = NULL;
$arguments335['extensionName'] = NULL;
$arguments335['pluginName'] = NULL;
$arguments335['pageUid'] = NULL;
$arguments335['pageType'] = NULL;
$arguments335['noCache'] = NULL;
$arguments335['section'] = NULL;
$arguments335['format'] = NULL;
$arguments335['linkAccessRestrictedPages'] = NULL;
$arguments335['additionalParams'] = NULL;
$arguments335['absolute'] = NULL;
$arguments335['addQueryString'] = NULL;
$arguments335['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments335['addQueryStringMethod'] = NULL;
$arguments335['arguments'] = NULL;
$arguments335['action'] = 'index';
$arguments335['controller'] = 'List';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure338 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments337 = array();
$arguments337['key'] = NULL;
$arguments337['id'] = NULL;
$arguments337['default'] = NULL;
$arguments337['arguments'] = NULL;
$arguments337['extensionName'] = NULL;
$arguments337['languageKey'] = NULL;
$arguments337['alternativeLanguageKeys'] = NULL;
$arguments337['key'] = 'extensionList.filter.showAll';
$arguments335['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments337, $renderChildrenClosure338, $renderingContext);
// Rendering Array
$array339 = array();
$array339['filter'] = '';
$arguments335['arguments'] = $array339;
$output340 = '';

$output340 .= 'btn btn-default ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure342 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments341 = array();
$arguments341['then'] = NULL;
$arguments341['else'] = NULL;
$arguments341['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array343 = array();
$array344 = array (
);$array343['0'] = $renderingContext->getVariableProvider()->getByPath('typeFilter', $array344);
$array343['1'] = ' == All';

$expression345 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == "All");};
$arguments341['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression345(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array343)
					),
					$renderingContext
				);
$arguments341['then'] = 'active';

$output340 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments341, $renderChildrenClosure342, $renderingContext);
$arguments335['class'] = $output340;
$arguments335['style'] = 'width: 80px;';

$output323 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments335, $renderChildrenClosure336, $renderingContext);

$output323 .= '
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure350 = function() use ($renderingContext, $self) {
$output360 = '';

$output360 .= '
                        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure362 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments361 = array();
$arguments361['key'] = NULL;
$arguments361['id'] = NULL;
$arguments361['default'] = NULL;
$arguments361['arguments'] = NULL;
$arguments361['extensionName'] = NULL;
$arguments361['languageKey'] = NULL;
$arguments361['alternativeLanguageKeys'] = NULL;
$arguments361['key'] = 'extensionList.filter.showSystemExtensions';

$output360 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments361, $renderChildrenClosure362, $renderingContext)]);

$output360 .= '
                    ';
return $output360;
};
$arguments349 = array();
$arguments349['additionalAttributes'] = NULL;
$arguments349['data'] = NULL;
$arguments349['aria'] = NULL;
$arguments349['class'] = NULL;
$arguments349['dir'] = NULL;
$arguments349['id'] = NULL;
$arguments349['lang'] = NULL;
$arguments349['style'] = NULL;
$arguments349['title'] = NULL;
$arguments349['accesskey'] = NULL;
$arguments349['tabindex'] = NULL;
$arguments349['onclick'] = NULL;
$arguments349['name'] = NULL;
$arguments349['rel'] = NULL;
$arguments349['rev'] = NULL;
$arguments349['target'] = NULL;
$arguments349['action'] = NULL;
$arguments349['controller'] = NULL;
$arguments349['extensionName'] = NULL;
$arguments349['pluginName'] = NULL;
$arguments349['pageUid'] = NULL;
$arguments349['pageType'] = NULL;
$arguments349['noCache'] = NULL;
$arguments349['section'] = NULL;
$arguments349['format'] = NULL;
$arguments349['linkAccessRestrictedPages'] = NULL;
$arguments349['additionalParams'] = NULL;
$arguments349['absolute'] = NULL;
$arguments349['addQueryString'] = NULL;
$arguments349['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments349['addQueryStringMethod'] = NULL;
$arguments349['arguments'] = NULL;
$arguments349['action'] = 'index';
$arguments349['controller'] = 'List';
// Rendering Array
$array351 = array();
$array351['filter'] = 'System';
$arguments349['arguments'] = $array351;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure353 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments352 = array();
$arguments352['key'] = NULL;
$arguments352['id'] = NULL;
$arguments352['default'] = NULL;
$arguments352['arguments'] = NULL;
$arguments352['extensionName'] = NULL;
$arguments352['languageKey'] = NULL;
$arguments352['alternativeLanguageKeys'] = NULL;
$arguments352['key'] = 'extensionList.filter.showSystemExtensions';
$arguments349['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments352, $renderChildrenClosure353, $renderingContext);
$output354 = '';

$output354 .= 'btn btn-default ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure356 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments355 = array();
$arguments355['then'] = NULL;
$arguments355['else'] = NULL;
$arguments355['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array357 = array();
$array358 = array (
);$array357['0'] = $renderingContext->getVariableProvider()->getByPath('typeFilter', $array358);
$array357['1'] = ' == System';

$expression359 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == "System");};
$arguments355['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression359(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array357)
					),
					$renderingContext
				);
$arguments355['then'] = 'active';

$output354 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments355, $renderChildrenClosure356, $renderingContext);
$arguments349['class'] = $output354;
$arguments349['style'] = 'width: 80px;';

$output323 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments349, $renderChildrenClosure350, $renderingContext);

$output323 .= '
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure364 = function() use ($renderingContext, $self) {
$output374 = '';

$output374 .= '
                        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure376 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments375 = array();
$arguments375['key'] = NULL;
$arguments375['id'] = NULL;
$arguments375['default'] = NULL;
$arguments375['arguments'] = NULL;
$arguments375['extensionName'] = NULL;
$arguments375['languageKey'] = NULL;
$arguments375['alternativeLanguageKeys'] = NULL;
$arguments375['key'] = 'extensionList.filter.showLocalExtensions';

$output374 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments375, $renderChildrenClosure376, $renderingContext)]);

$output374 .= '
                    ';
return $output374;
};
$arguments363 = array();
$arguments363['additionalAttributes'] = NULL;
$arguments363['data'] = NULL;
$arguments363['aria'] = NULL;
$arguments363['class'] = NULL;
$arguments363['dir'] = NULL;
$arguments363['id'] = NULL;
$arguments363['lang'] = NULL;
$arguments363['style'] = NULL;
$arguments363['title'] = NULL;
$arguments363['accesskey'] = NULL;
$arguments363['tabindex'] = NULL;
$arguments363['onclick'] = NULL;
$arguments363['name'] = NULL;
$arguments363['rel'] = NULL;
$arguments363['rev'] = NULL;
$arguments363['target'] = NULL;
$arguments363['action'] = NULL;
$arguments363['controller'] = NULL;
$arguments363['extensionName'] = NULL;
$arguments363['pluginName'] = NULL;
$arguments363['pageUid'] = NULL;
$arguments363['pageType'] = NULL;
$arguments363['noCache'] = NULL;
$arguments363['section'] = NULL;
$arguments363['format'] = NULL;
$arguments363['linkAccessRestrictedPages'] = NULL;
$arguments363['additionalParams'] = NULL;
$arguments363['absolute'] = NULL;
$arguments363['addQueryString'] = NULL;
$arguments363['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments363['addQueryStringMethod'] = NULL;
$arguments363['arguments'] = NULL;
$arguments363['action'] = 'index';
$arguments363['controller'] = 'List';
// Rendering Array
$array365 = array();
$array365['filter'] = 'Local';
$arguments363['arguments'] = $array365;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure367 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments366 = array();
$arguments366['key'] = NULL;
$arguments366['id'] = NULL;
$arguments366['default'] = NULL;
$arguments366['arguments'] = NULL;
$arguments366['extensionName'] = NULL;
$arguments366['languageKey'] = NULL;
$arguments366['alternativeLanguageKeys'] = NULL;
$arguments366['key'] = 'extensionList.filter.showLocalExtensions';
$arguments363['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments366, $renderChildrenClosure367, $renderingContext);
$output368 = '';

$output368 .= 'btn btn-default ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure370 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments369 = array();
$arguments369['then'] = NULL;
$arguments369['else'] = NULL;
$arguments369['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array371 = array();
$array372 = array (
);$array371['0'] = $renderingContext->getVariableProvider()->getByPath('typeFilter', $array372);
$array371['1'] = ' == Local';

$expression373 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == "Local");};
$arguments369['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression373(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array371)
					),
					$renderingContext
				);
$arguments369['then'] = 'active';

$output368 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments369, $renderChildrenClosure370, $renderingContext);
$arguments363['class'] = $output368;
$arguments363['style'] = 'width: 80px;';

$output323 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments363, $renderChildrenClosure364, $renderingContext);

$output323 .= '
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="table-fit">
        <table id="typo3-extension-list" class="table table-striped table-hover extension-list">
            <thead>
                <tr>
                    <th ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure378 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments377 = array();
$arguments377['then'] = NULL;
$arguments377['else'] = NULL;
$arguments377['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array379 = array();
$array380 = array (
);$array379['0'] = $renderingContext->getVariableProvider()->getByPath('sortByUpdate', $array380);

$expression381 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments377['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression381(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array379)
					),
					$renderingContext
				);
$arguments377['then'] = 'data-sort-default';

$output323 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments377, $renderChildrenClosure378, $renderingContext);

$output323 .= ' title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure383 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments382 = array();
$arguments382['key'] = NULL;
$arguments382['id'] = NULL;
$arguments382['default'] = NULL;
$arguments382['arguments'] = NULL;
$arguments382['extensionName'] = NULL;
$arguments382['languageKey'] = NULL;
$arguments382['alternativeLanguageKeys'] = NULL;
$arguments382['key'] = 'extensionList.header.title.update';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments382, $renderChildrenClosure383, $renderingContext)]);

$output323 .= '">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure385 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments384 = array();
$arguments384['key'] = NULL;
$arguments384['id'] = NULL;
$arguments384['default'] = NULL;
$arguments384['arguments'] = NULL;
$arguments384['extensionName'] = NULL;
$arguments384['languageKey'] = NULL;
$arguments384['alternativeLanguageKeys'] = NULL;
$arguments384['key'] = 'extensionList.header.update';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments384, $renderChildrenClosure385, $renderingContext)]);

$output323 .= '</th>
                    <th title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure387 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments386 = array();
$arguments386['key'] = NULL;
$arguments386['id'] = NULL;
$arguments386['default'] = NULL;
$arguments386['arguments'] = NULL;
$arguments386['extensionName'] = NULL;
$arguments386['languageKey'] = NULL;
$arguments386['alternativeLanguageKeys'] = NULL;
$arguments386['key'] = 'extensionList.header.title.activate';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments386, $renderChildrenClosure387, $renderingContext)]);

$output323 .= '">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure389 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments388 = array();
$arguments388['key'] = NULL;
$arguments388['id'] = NULL;
$arguments388['default'] = NULL;
$arguments388['arguments'] = NULL;
$arguments388['extensionName'] = NULL;
$arguments388['languageKey'] = NULL;
$arguments388['alternativeLanguageKeys'] = NULL;
$arguments388['key'] = 'extensionList.header.activate';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments388, $renderChildrenClosure389, $renderingContext)]);

$output323 .= '</th>
                    <th data-filterable>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure391 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments390 = array();
$arguments390['key'] = NULL;
$arguments390['id'] = NULL;
$arguments390['default'] = NULL;
$arguments390['arguments'] = NULL;
$arguments390['extensionName'] = NULL;
$arguments390['languageKey'] = NULL;
$arguments390['alternativeLanguageKeys'] = NULL;
$arguments390['key'] = 'extensionList.header.extensionName';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments390, $renderChildrenClosure391, $renderingContext)]);

$output323 .= '</th>
                    <th ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure393 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments392 = array();
$arguments392['then'] = NULL;
$arguments392['else'] = NULL;
$arguments392['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array394 = array();
$array394['0'] = '!';
$array395 = array (
);$array394['1'] = $renderingContext->getVariableProvider()->getByPath('sortByUpdate', $array395);

$expression396 = function($context) {return !(TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node1"]));};
$arguments392['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression396(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array394)
					),
					$renderingContext
				);
$arguments392['then'] = 'data-sort-default';

$output323 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments392, $renderChildrenClosure393, $renderingContext);

$output323 .= ' data-filterable>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure398 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments397 = array();
$arguments397['key'] = NULL;
$arguments397['id'] = NULL;
$arguments397['default'] = NULL;
$arguments397['arguments'] = NULL;
$arguments397['extensionName'] = NULL;
$arguments397['languageKey'] = NULL;
$arguments397['alternativeLanguageKeys'] = NULL;
$arguments397['key'] = 'extensionList.header.extensionKey';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments397, $renderChildrenClosure398, $renderingContext)]);

$output323 .= '</th>
                    <th data-sort-method="dotsep">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure400 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments399 = array();
$arguments399['key'] = NULL;
$arguments399['id'] = NULL;
$arguments399['default'] = NULL;
$arguments399['arguments'] = NULL;
$arguments399['extensionName'] = NULL;
$arguments399['languageKey'] = NULL;
$arguments399['alternativeLanguageKeys'] = NULL;
$arguments399['key'] = 'extensionList.header.extensionVersion';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments399, $renderChildrenClosure400, $renderingContext)]);

$output323 .= '</th>
                    <th data-sort-method="none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure402 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments401 = array();
$arguments401['key'] = NULL;
$arguments401['id'] = NULL;
$arguments401['default'] = NULL;
$arguments401['arguments'] = NULL;
$arguments401['extensionName'] = NULL;
$arguments401['languageKey'] = NULL;
$arguments401['alternativeLanguageKeys'] = NULL;
$arguments401['key'] = 'extensionList.header.extensionState';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments401, $renderChildrenClosure402, $renderingContext)]);

$output323 .= '</th>
                    <th>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure404 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments403 = array();
$arguments403['key'] = NULL;
$arguments403['id'] = NULL;
$arguments403['default'] = NULL;
$arguments403['arguments'] = NULL;
$arguments403['extensionName'] = NULL;
$arguments403['languageKey'] = NULL;
$arguments403['alternativeLanguageKeys'] = NULL;
$arguments403['key'] = 'extensionList.header.extensionType';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments403, $renderChildrenClosure404, $renderingContext)]);

$output323 .= '</th>
                    <th data-sort-method="none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure406 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments405 = array();
$arguments405['key'] = NULL;
$arguments405['id'] = NULL;
$arguments405['default'] = NULL;
$arguments405['arguments'] = NULL;
$arguments405['extensionName'] = NULL;
$arguments405['languageKey'] = NULL;
$arguments405['alternativeLanguageKeys'] = NULL;
$arguments405['key'] = 'extensionList.header.extensionActions';

$output323 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments405, $renderChildrenClosure406, $renderingContext)]);

$output323 .= '</th>
                </tr>
            </thead>
            <tbody>
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure408 = function() use ($renderingContext, $self) {
$output410 = '';

$output410 .= '
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure412 = function() use ($renderingContext, $self) {
$output440 = '';

$output440 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure442 = function() use ($renderingContext, $self) {
$output443 = '';

$output443 .= '
                            <tr role="row" id="';
$array444 = array (
);
$output443 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array444)]);

$output443 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure446 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments445 = array();
$arguments445['then'] = NULL;
$arguments445['else'] = NULL;
$arguments445['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array447 = array();
$array448 = array (
);$array447['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array448);
$array447['1'] = ' == -1';

$expression449 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -1);};
$arguments445['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression449(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array447)
					),
					$renderingContext
				);
$arguments445['then'] = 'insecure';

$output443 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments445, $renderChildrenClosure446, $renderingContext);
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure451 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments450 = array();
$arguments450['then'] = NULL;
$arguments450['else'] = NULL;
$arguments450['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array452 = array();
$array453 = array (
);$array452['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array453);
$array452['1'] = ' == -2';

$expression454 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -2);};
$arguments450['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression454(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array452)
					),
					$renderingContext
				);
$arguments450['then'] = 'outdated';

$output443 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments450, $renderChildrenClosure451, $renderingContext);

$output443 .= ' ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure456 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments455 = array();
$arguments455['then'] = NULL;
$arguments455['else'] = NULL;
$arguments455['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array457 = array();
$array458 = array (
);$array457['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array458);

$expression459 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments455['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression459(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array457)
					),
					$renderingContext
				);
$arguments455['then'] = '';
$arguments455['else'] = 'inactive';

$output443 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments455, $renderChildrenClosure456, $renderingContext);

$output443 .= '">
                        ';
return $output443;
};
$arguments441 = array();

$output440 .= '';

$output440 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure461 = function() use ($renderingContext, $self) {
$output462 = '';

$output462 .= '
                            <tr role="row" id="';
$array463 = array (
);
$output462 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array463)]);

$output462 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure465 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments464 = array();
$arguments464['then'] = NULL;
$arguments464['else'] = NULL;
$arguments464['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array466 = array();
$array467 = array (
);$array466['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array467);

$expression468 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments464['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression468(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array466)
					),
					$renderingContext
				);
$arguments464['then'] = '';
$arguments464['else'] = 'inactive';

$output462 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments464, $renderChildrenClosure465, $renderingContext);

$output462 .= '">
                        ';
return $output462;
};
$arguments460 = array();
$arguments460['if'] = NULL;

$output440 .= '';

$output440 .= '
                    ';
return $output440;
};
$arguments411 = array();
$arguments411['then'] = NULL;
$arguments411['else'] = NULL;
$arguments411['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array437 = array();
$array438 = array (
);$array437['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject', $array438);

$expression439 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments411['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression439(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array437)
					),
					$renderingContext
				);
$arguments411['__thenClosure'] = function() use ($renderingContext, $self) {
$output413 = '';

$output413 .= '
                            <tr role="row" id="';
$array414 = array (
);
$output413 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array414)]);

$output413 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure416 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments415 = array();
$arguments415['then'] = NULL;
$arguments415['else'] = NULL;
$arguments415['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array417 = array();
$array418 = array (
);$array417['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array418);
$array417['1'] = ' == -1';

$expression419 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -1);};
$arguments415['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression419(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array417)
					),
					$renderingContext
				);
$arguments415['then'] = 'insecure';

$output413 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments415, $renderChildrenClosure416, $renderingContext);
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure421 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments420 = array();
$arguments420['then'] = NULL;
$arguments420['else'] = NULL;
$arguments420['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array422 = array();
$array423 = array (
);$array422['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.reviewState', $array423);
$array422['1'] = ' == -2';

$expression424 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == -2);};
$arguments420['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression424(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array422)
					),
					$renderingContext
				);
$arguments420['then'] = 'outdated';

$output413 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments420, $renderChildrenClosure421, $renderingContext);

$output413 .= ' ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure426 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments425 = array();
$arguments425['then'] = NULL;
$arguments425['else'] = NULL;
$arguments425['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array427 = array();
$array428 = array (
);$array427['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array428);

$expression429 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments425['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression429(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array427)
					),
					$renderingContext
				);
$arguments425['then'] = '';
$arguments425['else'] = 'inactive';

$output413 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments425, $renderChildrenClosure426, $renderingContext);

$output413 .= '">
                        ';
return $output413;
};
$arguments411['__elseClosures'][] = function() use ($renderingContext, $self) {
$output430 = '';

$output430 .= '
                            <tr role="row" id="';
$array431 = array (
);
$output430 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array431)]);

$output430 .= '" class="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure433 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments432 = array();
$arguments432['then'] = NULL;
$arguments432['else'] = NULL;
$arguments432['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array434 = array();
$array435 = array (
);$array434['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array435);

$expression436 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments432['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression436(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array434)
					),
					$renderingContext
				);
$arguments432['then'] = '';
$arguments432['else'] = 'inactive';

$output430 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments432, $renderChildrenClosure433, $renderingContext);

$output430 .= '">
                        ';
return $output430;
};

$output410 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments411, $renderChildrenClosure412, $renderingContext);

$output410 .= '
                    <td data-sort="';
$array469 = array (
);
$output410 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.sortUpdate', $array469)]);

$output410 .= '">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure471 = function() use ($renderingContext, $self) {
$output475 = '';

$output475 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure477 = function() use ($renderingContext, $self) {
$output501 = '';

$output501 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure503 = function() use ($renderingContext, $self) {
$output504 = '';

$output504 .= '
                                    <span class="btn btn-default disabled" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure506 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments505 = array();
$arguments505['key'] = NULL;
$arguments505['id'] = NULL;
$arguments505['default'] = NULL;
$arguments505['arguments'] = NULL;
$arguments505['extensionName'] = NULL;
$arguments505['languageKey'] = NULL;
$arguments505['alternativeLanguageKeys'] = NULL;
$arguments505['key'] = 'extensionList.updateDisabled';

$output504 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments505, $renderChildrenClosure506, $renderingContext)]);

$output504 .= '">
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure508 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments507 = array();
$arguments507['identifier'] = NULL;
$arguments507['size'] = 'small';
$arguments507['overlay'] = NULL;
$arguments507['state'] = 'default';
$arguments507['alternativeMarkupIdentifier'] = NULL;
$arguments507['identifier'] = 'actions-system-extension-update';

$output504 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments507, $renderChildrenClosure508, $renderingContext);

$output504 .= '
                                    </span>
                                ';
return $output504;
};
$arguments502 = array();

$output501 .= '';

$output501 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure510 = function() use ($renderingContext, $self) {
$output511 = '';

$output511 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure513 = function() use ($renderingContext, $self) {
$output523 = '';

$output523 .= '
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure525 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments524 = array();
$arguments524['identifier'] = NULL;
$arguments524['size'] = 'small';
$arguments524['overlay'] = NULL;
$arguments524['state'] = 'default';
$arguments524['alternativeMarkupIdentifier'] = NULL;
$arguments524['identifier'] = 'actions-system-extension-update';

$output523 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments524, $renderChildrenClosure525, $renderingContext);

$output523 .= '
                                    ';
return $output523;
};
$arguments512 = array();
$arguments512['additionalAttributes'] = NULL;
$arguments512['data'] = NULL;
$arguments512['aria'] = NULL;
$arguments512['class'] = NULL;
$arguments512['dir'] = NULL;
$arguments512['id'] = NULL;
$arguments512['lang'] = NULL;
$arguments512['style'] = NULL;
$arguments512['title'] = NULL;
$arguments512['accesskey'] = NULL;
$arguments512['tabindex'] = NULL;
$arguments512['onclick'] = NULL;
$arguments512['name'] = NULL;
$arguments512['rel'] = NULL;
$arguments512['rev'] = NULL;
$arguments512['target'] = NULL;
$arguments512['action'] = NULL;
$arguments512['controller'] = NULL;
$arguments512['extensionName'] = NULL;
$arguments512['pluginName'] = NULL;
$arguments512['pageUid'] = NULL;
$arguments512['pageType'] = NULL;
$arguments512['noCache'] = NULL;
$arguments512['section'] = NULL;
$arguments512['format'] = NULL;
$arguments512['linkAccessRestrictedPages'] = NULL;
$arguments512['additionalParams'] = NULL;
$arguments512['absolute'] = NULL;
$arguments512['addQueryString'] = NULL;
$arguments512['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments512['addQueryStringMethod'] = NULL;
$arguments512['arguments'] = NULL;
$arguments512['action'] = 'updateCommentForUpdatableVersions';
$arguments512['class'] = 'btn btn-default';
// Rendering Array
$array514 = array();
$array514['data-action'] = 'update-extension';
$arguments512['additionalAttributes'] = $array514;
$arguments512['format'] = 'json';
$arguments512['controller'] = 'Download';
// Rendering Array
$array515 = array();
$array516 = array (
);$array515['extension'] = $renderingContext->getVariableProvider()->getByPath('extension.key', $array516);
$array517 = array (
);$array515['integerVersionStart'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.integerVersion', $array517);
$array518 = array (
);$array515['integerVersionStop'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.integerVersion', $array518);
$arguments512['arguments'] = $array515;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure520 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments519 = array();
$arguments519['key'] = NULL;
$arguments519['id'] = NULL;
$arguments519['default'] = NULL;
$arguments519['arguments'] = NULL;
$arguments519['extensionName'] = NULL;
$arguments519['languageKey'] = NULL;
$arguments519['alternativeLanguageKeys'] = NULL;
$arguments519['key'] = 'extensionList.updateToVersion';
// Rendering Array
$array521 = array();
$array522 = array (
);$array521['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.version', $array522);
$arguments519['arguments'] = $array521;
$arguments512['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments519, $renderChildrenClosure520, $renderingContext);

$output511 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments512, $renderChildrenClosure513, $renderingContext);

$output511 .= '
                                ';
return $output511;
};
$arguments509 = array();
$arguments509['if'] = NULL;

$output501 .= '';

$output501 .= '
                            ';
return $output501;
};
$arguments476 = array();
$arguments476['then'] = NULL;
$arguments476['else'] = NULL;
$arguments476['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array498 = array();
$array499 = array (
);$array498['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateIsBlocked', $array499);

$expression500 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments476['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression500(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array498)
					),
					$renderingContext
				);
$arguments476['__thenClosure'] = function() use ($renderingContext, $self) {
$output478 = '';

$output478 .= '
                                    <span class="btn btn-default disabled" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure480 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments479 = array();
$arguments479['key'] = NULL;
$arguments479['id'] = NULL;
$arguments479['default'] = NULL;
$arguments479['arguments'] = NULL;
$arguments479['extensionName'] = NULL;
$arguments479['languageKey'] = NULL;
$arguments479['alternativeLanguageKeys'] = NULL;
$arguments479['key'] = 'extensionList.updateDisabled';

$output478 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments479, $renderChildrenClosure480, $renderingContext)]);

$output478 .= '">
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure482 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments481 = array();
$arguments481['identifier'] = NULL;
$arguments481['size'] = 'small';
$arguments481['overlay'] = NULL;
$arguments481['state'] = 'default';
$arguments481['alternativeMarkupIdentifier'] = NULL;
$arguments481['identifier'] = 'actions-system-extension-update';

$output478 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments481, $renderChildrenClosure482, $renderingContext);

$output478 .= '
                                    </span>
                                ';
return $output478;
};
$arguments476['__elseClosures'][] = function() use ($renderingContext, $self) {
$output483 = '';

$output483 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure485 = function() use ($renderingContext, $self) {
$output495 = '';

$output495 .= '
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure497 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments496 = array();
$arguments496['identifier'] = NULL;
$arguments496['size'] = 'small';
$arguments496['overlay'] = NULL;
$arguments496['state'] = 'default';
$arguments496['alternativeMarkupIdentifier'] = NULL;
$arguments496['identifier'] = 'actions-system-extension-update';

$output495 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments496, $renderChildrenClosure497, $renderingContext);

$output495 .= '
                                    ';
return $output495;
};
$arguments484 = array();
$arguments484['additionalAttributes'] = NULL;
$arguments484['data'] = NULL;
$arguments484['aria'] = NULL;
$arguments484['class'] = NULL;
$arguments484['dir'] = NULL;
$arguments484['id'] = NULL;
$arguments484['lang'] = NULL;
$arguments484['style'] = NULL;
$arguments484['title'] = NULL;
$arguments484['accesskey'] = NULL;
$arguments484['tabindex'] = NULL;
$arguments484['onclick'] = NULL;
$arguments484['name'] = NULL;
$arguments484['rel'] = NULL;
$arguments484['rev'] = NULL;
$arguments484['target'] = NULL;
$arguments484['action'] = NULL;
$arguments484['controller'] = NULL;
$arguments484['extensionName'] = NULL;
$arguments484['pluginName'] = NULL;
$arguments484['pageUid'] = NULL;
$arguments484['pageType'] = NULL;
$arguments484['noCache'] = NULL;
$arguments484['section'] = NULL;
$arguments484['format'] = NULL;
$arguments484['linkAccessRestrictedPages'] = NULL;
$arguments484['additionalParams'] = NULL;
$arguments484['absolute'] = NULL;
$arguments484['addQueryString'] = NULL;
$arguments484['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments484['addQueryStringMethod'] = NULL;
$arguments484['arguments'] = NULL;
$arguments484['action'] = 'updateCommentForUpdatableVersions';
$arguments484['class'] = 'btn btn-default';
// Rendering Array
$array486 = array();
$array486['data-action'] = 'update-extension';
$arguments484['additionalAttributes'] = $array486;
$arguments484['format'] = 'json';
$arguments484['controller'] = 'Download';
// Rendering Array
$array487 = array();
$array488 = array (
);$array487['extension'] = $renderingContext->getVariableProvider()->getByPath('extension.key', $array488);
$array489 = array (
);$array487['integerVersionStart'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.integerVersion', $array489);
$array490 = array (
);$array487['integerVersionStop'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.integerVersion', $array490);
$arguments484['arguments'] = $array487;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure492 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments491 = array();
$arguments491['key'] = NULL;
$arguments491['id'] = NULL;
$arguments491['default'] = NULL;
$arguments491['arguments'] = NULL;
$arguments491['extensionName'] = NULL;
$arguments491['languageKey'] = NULL;
$arguments491['alternativeLanguageKeys'] = NULL;
$arguments491['key'] = 'extensionList.updateToVersion';
// Rendering Array
$array493 = array();
$array494 = array (
);$array493['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateToVersion.version', $array494);
$arguments491['arguments'] = $array493;
$arguments484['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments491, $renderChildrenClosure492, $renderingContext);

$output483 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments484, $renderChildrenClosure485, $renderingContext);

$output483 .= '
                                ';
return $output483;
};

$output475 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments476, $renderChildrenClosure477, $renderingContext);

$output475 .= '
                        ';
return $output475;
};
$arguments470 = array();
$arguments470['then'] = NULL;
$arguments470['else'] = NULL;
$arguments470['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array472 = array();
$array473 = array (
);$array472['0'] = $renderingContext->getVariableProvider()->getByPath('extension.updateAvailable', $array473);

$expression474 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments470['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression474(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array472)
					),
					$renderingContext
				);
$arguments470['__thenClosure'] = $renderChildrenClosure471;

$output410 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments470, $renderChildrenClosure471, $renderingContext);

$output410 .= '
                    </td>
                    <td data-sort="';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure527 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments526 = array();
$arguments526['then'] = NULL;
$arguments526['else'] = NULL;
$arguments526['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array528 = array();
$array529 = array (
);$array528['0'] = $renderingContext->getVariableProvider()->getByPath('extension.installed', $array529);

$expression530 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments526['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression530(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array528)
					),
					$renderingContext
				);
$arguments526['then'] = 'active';
$arguments526['else'] = 'inactive';

$output410 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments526, $renderChildrenClosure527, $renderingContext);

$output410 .= '">
                        ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\ToggleExtensionInstallationStateViewHelper
$renderChildrenClosure532 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments531 = array();
$arguments531['additionalAttributes'] = NULL;
$arguments531['data'] = NULL;
$arguments531['aria'] = NULL;
$arguments531['class'] = NULL;
$arguments531['dir'] = NULL;
$arguments531['id'] = NULL;
$arguments531['lang'] = NULL;
$arguments531['style'] = NULL;
$arguments531['title'] = NULL;
$arguments531['accesskey'] = NULL;
$arguments531['tabindex'] = NULL;
$arguments531['onclick'] = NULL;
$arguments531['extension'] = NULL;
$array533 = array (
);$arguments531['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array533);

$output410 .= TYPO3\CMS\Extensionmanager\ViewHelpers\ToggleExtensionInstallationStateViewHelper::renderStatic($arguments531, $renderChildrenClosure532, $renderingContext);

$output410 .= '
                    </td>
                    <td>
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure535 = function() use ($renderingContext, $self) {
$output544 = '';

$output544 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure546 = function() use ($renderingContext, $self) {
$output547 = '';

$output547 .= '
                                <img class="extension-icon" src="';
$array548 = array (
);
$output547 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.icon', $array548)]);

$output547 .= '" alt="" />
                            ';
return $output547;
};
$arguments545 = array();

$output544 .= '';

$output544 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure550 = function() use ($renderingContext, $self) {
$output551 = '';

$output551 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure553 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments552 = array();
$arguments552['identifier'] = NULL;
$arguments552['size'] = 'small';
$arguments552['overlay'] = NULL;
$arguments552['state'] = 'default';
$arguments552['alternativeMarkupIdentifier'] = NULL;
$arguments552['identifier'] = 'empty-empty';

$output551 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments552, $renderChildrenClosure553, $renderingContext);

$output551 .= '
                            ';
return $output551;
};
$arguments549 = array();
$arguments549['if'] = NULL;

$output544 .= '';

$output544 .= '
                        ';
return $output544;
};
$arguments534 = array();
$arguments534['then'] = NULL;
$arguments534['else'] = NULL;
$arguments534['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array541 = array();
$array542 = array (
);$array541['0'] = $renderingContext->getVariableProvider()->getByPath('extension.icon', $array542);

$expression543 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments534['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression543(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array541)
					),
					$renderingContext
				);
$arguments534['__thenClosure'] = function() use ($renderingContext, $self) {
$output536 = '';

$output536 .= '
                                <img class="extension-icon" src="';
$array537 = array (
);
$output536 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.icon', $array537)]);

$output536 .= '" alt="" />
                            ';
return $output536;
};
$arguments534['__elseClosures'][] = function() use ($renderingContext, $self) {
$output538 = '';

$output538 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure540 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments539 = array();
$arguments539['identifier'] = NULL;
$arguments539['size'] = 'small';
$arguments539['overlay'] = NULL;
$arguments539['state'] = 'default';
$arguments539['alternativeMarkupIdentifier'] = NULL;
$arguments539['identifier'] = 'empty-empty';

$output538 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments539, $renderChildrenClosure540, $renderingContext);

$output538 .= '
                            ';
return $output538;
};

$output410 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments534, $renderChildrenClosure535, $renderingContext);

$output410 .= '
                        <span title="';
$array554 = array (
);
$output410 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.description', $array554)]);

$output410 .= '">';
$array555 = array (
);
$output410 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.title', $array555)]);

$output410 .= '</span>
                    </td>
                    <td>';
$array556 = array (
);
$output410 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extensionKey', $array556)]);

$output410 .= '</td>
                    <td>
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure558 = function() use ($renderingContext, $self) {
$output573 = '';

$output573 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure575 = function() use ($renderingContext, $self) {
$output576 = '';

$output576 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure578 = function() use ($renderingContext, $self) {
$output583 = '';

$output583 .= '
                                    ';
$array584 = array (
);
$output583 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array584)]);

$output583 .= '
                                ';
return $output583;
};
$arguments577 = array();
$arguments577['additionalAttributes'] = NULL;
$arguments577['data'] = NULL;
$arguments577['aria'] = NULL;
$arguments577['class'] = NULL;
$arguments577['dir'] = NULL;
$arguments577['id'] = NULL;
$arguments577['lang'] = NULL;
$arguments577['style'] = NULL;
$arguments577['title'] = NULL;
$arguments577['accesskey'] = NULL;
$arguments577['tabindex'] = NULL;
$arguments577['onclick'] = NULL;
$arguments577['name'] = NULL;
$arguments577['rel'] = NULL;
$arguments577['rev'] = NULL;
$arguments577['target'] = NULL;
$arguments577['action'] = NULL;
$arguments577['controller'] = NULL;
$arguments577['extensionName'] = NULL;
$arguments577['pluginName'] = NULL;
$arguments577['pageUid'] = NULL;
$arguments577['pageType'] = NULL;
$arguments577['noCache'] = NULL;
$arguments577['section'] = NULL;
$arguments577['format'] = NULL;
$arguments577['linkAccessRestrictedPages'] = NULL;
$arguments577['additionalParams'] = NULL;
$arguments577['absolute'] = NULL;
$arguments577['addQueryString'] = NULL;
$arguments577['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments577['addQueryStringMethod'] = NULL;
$arguments577['arguments'] = NULL;
$arguments577['action'] = 'showAllVersions';
// Rendering Array
$array579 = array();
$array580 = array (
);$array579['extensionKey'] = $renderingContext->getVariableProvider()->getByPath('extensionKey', $array580);
$array579['returnTo'] = 'index';
$arguments577['arguments'] = $array579;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure582 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments581 = array();
$arguments581['key'] = NULL;
$arguments581['id'] = NULL;
$arguments581['default'] = NULL;
$arguments581['arguments'] = NULL;
$arguments581['extensionName'] = NULL;
$arguments581['languageKey'] = NULL;
$arguments581['alternativeLanguageKeys'] = NULL;
$arguments581['key'] = 'showAllVersions';
$arguments577['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments581, $renderChildrenClosure582, $renderingContext);

$output576 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments577, $renderChildrenClosure578, $renderingContext);

$output576 .= '
                            ';
return $output576;
};
$arguments574 = array();

$output573 .= '';

$output573 .= '
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure586 = function() use ($renderingContext, $self) {
$output587 = '';

$output587 .= '
                                ';
$array588 = array (
);
$output587 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array588)]);

$output587 .= '
                            ';
return $output587;
};
$arguments585 = array();
$arguments585['if'] = NULL;

$output573 .= '';

$output573 .= '
                        ';
return $output573;
};
$arguments557 = array();
$arguments557['then'] = NULL;
$arguments557['else'] = NULL;
$arguments557['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array570 = array();
$array571 = array (
);$array570['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject', $array571);

$expression572 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments557['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression572(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array570)
					),
					$renderingContext
				);
$arguments557['__thenClosure'] = function() use ($renderingContext, $self) {
$output559 = '';

$output559 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure561 = function() use ($renderingContext, $self) {
$output566 = '';

$output566 .= '
                                    ';
$array567 = array (
);
$output566 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array567)]);

$output566 .= '
                                ';
return $output566;
};
$arguments560 = array();
$arguments560['additionalAttributes'] = NULL;
$arguments560['data'] = NULL;
$arguments560['aria'] = NULL;
$arguments560['class'] = NULL;
$arguments560['dir'] = NULL;
$arguments560['id'] = NULL;
$arguments560['lang'] = NULL;
$arguments560['style'] = NULL;
$arguments560['title'] = NULL;
$arguments560['accesskey'] = NULL;
$arguments560['tabindex'] = NULL;
$arguments560['onclick'] = NULL;
$arguments560['name'] = NULL;
$arguments560['rel'] = NULL;
$arguments560['rev'] = NULL;
$arguments560['target'] = NULL;
$arguments560['action'] = NULL;
$arguments560['controller'] = NULL;
$arguments560['extensionName'] = NULL;
$arguments560['pluginName'] = NULL;
$arguments560['pageUid'] = NULL;
$arguments560['pageType'] = NULL;
$arguments560['noCache'] = NULL;
$arguments560['section'] = NULL;
$arguments560['format'] = NULL;
$arguments560['linkAccessRestrictedPages'] = NULL;
$arguments560['additionalParams'] = NULL;
$arguments560['absolute'] = NULL;
$arguments560['addQueryString'] = NULL;
$arguments560['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments560['addQueryStringMethod'] = NULL;
$arguments560['arguments'] = NULL;
$arguments560['action'] = 'showAllVersions';
// Rendering Array
$array562 = array();
$array563 = array (
);$array562['extensionKey'] = $renderingContext->getVariableProvider()->getByPath('extensionKey', $array563);
$array562['returnTo'] = 'index';
$arguments560['arguments'] = $array562;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure565 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments564 = array();
$arguments564['key'] = NULL;
$arguments564['id'] = NULL;
$arguments564['default'] = NULL;
$arguments564['arguments'] = NULL;
$arguments564['extensionName'] = NULL;
$arguments564['languageKey'] = NULL;
$arguments564['alternativeLanguageKeys'] = NULL;
$arguments564['key'] = 'showAllVersions';
$arguments560['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments564, $renderChildrenClosure565, $renderingContext);

$output559 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments560, $renderChildrenClosure561, $renderingContext);

$output559 .= '
                            ';
return $output559;
};
$arguments557['__elseClosures'][] = function() use ($renderingContext, $self) {
$output568 = '';

$output568 .= '
                                ';
$array569 = array (
);
$output568 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.version', $array569)]);

$output568 .= '
                            ';
return $output568;
};

$output410 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments557, $renderChildrenClosure558, $renderingContext);

$output410 .= '
                    </td>
                    <td><span class="label label-';
$array589 = array (
);
$output410 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.state', $array589)]);

$output410 .= '">';
$array590 = array (
);
$output410 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.state', $array590)]);

$output410 .= '</span></td>
                    <td>';
$array591 = array (
);
$output410 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.type', $array591)]);

$output410 .= '</td>
                    <td>
                        <div class="btn-group">
                            ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\ProcessAvailableActionsViewHelper
$renderChildrenClosure593 = function() use ($renderingContext, $self) {
$output595 = '';

$output595 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure597 = function() use ($renderingContext, $self) {
$output601 = '';

$output601 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\RemoveExtensionViewHelper
$renderChildrenClosure603 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments602 = array();
$arguments602['additionalAttributes'] = NULL;
$arguments602['data'] = NULL;
$arguments602['aria'] = NULL;
$arguments602['class'] = NULL;
$arguments602['dir'] = NULL;
$arguments602['id'] = NULL;
$arguments602['lang'] = NULL;
$arguments602['style'] = NULL;
$arguments602['title'] = NULL;
$arguments602['accesskey'] = NULL;
$arguments602['tabindex'] = NULL;
$arguments602['onclick'] = NULL;
$arguments602['extension'] = NULL;
$arguments602['class'] = 'removeExtension btn btn-default';
$array604 = array (
);$arguments602['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array604);

$output601 .= TYPO3\CMS\Extensionmanager\ViewHelpers\RemoveExtensionViewHelper::renderStatic($arguments602, $renderChildrenClosure603, $renderingContext);

$output601 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper
$renderChildrenClosure606 = function() use ($renderingContext, $self) {
$output611 = '';

$output611 .= '
                                        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure613 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments612 = array();
$arguments612['identifier'] = NULL;
$arguments612['size'] = 'small';
$arguments612['overlay'] = NULL;
$arguments612['state'] = 'default';
$arguments612['alternativeMarkupIdentifier'] = NULL;
$arguments612['identifier'] = 'actions-system-extension-download';

$output611 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments612, $renderChildrenClosure613, $renderingContext);

$output611 .= '
                                    ';
return $output611;
};
$arguments605 = array();
$arguments605['additionalAttributes'] = NULL;
$arguments605['data'] = NULL;
$arguments605['aria'] = NULL;
$arguments605['class'] = NULL;
$arguments605['dir'] = NULL;
$arguments605['id'] = NULL;
$arguments605['lang'] = NULL;
$arguments605['style'] = NULL;
$arguments605['title'] = NULL;
$arguments605['accesskey'] = NULL;
$arguments605['tabindex'] = NULL;
$arguments605['onclick'] = NULL;
$arguments605['name'] = NULL;
$arguments605['rel'] = NULL;
$arguments605['rev'] = NULL;
$arguments605['target'] = NULL;
$arguments605['action'] = NULL;
$arguments605['controller'] = NULL;
$arguments605['extensionName'] = NULL;
$arguments605['pluginName'] = NULL;
$arguments605['pageUid'] = NULL;
$arguments605['pageType'] = NULL;
$arguments605['noCache'] = NULL;
$arguments605['section'] = NULL;
$arguments605['format'] = NULL;
$arguments605['linkAccessRestrictedPages'] = NULL;
$arguments605['additionalParams'] = NULL;
$arguments605['absolute'] = NULL;
$arguments605['addQueryString'] = NULL;
$arguments605['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments605['addQueryStringMethod'] = NULL;
$arguments605['arguments'] = NULL;
$arguments605['action'] = 'downloadExtensionZip';
$arguments605['controller'] = 'Action';
// Rendering Array
$array607 = array();
$array608 = array (
);$array607['extension'] = $renderingContext->getVariableProvider()->getByPath('extension.key', $array608);
$arguments605['arguments'] = $array607;
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure610 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments609 = array();
$arguments609['key'] = NULL;
$arguments609['id'] = NULL;
$arguments609['default'] = NULL;
$arguments609['arguments'] = NULL;
$arguments609['extensionName'] = NULL;
$arguments609['languageKey'] = NULL;
$arguments609['alternativeLanguageKeys'] = NULL;
$arguments609['key'] = 'extensionList.downloadzip';
$arguments605['title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments609, $renderChildrenClosure610, $renderingContext);
$arguments605['class'] = 'btn btn-default';

$output601 .= TYPO3\CMS\Fluid\ViewHelpers\Link\ActionViewHelper::renderStatic($arguments605, $renderChildrenClosure606, $renderingContext);

$output601 .= '
                                ';
return $output601;
};
$arguments596 = array();
$arguments596['then'] = NULL;
$arguments596['else'] = NULL;
$arguments596['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array598 = array();
$array598['0'] = '!';
$array599 = array (
);$array598['1'] = $renderingContext->getVariableProvider()->getByPath('isComposerMode', $array599);

$expression600 = function($context) {return !(TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node1"]));};
$arguments596['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression600(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array598)
					),
					$renderingContext
				);
$arguments596['__thenClosure'] = $renderChildrenClosure597;

$output595 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments596, $renderChildrenClosure597, $renderingContext);

$output595 .= '
                                ';
// Rendering ViewHelper TYPO3\CMS\Extensionmanager\ViewHelpers\ReloadSqlDataViewHelper
$renderChildrenClosure615 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments614 = array();
$arguments614['additionalAttributes'] = NULL;
$arguments614['data'] = NULL;
$arguments614['aria'] = NULL;
$arguments614['class'] = NULL;
$arguments614['dir'] = NULL;
$arguments614['id'] = NULL;
$arguments614['lang'] = NULL;
$arguments614['style'] = NULL;
$arguments614['title'] = NULL;
$arguments614['accesskey'] = NULL;
$arguments614['tabindex'] = NULL;
$arguments614['onclick'] = NULL;
$arguments614['extension'] = NULL;
$arguments614['class'] = 'btn btn-default';
$array616 = array (
);$arguments614['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array616);

$output595 .= TYPO3\CMS\Extensionmanager\ViewHelpers\ReloadSqlDataViewHelper::renderStatic($arguments614, $renderChildrenClosure615, $renderingContext);

$output595 .= '
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure618 = function() use ($renderingContext, $self) {
$output629 = '';

$output629 .= '
                                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure631 = function() use ($renderingContext, $self) {
$output632 = '';

$output632 .= '
                                        <a href="';
$array633 = array (
);
$output632 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.terObject.documentationLink', $array633)]);

$output632 .= '" target="_blank" rel="noopener noreferrer" class="btn btn-default">
                                            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure635 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments634 = array();
$arguments634['identifier'] = NULL;
$arguments634['size'] = 'small';
$arguments634['overlay'] = NULL;
$arguments634['state'] = 'default';
$arguments634['alternativeMarkupIdentifier'] = NULL;
$arguments634['identifier'] = 'actions-system-extension-documentation';
$arguments634['size'] = 'small';

$output632 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments634, $renderChildrenClosure635, $renderingContext);

$output632 .= '
                                        </a>
                                    ';
return $output632;
};
$arguments630 = array();

$output629 .= '';

$output629 .= '
                                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure637 = function() use ($renderingContext, $self) {
$output638 = '';

$output638 .= '
                                        <span class="btn btn-default disabled">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure640 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments639 = array();
$arguments639['identifier'] = NULL;
$arguments639['size'] = 'small';
$arguments639['overlay'] = NULL;
$arguments639['state'] = 'default';
$arguments639['alternativeMarkupIdentifier'] = NULL;
$arguments639['identifier'] = 'empty-empty';
$arguments639['size'] = 'small';

$output638 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments639, $renderChildrenClosure640, $renderingContext);

$output638 .= '</span>
                                    ';
return $output638;
};
$arguments636 = array();
$arguments636['if'] = NULL;

$output629 .= '';

$output629 .= '
                                ';
return $output629;
};
$arguments617 = array();
$arguments617['then'] = NULL;
$arguments617['else'] = NULL;
$arguments617['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array626 = array();
$array627 = array (
);$array626['0'] = $renderingContext->getVariableProvider()->getByPath('extension.terObject.documentationLink', $array627);

$expression628 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments617['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression628(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array626)
					),
					$renderingContext
				);
$arguments617['__thenClosure'] = function() use ($renderingContext, $self) {
$output619 = '';

$output619 .= '
                                        <a href="';
$array620 = array (
);
$output619 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('extension.terObject.documentationLink', $array620)]);

$output619 .= '" target="_blank" rel="noopener noreferrer" class="btn btn-default">
                                            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure622 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments621 = array();
$arguments621['identifier'] = NULL;
$arguments621['size'] = 'small';
$arguments621['overlay'] = NULL;
$arguments621['state'] = 'default';
$arguments621['alternativeMarkupIdentifier'] = NULL;
$arguments621['identifier'] = 'actions-system-extension-documentation';
$arguments621['size'] = 'small';

$output619 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments621, $renderChildrenClosure622, $renderingContext);

$output619 .= '
                                        </a>
                                    ';
return $output619;
};
$arguments617['__elseClosures'][] = function() use ($renderingContext, $self) {
$output623 = '';

$output623 .= '
                                        <span class="btn btn-default disabled">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure625 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments624 = array();
$arguments624['identifier'] = NULL;
$arguments624['size'] = 'small';
$arguments624['overlay'] = NULL;
$arguments624['state'] = 'default';
$arguments624['alternativeMarkupIdentifier'] = NULL;
$arguments624['identifier'] = 'empty-empty';
$arguments624['size'] = 'small';

$output623 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments624, $renderChildrenClosure625, $renderingContext);

$output623 .= '</span>
                                    ';
return $output623;
};

$output595 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments617, $renderChildrenClosure618, $renderingContext);

$output595 .= '
                            ';
return $output595;
};
$arguments592 = array();
$arguments592['additionalAttributes'] = NULL;
$arguments592['data'] = NULL;
$arguments592['aria'] = NULL;
$arguments592['extension'] = NULL;
$array594 = array (
);$arguments592['extension'] = $renderingContext->getVariableProvider()->getByPath('extension', $array594);

$output410 .= TYPO3\CMS\Extensionmanager\ViewHelpers\ProcessAvailableActionsViewHelper::renderStatic($arguments592, $renderChildrenClosure593, $renderingContext);

$output410 .= '
                        </div>
                    </td>
                    </tr>
                ';
return $output410;
};
$arguments407 = array();
$arguments407['each'] = NULL;
$arguments407['as'] = NULL;
$arguments407['key'] = NULL;
$arguments407['reverse'] = false;
$arguments407['iteration'] = NULL;
$array409 = array (
);$arguments407['each'] = $renderingContext->getVariableProvider()->getByPath('extensions', $array409);
$arguments407['as'] = 'extension';
$arguments407['key'] = 'extensionKey';

$output323 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments407, $renderChildrenClosure408, $renderingContext);

$output323 .= '
            </tbody>
        </table>
    </div>

';
return $output323;
};
$arguments321 = array();
$arguments321['name'] = NULL;
$arguments321['name'] = 'content';

$output318 .= NULL;

$output318 .= '
';

return $output318;
}


}
#