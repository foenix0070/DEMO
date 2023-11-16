<?php

class Standard_action_index_3624becbe1532e7a320f036a04873c6c1250286e extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getLayoutName(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
return (string) 'Default';
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
));
}

/**
 * section Module
 */
public function section_b8ff02892916ff59f7fbd4e617fccd01f6bca576(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
$output4 = '';

$output4 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure6 = function() use ($renderingContext, $self) {
$array7 = array (
);return $renderingContext->getVariableProvider()->getByPath('iteration.index', $array7);
};
$arguments5 = array();
$arguments5['value'] = NULL;
$arguments5['name'] = NULL;
$arguments5['name'] = 'uid';
$renderChildrenClosure6 = ($arguments5['value'] !== null) ? function() use ($arguments5) { return $arguments5['value']; } : $renderChildrenClosure6;
$output4 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments5, $renderChildrenClosure6, $renderingContext)]);

$output4 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure9 = function() use ($renderingContext, $self) {
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
$array12 = array (
);$arguments10['identifier'] = $renderingContext->getVariableProvider()->getByPath('module.iconIdentifier', $array12);
$arguments10['alternativeMarkupIdentifier'] = 'inline';
return TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments10, $renderChildrenClosure11, $renderingContext);
};
$arguments8 = array();
$arguments8['value'] = NULL;
$arguments8['name'] = NULL;
$arguments8['name'] = 'icon';
$renderChildrenClosure9 = ($arguments8['value'] !== null) ? function() use ($arguments8) { return $arguments8['value']; } : $renderChildrenClosure9;
$output4 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments8, $renderChildrenClosure9, $renderingContext)]);

$output4 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure14 = function() use ($renderingContext, $self) {
$array15 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.label', $array15);
};
$arguments13 = array();
$arguments13['value'] = NULL;
$arguments13['name'] = NULL;
$arguments13['name'] = 'label';
$renderChildrenClosure14 = ($arguments13['value'] !== null) ? function() use ($arguments13) { return $arguments13['value']; } : $renderChildrenClosure14;
$output4 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments13, $renderChildrenClosure14, $renderingContext)]);

$output4 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure17 = function() use ($renderingContext, $self) {
$array18 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.shortInfo', $array18);
};
$arguments16 = array();
$arguments16['value'] = NULL;
$arguments16['name'] = NULL;
$arguments16['name'] = 'information';
$renderChildrenClosure17 = ($arguments16['value'] !== null) ? function() use ($arguments16) { return $arguments16['value']; } : $renderChildrenClosure17;
$output4 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments16, $renderChildrenClosure17, $renderingContext)]);

$output4 .= '
        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure20 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments19 = array();
$arguments19['section'] = NULL;
$arguments19['partial'] = NULL;
$arguments19['delegate'] = NULL;
$arguments19['renderable'] = NULL;
$arguments19['arguments'] = array (
);
$arguments19['optional'] = false;
$arguments19['default'] = NULL;
$arguments19['contentAs'] = NULL;
$arguments19['debug'] = true;
$arguments19['partial'] = 'Modules/Item';
// Rendering Array
$array21 = array();
$array22 = array (
);$array21['module'] = $renderingContext->getVariableProvider()->getByPath('module', $array22);
$array23 = array (
);$array21['uid'] = $renderingContext->getVariableProvider()->getByPath('uid', $array23);
$array24 = array (
);$array21['icon'] = $renderingContext->getVariableProvider()->getByPath('icon', $array24);
$array25 = array (
);$array21['label'] = $renderingContext->getVariableProvider()->getByPath('label', $array25);
$array26 = array (
);$array21['information'] = $renderingContext->getVariableProvider()->getByPath('information', $array26);
$array27 = array (
);$array21['data'] = $renderingContext->getVariableProvider()->getByPath('data', $array27);
$array28 = array (
);$array21['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array28);
$arguments19['arguments'] = $array21;
// Rendering Boolean node
// Rendering Array
$array29 = array();
$array29['0'] = 'false';

$expression30 = function($context) {return FALSE;};
$arguments19['debug'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression30(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array29)
					),
					$renderingContext
				);

$output4 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments19, $renderChildrenClosure20, $renderingContext);

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
);$arguments1['each'] = $renderingContext->getVariableProvider()->getByPath('parentModules', $array3);
$arguments1['as'] = 'module';
$arguments1['iteration'] = 'iteration';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext);

$output0 .= '

    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure32 = function() use ($renderingContext, $self) {
$output36 = '';

$output36 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure38 = function() use ($renderingContext, $self) {
return 'hook';
};
$arguments37 = array();
$arguments37['value'] = NULL;
$arguments37['name'] = NULL;
$arguments37['name'] = 'uid';
$renderChildrenClosure38 = ($arguments37['value'] !== null) ? function() use ($arguments37) { return $arguments37['value']; } : $renderChildrenClosure38;
$output36 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments37, $renderChildrenClosure38, $renderingContext)]);

