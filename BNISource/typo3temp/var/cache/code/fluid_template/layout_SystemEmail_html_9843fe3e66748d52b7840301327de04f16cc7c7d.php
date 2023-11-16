<?php

class layout_SystemEmail_html_9843fe3e66748d52b7840301327de04f16cc7c7d extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

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
    1 => NULL,
  ),
  'o' => NULL,
));
}

/**
 * Main Render function
 */
public function render(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '<!doctype html>

<head>
    <!--[if gte mso 15]>
    <xml>
        ';

$output0 .= '<o:OfficeDocumentSettings>';

$output0 .= '
            ';

$output0 .= '<o:AllowPNG/>';

$output0 .= '
            ';

$output0 .= '<o:PixelsPerInch>';

$output0 .= '96';

$output0 .= '</o:PixelsPerInch>';

$output0 .= '
        ';

$output0 .= '</o:OfficeDocumentSettings>';

$output0 .= '
    </xml>
    <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
        p {
            margin:10px 0;
            padding:0;
        }
        table {
            border-collapse:collapse;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            display:block;
            margin:0;
            padding:0;
        }
        img,
        a img {
            border:0;
            height:auto;
            outline:none;
            text-decoration:none;
        }
        body,
        #bodyTable,
        #bodyCell {
            height:100%;
            margin:0;
            padding:0;
            width:100%;
        }
        #outlook a {
            padding:0;
        }
        img {
            -ms-interpolation-mode:bicubic;
        }
        table {
            mso-table-lspace:0pt;
            mso-table-rspace:0pt;
        }
        .ReadMsgBody {
            width:100%;
        }
        .ExternalClass {
            width:100%;
        }
        p,
        a,
        td {
            mso-line-height-rule:exactly;
        }
        a[href^=tel],
        a[href^=sms] {
            color:inherit;
            cursor:default;
            text-decoration:none;
        }
        p,
        a,
        td,
        body,
        table,
        blockquote {
            -ms-text-size-adjust:100%;
            -webkit-text-size-adjust:100%;
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass td,
        .ExternalClass div,
        .ExternalClass span,
        .ExternalClass font {
            line-height:100%;
        }
        a[x-apple-data-detectors]{
            color:inherit !important;
            text-decoration:none !important;
            font-size:inherit !important;
            font-family:inherit !important;
            font-weight:inherit !important;
            line-height:inherit !important;
        }

        .templateContainer {
            max-width:600px !important;
        }
        a.button {
            display:block;
        }
        .image,.retinaImage {
            vertical-align:bottom;
        }
        .textContent {
            word-break:break-word;
        }
        .textContent img {
            height:auto !important;
        }
        .dividerBlock {
            table-layout:fixed !important;
        }
        h1 {
            color:#222222;
            font-family:\'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
            font-size:40px;
            font-style:normal;
            font-weight:bold;
            line-height:150%;
            letter-spacing:normal;
            text-align:center;
        }
        h2 {
            color:#222222;
            font-family:\'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
            font-size:34px;
            font-style:normal;
            font-weight:bold;
            line-height:150%;
            letter-spacing:normal;
            text-align:left;
        }
        h3 {
            color:#444444;
            font-family:\'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
            font-size:22px;
            font-style:normal;
            font-weight:bold;
            line-height:150%;
            letter-spacing:normal;
            text-align:left;
        }
        h4 {
            color:#999999;
            font-family:\'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
            font-size:20px;
            font-style:italic;
            font-weight:normal;
            line-height:125%;
            letter-spacing:normal;
            text-align:left;
        }
        #templateHeader {
            background-image:none;
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            border-top:0;
            border-bottom:0;
            padding-top:36px;
            padding-bottom:0;
        }
        .headerContainer {
            background-color:#ffffff;
            background-image:none;
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            border-top:1px none ;
            border-bottom:0;
            padding-top:36px;
            padding-bottom:36px;
        }
        .headerContainer .textContent,
        .headerContainer .textContent p {
            color:#808080;
            font-family:\'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
            font-size:16px;
            line-height:150%;
            text-align:left;
        }
        .headerContainer .textContent a,
        .headerContainer .textContent p a {
            color:#538bb3;
            font-weight:normal;
            text-decoration:underline;
        }
        #templateBody {
            background-color:#f2f2f2;
            background-image:none;
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            border-top:0;
            border-bottom:0;
            padding-top:0;
            padding-bottom:0;
        }
        .bodyContainer {
            background-color:#ffffff;
            background-image:none;
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            border-top:0;
            border-bottom:0;
            padding-top:0;
            padding-bottom:18px;
        }
        .bodyContainer .textContent,
        .bodyContainer .textContent p {
            color:#808080;
            font-family:\'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
            font-size:16px;
            line-height:150%;
            text-align:left;
        }
        .bodyContainer .textContent a,
        .bodyContainer .textContent p a {
            color:#538bb3;
            font-weight:normal;
            text-decoration:underline;
        }
        .bodyContainer table.statistics th,
        .bodyContainer table.statistics td {
            padding: 0 5px;
        }
        .bodyContainer table.statistics th:first-child,
        .bodyContainer table.statistics td:first-child {
            padding-left: 0;
        }
        .bodyContainer table.statistics th:last-child,
        .bodyContainer table.statistics td:last-child {
            padding-right: 0;
        }
        #templateFooter{
            background-color:#f2f2f2;
            background-image:none;
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            border-top:1px none ;
            border-bottom:0;
            padding-top:0;
            padding-bottom:36px;
        }
        .footerContainer{
            background-color:#313131;
            background-image:none;
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
            border-top:0;
            border-bottom:0;
            padding-top:45px;
            padding-bottom:45px;
        }
        .footerContainer .textContent,
        .footerContainer .textContent p {
            color:#FFFFFF;
            font-family:\'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
            font-size:12px;
            line-height:150%;
            text-align:center;
        }
        .footerContainer .textContent a,
        .footerContainer .textContent p a {
            color:#FFFFFF;
            font-weight:normal;
            text-decoration:underline;
        }
        @media only screen and (min-width:768px){
            .templateContainer {
                width:600px !important;
            }
        }
        @media only screen and (max-width: 480px){
            body,
            table,
            td,
            p,
            a {
                -webkit-text-size-adjust:none !important;
            }
            body {
                width:100% !important;
                min-width:100% !important;
            }
            h1 {
                font-size:30px !important;
                line-height:125% !important;
            }
            h2 {
                font-size:26px !important;
                line-height:125% !important;
            }
            h3 {
                font-size:20px !important;
                line-height:150% !important;
            }
            h4 {
                font-size:18px !important;
                line-height:150% !important;
            }
            .headerContainer .textContent,
            .headerContainer .textContent p {
                font-size:16px !important;
                line-height:150% !important;
            }
            .bodyContainer .textContent,
            .bodyContainer .textContent p {
                font-size:16px !important;
                line-height:150% !important;
            }
        }
    </style>
