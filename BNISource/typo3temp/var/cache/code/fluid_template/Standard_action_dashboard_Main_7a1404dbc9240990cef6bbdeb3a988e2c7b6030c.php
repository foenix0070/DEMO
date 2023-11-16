<?php

class Standard_action_dashboard_Main_7a1404dbc9240990cef6bbdeb3a988e2c7b6030c extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getLayoutName(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
return (string) '';
}
public function hasLayout() {
return FALSE;
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
));
}

/**
 * Main Render function
 */
public function render(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '
<div class="dashboard-header">

    <div class="dashboard-tabs">
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
$output4 = '';

$output4 .= '
            ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper
$renderChildrenClosure6 = function() use ($renderingContext, $self) {
$output16 = '';

$output16 .= '
                ';
$array17 = array (
);
$output16 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('dashboard.title', $array17)]);

$output16 .= '
            ';
return $output16;
};
$arguments5 = array();
$arguments5['additionalAttributes'] = NULL;
$arguments5['data'] = NULL;
$arguments5['aria'] = NULL;
$arguments5['route'] = NULL;
$arguments5['parameters'] = array (
);
$arguments5['referenceType'] = 'absolute';
$arguments5['name'] = NULL;
$arguments5['rel'] = NULL;
$arguments5['rev'] = NULL;
$arguments5['target'] = NULL;
$arguments5['class'] = NULL;
$arguments5['dir'] = NULL;
$arguments5['id'] = NULL;
$arguments5['lang'] = NULL;
$arguments5['style'] = NULL;
$arguments5['title'] = NULL;
$arguments5['accesskey'] = NULL;
$arguments5['tabindex'] = NULL;
$arguments5['onclick'] = NULL;
$arguments5['route'] = 'dashboard';
// Rendering Array
$array7 = array();
$array7['action'] = 'setActiveDashboard';
$array8 = array (
);$array7['currentDashboard'] = $renderingContext->getVariableProvider()->getByPath('dashboardKey', $array8);
$arguments5['parameters'] = $array7;
$output9 = '';

$output9 .= 'dashboard-tab ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure11 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments10 = array();
$arguments10['then'] = NULL;
$arguments10['else'] = NULL;
$arguments10['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array12 = array();
$array13 = array (
);$array12['0'] = $renderingContext->getVariableProvider()->getByPath('dashboardKey', $array13);
$array12['1'] = ' == ';
$array14 = array (
);$array12['2'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.identifier', $array14);

$expression15 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node2"]));};
$arguments10['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression15(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array12)
					),
					$renderingContext
				);
$arguments10['then'] = 'dashboard-tab--active';

$output9 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments10, $renderChildrenClosure11, $renderingContext);
$arguments5['class'] = $output9;

$output4 .= TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper::renderStatic($arguments5, $renderChildrenClosure6, $renderingContext);

$output4 .= '
        ';
return $output4;
};
$arguments1 = array();
$arguments1['each'] = NULL;
$arguments1['as'] = NULL;
$arguments1['key'] = NULL;
$arguments1['reverse'] = false;
$arguments1['iteration'] = NULL;
$array3 = array (
);$arguments1['each'] = $renderingContext->getVariableProvider()->getByPath('availableDashboards', $array3);
$arguments1['as'] = 'dashboard';
$arguments1['key'] = 'dashboardKey';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext);

$output0 .= '
        <a href="';
$array18 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('addDashboardUri', $array18)]);