$output36 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure40 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure42 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments41 = array();
$arguments41['identifier'] = NULL;
$arguments41['size'] = 'small';
$arguments41['overlay'] = NULL;
$arguments41['state'] = 'default';
$arguments41['alternativeMarkupIdentifier'] = NULL;
$arguments41['identifier'] = 'actions-window-open';
$arguments41['alternativeMarkupIdentifier'] = 'inline';
return TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments41, $renderChildrenClosure42, $renderingContext);
};
$arguments39 = array();
$arguments39['value'] = NULL;
$arguments39['name'] = NULL;
$arguments39['name'] = 'icon';
$renderChildrenClosure40 = ($arguments39['value'] !== null) ? function() use ($arguments39) { return $arguments39['value']; } : $renderChildrenClosure40;
$output36 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments39, $renderChildrenClosure40, $renderingContext)]);

$output36 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure44 = function() use ($renderingContext, $self) {
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
$arguments45['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:deprecatedModuleLabel';
$array47 = array (
);$arguments45['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array47);
return TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments45, $renderChildrenClosure46, $renderingContext);
};
$arguments43 = array();
$arguments43['value'] = NULL;
$arguments43['name'] = NULL;
$arguments43['name'] = 'label';
$renderChildrenClosure44 = ($arguments43['value'] !== null) ? function() use ($arguments43) { return $arguments43['value']; } : $renderChildrenClosure44;
$output36 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments43, $renderChildrenClosure44, $renderingContext)]);

$output36 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure49 = function() use ($renderingContext, $self) {
$array50 = array (
);return $renderingContext->getVariableProvider()->getByPath('hookObjectModuleContent', $array50);
};
$arguments48 = array();
$arguments48['value'] = NULL;
$arguments48['name'] = NULL;
$arguments48['name'] = 'mainContent';
$renderChildrenClosure49 = ($arguments48['value'] !== null) ? function() use ($arguments48) { return $arguments48['value']; } : $renderChildrenClosure49;
$output36 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments48, $renderChildrenClosure49, $renderingContext)]);

$output36 .= '
        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure52 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments51 = array();
$arguments51['section'] = NULL;
$arguments51['partial'] = NULL;
$arguments51['delegate'] = NULL;
$arguments51['renderable'] = NULL;
$arguments51['arguments'] = array (
);
$arguments51['optional'] = false;
$arguments51['default'] = NULL;
$arguments51['contentAs'] = NULL;
$arguments51['debug'] = true;
$arguments51['partial'] = 'Modules/Item';
$output53 = '';
// Rendering Array
$array54 = array();
$array55 = array (
);$array54['uid'] = $renderingContext->getVariableProvider()->getByPath('uid', $array55);
$array56 = array (
);$array54['icon'] = $renderingContext->getVariableProvider()->getByPath('icon', $array56);
$array57 = array (
);$array54['label'] = $renderingContext->getVariableProvider()->getByPath('label', $array57);
$array58 = array (
);$array54['mainContent'] = $renderingContext->getVariableProvider()->getByPath('mainContent', $array58);
$array59 = array (
);$array54['data'] = $renderingContext->getVariableProvider()->getByPath('data', $array59);
$array60 = array (
);$array54['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array60);

$output53 .= $array54;

$output53 .= '}';
$arguments51['arguments'] = $output53;
// Rendering Boolean node
// Rendering Array
$array61 = array();
$array61['0'] = 'false';

$expression62 = function($context) {return FALSE;};
$arguments51['debug'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression62(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array61)
					),
					$renderingContext
				);

$output36 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments51, $renderChildrenClosure52, $renderingContext);

$output36 .= '
    ';
return $output36;
};
$arguments31 = array();
$arguments31['then'] = NULL;
$arguments31['else'] = NULL;
$arguments31['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array33 = array();
$array34 = array (
);$array33['0'] = $renderingContext->getVariableProvider()->getByPath('hookObjectModuleContent', $array34);

$expression35 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments31['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression35(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array33)
					),
					$renderingContext
				);
$arguments31['__thenClosure'] = $renderChildrenClosure32;

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments31, $renderChildrenClosure32, $renderingContext);

$output0 .= '

';

return $output0;
}
/**
 * section Settings
 */