</head>
<body>


<center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable"><tr><td align="center" valign="top" id="bodyCell">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">

            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
$output13 = '';

$output13 .= '
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure15 = function() use ($renderingContext, $self) {
$output16 = '';

$output16 .= '
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure18 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments17 = array();
$arguments17['value'] = NULL;
$arguments17['name'] = NULL;
$arguments17['name'] = 'backgroundColor';
$array19 = array (
);$arguments17['value'] = $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginHighlightColor', $array19);
$renderChildrenClosure18 = ($arguments17['value'] !== null) ? function() use ($arguments17) { return $arguments17['value']; } : $renderChildrenClosure18;
$output16 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments17, $renderChildrenClosure18, $renderingContext)]);

$output16 .= '
                ';
return $output16;
};
$arguments14 = array();

$output13 .= '';

$output13 .= '
                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure21 = function() use ($renderingContext, $self) {
$output22 = '';

$output22 .= '
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure24 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments23 = array();
$arguments23['value'] = NULL;
$arguments23['name'] = NULL;
$arguments23['name'] = 'backgroundColor';
$arguments23['value'] = '#ff8700';
$renderChildrenClosure24 = ($arguments23['value'] !== null) ? function() use ($arguments23) { return $arguments23['value']; } : $renderChildrenClosure24;
$output22 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments23, $renderChildrenClosure24, $renderingContext)]);

$output22 .= '
                ';
return $output22;
};
$arguments20 = array();
$arguments20['if'] = NULL;

$output13 .= '';

$output13 .= '
            ';