$output0 .= '" class="js-dashboard-modal dashboard-button dashboard-button-tab-add" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure20 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments19 = array();
$arguments19['key'] = NULL;
$arguments19['id'] = NULL;
$arguments19['default'] = NULL;
$arguments19['arguments'] = NULL;
$arguments19['extensionName'] = NULL;
$arguments19['languageKey'] = NULL;
$arguments19['alternativeLanguageKeys'] = NULL;
$arguments19['key'] = 'dashboard.add';
$arguments19['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments19, $renderChildrenClosure20, $renderingContext)]);

$output0 .= '" data-modal-identifier="add" data-modal-title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure22 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments21 = array();
$arguments21['key'] = NULL;
$arguments21['id'] = NULL;
$arguments21['default'] = NULL;
$arguments21['arguments'] = NULL;
$arguments21['extensionName'] = NULL;
$arguments21['languageKey'] = NULL;
$arguments21['alternativeLanguageKeys'] = NULL;
$arguments21['key'] = 'dashboard.add';
$arguments21['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments21, $renderChildrenClosure22, $renderingContext)]);

$output0 .= '" data-button-close-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure24 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments23 = array();
$arguments23['key'] = NULL;
$arguments23['id'] = NULL;
$arguments23['default'] = NULL;
$arguments23['arguments'] = NULL;
$arguments23['extensionName'] = NULL;
$arguments23['languageKey'] = NULL;
$arguments23['alternativeLanguageKeys'] = NULL;
$arguments23['key'] = 'dashboard.add.button.close';
$arguments23['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments23, $renderChildrenClosure24, $renderingContext)]);

$output0 .= '" data-button-ok-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure26 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments25 = array();
$arguments25['key'] = NULL;
$arguments25['id'] = NULL;
$arguments25['default'] = NULL;
$arguments25['arguments'] = NULL;
$arguments25['extensionName'] = NULL;
$arguments25['languageKey'] = NULL;
$arguments25['alternativeLanguageKeys'] = NULL;
$arguments25['key'] = 'dashboard.add.button.ok';
$arguments25['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments25, $renderChildrenClosure26, $renderingContext)]);

$output0 .= '">
            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure28 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments27 = array();
$arguments27['identifier'] = NULL;
$arguments27['size'] = 'small';
$arguments27['overlay'] = NULL;
$arguments27['state'] = 'default';
$arguments27['alternativeMarkupIdentifier'] = NULL;
$arguments27['identifier'] = 'actions-add';
$arguments27['alternativeMarkupIdentifier'] = 'inline';

$output0 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments27, $renderChildrenClosure28, $renderingContext);

$output0 .= '<span class="visually-hidden">';
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
$arguments29['key'] = 'dashboard.add';
$arguments29['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments29, $renderChildrenClosure30, $renderingContext)]);

$output0 .= '</span>
        </a>
    </div>

    <div class="dashboard-configuration btn-toolbar" role="toolbar">
        <a href="';
$array31 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('configureDashboardUri', $array31)]);

$output0 .= '" class="js-dashboard-modal btn btn-default btn-sm" data-modal-identifier="configure" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure33 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments32 = array();
$arguments32['key'] = NULL;
$arguments32['id'] = NULL;
$arguments32['default'] = NULL;
$arguments32['arguments'] = NULL;
$arguments32['extensionName'] = NULL;
$arguments32['languageKey'] = NULL;
$arguments32['alternativeLanguageKeys'] = NULL;
$arguments32['key'] = 'dashboard.configure';
$arguments32['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments32, $renderChildrenClosure33, $renderingContext)]);

$output0 .= '" data-modal-title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure35 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments34 = array();
$arguments34['key'] = NULL;
$arguments34['id'] = NULL;
$arguments34['default'] = NULL;
$arguments34['arguments'] = NULL;
$arguments34['extensionName'] = NULL;
$arguments34['languageKey'] = NULL;
$arguments34['alternativeLanguageKeys'] = NULL;
$arguments34['key'] = 'dashboard.configure';
$arguments34['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments34, $renderChildrenClosure35, $renderingContext)]);

$output0 .= '" data-button-close-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure37 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments36 = array();
$arguments36['key'] = NULL;
$arguments36['id'] = NULL;
$arguments36['default'] = NULL;
$arguments36['arguments'] = NULL;
$arguments36['extensionName'] = NULL;
$arguments36['languageKey'] = NULL;
$arguments36['alternativeLanguageKeys'] = NULL;
$arguments36['key'] = 'dashboard.configure.button.close';
$arguments36['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments36, $renderChildrenClosure37, $renderingContext)]);

$output0 .= '" data-button-ok-text="';
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
$arguments38['key'] = 'dashboard.configure.button.ok';
$arguments38['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments38, $renderChildrenClosure39, $renderingContext)]);

$output0 .= '">
            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure41 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments40 = array();
$arguments40['identifier'] = NULL;
$arguments40['size'] = 'small';
$arguments40['overlay'] = NULL;
$arguments40['state'] = 'default';
$arguments40['alternativeMarkupIdentifier'] = NULL;
$arguments40['identifier'] = 'actions-cog';
$arguments40['alternativeMarkupIdentifier'] = 'inline';

$output0 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments40, $renderChildrenClosure41, $renderingContext);

$output0 .= '<span class="visually-hidden">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure43 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments42 = array();
$arguments42['key'] = NULL;
$arguments42['id'] = NULL;
$arguments42['default'] = NULL;
$arguments42['arguments'] = NULL;
$arguments42['extensionName'] = NULL;
$arguments42['languageKey'] = NULL;
$arguments42['alternativeLanguageKeys'] = NULL;
$arguments42['key'] = 'dashboard.configure';
$arguments42['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments42, $renderChildrenClosure43, $renderingContext)]);

$output0 .= '</span>
        </a>
        <a href="';
$array44 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('deleteDashboardUri', $array44)]);

$output0 .= '" class="js-dashboard-delete btn btn-default btn-sm" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure46 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments45 = array();
$arguments45['key'] = NULL;
$arguments45['id'] = NULL;
$arguments45['default'] = NULL;
$arguments45['arguments'] = NULL;
$arguments45['extensionName'] = NULL;
$arguments45['languageKey'] = NULL;
$arguments45['alternativeLanguageKeys'] = NULL;
$arguments45['key'] = 'dashboard.delete';
$arguments45['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments45, $renderChildrenClosure46, $renderingContext)]);

$output0 .= '" data-modal-title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure48 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments47 = array();
$arguments47['key'] = NULL;
$arguments47['id'] = NULL;
$arguments47['default'] = NULL;
$arguments47['arguments'] = NULL;
$arguments47['extensionName'] = NULL;
$arguments47['languageKey'] = NULL;
$arguments47['alternativeLanguageKeys'] = NULL;
$arguments47['key'] = 'dashboard.delete';
$arguments47['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments47, $renderChildrenClosure48, $renderingContext)]);

$output0 .= '" data-modal-question="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure50 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments49 = array();
$arguments49['key'] = NULL;
$arguments49['id'] = NULL;
$arguments49['default'] = NULL;
$arguments49['arguments'] = NULL;
$arguments49['extensionName'] = NULL;
$arguments49['languageKey'] = NULL;
$arguments49['alternativeLanguageKeys'] = NULL;
$arguments49['key'] = 'dashboard.delete.sure';
$arguments49['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments49, $renderChildrenClosure50, $renderingContext)]);

$output0 .= '" data-modal-ok="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure52 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments51 = array();
$arguments51['key'] = NULL;
$arguments51['id'] = NULL;
$arguments51['default'] = NULL;
$arguments51['arguments'] = NULL;
$arguments51['extensionName'] = NULL;
$arguments51['languageKey'] = NULL;
$arguments51['alternativeLanguageKeys'] = NULL;
$arguments51['key'] = 'dashboard.delete.ok';
$arguments51['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments51, $renderChildrenClosure52, $renderingContext)]);

$output0 .= '" data-modal-cancel="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure54 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments53 = array();
$arguments53['key'] = NULL;
$arguments53['id'] = NULL;
$arguments53['default'] = NULL;
$arguments53['arguments'] = NULL;
$arguments53['extensionName'] = NULL;
$arguments53['languageKey'] = NULL;
$arguments53['alternativeLanguageKeys'] = NULL;
$arguments53['key'] = 'dashboard.delete.cancel';
$arguments53['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments53, $renderChildrenClosure54, $renderingContext)]);

$output0 .= '" >
            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure56 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments55 = array();
$arguments55['identifier'] = NULL;
$arguments55['size'] = 'small';
$arguments55['overlay'] = NULL;
$arguments55['state'] = 'default';
$arguments55['alternativeMarkupIdentifier'] = NULL;
$arguments55['identifier'] = 'actions-delete';
$arguments55['alternativeMarkupIdentifier'] = 'inline';

$output0 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments55, $renderChildrenClosure56, $renderingContext);

$output0 .= '<span class="visually-hidden">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure58 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments57 = array();
$arguments57['key'] = NULL;
$arguments57['id'] = NULL;
$arguments57['default'] = NULL;
$arguments57['arguments'] = NULL;
$arguments57['extensionName'] = NULL;
$arguments57['languageKey'] = NULL;
$arguments57['alternativeLanguageKeys'] = NULL;
$arguments57['key'] = 'dashboard.delete';
$arguments57['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments57, $renderChildrenClosure58, $renderingContext)]);

$output0 .= '</span>
        </a>
    </div>

</div>

';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure60 = function() use ($renderingContext, $self) {
$output122 = '';

$output122 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure124 = function() use ($renderingContext, $self) {
$output125 = '';

$output125 .= '
        <div class="dashboard-grid">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure127 = function() use ($renderingContext, $self) {
$output129 = '';

$output129 .= '
                <div class="dashboard-item dashboard-item--w-';
$array130 = array (
);
$output129 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.width', $array130)]);

$output129 .= ' dashboard-item--h-';
$array131 = array (
);
$output129 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.height', $array131)]);

$output129 .= ' ';
$array132 = array (
);
$output129 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.additionalCssClasses', $array132)]);

$output129 .= ' dashboard-item--enableSelect" data-widget-hash="';
$array133 = array (
);
$output129 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widgetHash', $array133)]);

$output129 .= '" data-widget-key="';
$array134 = array (
);
$output129 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.identifier', $array134)]);

$output129 .= '">
                    <div class="dashboard-item-content">
                        <div class="widget widget-identifier-';
$array135 = array (
);
$output129 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.identifier', $array135)]);

$output129 .= '">
                            <div class="widget-waiting">
                                ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure137 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments136 = array();
$arguments136['identifier'] = NULL;
$arguments136['size'] = 'small';
$arguments136['overlay'] = NULL;
$arguments136['state'] = 'default';
$arguments136['alternativeMarkupIdentifier'] = NULL;
$arguments136['identifier'] = 'spinner-circle';
$arguments136['size'] = 'large';

$output129 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments136, $renderChildrenClosure137, $renderingContext);

$output129 .= '
                            </div>
                            <div class="widget-content hide"></div>
                            <div class="widget-error hide">
                                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure139 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments138 = array();
$arguments138['key'] = NULL;
$arguments138['id'] = NULL;
$arguments138['default'] = NULL;
$arguments138['arguments'] = NULL;
$arguments138['extensionName'] = NULL;
$arguments138['languageKey'] = NULL;
$arguments138['alternativeLanguageKeys'] = NULL;
$arguments138['key'] = 'widget.error';
$arguments138['extensionName'] = 'dashboard';

$output129 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments138, $renderChildrenClosure139, $renderingContext)]);

$output129 .= '
                            </div>
                            <div class="widget-actions">
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure141 = function() use ($renderingContext, $self) {
$output145 = '';

$output145 .= '
                                    <typo3-dashboard-widget-refresh>
                                        <button type="button" class="widget-action widget-action-refresh btn btn-link">
                                            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure147 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments146 = array();
$arguments146['identifier'] = NULL;
$arguments146['size'] = 'small';
$arguments146['overlay'] = NULL;
$arguments146['state'] = 'default';
$arguments146['alternativeMarkupIdentifier'] = NULL;
$arguments146['identifier'] = 'actions-refresh';
$arguments146['alternativeMarkupIdentifier'] = 'inline';

$output145 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments146, $renderChildrenClosure147, $renderingContext);

$output145 .= '
                                        </button>
                                    </typo3-dashboard-widget-refresh>
                                ';
return $output145;
};
$arguments140 = array();
$arguments140['then'] = NULL;
$arguments140['else'] = NULL;
$arguments140['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array142 = array();
$array143 = array (
);$array142['0'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.widgetOptions.{widgetHash}.refreshAvailable', $array143);

$expression144 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments140['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression144(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array142)
					),
					$renderingContext
				);
$arguments140['__thenClosure'] = $renderChildrenClosure141;

$output129 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments140, $renderChildrenClosure141, $renderingContext);

$output129 .= '
                                <div class="widget-action widget-action-move js-dashboard-move-widget">
                                    ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure149 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments148 = array();
$arguments148['identifier'] = NULL;
$arguments148['size'] = 'small';
$arguments148['overlay'] = NULL;
$arguments148['state'] = 'default';
$arguments148['alternativeMarkupIdentifier'] = NULL;
$arguments148['identifier'] = 'actions-move';
$arguments148['alternativeMarkupIdentifier'] = 'inline';

$output129 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments148, $renderChildrenClosure149, $renderingContext);

$output129 .= '
                                </div>
                                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper
$renderChildrenClosure151 = function() use ($renderingContext, $self) {
$output163 = '';

$output163 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure165 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments164 = array();
$arguments164['identifier'] = NULL;
$arguments164['size'] = 'small';
$arguments164['overlay'] = NULL;
$arguments164['state'] = 'default';
$arguments164['alternativeMarkupIdentifier'] = NULL;
$arguments164['identifier'] = 'actions-delete';
$arguments164['alternativeMarkupIdentifier'] = 'inline';

$output163 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments164, $renderChildrenClosure165, $renderingContext);

$output163 .= '
                                ';
return $output163;
};
$arguments150 = array();
$arguments150['additionalAttributes'] = NULL;
$arguments150['data'] = NULL;
$arguments150['aria'] = NULL;
$arguments150['route'] = NULL;
$arguments150['parameters'] = array (
);
$arguments150['referenceType'] = 'absolute';
$arguments150['name'] = NULL;
$arguments150['rel'] = NULL;
$arguments150['rev'] = NULL;
$arguments150['target'] = NULL;
$arguments150['class'] = NULL;
$arguments150['dir'] = NULL;
$arguments150['id'] = NULL;
$arguments150['lang'] = NULL;
$arguments150['style'] = NULL;
$arguments150['title'] = NULL;
$arguments150['accesskey'] = NULL;
$arguments150['tabindex'] = NULL;
$arguments150['onclick'] = NULL;
$arguments150['class'] = 'widget-action widget-action-remove js-dashboard-remove-widget';
$arguments150['route'] = 'dashboard';
// Rendering Array
$array152 = array();
$array152['action'] = 'removeWidget';
$array153 = array (
);$array152['widgetHash'] = $renderingContext->getVariableProvider()->getByPath('widgetHash', $array153);
$arguments150['parameters'] = $array152;
// Rendering Array
$array154 = array();
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure156 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments155 = array();
$arguments155['key'] = NULL;
$arguments155['id'] = NULL;
$arguments155['default'] = NULL;
$arguments155['arguments'] = NULL;
$arguments155['extensionName'] = NULL;
$arguments155['languageKey'] = NULL;
$arguments155['alternativeLanguageKeys'] = NULL;
$arguments155['key'] = 'widget.remove.confirm.title';
$arguments155['extensionName'] = 'dashboard';
$array154['modal-title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments155, $renderChildrenClosure156, $renderingContext);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure158 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments157 = array();
$arguments157['key'] = NULL;
$arguments157['id'] = NULL;
$arguments157['default'] = NULL;
$arguments157['arguments'] = NULL;
$arguments157['extensionName'] = NULL;
$arguments157['languageKey'] = NULL;
$arguments157['alternativeLanguageKeys'] = NULL;
$arguments157['key'] = 'widget.remove.confirm.message';
$arguments157['extensionName'] = 'dashboard';
$array154['modal-question'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments157, $renderChildrenClosure158, $renderingContext);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure160 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments159 = array();
$arguments159['key'] = NULL;
$arguments159['id'] = NULL;
$arguments159['default'] = NULL;
$arguments159['arguments'] = NULL;
$arguments159['extensionName'] = NULL;
$arguments159['languageKey'] = NULL;
$arguments159['alternativeLanguageKeys'] = NULL;
$arguments159['key'] = 'widget.remove.button.ok';
$arguments159['extensionName'] = 'dashboard';
$array154['modal-ok'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments159, $renderChildrenClosure160, $renderingContext);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure162 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments161 = array();
$arguments161['key'] = NULL;
$arguments161['id'] = NULL;
$arguments161['default'] = NULL;
$arguments161['arguments'] = NULL;
$arguments161['extensionName'] = NULL;
$arguments161['languageKey'] = NULL;
$arguments161['alternativeLanguageKeys'] = NULL;
$arguments161['key'] = 'widget.remove.button.close';
$arguments161['extensionName'] = 'dashboard';
$array154['modal-cancel'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments161, $renderChildrenClosure162, $renderingContext);
$arguments150['data'] = $array154;

$output129 .= TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper::renderStatic($arguments150, $renderChildrenClosure151, $renderingContext);

$output129 .= '
                            </div>
                        </div>
                    </div>
                </div>
            ';
return $output129;
};
$arguments126 = array();
$arguments126['each'] = NULL;
$arguments126['as'] = NULL;
$arguments126['key'] = NULL;
$arguments126['reverse'] = false;
$arguments126['iteration'] = NULL;
$array128 = array (
);$arguments126['each'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.widgets', $array128);
$arguments126['as'] = 'widget';
$arguments126['iteration'] = 'widgetIterator';
$arguments126['key'] = 'widgetHash';

$output125 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments126, $renderChildrenClosure127, $renderingContext);

$output125 .= '
        </div>
    ';
return $output125;
};
$arguments123 = array();

$output122 .= '';

$output122 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure167 = function() use ($renderingContext, $self) {
$output168 = '';

$output168 .= '
        <div class="dashboard-empty">
            <div class="dashboard-empty-content">
                <h3>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure170 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments169 = array();
$arguments169['key'] = NULL;
$arguments169['id'] = NULL;
$arguments169['default'] = NULL;
$arguments169['arguments'] = NULL;
$arguments169['extensionName'] = NULL;
$arguments169['languageKey'] = NULL;
$arguments169['alternativeLanguageKeys'] = NULL;
$arguments169['key'] = 'dashboard.empty.content.title';
$arguments169['extensionName'] = 'dashboard';

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments169, $renderChildrenClosure170, $renderingContext)]);

$output168 .= '</h3>
                <p>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure172 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments171 = array();
$arguments171['key'] = NULL;
$arguments171['id'] = NULL;
$arguments171['default'] = NULL;
$arguments171['arguments'] = NULL;
$arguments171['extensionName'] = NULL;
$arguments171['languageKey'] = NULL;
$arguments171['alternativeLanguageKeys'] = NULL;
$arguments171['key'] = 'dashboard.empty.content.description';
$arguments171['extensionName'] = 'dashboard';

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments171, $renderChildrenClosure172, $renderingContext)]);