public function section_c7f73bb54d928922c3838bb789ee9fb8a5b1eb37(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output63 = '';

$output63 .= '

    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure65 = function() use ($renderingContext, $self) {
return 'settings';
};
$arguments64 = array();
$arguments64['value'] = NULL;
$arguments64['name'] = NULL;
$arguments64['name'] = 'uid';
$renderChildrenClosure65 = ($arguments64['value'] !== null) ? function() use ($arguments64) { return $arguments64['value']; } : $renderChildrenClosure65;
$output63 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments64, $renderChildrenClosure65, $renderingContext)]);

$output63 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure67 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure69 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments68 = array();
$arguments68['identifier'] = NULL;
$arguments68['size'] = 'small';
$arguments68['overlay'] = NULL;
$arguments68['state'] = 'default';
$arguments68['alternativeMarkupIdentifier'] = NULL;
$arguments68['identifier'] = 'actions-system-extension-configure';
$arguments68['alternativeMarkupIdentifier'] = 'inline';
return TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments68, $renderChildrenClosure69, $renderingContext);
};
$arguments66 = array();
$arguments66['value'] = NULL;
$arguments66['name'] = NULL;
$arguments66['name'] = 'icon';
$renderChildrenClosure67 = ($arguments66['value'] !== null) ? function() use ($arguments66) { return $arguments66['value']; } : $renderChildrenClosure67;
$output63 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments66, $renderChildrenClosure67, $renderingContext)]);

$output63 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure71 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure73 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments72 = array();
$arguments72['key'] = NULL;
$arguments72['id'] = NULL;
$arguments72['default'] = NULL;
$arguments72['arguments'] = NULL;
$arguments72['extensionName'] = NULL;
$arguments72['languageKey'] = NULL;
$arguments72['alternativeLanguageKeys'] = NULL;
$arguments72['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:settings.label';
$array74 = array (
);$arguments72['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array74);
return TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments72, $renderChildrenClosure73, $renderingContext);
};
$arguments70 = array();
$arguments70['value'] = NULL;
$arguments70['name'] = NULL;
$arguments70['name'] = 'label';
$renderChildrenClosure71 = ($arguments70['value'] !== null) ? function() use ($arguments70) { return $arguments70['value']; } : $renderChildrenClosure71;
$output63 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments70, $renderChildrenClosure71, $renderingContext)]);

$output63 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure76 = function() use ($renderingContext, $self) {
$array77 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.shortInfo', $array77);
};
$arguments75 = array();
$arguments75['value'] = NULL;
$arguments75['name'] = NULL;
$arguments75['name'] = 'information';
$renderChildrenClosure76 = ($arguments75['value'] !== null) ? function() use ($arguments75) { return $arguments75['value']; } : $renderChildrenClosure76;
$output63 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments75, $renderChildrenClosure76, $renderingContext)]);

$output63 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure79 = function() use ($renderingContext, $self) {
$output80 = '';

$output80 .= '
        <h1 class="typo3-adminPanel-headline">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure82 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments81 = array();
$arguments81['key'] = NULL;
$arguments81['id'] = NULL;
$arguments81['default'] = NULL;
$arguments81['arguments'] = NULL;
$arguments81['extensionName'] = NULL;
$arguments81['languageKey'] = NULL;
$arguments81['alternativeLanguageKeys'] = NULL;
$arguments81['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:settings.label';
$array83 = array (
);$arguments81['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array83);

$output80 .= TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments81, $renderChildrenClosure82, $renderingContext);

$output80 .= '</h1>
        <div class="typo3-adminPanel-card-group">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure85 = function() use ($renderingContext, $self) {
$output87 = '';

$output87 .= '
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure89 = function() use ($renderingContext, $self) {
$output93 = '';

$output93 .= '
                    <div class="typo3-adminPanel-card">
                        <div class="typo3-adminPanel-card-header">
                            <h2 class="typo3-adminPanel-card-header-headline">
                                <span class="typo3-adminPanel-card-header-icon">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure95 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments94 = array();
$arguments94['identifier'] = NULL;
$arguments94['size'] = 'small';
$arguments94['overlay'] = NULL;
$arguments94['state'] = 'default';
$arguments94['alternativeMarkupIdentifier'] = NULL;
$array96 = array (
);$arguments94['identifier'] = $renderingContext->getVariableProvider()->getByPath('module.iconIdentifier', $array96);
$arguments94['alternativeMarkupIdentifier'] = 'inline';

$output93 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments94, $renderChildrenClosure95, $renderingContext);

$output93 .= '</span>
                                <span class="typo3-adminPanel-card-header-text">';
$array97 = array (
);
$output93 .= $renderingContext->getVariableProvider()->getByPath('module.label', $array97);

$output93 .= '</span>
                            </h2>
                        </div>
                        <div class="typo3-adminPanel-card-body">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure99 = function() use ($renderingContext, $self) {
$array100 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.pageSettings', $array100);
};
$arguments98 = array();
$arguments98['value'] = NULL;

$output93 .= isset($arguments98['value']) ? $arguments98['value'] : $renderChildrenClosure99();

$output93 .= '</div>
                    </div>
                ';
return $output93;
};
$arguments88 = array();
$arguments88['then'] = NULL;
$arguments88['else'] = NULL;
$arguments88['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array90 = array();
$array91 = array (
);$array90['0'] = $renderingContext->getVariableProvider()->getByPath('module.pageSettings', $array91);

$expression92 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments88['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression92(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array90)
					),
					$renderingContext
				);
$arguments88['__thenClosure'] = $renderChildrenClosure89;

$output87 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments88, $renderChildrenClosure89, $renderingContext);

$output87 .= '
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
);$arguments84['each'] = $renderingContext->getVariableProvider()->getByPath('settingsModules', $array86);
$arguments84['as'] = 'module';