return $output13;
};
$arguments1 = array();
$arguments1['then'] = NULL;
$arguments1['else'] = NULL;
$arguments1['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array10 = array();
$array11 = array (
);$array10['0'] = $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginHighlightColor', $array11);

$expression12 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments1['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression12(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array10)
					),
					$renderingContext
				);
$arguments1['__thenClosure'] = function() use ($renderingContext, $self) {
$output3 = '';

$output3 .= '
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure5 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments4 = array();
$arguments4['value'] = NULL;
$arguments4['name'] = NULL;
$arguments4['name'] = 'backgroundColor';
$array6 = array (
);$arguments4['value'] = $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginHighlightColor', $array6);
$renderChildrenClosure5 = ($arguments4['value'] !== null) ? function() use ($arguments4) { return $arguments4['value']; } : $renderChildrenClosure5;
$output3 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments4, $renderChildrenClosure5, $renderingContext)]);

$output3 .= '
                ';
return $output3;
};
$arguments1['__elseClosures'][] = function() use ($renderingContext, $self) {
$output7 = '';

$output7 .= '
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper
$renderChildrenClosure9 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments8 = array();
$arguments8['value'] = NULL;
$arguments8['name'] = NULL;
$arguments8['name'] = 'backgroundColor';
$arguments8['value'] = '#ff8700';
$renderChildrenClosure9 = ($arguments8['value'] !== null) ? function() use ($arguments8) { return $arguments8['value']; } : $renderChildrenClosure9;
$output7 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3Fluid\Fluid\ViewHelpers\VariableViewHelper::renderStatic($arguments8, $renderChildrenClosure9, $renderingContext)]);

$output7 .= '
                ';
return $output7;
};

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext);

$output0 .= '

            <!-- HEADER START -->
            <tr><td align="center" valign="top" id="templateHeader" style="background-color: ';
$array25 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('backgroundColor', $array25)]);

$output0 .= '">

                <!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="600" style="width:600px;"><![endif]-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer"><tr><td valign="top" class="headerContainer">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="textBlock" style="min-width:100%;"><tbody class="textBlockOuter"><tr><td valign="top" class="textBlockInner" style="padding-top:9px;">

                        <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr><td valign="top" width="600" style="width:600px;"><![endif]-->
                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="textContentContainer">
                            <tbody>
                            <tr>
                                <td valign="top" class="image" align="center" style="padding: 0px 36px; padding-bottom: 20px; color: #222222;text-align: center;">
                                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure27 = function() use ($renderingContext, $self) {
$output46 = '';

$output46 .= '
                                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure48 = function() use ($renderingContext, $self) {
$output49 = '';

$output49 .= '
                                            <img src="';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\NormalizedUrlViewHelper
$renderChildrenClosure51 = function() use ($renderingContext, $self) {
$array52 = array (
);return $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginLogo', $array52);
};
$arguments50 = array();
$arguments50['pathOrUrl'] = NULL;
$renderChildrenClosure51 = ($arguments50['pathOrUrl'] !== null) ? function() use ($arguments50) { return $arguments50['pathOrUrl']; } : $renderChildrenClosure51;
$output49 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Core\ViewHelpers\NormalizedUrlViewHelper::renderStatic($arguments50, $renderChildrenClosure51, $renderingContext)]);

$output49 .= '" alt="TYPO3 Logo" height="41" width="150" />
                                        ';
return $output49;
};
$arguments47 = array();

$output46 .= '';

$output46 .= '
                                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure54 = function() use ($renderingContext, $self) {
$output58 = '';

$output58 .= '
                                            <img src="';
$array59 = array (
);
$output58 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('normalizedParams.siteUrl', $array59)]);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper
$renderChildrenClosure61 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments60 = array();
$arguments60['path'] = NULL;
$arguments60['extensionName'] = NULL;
$arguments60['absolute'] = false;
$arguments60['extensionName'] = 'core';
$arguments60['path'] = 'Images/typo3_black.svg';

$output58 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper::renderStatic($arguments60, $renderChildrenClosure61, $renderingContext)]);

$output58 .= '" alt="TYPO3 Logo" height="41" width="150" />
                                        ';