$output168 .= '</p>
                <button class="js-dashboard-addWidget btn dashboard-button hide" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure174 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments173 = array();
$arguments173['key'] = NULL;
$arguments173['id'] = NULL;
$arguments173['default'] = NULL;
$arguments173['arguments'] = NULL;
$arguments173['extensionName'] = NULL;
$arguments173['languageKey'] = NULL;
$arguments173['alternativeLanguageKeys'] = NULL;
$arguments173['key'] = 'widget.add';
$arguments173['extensionName'] = 'dashboard';

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments173, $renderChildrenClosure174, $renderingContext)]);

$output168 .= '" data-modal-title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure176 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments175 = array();
$arguments175['key'] = NULL;
$arguments175['id'] = NULL;
$arguments175['default'] = NULL;
$arguments175['arguments'] = NULL;
$arguments175['extensionName'] = NULL;
$arguments175['languageKey'] = NULL;
$arguments175['alternativeLanguageKeys'] = NULL;
$arguments175['key'] = 'widget.add';
$arguments175['extensionName'] = 'dashboard';

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments175, $renderChildrenClosure176, $renderingContext)]);

$output168 .= '" data-button-close-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure178 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments177 = array();
$arguments177['key'] = NULL;
$arguments177['id'] = NULL;
$arguments177['default'] = NULL;
$arguments177['arguments'] = NULL;
$arguments177['extensionName'] = NULL;
$arguments177['languageKey'] = NULL;
$arguments177['alternativeLanguageKeys'] = NULL;
$arguments177['key'] = 'widget.add.button.close';
$arguments177['extensionName'] = 'dashboard';

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments177, $renderChildrenClosure178, $renderingContext)]);

$output168 .= '" data-button-ok-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure180 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments179 = array();
$arguments179['key'] = NULL;
$arguments179['id'] = NULL;
$arguments179['default'] = NULL;
$arguments179['arguments'] = NULL;
$arguments179['extensionName'] = NULL;
$arguments179['languageKey'] = NULL;
$arguments179['alternativeLanguageKeys'] = NULL;
$arguments179['key'] = 'widget.add.button.ok';
$arguments179['extensionName'] = 'dashboard';

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments179, $renderChildrenClosure180, $renderingContext)]);

$output168 .= '">
                    <span class="dashboard-button-icon">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure182 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments181 = array();
$arguments181['identifier'] = NULL;
$arguments181['size'] = 'small';
$arguments181['overlay'] = NULL;
$arguments181['state'] = 'default';
$arguments181['alternativeMarkupIdentifier'] = NULL;
$arguments181['identifier'] = 'actions-add';
$arguments181['alternativeMarkupIdentifier'] = 'inline';

$output168 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments181, $renderChildrenClosure182, $renderingContext);

$output168 .= '</span>
                    <span class="dashboard-button-text">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure184 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments183 = array();
$arguments183['key'] = NULL;
$arguments183['id'] = NULL;
$arguments183['default'] = NULL;
$arguments183['arguments'] = NULL;
$arguments183['extensionName'] = NULL;
$arguments183['languageKey'] = NULL;
$arguments183['alternativeLanguageKeys'] = NULL;
$arguments183['key'] = 'dashboard.empty.content.button';
$arguments183['extensionName'] = 'dashboard';

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments183, $renderChildrenClosure184, $renderingContext)]);

$output168 .= '</span>
                </button>
            </div>
        </div>
    ';
return $output168;
};
$arguments166 = array();
$arguments166['if'] = NULL;

$output122 .= '';