$output80 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments84, $renderChildrenClosure85, $renderingContext);

$output80 .= '
        </div>
        <div class="typo3-adminPanel-form-group">
            <button data-typo3-role="typo3-adminPanel-saveButton" class="typo3-adminPanel-btn typo3-adminPanel-btn-primary">
                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure102 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments101 = array();
$arguments101['key'] = NULL;
$arguments101['id'] = NULL;
$arguments101['default'] = NULL;
$arguments101['arguments'] = NULL;
$arguments101['extensionName'] = NULL;
$arguments101['languageKey'] = NULL;
$arguments101['alternativeLanguageKeys'] = NULL;
$arguments101['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:settings.updateButtonLabel';
$array103 = array (
);$arguments101['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array103);

$output80 .= TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments101, $renderChildrenClosure102, $renderingContext);

$output80 .= '
            </button>
        </div>
    ';
return $output80;
};
$arguments78 = array();
$arguments78['value'] = NULL;
$arguments78['name'] = NULL;
$arguments78['name'] = 'mainContent';
$renderChildrenClosure79 = ($arguments78['value'] !== null) ? function() use ($arguments78) { return $arguments78['value']; } : $renderChildrenClosure79;
$output63 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments78, $renderChildrenClosure79, $renderingContext)]);

$output63 .= '
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure105 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments104 = array();
$arguments104['section'] = NULL;
$arguments104['partial'] = NULL;
$arguments104['delegate'] = NULL;
$arguments104['renderable'] = NULL;
$arguments104['arguments'] = array (
);
$arguments104['optional'] = false;
$arguments104['default'] = NULL;
$arguments104['contentAs'] = NULL;
$arguments104['debug'] = true;
$arguments104['partial'] = 'Modules/Item';
// Rendering Array
$array106 = array();
$array107 = array (
);$array106['uid'] = $renderingContext->getVariableProvider()->getByPath('uid', $array107);
$array108 = array (
);$array106['icon'] = $renderingContext->getVariableProvider()->getByPath('icon', $array108);
$array109 = array (
);$array106['label'] = $renderingContext->getVariableProvider()->getByPath('label', $array109);
$array110 = array (
);$array106['information'] = $renderingContext->getVariableProvider()->getByPath('information', $array110);
$array111 = array (
);$array106['mainContent'] = $renderingContext->getVariableProvider()->getByPath('mainContent', $array111);
$array112 = array (
);$array106['data'] = $renderingContext->getVariableProvider()->getByPath('data', $array112);
$array113 = array (
);$array106['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array113);
$arguments104['arguments'] = $array106;
// Rendering Boolean node
// Rendering Array
$array114 = array();
$array114['0'] = 'false';

$expression115 = function($context) {return FALSE;};
$arguments104['debug'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression115(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array114)
					),
					$renderingContext
				);

$output63 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments104, $renderChildrenClosure105, $renderingContext);

$output63 .= '
';

return $output63;
}
/**
 * Main Render function
 */
public function render(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output116 = '';

$output116 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\LayoutViewHelper
$renderChildrenClosure118 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments117 = array();
$arguments117['name'] = NULL;
$arguments117['name'] = 'Default';

$output116 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [NULL]);

$output116 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\SectionViewHelper
$renderChildrenClosure120 = function() use ($renderingContext, $self) {
$output121 = '';

$output121 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure123 = function() use ($renderingContext, $self) {
$output125 = '';

$output125 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure127 = function() use ($renderingContext, $self) {
$array128 = array (
);return $renderingContext->getVariableProvider()->getByPath('iteration.index', $array128);
};
$arguments126 = array();
$arguments126['value'] = NULL;
$arguments126['name'] = NULL;
$arguments126['name'] = 'uid';
$renderChildrenClosure127 = ($arguments126['value'] !== null) ? function() use ($arguments126) { return $arguments126['value']; } : $renderChildrenClosure127;
$output125 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments126, $renderChildrenClosure127, $renderingContext)]);