return $output58;
};
$arguments53 = array();
$arguments53['if'] = NULL;
// Rendering Boolean node
// Rendering Array
$array55 = array();
$array56 = array (
);$array55['0'] = $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginHighlightColor', $array56);

$expression57 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments53['if'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression57(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array55)
					),
					$renderingContext
				);

$output46 .= '';

$output46 .= '
                                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure63 = function() use ($renderingContext, $self) {
$output64 = '';

$output64 .= '
                                            <img src="';
$array65 = array (
);
$output64 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('normalizedParams.siteUrl', $array65)]);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper
$renderChildrenClosure67 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments66 = array();
$arguments66['path'] = NULL;
$arguments66['extensionName'] = NULL;
$arguments66['absolute'] = false;
$arguments66['extensionName'] = 'core';
$arguments66['path'] = 'Images/typo3_orange.svg';

$output64 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper::renderStatic($arguments66, $renderChildrenClosure67, $renderingContext)]);

$output64 .= '" alt="TYPO3 Logo" height="41" width="150" />
                                        ';
return $output64;
};
$arguments62 = array();
$arguments62['if'] = NULL;

$output46 .= '';

$output46 .= '
                                    ';
return $output46;
};
$arguments26 = array();
$arguments26['then'] = NULL;
$arguments26['else'] = NULL;
$arguments26['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array43 = array();
$array44 = array (
);$array43['0'] = $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginLogo', $array44);

$expression45 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments26['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression45(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array43)
					),
					$renderingContext
				);
$arguments26['__thenClosure'] = function() use ($renderingContext, $self) {
$output28 = '';

$output28 .= '
                                            <img src="';
// Rendering ViewHelper TYPO3\CMS\Core\ViewHelpers\NormalizedUrlViewHelper
$renderChildrenClosure30 = function() use ($renderingContext, $self) {
$array31 = array (
);return $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginLogo', $array31);
};
$arguments29 = array();
$arguments29['pathOrUrl'] = NULL;
$renderChildrenClosure30 = ($arguments29['pathOrUrl'] !== null) ? function() use ($arguments29) { return $arguments29['pathOrUrl']; } : $renderChildrenClosure30;
$output28 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Core\ViewHelpers\NormalizedUrlViewHelper::renderStatic($arguments29, $renderChildrenClosure30, $renderingContext)]);

$output28 .= '" alt="TYPO3 Logo" height="41" width="150" />
                                        ';
return $output28;
};
$arguments26['__elseClosures'][] = function() use ($renderingContext, $self) {
$output32 = '';

$output32 .= '
                                            <img src="';
$array33 = array (
);
$output32 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('normalizedParams.siteUrl', $array33)]);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper
$renderChildrenClosure35 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments34 = array();
$arguments34['path'] = NULL;
$arguments34['extensionName'] = NULL;
$arguments34['absolute'] = false;
$arguments34['extensionName'] = 'core';
$arguments34['path'] = 'Images/typo3_black.svg';

$output32 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper::renderStatic($arguments34, $renderChildrenClosure35, $renderingContext)]);

$output32 .= '" alt="TYPO3 Logo" height="41" width="150" />
                                        ';
return $output32;
};
$arguments26['__elseifClosures'][] = function() use ($renderingContext, $self) {
// Rendering Boolean node
// Rendering Array
$array36 = array();
$array37 = array (
);$array36['0'] = $renderingContext->getVariableProvider()->getByPath('typo3.systemConfiguration.backend.loginHighlightColor', $array37);

$expression38 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};

return TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression38(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array36)
					),
					$renderingContext
				);
};
$arguments26['__elseClosures'][] = function() use ($renderingContext, $self) {
$output39 = '';

$output39 .= '
                                            <img src="';
$array40 = array (
);
$output39 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('normalizedParams.siteUrl', $array40)]);
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper
$renderChildrenClosure42 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments41 = array();
$arguments41['path'] = NULL;
$arguments41['extensionName'] = NULL;
$arguments41['absolute'] = false;
$arguments41['extensionName'] = 'core';
$arguments41['path'] = 'Images/typo3_orange.svg';

$output39 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ResourceViewHelper::renderStatic($arguments41, $renderChildrenClosure42, $renderingContext)]);

$output39 .= '" alt="TYPO3 Logo" height="41" width="150" />
                                        ';