$output122 .= '
';
return $output122;
};
$arguments59 = array();
$arguments59['then'] = NULL;
$arguments59['else'] = NULL;
$arguments59['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array119 = array();
$array120 = array (
);$array119['0'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.widgets', $array120);

$expression121 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments59['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression121(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array119)
					),
					$renderingContext
				);
$arguments59['__thenClosure'] = function() use ($renderingContext, $self) {
$output61 = '';

$output61 .= '
        <div class="dashboard-grid">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure63 = function() use ($renderingContext, $self) {
$output65 = '';

$output65 .= '
                <div class="dashboard-item dashboard-item--w-';
$array66 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.width', $array66)]);

$output65 .= ' dashboard-item--h-';
$array67 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.height', $array67)]);

$output65 .= ' ';
$array68 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.additionalCssClasses', $array68)]);

$output65 .= ' dashboard-item--enableSelect" data-widget-hash="';
$array69 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widgetHash', $array69)]);

$output65 .= '" data-widget-key="';
$array70 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.identifier', $array70)]);

$output65 .= '">
                    <div class="dashboard-item-content">
                        <div class="widget widget-identifier-';
$array71 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widget.identifier', $array71)]);

$output65 .= '">
                            <div class="widget-waiting">
                                ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure73 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments72 = array();
$arguments72['identifier'] = NULL;
$arguments72['size'] = 'small';
$arguments72['overlay'] = NULL;
$arguments72['state'] = 'default';
$arguments72['alternativeMarkupIdentifier'] = NULL;
$arguments72['identifier'] = 'spinner-circle';
$arguments72['size'] = 'large';

$output65 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments72, $renderChildrenClosure73, $renderingContext);

$output65 .= '
                            </div>
                            <div class="widget-content hide"></div>
                            <div class="widget-error hide">
                                ';
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
$arguments74['key'] = 'widget.error';
$arguments74['extensionName'] = 'dashboard';

$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments74, $renderChildrenClosure75, $renderingContext)]);

$output65 .= '
                            </div>
                            <div class="widget-actions">
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure77 = function() use ($renderingContext, $self) {
$output81 = '';

$output81 .= '
                                    <typo3-dashboard-widget-refresh>
                                        <button type="button" class="widget-action widget-action-refresh btn btn-link">
                                            ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure83 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments82 = array();
$arguments82['identifier'] = NULL;
$arguments82['size'] = 'small';
$arguments82['overlay'] = NULL;
$arguments82['state'] = 'default';
$arguments82['alternativeMarkupIdentifier'] = NULL;
$arguments82['identifier'] = 'actions-refresh';
$arguments82['alternativeMarkupIdentifier'] = 'inline';

$output81 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments82, $renderChildrenClosure83, $renderingContext);

$output81 .= '
                                        </button>
                                    </typo3-dashboard-widget-refresh>
                                ';
return $output81;
};
$arguments76 = array();
$arguments76['then'] = NULL;
$arguments76['else'] = NULL;
$arguments76['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array78 = array();
$array79 = array (
);$array78['0'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.widgetOptions.{widgetHash}.refreshAvailable', $array79);

$expression80 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments76['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression80(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array78)
					),
					$renderingContext
				);
$arguments76['__thenClosure'] = $renderChildrenClosure77;

$output65 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments76, $renderChildrenClosure77, $renderingContext);

$output65 .= '
                                <div class="widget-action widget-action-move js-dashboard-move-widget">
                                    ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure85 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments84 = array();
$arguments84['identifier'] = NULL;
$arguments84['size'] = 'small';
$arguments84['overlay'] = NULL;
$arguments84['state'] = 'default';
$arguments84['alternativeMarkupIdentifier'] = NULL;
$arguments84['identifier'] = 'actions-move';
$arguments84['alternativeMarkupIdentifier'] = 'inline';

$output65 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments84, $renderChildrenClosure85, $renderingContext);

$output65 .= '
                                </div>
                                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper
$renderChildrenClosure87 = function() use ($renderingContext, $self) {
$output99 = '';

$output99 .= '
                                    ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure101 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments100 = array();
$arguments100['identifier'] = NULL;
$arguments100['size'] = 'small';
$arguments100['overlay'] = NULL;
$arguments100['state'] = 'default';
$arguments100['alternativeMarkupIdentifier'] = NULL;
$arguments100['identifier'] = 'actions-delete';
$arguments100['alternativeMarkupIdentifier'] = 'inline';

$output99 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments100, $renderChildrenClosure101, $renderingContext);

$output99 .= '
                                ';
return $output99;
};
$arguments86 = array();
$arguments86['additionalAttributes'] = NULL;
$arguments86['data'] = NULL;
$arguments86['aria'] = NULL;
$arguments86['route'] = NULL;
$arguments86['parameters'] = array (
);
$arguments86['referenceType'] = 'absolute';
$arguments86['name'] = NULL;
$arguments86['rel'] = NULL;
$arguments86['rev'] = NULL;
$arguments86['target'] = NULL;
$arguments86['class'] = NULL;
$arguments86['dir'] = NULL;
$arguments86['id'] = NULL;
$arguments86['lang'] = NULL;
$arguments86['style'] = NULL;
$arguments86['title'] = NULL;
$arguments86['accesskey'] = NULL;
$arguments86['tabindex'] = NULL;
$arguments86['onclick'] = NULL;
$arguments86['class'] = 'widget-action widget-action-remove js-dashboard-remove-widget';
$arguments86['route'] = 'dashboard';
// Rendering Array
$array88 = array();
$array88['action'] = 'removeWidget';
$array89 = array (
);$array88['widgetHash'] = $renderingContext->getVariableProvider()->getByPath('widgetHash', $array89);
$arguments86['parameters'] = $array88;
// Rendering Array
$array90 = array();
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure92 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments91 = array();
$arguments91['key'] = NULL;
$arguments91['id'] = NULL;
$arguments91['default'] = NULL;
$arguments91['arguments'] = NULL;
$arguments91['extensionName'] = NULL;
$arguments91['languageKey'] = NULL;
$arguments91['alternativeLanguageKeys'] = NULL;
$arguments91['key'] = 'widget.remove.confirm.title';
$arguments91['extensionName'] = 'dashboard';
$array90['modal-title'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments91, $renderChildrenClosure92, $renderingContext);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure94 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments93 = array();
$arguments93['key'] = NULL;
$arguments93['id'] = NULL;
$arguments93['default'] = NULL;
$arguments93['arguments'] = NULL;
$arguments93['extensionName'] = NULL;
$arguments93['languageKey'] = NULL;
$arguments93['alternativeLanguageKeys'] = NULL;
$arguments93['key'] = 'widget.remove.confirm.message';
$arguments93['extensionName'] = 'dashboard';
$array90['modal-question'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments93, $renderChildrenClosure94, $renderingContext);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure96 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments95 = array();
$arguments95['key'] = NULL;
$arguments95['id'] = NULL;
$arguments95['default'] = NULL;
$arguments95['arguments'] = NULL;
$arguments95['extensionName'] = NULL;
$arguments95['languageKey'] = NULL;
$arguments95['alternativeLanguageKeys'] = NULL;
$arguments95['key'] = 'widget.remove.button.ok';
$arguments95['extensionName'] = 'dashboard';
$array90['modal-ok'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments95, $renderChildrenClosure96, $renderingContext);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure98 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments97 = array();
$arguments97['key'] = NULL;
$arguments97['id'] = NULL;
$arguments97['default'] = NULL;
$arguments97['arguments'] = NULL;
$arguments97['extensionName'] = NULL;
$arguments97['languageKey'] = NULL;
$arguments97['alternativeLanguageKeys'] = NULL;
$arguments97['key'] = 'widget.remove.button.close';
$arguments97['extensionName'] = 'dashboard';
$array90['modal-cancel'] = TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments97, $renderChildrenClosure98, $renderingContext);
$arguments86['data'] = $array90;

$output65 .= TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper::renderStatic($arguments86, $renderChildrenClosure87, $renderingContext);

$output65 .= '
                            </div>
                        </div>
                    </div>
                </div>
            ';
return $output65;
};
$arguments62 = array();
$arguments62['each'] = NULL;
$arguments62['as'] = NULL;
$arguments62['key'] = NULL;
$arguments62['reverse'] = false;
$arguments62['iteration'] = NULL;
$array64 = array (
);$arguments62['each'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.widgets', $array64);
$arguments62['as'] = 'widget';
$arguments62['iteration'] = 'widgetIterator';
$arguments62['key'] = 'widgetHash';

$output61 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments62, $renderChildrenClosure63, $renderingContext);

$output61 .= '
        </div>
    ';
return $output61;
};
$arguments59['__elseClosures'][] = function() use ($renderingContext, $self) {
$output102 = '';

$output102 .= '
        <div class="dashboard-empty">
            <div class="dashboard-empty-content">
                <h3>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure104 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments103 = array();
$arguments103['key'] = NULL;
$arguments103['id'] = NULL;
$arguments103['default'] = NULL;
$arguments103['arguments'] = NULL;
$arguments103['extensionName'] = NULL;
$arguments103['languageKey'] = NULL;
$arguments103['alternativeLanguageKeys'] = NULL;
$arguments103['key'] = 'dashboard.empty.content.title';
$arguments103['extensionName'] = 'dashboard';

$output102 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments103, $renderChildrenClosure104, $renderingContext)]);

$output102 .= '</h3>
                <p>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure106 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments105 = array();