$output125 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure130 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure132 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments131 = array();
$arguments131['identifier'] = NULL;
$arguments131['size'] = 'small';
$arguments131['overlay'] = NULL;
$arguments131['state'] = 'default';
$arguments131['alternativeMarkupIdentifier'] = NULL;
$array133 = array (
);$arguments131['identifier'] = $renderingContext->getVariableProvider()->getByPath('module.iconIdentifier', $array133);
$arguments131['alternativeMarkupIdentifier'] = 'inline';
return TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments131, $renderChildrenClosure132, $renderingContext);
};
$arguments129 = array();
$arguments129['value'] = NULL;
$arguments129['name'] = NULL;
$arguments129['name'] = 'icon';
$renderChildrenClosure130 = ($arguments129['value'] !== null) ? function() use ($arguments129) { return $arguments129['value']; } : $renderChildrenClosure130;
$output125 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments129, $renderChildrenClosure130, $renderingContext)]);

$output125 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure135 = function() use ($renderingContext, $self) {
$array136 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.label', $array136);
};
$arguments134 = array();
$arguments134['value'] = NULL;
$arguments134['name'] = NULL;
$arguments134['name'] = 'label';
$renderChildrenClosure135 = ($arguments134['value'] !== null) ? function() use ($arguments134) { return $arguments134['value']; } : $renderChildrenClosure135;
$output125 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments134, $renderChildrenClosure135, $renderingContext)]);

$output125 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure138 = function() use ($renderingContext, $self) {
$array139 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.shortInfo', $array139);
};
$arguments137 = array();
$arguments137['value'] = NULL;
$arguments137['name'] = NULL;
$arguments137['name'] = 'information';
$renderChildrenClosure138 = ($arguments137['value'] !== null) ? function() use ($arguments137) { return $arguments137['value']; } : $renderChildrenClosure138;
$output125 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments137, $renderChildrenClosure138, $renderingContext)]);

$output125 .= '
        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure141 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments140 = array();
$arguments140['section'] = NULL;
$arguments140['partial'] = NULL;
$arguments140['delegate'] = NULL;
$arguments140['renderable'] = NULL;
$arguments140['arguments'] = array (
);
$arguments140['optional'] = false;
$arguments140['default'] = NULL;
$arguments140['contentAs'] = NULL;
$arguments140['debug'] = true;
$arguments140['partial'] = 'Modules/Item';
// Rendering Array
$array142 = array();
$array143 = array (
);$array142['module'] = $renderingContext->getVariableProvider()->getByPath('module', $array143);
$array144 = array (
);$array142['uid'] = $renderingContext->getVariableProvider()->getByPath('uid', $array144);
$array145 = array (
);$array142['icon'] = $renderingContext->getVariableProvider()->getByPath('icon', $array145);
$array146 = array (
);$array142['label'] = $renderingContext->getVariableProvider()->getByPath('label', $array146);
$array147 = array (
);$array142['information'] = $renderingContext->getVariableProvider()->getByPath('information', $array147);
$array148 = array (
);$array142['data'] = $renderingContext->getVariableProvider()->getByPath('data', $array148);
$array149 = array (
);$array142['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array149);
$arguments140['arguments'] = $array142;
// Rendering Boolean node
// Rendering Array
$array150 = array();
$array150['0'] = 'false';

$expression151 = function($context) {return FALSE;};
$arguments140['debug'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression151(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array150)
					),
					$renderingContext
				);

$output125 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments140, $renderChildrenClosure141, $renderingContext);

$output125 .= '
    ';
return $output125;
};
$arguments122 = array();
$arguments122['each'] = NULL;
$arguments122['as'] = NULL;
$arguments122['key'] = NULL;
$arguments122['reverse'] = false;
$arguments122['iteration'] = NULL;
$array124 = array (
);$arguments122['each'] = $renderingContext->getVariableProvider()->getByPath('parentModules', $array124);
$arguments122['as'] = 'module';
$arguments122['iteration'] = 'iteration';

$output121 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments122, $renderChildrenClosure123, $renderingContext);

$output121 .= '

    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure153 = function() use ($renderingContext, $self) {
$output157 = '';

$output157 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure159 = function() use ($renderingContext, $self) {
return 'hook';
};
$arguments158 = array();
$arguments158['value'] = NULL;
$arguments158['name'] = NULL;
$arguments158['name'] = 'uid';
$renderChildrenClosure159 = ($arguments158['value'] !== null) ? function() use ($arguments158) { return $arguments158['value']; } : $renderChildrenClosure159;
$output157 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments158, $renderChildrenClosure159, $renderingContext)]);