return $output39;
};

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments26, $renderChildrenClosure27, $renderingContext);

$output0 .= '
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" class="textContent" style="padding: 0px 36px;color: #222222;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif;font-size: 24px;text-align: center;">
                                    <strong>';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure69 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments68 = array();
$arguments68['section'] = NULL;
$arguments68['partial'] = NULL;
$arguments68['delegate'] = NULL;
$arguments68['renderable'] = NULL;
$arguments68['arguments'] = array (
);
$arguments68['optional'] = false;
$arguments68['default'] = NULL;
$arguments68['contentAs'] = NULL;
$arguments68['debug'] = true;
$arguments68['section'] = 'Title';
// Rendering Boolean node
// Rendering Array
$array70 = array();
$array70['0'] = 'true';

$expression71 = function($context) {return TRUE;};
$arguments68['optional'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression71(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array70)
					),
					$renderingContext
				);

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments68, $renderChildrenClosure69, $renderingContext);

$output0 .= '</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--[if mso]></td></tr></table><![endif]-->

                    </td></tr></tbody></table>
                </td></tr></table>
                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->

            </td></tr>
            <!-- HEADER END -->


            <!-- BODY START -->
            <tr><td align="center" valign="top" id="templateBody">

                <!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="600" style="width:600px;"><![endif]-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer"><tr><td valign="top" class="bodyContainer">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="textBlock" style="min-width:100%;"><tbody class="textBlockOuter"><tr><td valign="top" class="textBlockInner" style="padding: 36px 0px;">

                        <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr><td valign="top" width="600" style="width:600px;"><![endif]-->
                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="textContentContainer">
                            <tbody>
                            <tr>
                                <td valign="top" class="textContent" style="padding: 0px 36px;">

                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure73 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments72 = array();
$arguments72['section'] = NULL;
$arguments72['partial'] = NULL;
$arguments72['delegate'] = NULL;
$arguments72['renderable'] = NULL;
$arguments72['arguments'] = array (
);
$arguments72['optional'] = false;
$arguments72['default'] = NULL;
$arguments72['contentAs'] = NULL;
$arguments72['debug'] = true;
$arguments72['section'] = 'Main';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments72, $renderChildrenClosure73, $renderingContext);

$output0 .= '

                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--[if mso]></td></tr></table><![endif]-->

                    </td></tr></tbody></table>
                </td></tr></table>
                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->

            </td></tr>
            <!-- BODY END -->

            <!-- FOOTER START -->
            <tr><td align="center" valign="top" id="templateFooter">

                <!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="600" style="width:600px;"><![endif]-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer"><tr><td valign="top" class="footerContainer">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="textBlock" style="min-width:100%;"><tbody class="textBlockOuter"><tr><td valign="top" class="textBlockInner">

                        <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr><td valign="top" width="600" style="width:600px;"><![endif]-->
                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="textContentContainer"><tbody><tr><td valign="top" class="textContent" style="padding:0 36px;">

                            <p style="margin-top: 0;">
                                This email was sent by <strong>';
$array74 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('typo3.sitename', $array74)]);

$output0 .= '</strong> from URL: <a href="';
$array75 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('normalizedParams.siteUrl', $array75)]);

$output0 .= '" target="_blank" rel="noopener">';
$array76 = array (
);
$output0 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('normalizedParams.siteUrl', $array76)]);

$output0 .= '</a> - Please contact your site administrator if you feel you received this email by accident.
                            </p>
                            <p style="margin-top: 0;">
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\Format\RawViewHelper
$renderChildrenClosure78 = function() use ($renderingContext, $self) {
$array79 = array (
);return $renderingContext->getVariableProvider()->getByPath('typo3.information.copyrightNotice', $array79);
};
$arguments77 = array();
$arguments77['value'] = NULL;

$output0 .= isset($arguments77['value']) ? $arguments77['value'] : $renderChildrenClosure78();

$output0 .= '
                            </p>

                        </td></tr></tbody></table>
                        <!--[if mso]></td></tr></table><![endif]-->

                    </td></tr></tbody></table>
                </td></tr></table>
                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->


            </td></tr>
            <!-- FOOTER END -->

        </table>
    </td></tr></table>
</center>

</body>

';

return $output0;
}


}
#