$arguments105['key'] = NULL;
$arguments105['id'] = NULL;
$arguments105['default'] = NULL;
$arguments105['arguments'] = NULL;
$arguments105['extensionName'] = NULL;
$arguments105['languageKey'] = NULL;
$arguments105['alternativeLanguageKeys'] = NULL;
$arguments105['key'] = 'dashboard.empty.content.description';
$arguments105['extensionName'] = 'dashboard';

$output102 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments105, $renderChildrenClosure106, $renderingContext)]);

$output102 .= '</p>
                <button class="js-dashboard-addWidget btn dashboard-button hide" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure108 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments107 = array();
$arguments107['key'] = NULL;
$arguments107['id'] = NULL;
$arguments107['default'] = NULL;
$arguments107['arguments'] = NULL;
$arguments107['extensionName'] = NULL;
$arguments107['languageKey'] = NULL;
$arguments107['alternativeLanguageKeys'] = NULL;
$arguments107['key'] = 'widget.add';
$arguments107['extensionName'] = 'dashboard';

$output102 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments107, $renderChildrenClosure108, $renderingContext)]);

$output102 .= '" data-modal-title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure110 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments109 = array();
$arguments109['key'] = NULL;
$arguments109['id'] = NULL;
$arguments109['default'] = NULL;
$arguments109['arguments'] = NULL;
$arguments109['extensionName'] = NULL;
$arguments109['languageKey'] = NULL;
$arguments109['alternativeLanguageKeys'] = NULL;
$arguments109['key'] = 'widget.add';
$arguments109['extensionName'] = 'dashboard';

$output102 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments109, $renderChildrenClosure110, $renderingContext)]);

$output102 .= '" data-button-close-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure112 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments111 = array();
$arguments111['key'] = NULL;
$arguments111['id'] = NULL;
$arguments111['default'] = NULL;
$arguments111['arguments'] = NULL;
$arguments111['extensionName'] = NULL;
$arguments111['languageKey'] = NULL;
$arguments111['alternativeLanguageKeys'] = NULL;
$arguments111['key'] = 'widget.add.button.close';
$arguments111['extensionName'] = 'dashboard';

$output102 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments111, $renderChildrenClosure112, $renderingContext)]);

$output102 .= '" data-button-ok-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure114 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments113 = array();
$arguments113['key'] = NULL;
$arguments113['id'] = NULL;
$arguments113['default'] = NULL;
$arguments113['arguments'] = NULL;
$arguments113['extensionName'] = NULL;
$arguments113['languageKey'] = NULL;
$arguments113['alternativeLanguageKeys'] = NULL;
$arguments113['key'] = 'widget.add.button.ok';
$arguments113['extensionName'] = 'dashboard';

$output102 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments113, $renderChildrenClosure114, $renderingContext)]);

$output102 .= '">
                    <span class="dashboard-button-icon">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure116 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments115 = array();
$arguments115['identifier'] = NULL;
$arguments115['size'] = 'small';
$arguments115['overlay'] = NULL;
$arguments115['state'] = 'default';
$arguments115['alternativeMarkupIdentifier'] = NULL;
$arguments115['identifier'] = 'actions-add';
$arguments115['alternativeMarkupIdentifier'] = 'inline';

$output102 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments115, $renderChildrenClosure116, $renderingContext);

$output102 .= '</span>
                    <span class="dashboard-button-text">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure118 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments117 = array();
$arguments117['key'] = NULL;
$arguments117['id'] = NULL;
$arguments117['default'] = NULL;
$arguments117['arguments'] = NULL;
$arguments117['extensionName'] = NULL;
$arguments117['languageKey'] = NULL;
$arguments117['alternativeLanguageKeys'] = NULL;
$arguments117['key'] = 'dashboard.empty.content.button';
$arguments117['extensionName'] = 'dashboard';

$output102 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments117, $renderChildrenClosure118, $renderingContext)]);

$output102 .= '</span>
                </button>
            </div>
        </div>
    ';
return $output102;
};

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments59, $renderChildrenClosure60, $renderingContext);

$output0 .= '

<div class="dashboard-add-item">
    <button class="js-dashboard-addWidget btn dashboard-button dashboard-button-add hide" title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure186 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments185 = array();
$arguments185['key'] = NULL;
$arguments185['id'] = NULL;
$arguments185['default'] = NULL;
$arguments185['arguments'] = NULL;
$arguments185['extensionName'] = NULL;
$arguments185['languageKey'] = NULL;
$arguments185['alternativeLanguageKeys'] = NULL;
$arguments185['key'] = 'widget.add';
$arguments185['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments185, $renderChildrenClosure186, $renderingContext)]);

$output0 .= '" data-modal-title="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure188 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments187 = array();
$arguments187['key'] = NULL;
$arguments187['id'] = NULL;
$arguments187['default'] = NULL;
$arguments187['arguments'] = NULL;
$arguments187['extensionName'] = NULL;
$arguments187['languageKey'] = NULL;
$arguments187['alternativeLanguageKeys'] = NULL;
$arguments187['key'] = 'widget.add';
$arguments187['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments187, $renderChildrenClosure188, $renderingContext)]);

$output0 .= '" data-button-close-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure190 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments189 = array();
$arguments189['key'] = NULL;
$arguments189['id'] = NULL;
$arguments189['default'] = NULL;
$arguments189['arguments'] = NULL;
$arguments189['extensionName'] = NULL;
$arguments189['languageKey'] = NULL;
$arguments189['alternativeLanguageKeys'] = NULL;
$arguments189['key'] = 'widget.add.button.close';
$arguments189['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments189, $renderChildrenClosure190, $renderingContext)]);

$output0 .= '" data-button-ok-text="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure192 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments191 = array();
$arguments191['key'] = NULL;
$arguments191['id'] = NULL;
$arguments191['default'] = NULL;
$arguments191['arguments'] = NULL;
$arguments191['extensionName'] = NULL;
$arguments191['languageKey'] = NULL;
$arguments191['alternativeLanguageKeys'] = NULL;
$arguments191['key'] = 'widget.add.button.ok';
$arguments191['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments191, $renderChildrenClosure192, $renderingContext)]);

$output0 .= '">
        ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure194 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments193 = array();
$arguments193['identifier'] = NULL;
$arguments193['size'] = 'small';
$arguments193['overlay'] = NULL;
$arguments193['state'] = 'default';
$arguments193['alternativeMarkupIdentifier'] = NULL;
$arguments193['identifier'] = 'actions-add';
$arguments193['alternativeMarkupIdentifier'] = 'inline';

$output0 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments193, $renderChildrenClosure194, $renderingContext);

$output0 .= '<span class="visually-hidden">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure196 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments195 = array();
$arguments195['key'] = NULL;
$arguments195['id'] = NULL;
$arguments195['default'] = NULL;
$arguments195['arguments'] = NULL;
$arguments195['extensionName'] = NULL;
$arguments195['languageKey'] = NULL;
$arguments195['alternativeLanguageKeys'] = NULL;
$arguments195['key'] = 'widget.add';
$arguments195['extensionName'] = 'dashboard';

$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments195, $renderChildrenClosure196, $renderingContext)]);

$output0 .= '</span>
    </button>
</div>

<div id="widgetSelector" class="hide">
    <div class="dashboard-modal-tabpanel" role="tabpanel">
        <ul class="nav nav-tabs t3js-tabs" id="widget-selector" role="tablist">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure198 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments197 = array();
$arguments197['value'] = NULL;
$arguments197['name'] = NULL;
$arguments197['name'] = 'firstGroupActive';
$arguments197['value'] = 'false';
$renderChildrenClosure198 = ($arguments197['value'] !== null) ? function() use ($arguments197) { return $arguments197['value']; } : $renderChildrenClosure198;
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments197, $renderChildrenClosure198, $renderingContext)]);

$output0 .= '
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure200 = function() use ($renderingContext, $self) {
$output202 = '';

$output202 .= '
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure204 = function() use ($renderingContext, $self) {
$output208 = '';

$output208 .= '
                    <li class="t3js-tabmenu-item nav-item">
                        <a id="dashboard-widgetgroup-tab-';
$array209 = array (
);
$output208 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('groupConfiguration.identifier', $array209)]);

$output208 .= '" class="nav-link ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure211 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments210 = array();
$arguments210['then'] = NULL;
$arguments210['else'] = NULL;
$arguments210['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array212 = array();
$array213 = array (
);$array212['0'] = $renderingContext->getVariableProvider()->getByPath('firstGroupActive', $array213);
$array212['1'] = ' == \'false\'';

$expression214 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == 'false');};
$arguments210['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression214(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array212)
					),
					$renderingContext
				);
$arguments210['then'] = 'active';

$output208 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments210, $renderChildrenClosure211, $renderingContext);

$output208 .= '" data-bs-toggle="tab" href="#dashboard-widgetgroup-';
$array215 = array (
);
$output208 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('groupConfiguration.identifier', $array215)]);