$output157 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure161 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure163 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments162 = array();
$arguments162['identifier'] = NULL;
$arguments162['size'] = 'small';
$arguments162['overlay'] = NULL;
$arguments162['state'] = 'default';
$arguments162['alternativeMarkupIdentifier'] = NULL;
$arguments162['identifier'] = 'actions-window-open';
$arguments162['alternativeMarkupIdentifier'] = 'inline';
return TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments162, $renderChildrenClosure163, $renderingContext);
};
$arguments160 = array();
$arguments160['value'] = NULL;
$arguments160['name'] = NULL;
$arguments160['name'] = 'icon';
$renderChildrenClosure161 = ($arguments160['value'] !== null) ? function() use ($arguments160) { return $arguments160['value']; } : $renderChildrenClosure161;
$output157 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments160, $renderChildrenClosure161, $renderingContext)]);

$output157 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure165 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure167 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments166 = array();
$arguments166['key'] = NULL;
$arguments166['id'] = NULL;
$arguments166['default'] = NULL;
$arguments166['arguments'] = NULL;
$arguments166['extensionName'] = NULL;
$arguments166['languageKey'] = NULL;
$arguments166['alternativeLanguageKeys'] = NULL;
$arguments166['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:deprecatedModuleLabel';
$array168 = array (
);$arguments166['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array168);
return TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments166, $renderChildrenClosure167, $renderingContext);
};
$arguments164 = array();
$arguments164['value'] = NULL;
$arguments164['name'] = NULL;
$arguments164['name'] = 'label';
$renderChildrenClosure165 = ($arguments164['value'] !== null) ? function() use ($arguments164) { return $arguments164['value']; } : $renderChildrenClosure165;
$output157 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments164, $renderChildrenClosure165, $renderingContext)]);

$output157 .= '
        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure170 = function() use ($renderingContext, $self) {
$array171 = array (
);return $renderingContext->getVariableProvider()->getByPath('hookObjectModuleContent', $array171);
};
$arguments169 = array();
$arguments169['value'] = NULL;
$arguments169['name'] = NULL;
$arguments169['name'] = 'mainContent';
$renderChildrenClosure170 = ($arguments169['value'] !== null) ? function() use ($arguments169) { return $arguments169['value']; } : $renderChildrenClosure170;
$output157 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments169, $renderChildrenClosure170, $renderingContext)]);

$output157 .= '
        ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure173 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments172 = array();
$arguments172['section'] = NULL;
$arguments172['partial'] = NULL;
$arguments172['delegate'] = NULL;
$arguments172['renderable'] = NULL;
$arguments172['arguments'] = array (
);
$arguments172['optional'] = false;
$arguments172['default'] = NULL;
$arguments172['contentAs'] = NULL;
$arguments172['debug'] = true;
$arguments172['partial'] = 'Modules/Item';
$output174 = '';
// Rendering Array
$array175 = array();
$array176 = array (
);$array175['uid'] = $renderingContext->getVariableProvider()->getByPath('uid', $array176);
$array177 = array (
);$array175['icon'] = $renderingContext->getVariableProvider()->getByPath('icon', $array177);
$array178 = array (
);$array175['label'] = $renderingContext->getVariableProvider()->getByPath('label', $array178);
$array179 = array (
);$array175['mainContent'] = $renderingContext->getVariableProvider()->getByPath('mainContent', $array179);
$array180 = array (
);$array175['data'] = $renderingContext->getVariableProvider()->getByPath('data', $array180);
$array181 = array (
);$array175['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array181);

$output174 .= $array175;

$output174 .= '}';
$arguments172['arguments'] = $output174;
// Rendering Boolean node
// Rendering Array
$array182 = array();
$array182['0'] = 'false';

$expression183 = function($context) {return FALSE;};
$arguments172['debug'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression183(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array182)
					),
					$renderingContext
				);

$output157 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments172, $renderChildrenClosure173, $renderingContext);

$output157 .= '
    ';
return $output157;
};
$arguments152 = array();
$arguments152['then'] = NULL;
$arguments152['else'] = NULL;
$arguments152['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array154 = array();
$array155 = array (
);$array154['0'] = $renderingContext->getVariableProvider()->getByPath('hookObjectModuleContent', $array155);

$expression156 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments152['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression156(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array154)
					),
					$renderingContext
				);
$arguments152['__thenClosure'] = $renderChildrenClosure153;

$output121 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments152, $renderChildrenClosure153, $renderingContext);

$output121 .= '

';
return $output121;
};
$arguments119 = array();
$arguments119['name'] = NULL;
$arguments119['name'] = 'Module';

$output116 .= NULL;

$output116 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\SectionViewHelper
$renderChildrenClosure185 = function() use ($renderingContext, $self) {
$output186 = '';

$output186 .= '

    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure188 = function() use ($renderingContext, $self) {
return 'settings';
};
$arguments187 = array();
$arguments187['value'] = NULL;
$arguments187['name'] = NULL;
$arguments187['name'] = 'uid';
$renderChildrenClosure188 = ($arguments187['value'] !== null) ? function() use ($arguments187) { return $arguments187['value']; } : $renderChildrenClosure188;
$output186 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments187, $renderChildrenClosure188, $renderingContext)]);

$output186 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure190 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure192 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments191 = array();
$arguments191['identifier'] = NULL;
$arguments191['size'] = 'small';
$arguments191['overlay'] = NULL;
$arguments191['state'] = 'default';
$arguments191['alternativeMarkupIdentifier'] = NULL;
$arguments191['identifier'] = 'actions-system-extension-configure';
$arguments191['alternativeMarkupIdentifier'] = 'inline';
return TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments191, $renderChildrenClosure192, $renderingContext);
};
$arguments189 = array();
$arguments189['value'] = NULL;
$arguments189['name'] = NULL;
$arguments189['name'] = 'icon';
$renderChildrenClosure190 = ($arguments189['value'] !== null) ? function() use ($arguments189) { return $arguments189['value']; } : $renderChildrenClosure190;
$output186 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments189, $renderChildrenClosure190, $renderingContext)]);

$output186 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure194 = function() use ($renderingContext, $self) {
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
$arguments195['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:settings.label';
$array197 = array (
);$arguments195['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array197);
return TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments195, $renderChildrenClosure196, $renderingContext);
};
$arguments193 = array();
$arguments193['value'] = NULL;
$arguments193['name'] = NULL;
$arguments193['name'] = 'label';
$renderChildrenClosure194 = ($arguments193['value'] !== null) ? function() use ($arguments193) { return $arguments193['value']; } : $renderChildrenClosure194;
$output186 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments193, $renderChildrenClosure194, $renderingContext)]);

$output186 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure199 = function() use ($renderingContext, $self) {
$array200 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.shortInfo', $array200);
};
$arguments198 = array();
$arguments198['value'] = NULL;
$arguments198['name'] = NULL;
$arguments198['name'] = 'information';
$renderChildrenClosure199 = ($arguments198['value'] !== null) ? function() use ($arguments198) { return $arguments198['value']; } : $renderChildrenClosure199;
$output186 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments198, $renderChildrenClosure199, $renderingContext)]);

$output186 .= '
    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure202 = function() use ($renderingContext, $self) {
$output203 = '';

$output203 .= '
        <h1 class="typo3-adminPanel-headline">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure205 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments204 = array();
$arguments204['key'] = NULL;
$arguments204['id'] = NULL;
$arguments204['default'] = NULL;
$arguments204['arguments'] = NULL;
$arguments204['extensionName'] = NULL;
$arguments204['languageKey'] = NULL;
$arguments204['alternativeLanguageKeys'] = NULL;
$arguments204['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:settings.label';
$array206 = array (
);$arguments204['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array206);

$output203 .= TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments204, $renderChildrenClosure205, $renderingContext);

$output203 .= '</h1>
        <div class="typo3-adminPanel-card-group">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure208 = function() use ($renderingContext, $self) {
$output210 = '';

$output210 .= '
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure212 = function() use ($renderingContext, $self) {
$output216 = '';

$output216 .= '
                    <div class="typo3-adminPanel-card">
                        <div class="typo3-adminPanel-card-header">
                            <h2 class="typo3-adminPanel-card-header-headline">
                                <span class="typo3-adminPanel-card-header-icon">';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\IconViewHelper
$renderChildrenClosure218 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments217 = array();
$arguments217['identifier'] = NULL;
$arguments217['size'] = 'small';
$arguments217['overlay'] = NULL;
$arguments217['state'] = 'default';
$arguments217['alternativeMarkupIdentifier'] = NULL;
$array219 = array (
);$arguments217['identifier'] = $renderingContext->getVariableProvider()->getByPath('module.iconIdentifier', $array219);
$arguments217['alternativeMarkupIdentifier'] = 'inline';

$output216 .= TYPO3\CMS\Core\ViewHelpers\IconViewHelper::renderStatic($arguments217, $renderChildrenClosure218, $renderingContext);

$output216 .= '</span>
                                <span class="typo3-adminPanel-card-header-text">';
$array220 = array (
);
$output216 .= $renderingContext->getVariableProvider()->getByPath('module.label', $array220);

$output216 .= '</span>
                            </h2>
                        </div>
                        <div class="typo3-adminPanel-card-body">';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure222 = function() use ($renderingContext, $self) {
$array223 = array (
);return $renderingContext->getVariableProvider()->getByPath('module.pageSettings', $array223);
};
$arguments221 = array();
$arguments221['value'] = NULL;

$output216 .= isset($arguments221['value']) ? $arguments221['value'] : $renderChildrenClosure222();

$output216 .= '</div>
                    </div>
                ';
return $output216;
};
$arguments211 = array();
$arguments211['then'] = NULL;
$arguments211['else'] = NULL;
$arguments211['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array213 = array();
$array214 = array (
);$array213['0'] = $renderingContext->getVariableProvider()->getByPath('module.pageSettings', $array214);

$expression215 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments211['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression215(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array213)
					),
					$renderingContext
				);
$arguments211['__thenClosure'] = $renderChildrenClosure212;

$output210 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments211, $renderChildrenClosure212, $renderingContext);

$output210 .= '
            ';
return $output210;
};
$arguments207 = array();
$arguments207['each'] = NULL;
$arguments207['as'] = NULL;
$arguments207['key'] = NULL;
$arguments207['reverse'] = false;
$arguments207['iteration'] = NULL;
$array209 = array (
);$arguments207['each'] = $renderingContext->getVariableProvider()->getByPath('settingsModules', $array209);
$arguments207['as'] = 'module';