$output208 .= '" role="tab" aria-controls="dashboard-widgetgroup-';
$array216 = array (
);
$output208 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('groupConfiguration.identifier', $array216)]);

$output208 .= '" aria-selected="true">';
$array217 = array (
);
$output208 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('groupConfiguration.title', $array217)]);

$output208 .= '</a>
                    </li>
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure219 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments218 = array();
$arguments218['value'] = NULL;
$arguments218['name'] = NULL;
$arguments218['name'] = 'firstGroupActive';
$arguments218['value'] = 'true';
$renderChildrenClosure219 = ($arguments218['value'] !== null) ? function() use ($arguments218) { return $arguments218['value']; } : $renderChildrenClosure219;
$output208 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments218, $renderChildrenClosure219, $renderingContext)]);

$output208 .= '
                ';
return $output208;
};
$arguments203 = array();
$arguments203['then'] = NULL;
$arguments203['else'] = NULL;
$arguments203['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array205 = array();
$array206 = array (
);$array205['0'] = $renderingContext->getVariableProvider()->getByPath('groupConfiguration.widgets', $array206);

$expression207 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments203['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression207(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array205)
					),
					$renderingContext
				);
$arguments203['__thenClosure'] = $renderChildrenClosure204;

$output202 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments203, $renderChildrenClosure204, $renderingContext);

$output202 .= '
            ';
return $output202;
};
$arguments199 = array();
$arguments199['each'] = NULL;
$arguments199['as'] = NULL;
$arguments199['key'] = NULL;
$arguments199['reverse'] = false;
$arguments199['iteration'] = NULL;
$array201 = array (
);$arguments199['each'] = $renderingContext->getVariableProvider()->getByPath('widgetGroups', $array201);
$arguments199['as'] = 'groupConfiguration';
$arguments199['iteration'] = 'iterator';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments199, $renderChildrenClosure200, $renderingContext);

$output0 .= '
        </ul>
        <div class="tab-content">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure221 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments220 = array();
$arguments220['value'] = NULL;
$arguments220['name'] = NULL;
$arguments220['name'] = 'firstGroupActive';
$arguments220['value'] = 'false';
$renderChildrenClosure221 = ($arguments220['value'] !== null) ? function() use ($arguments220) { return $arguments220['value']; } : $renderChildrenClosure221;
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments220, $renderChildrenClosure221, $renderingContext)]);

$output0 .= '
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure223 = function() use ($renderingContext, $self) {
$output225 = '';

$output225 .= '
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure227 = function() use ($renderingContext, $self) {
$output231 = '';

$output231 .= '
                    <div class="tab-pane ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure233 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments232 = array();
$arguments232['then'] = NULL;
$arguments232['else'] = NULL;
$arguments232['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array234 = array();
$array235 = array (
);$array234['0'] = $renderingContext->getVariableProvider()->getByPath('firstGroupActive', $array235);
$array234['1'] = ' == \'false\'';

$expression236 = function($context) {return (TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]) == 'false');};
$arguments232['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression236(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array234)
					),
					$renderingContext
				);
$arguments232['then'] = 'active';

$output231 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments232, $renderChildrenClosure233, $renderingContext);

$output231 .= '" id="dashboard-widgetgroup-';
$array237 = array (
);
$output231 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('groupConfiguration.identifier', $array237)]);

$output231 .= '" role="tabpanel" aria-labelledby="dashboard-widgetgroup-';
$array238 = array (
);
$output231 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('groupConfiguration.identifier', $array238)]);

$output231 .= '-tab">
                        <div class="dashboard-modal-items ">
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure240 = function() use ($renderingContext, $self) {
$output242 = '';

$output242 .= '
                                <div class="dashboard-modal-item">
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper
$renderChildrenClosure244 = function() use ($renderingContext, $self) {
$output247 = '';

$output247 .= '
                                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure249 = function() use ($renderingContext, $self) {
$output253 = '';

$output253 .= '
                                            <div class="dashboard-modal-item-icon">
                                                ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure255 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments254 = array();
$arguments254['identifier'] = NULL;
$arguments254['size'] = 'small';
$arguments254['overlay'] = NULL;
$arguments254['state'] = 'default';
$arguments254['alternativeMarkupIdentifier'] = NULL;
$arguments254['size'] = 'default';
$arguments254['alternativeMarkupIdentifier'] = 'inline';
$array256 = array (
);$arguments254['identifier'] = $renderingContext->getVariableProvider()->getByPath('widgetConfiguration.iconIdentifier', $array256);

$output253 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments254, $renderChildrenClosure255, $renderingContext);

$output253 .= '
                                            </div>
                                        ';
return $output253;
};
$arguments248 = array();
$arguments248['then'] = NULL;
$arguments248['else'] = NULL;
$arguments248['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array250 = array();
$array251 = array (
);$array250['0'] = $renderingContext->getVariableProvider()->getByPath('widgetConfiguration.iconIdentifier', $array251);

$expression252 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments248['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression252(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array250)
					),
					$renderingContext
				);
$arguments248['__thenClosure'] = $renderChildrenClosure249;

$output247 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments248, $renderChildrenClosure249, $renderingContext);

$output247 .= '
                                        <div class="dashboard-modal-item-details">
                                            <div class="dashboard-modal-item-title">
                                                ';
$array257 = array (
);
$output247 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widgetConfiguration.title', $array257)]);

$output247 .= '
                                            </div>
                                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure259 = function() use ($renderingContext, $self) {
$output263 = '';

$output263 .= '
                                                <div class="dashboard-modal-item-description">
                                                    ';
$array264 = array (
);
$output263 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('widgetConfiguration.description', $array264)]);

$output263 .= '
                                                </div>
                                            ';
return $output263;
};
$arguments258 = array();
$arguments258['then'] = NULL;
$arguments258['else'] = NULL;
$arguments258['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array260 = array();
$array261 = array (
);$array260['0'] = $renderingContext->getVariableProvider()->getByPath('widgetConfiguration.description', $array261);

$expression262 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments258['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression262(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array260)
					),
					$renderingContext
				);
$arguments258['__thenClosure'] = $renderChildrenClosure259;

$output247 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments258, $renderChildrenClosure259, $renderingContext);

$output247 .= '
                                        </div>
                                    ';
return $output247;
};
$arguments243 = array();
$arguments243['additionalAttributes'] = NULL;
$arguments243['data'] = NULL;
$arguments243['aria'] = NULL;
$arguments243['route'] = NULL;
$arguments243['parameters'] = array (
);
$arguments243['referenceType'] = 'absolute';
$arguments243['name'] = NULL;
$arguments243['rel'] = NULL;
$arguments243['rev'] = NULL;
$arguments243['target'] = NULL;
$arguments243['class'] = NULL;
$arguments243['dir'] = NULL;
$arguments243['id'] = NULL;
$arguments243['lang'] = NULL;
$arguments243['style'] = NULL;
$arguments243['title'] = NULL;
$arguments243['accesskey'] = NULL;
$arguments243['tabindex'] = NULL;
$arguments243['onclick'] = NULL;
$arguments243['class'] = 'dashboard-modal-item-block';
$arguments243['route'] = 'dashboard';
$arguments243['target'] = 'list_frame';
// Rendering Array
$array245 = array();
$array245['action'] = 'addWidget';
$array246 = array (
);$array245['widget'] = $renderingContext->getVariableProvider()->getByPath('widgetIdentifier', $array246);
$arguments243['parameters'] = $array245;

$output242 .= TYPO3\CMS\Fluid\ViewHelpers\Be\LinkViewHelper::renderStatic($arguments243, $renderChildrenClosure244, $renderingContext);

$output242 .= '
                                </div>
                            ';
return $output242;
};
$arguments239 = array();
$arguments239['each'] = NULL;
$arguments239['as'] = NULL;
$arguments239['key'] = NULL;
$arguments239['reverse'] = false;
$arguments239['iteration'] = NULL;
$array241 = array (
);$arguments239['each'] = $renderingContext->getVariableProvider()->getByPath('groupConfiguration.widgets', $array241);
$arguments239['as'] = 'widgetConfiguration';
$arguments239['key'] = 'widgetIdentifier';

$output231 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments239, $renderChildrenClosure240, $renderingContext);

$output231 .= '
                        </div>
                    </div>
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure266 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments265 = array();
$arguments265['value'] = NULL;
$arguments265['name'] = NULL;
$arguments265['name'] = 'firstGroupActive';
$arguments265['value'] = 'true';
$renderChildrenClosure266 = ($arguments265['value'] !== null) ? function() use ($arguments265) { return $arguments265['value']; } : $renderChildrenClosure266;
$output231 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments265, $renderChildrenClosure266, $renderingContext)]);

$output231 .= '
                ';
return $output231;
};
$arguments226 = array();
$arguments226['then'] = NULL;
$arguments226['else'] = NULL;
$arguments226['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array228 = array();
$array229 = array (
);$array228['0'] = $renderingContext->getVariableProvider()->getByPath('groupConfiguration.widgets', $array229);

$expression230 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments226['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression230(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array228)
					),
					$renderingContext
				);