$output203 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments207, $renderChildrenClosure208, $renderingContext);

$output203 .= '
        </div>
        <div class="typo3-adminPanel-form-group">
            <button data-typo3-role="typo3-adminPanel-saveButton" class="typo3-adminPanel-btn typo3-adminPanel-btn-primary">
                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper
$renderChildrenClosure225 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments224 = array();
$arguments224['key'] = NULL;
$arguments224['id'] = NULL;
$arguments224['default'] = NULL;
$arguments224['arguments'] = NULL;
$arguments224['extensionName'] = NULL;
$arguments224['languageKey'] = NULL;
$arguments224['alternativeLanguageKeys'] = NULL;
$arguments224['key'] = 'LLL:EXT:adminpanel/Resources/Private/Language/locallang.xlf:settings.updateButtonLabel';
$array226 = array (
);$arguments224['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array226);

$output203 .= TYPO3\CMS\Fluid\ViewHelpers\TranslateViewHelper::renderStatic($arguments224, $renderChildrenClosure225, $renderingContext);

$output203 .= '
            </button>
        </div>
    ';
return $output203;
};
$arguments201 = array();
$arguments201['value'] = NULL;
$arguments201['name'] = NULL;
$arguments201['name'] = 'mainContent';
$renderChildrenClosure202 = ($arguments201['value'] !== null) ? function() use ($arguments201) { return $arguments201['value']; } : $renderChildrenClosure202;
$output186 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments201, $renderChildrenClosure202, $renderingContext)]);

$output186 .= '
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure228 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments227 = array();
$arguments227['section'] = NULL;
$arguments227['partial'] = NULL;
$arguments227['delegate'] = NULL;
$arguments227['renderable'] = NULL;
$arguments227['arguments'] = array (
);
$arguments227['optional'] = false;
$arguments227['default'] = NULL;
$arguments227['contentAs'] = NULL;
$arguments227['debug'] = true;
$arguments227['partial'] = 'Modules/Item';
// Rendering Array
$array229 = array();
$array230 = array (
);$array229['uid'] = $renderingContext->getVariableProvider()->getByPath('uid', $array230);
$array231 = array (
);$array229['icon'] = $renderingContext->getVariableProvider()->getByPath('icon', $array231);
$array232 = array (
);$array229['label'] = $renderingContext->getVariableProvider()->getByPath('label', $array232);
$array233 = array (
);$array229['information'] = $renderingContext->getVariableProvider()->getByPath('information', $array233);
$array234 = array (
);$array229['mainContent'] = $renderingContext->getVariableProvider()->getByPath('mainContent', $array234);
$array235 = array (
);$array229['data'] = $renderingContext->getVariableProvider()->getByPath('data', $array235);
$array236 = array (
);$array229['languageKey'] = $renderingContext->getVariableProvider()->getByPath('languageKey', $array236);
$arguments227['arguments'] = $array229;
// Rendering Boolean node
// Rendering Array
$array237 = array();
$array237['0'] = 'false';

$expression238 = function($context) {return FALSE;};
$arguments227['debug'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression238(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array237)
					),
					$renderingContext
				);

$output186 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments227, $renderChildrenClosure228, $renderingContext);

$output186 .= '
';
return $output186;
};
$arguments184 = array();
$arguments184['name'] = NULL;
$arguments184['name'] = 'Settings';

$output116 .= NULL;

$output116 .= '

';

return $output116;
}


}
#