$arguments226['__thenClosure'] = $renderChildrenClosure227;

$output225 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments226, $renderChildrenClosure227, $renderingContext);

$output225 .= '
            ';
return $output225;
};
$arguments222 = array();
$arguments222['each'] = NULL;
$arguments222['as'] = NULL;
$arguments222['key'] = NULL;
$arguments222['reverse'] = false;
$arguments222['iteration'] = NULL;
$array224 = array (
);$arguments222['each'] = $renderingContext->getVariableProvider()->getByPath('widgetGroups', $array224);
$arguments222['as'] = 'groupConfiguration';
$arguments222['iteration'] = 'iterator';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments222, $renderChildrenClosure223, $renderingContext);

$output0 .= '
        </div>
    </div>
</div>

<div id="dashboardModal-add" class="hide">
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper
$renderChildrenClosure268 = function() use ($renderingContext, $self) {
$output270 = '';

$output270 .= '
        <div class="form-group">
            <label for="dashboardModalAdd-title">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure272 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments271 = array();
$arguments271['key'] = NULL;
$arguments271['id'] = NULL;
$arguments271['default'] = NULL;
$arguments271['arguments'] = NULL;
$arguments271['extensionName'] = NULL;
$arguments271['languageKey'] = NULL;
$arguments271['alternativeLanguageKeys'] = NULL;
$arguments271['key'] = 'dashboard.title';
$arguments271['extensionName'] = 'dashboard';

$output270 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments271, $renderChildrenClosure272, $renderingContext)]);

$output270 .= '</label>
            ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper
$renderChildrenClosure274 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments273 = array();
$arguments273['additionalAttributes'] = NULL;
$arguments273['data'] = NULL;
$arguments273['aria'] = NULL;
$arguments273['name'] = NULL;
$arguments273['value'] = NULL;
$arguments273['property'] = NULL;
$arguments273['autofocus'] = NULL;
$arguments273['disabled'] = NULL;
$arguments273['maxlength'] = NULL;
$arguments273['readonly'] = NULL;
$arguments273['size'] = NULL;
$arguments273['placeholder'] = NULL;
$arguments273['pattern'] = NULL;
$arguments273['errorClass'] = 'f3-form-error';
$arguments273['class'] = NULL;
$arguments273['dir'] = NULL;
$arguments273['id'] = NULL;
$arguments273['lang'] = NULL;
$arguments273['style'] = NULL;
$arguments273['title'] = NULL;
$arguments273['accesskey'] = NULL;
$arguments273['tabindex'] = NULL;
$arguments273['onclick'] = NULL;
$arguments273['required'] = false;
$arguments273['type'] = 'text';
$arguments273['name'] = 'dashboard-title';
$arguments273['id'] = 'dashboardModalAdd-title';
$arguments273['class'] = 'form-control';
// Rendering Boolean node
// Rendering Array
$array275 = array();
$array275['0'] = 'required';

$expression276 = function($context) {return "required";};
$arguments273['required'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression276(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array275)
					),
					$renderingContext
				);

$output270 .= TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper::renderStatic($arguments273, $renderChildrenClosure274, $renderingContext);

$output270 .= '
        </div>

        <div class="dashboard-modal-items">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure278 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments277 = array();
$arguments277['value'] = NULL;
$arguments277['name'] = NULL;
$arguments277['name'] = 'dashboardShown';
$arguments277['value'] = 'false';
$renderChildrenClosure278 = ($arguments277['value'] !== null) ? function() use ($arguments277) { return $arguments277['value']; } : $renderChildrenClosure278;
$output270 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments277, $renderChildrenClosure278, $renderingContext)]);

$output270 .= '
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure280 = function() use ($renderingContext, $self) {
$output282 = '';

$output282 .= '
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure284 = function() use ($renderingContext, $self) {
$output288 = '';

$output288 .= '
                    <div class="dashboard-modal-item">
                        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Form\RadioViewHelper
$renderChildrenClosure290 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments289 = array();
$arguments289['additionalAttributes'] = NULL;
$arguments289['data'] = NULL;
$arguments289['aria'] = NULL;
$arguments289['name'] = NULL;
$arguments289['value'] = NULL;
$arguments289['property'] = NULL;
$arguments289['errorClass'] = 'f3-form-error';
$arguments289['checked'] = NULL;
$arguments289['class'] = NULL;
$arguments289['dir'] = NULL;
$arguments289['id'] = NULL;
$arguments289['lang'] = NULL;
$arguments289['style'] = NULL;
$arguments289['title'] = NULL;
$arguments289['accesskey'] = NULL;
$arguments289['tabindex'] = NULL;
$arguments289['onclick'] = NULL;
$arguments289['disabled'] = NULL;
$output291 = '';

$output291 .= 'dashboardKey-';
$array292 = array (
);
$output291 .= $renderingContext->getVariableProvider()->getByPath('availableDashboardKey', $array292);
$arguments289['id'] = $output291;
$arguments289['name'] = 'dashboard';
$arguments289['class'] = 'dashboard-modal-item-checkBox';
// Rendering Boolean node
// Rendering Array
$array293 = array();
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure295 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments294 = array();
$arguments294['then'] = NULL;
$arguments294['else'] = NULL;
$arguments294['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array296 = array();
$array297 = array (
);$array296['0'] = $renderingContext->getVariableProvider()->getByPath('dashboardShown', $array297);

$expression298 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments294['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression298(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array296)
					),
					$renderingContext
				);
$arguments294['then'] = 'false';
$arguments294['else'] = 'true';
$array293['0'] = TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments294, $renderChildrenClosure295, $renderingContext);

$expression299 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments289['checked'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression299(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array293)
					),
					$renderingContext
				);
$array300 = array (
);$arguments289['value'] = $renderingContext->getVariableProvider()->getByPath('availableDashboardKey', $array300);

$output288 .= TYPO3\CMS\Fluid\ViewHelpers\Form\RadioViewHelper::renderStatic($arguments289, $renderChildrenClosure290, $renderingContext);

$output288 .= '
                        <label for="dashboardKey-';
$array301 = array (
);
$output288 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('availableDashboardKey', $array301)]);

$output288 .= '" class="dashboard-modal-item-block">
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure303 = function() use ($renderingContext, $self) {
$output307 = '';

$output307 .= '
                                <span class="dashboard-modal-item-icon">
                                    ';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure309 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments308 = array();
$arguments308['identifier'] = NULL;
$arguments308['size'] = 'small';
$arguments308['overlay'] = NULL;
$arguments308['state'] = 'default';
$arguments308['alternativeMarkupIdentifier'] = NULL;
$arguments308['size'] = 'default';
$arguments308['alternativeMarkupIdentifier'] = 'inline';
$array310 = array (
);$arguments308['identifier'] = $renderingContext->getVariableProvider()->getByPath('availableDashboardPreset.iconIdentifier', $array310);

$output307 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments308, $renderChildrenClosure309, $renderingContext);

$output307 .= '
                                </span>
                            ';
return $output307;
};
$arguments302 = array();
$arguments302['then'] = NULL;
$arguments302['else'] = NULL;
$arguments302['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array304 = array();
$array305 = array (
);$array304['0'] = $renderingContext->getVariableProvider()->getByPath('availableDashboardPreset.iconIdentifier', $array305);

$expression306 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments302['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression306(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array304)
					),
					$renderingContext
				);
$arguments302['__thenClosure'] = $renderChildrenClosure303;

$output288 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments302, $renderChildrenClosure303, $renderingContext);

$output288 .= '
                            <span class="dashboard-modal-item-details">
                                <span class="dashboard-modal-item-title">
                                    ';
$array311 = array (
);
$output288 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('availableDashboardPreset.title', $array311)]);

$output288 .= '
                                </span>
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure313 = function() use ($renderingContext, $self) {
$output317 = '';

$output317 .= '
                                    <span class="dashboard-modal-item-description">
                                            ';
$array318 = array (
);
$output317 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('availableDashboardPreset.description', $array318)]);

$output317 .= '
                                    </span>
                                ';
return $output317;
};
$arguments312 = array();
$arguments312['then'] = NULL;
$arguments312['else'] = NULL;
$arguments312['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array314 = array();
$array315 = array (
);$array314['0'] = $renderingContext->getVariableProvider()->getByPath('availableDashboardPreset.description', $array315);

$expression316 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments312['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression316(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array314)
					),
					$renderingContext
				);
$arguments312['__thenClosure'] = $renderChildrenClosure313;

$output288 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments312, $renderChildrenClosure313, $renderingContext);

$output288 .= '
                            </span>
                        </label>
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure320 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments319 = array();
$arguments319['value'] = NULL;
$arguments319['name'] = NULL;
$arguments319['name'] = 'dashboardShown';
$arguments319['value'] = 'true';
$renderChildrenClosure320 = ($arguments319['value'] !== null) ? function() use ($arguments319) { return $arguments319['value']; } : $renderChildrenClosure320;
$output288 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments319, $renderChildrenClosure320, $renderingContext)]);

$output288 .= '
                    </div>
                ';
return $output288;
};
$arguments283 = array();
$arguments283['then'] = NULL;
$arguments283['else'] = NULL;
$arguments283['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array285 = array();
$array286 = array (
);$array285['0'] = $renderingContext->getVariableProvider()->getByPath('availableDashboardPreset.showInWizard', $array286);

$expression287 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments283['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression287(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array285)
					),
					$renderingContext
				);
$arguments283['__thenClosure'] = $renderChildrenClosure284;

$output282 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments283, $renderChildrenClosure284, $renderingContext);

$output282 .= '
            ';
return $output282;
};
$arguments279 = array();
$arguments279['each'] = NULL;
$arguments279['as'] = NULL;
$arguments279['key'] = NULL;
$arguments279['reverse'] = false;
$arguments279['iteration'] = NULL;
$array281 = array (
);$arguments279['each'] = $renderingContext->getVariableProvider()->getByPath('dashboardPresets', $array281);
$arguments279['as'] = 'availableDashboardPreset';
$arguments279['key'] = 'availableDashboardKey';

$output270 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments279, $renderChildrenClosure280, $renderingContext);

$output270 .= '
        </div>
    ';
return $output270;
};
$arguments267 = array();
$arguments267['additionalAttributes'] = NULL;
$arguments267['data'] = NULL;
$arguments267['aria'] = NULL;
$arguments267['action'] = NULL;
$arguments267['arguments'] = array (
);
$arguments267['controller'] = NULL;
$arguments267['extensionName'] = NULL;
$arguments267['pluginName'] = NULL;
$arguments267['pageUid'] = NULL;
$arguments267['object'] = NULL;
$arguments267['pageType'] = 0;
$arguments267['noCache'] = false;
$arguments267['section'] = '';
$arguments267['format'] = '';
$arguments267['additionalParams'] = array (
);
$arguments267['absolute'] = false;
$arguments267['addQueryString'] = false;
$arguments267['argumentsToBeExcludedFromQueryString'] = array (
);
$arguments267['addQueryStringMethod'] = NULL;
$arguments267['fieldNamePrefix'] = NULL;
$arguments267['actionUri'] = NULL;
$arguments267['objectName'] = NULL;
$arguments267['hiddenFieldClassName'] = NULL;
$arguments267['enctype'] = NULL;
$arguments267['method'] = NULL;
$arguments267['name'] = NULL;
$arguments267['onreset'] = NULL;
$arguments267['onsubmit'] = NULL;
$arguments267['target'] = NULL;
$arguments267['novalidate'] = NULL;
$arguments267['class'] = NULL;
$arguments267['dir'] = NULL;
$arguments267['id'] = NULL;
$arguments267['lang'] = NULL;
$arguments267['style'] = NULL;
$arguments267['title'] = NULL;
$arguments267['accesskey'] = NULL;
$arguments267['tabindex'] = NULL;
$arguments267['onclick'] = NULL;
$array269 = array (
);$arguments267['actionUri'] = $renderingContext->getVariableProvider()->getByPath('addDashboardUri', $array269);
$arguments267['id'] = 'formAddDashboard';
$arguments267['class'] = 'dashboardModal-form';
$arguments267['target'] = 'list_frame';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper::renderStatic($arguments267, $renderChildrenClosure268, $renderingContext);

$output0 .= '
</div>

<div id="dashboardModal-configure" class="hide">
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper
$renderChildrenClosure322 = function() use ($renderingContext, $self) {
$output324 = '';

$output324 .= '
        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Form\HiddenViewHelper
$renderChildrenClosure326 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments325 = array();
$arguments325['additionalAttributes'] = NULL;
$arguments325['data'] = NULL;
$arguments325['aria'] = NULL;
$arguments325['name'] = NULL;
$arguments325['value'] = NULL;
$arguments325['property'] = NULL;
$arguments325['class'] = NULL;
$arguments325['dir'] = NULL;
$arguments325['id'] = NULL;
$arguments325['lang'] = NULL;
$arguments325['style'] = NULL;
$arguments325['title'] = NULL;
$arguments325['accesskey'] = NULL;
$arguments325['tabindex'] = NULL;
$arguments325['onclick'] = NULL;
$arguments325['respectSubmittedDataValue'] = true;
$arguments325['name'] = 'currentDashboard';
$array327 = array (
);$arguments325['value'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.identifier', $array327);

$output324 .= TYPO3\CMS\Fluid\ViewHelpers\Form\HiddenViewHelper::renderStatic($arguments325, $renderChildrenClosure326, $renderingContext);

$output324 .= '
        <div class="form-group">
            <label for="dashboardModalConfigure-title">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure329 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments328 = array();
$arguments328['key'] = NULL;
$arguments328['id'] = NULL;
$arguments328['default'] = NULL;
$arguments328['arguments'] = NULL;
$arguments328['extensionName'] = NULL;
$arguments328['languageKey'] = NULL;
$arguments328['alternativeLanguageKeys'] = NULL;
$arguments328['key'] = 'dashboard.title';
$arguments328['extensionName'] = 'dashboard';

$output324 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments328, $renderChildrenClosure329, $renderingContext)]);

$output324 .= '</label>
            ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper
$renderChildrenClosure331 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments330 = array();
$arguments330['additionalAttributes'] = NULL;
$arguments330['data'] = NULL;
$arguments330['aria'] = NULL;
$arguments330['name'] = NULL;
$arguments330['value'] = NULL;
$arguments330['property'] = NULL;
$arguments330['autofocus'] = NULL;
$arguments330['disabled'] = NULL;
$arguments330['maxlength'] = NULL;
$arguments330['readonly'] = NULL;
$arguments330['size'] = NULL;
$arguments330['placeholder'] = NULL;
$arguments330['pattern'] = NULL;
$arguments330['errorClass'] = 'f3-form-error';
$arguments330['class'] = NULL;
$arguments330['dir'] = NULL;
$arguments330['id'] = NULL;
$arguments330['lang'] = NULL;
$arguments330['style'] = NULL;
$arguments330['title'] = NULL;
$arguments330['accesskey'] = NULL;
$arguments330['tabindex'] = NULL;
$arguments330['onclick'] = NULL;
$arguments330['required'] = false;
$arguments330['type'] = 'text';
$arguments330['name'] = 'dashboard[title]';
$arguments330['id'] = 'dashboardModalConfigure-title';
$arguments330['class'] = 'form-control';
$array332 = array (
);$arguments330['value'] = $renderingContext->getVariableProvider()->getByPath('currentDashboard.title', $array332);
// Rendering Boolean node
// Rendering Array
$array333 = array();
$array333['0'] = 'required';

$expression334 = function($context) {return "required";};
$arguments330['required'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression334(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array333)
					),
					$renderingContext
				);

$output324 .= TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper::renderStatic($arguments330, $renderChildrenClosure331, $renderingContext);

$output324 .= '
        </div>
    ';
return $output324;
};
$arguments321 = array();
$arguments321['additionalAttributes'] = NULL;
$arguments321['data'] = NULL;
$arguments321['aria'] = NULL;
$arguments321['action'] = NULL;
$arguments321['arguments'] = array (
);
$arguments321['controller'] = NULL;
$arguments321['extensionName'] = NULL;
$arguments321['pluginName'] = NULL;
$arguments321['pageUid'] = NULL;
$arguments321['object'] = NULL;
$arguments321['pageType'] = 0;
$arguments321['noCache'] = false;
$arguments321['section'] = '';
$arguments321['format'] = '';
$arguments321['additionalParams'] = array (
);
$arguments321['absolute'] = false;
$arguments321['addQueryString'] = false;
$arguments321['argumentsToBeExcludedFromQueryString'] = array (
);
$arguments321['addQueryStringMethod'] = NULL;
$arguments321['fieldNamePrefix'] = NULL;
$arguments321['actionUri'] = NULL;
$arguments321['objectName'] = NULL;
$arguments321['hiddenFieldClassName'] = NULL;
$arguments321['enctype'] = NULL;
$arguments321['method'] = NULL;
$arguments321['name'] = NULL;
$arguments321['onreset'] = NULL;
$arguments321['onsubmit'] = NULL;
$arguments321['target'] = NULL;
$arguments321['novalidate'] = NULL;
$arguments321['class'] = NULL;
$arguments321['dir'] = NULL;
$arguments321['id'] = NULL;
$arguments321['lang'] = NULL;
$arguments321['style'] = NULL;
$arguments321['title'] = NULL;
$arguments321['accesskey'] = NULL;
$arguments321['tabindex'] = NULL;
$arguments321['onclick'] = NULL;
$array323 = array (
);$arguments321['actionUri'] = $renderingContext->getVariableProvider()->getByPath('configureDashboardUri', $array323);
$arguments321['id'] = 'configureDashboardForm';
$arguments321['class'] = 'dashboardModal-form';
$arguments321['target'] = 'list_frame';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\FormViewHelper::renderStatic($arguments321, $renderChildrenClosure322, $renderingContext);

$output0 .= '
</div>

';

return $output0;
}


}
#