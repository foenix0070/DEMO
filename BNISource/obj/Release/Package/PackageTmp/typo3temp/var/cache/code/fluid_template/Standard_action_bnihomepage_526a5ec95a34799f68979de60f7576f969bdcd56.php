<?php

class Standard_action_bnihomepage_526a5ec95a34799f68979de60f7576f969bdcd56 extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

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
 * section Main
 */
public function section_62bce9422ff2d14f69ab80a154510232fc8a9afd(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '
    <div role="main" class="main container p-0">
        <section id="main-head" class="banner-container">
            <div class="d-flex">

                ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments1 = array();
$arguments1['section'] = NULL;
$arguments1['partial'] = NULL;
$arguments1['delegate'] = NULL;
$arguments1['renderable'] = NULL;
$arguments1['arguments'] = array (
);
$arguments1['optional'] = false;
$arguments1['default'] = NULL;
$arguments1['contentAs'] = NULL;
$arguments1['debug'] = true;
$arguments1['partial'] = 'LeftHomeNavigation';
$arguments1['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext);

$output0 .= '
                
                <!-- ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure5 = function() use ($renderingContext, $self) {
$output7 = '';

$output7 .= '
                    <div id="slider" class="slider-element dark py-5" style="background-image:url(fileadmin';
$array8 = array (
);
$output7 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.BackgroundImages.0.originalFile.identifier', $array8)]);

$output7 .= '); background-size: cover;">
                        <div class="bg-overlay"></div>
                        <div class="banner-title ms-3">
                            <div class="container">
                                <div class="row">
                                    <div id="slider-contain" class=" col-lg-6">
                                        <h2 class="display-2 text-white">';
$array9 = array (
);
$output7 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.header', $array9)]);

$output7 .= '</h2>
                                        <p class="text-white py-3">';
$array10 = array (
);
$output7 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.subheader', $array10)]);

$output7 .= '</p>
                                        <a href="" title="" class="btn btn-warning rounded-pill text-white px-4 py-2 h-op-09 op-ts">En savoir Plus <i class="fa-solid fa-arrow-right-long" style="margin-left: 8px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
return $output7;
};
$arguments4 = array();
$arguments4['each'] = NULL;
$arguments4['as'] = NULL;
$arguments4['key'] = NULL;
$arguments4['reverse'] = false;
$arguments4['iteration'] = NULL;
$array6 = array (
);$arguments4['each'] = $renderingContext->getVariableProvider()->getByPath('Slider', $array6);
$arguments4['as'] = 'sliderContentElement';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments4, $renderChildrenClosure5, $renderingContext);

$output0 .= ' -->

                
                    <div id="BannerSlider" class="carousel slide carousel-fade slider-element" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure12 = function() use ($renderingContext, $self) {
$output14 = '';

$output14 .= '
                                <div class="carousel-item ';
$array15 = array (
);
$output14 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.subheader', $array15)]);

$output14 .= '">
                                    <img src="fileadmin';
$array16 = array (
);
$output14 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.BackgroundImages.0.originalFile.identifier', $array16)]);

$output14 .= '" class="d-block w-100" alt="';
$array17 = array (
);
$output14 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.header', $array17)]);

$output14 .= '">
                                </div>
                            ';
return $output14;
};
$arguments11 = array();
$arguments11['each'] = NULL;
$arguments11['as'] = NULL;
$arguments11['key'] = NULL;
$arguments11['reverse'] = false;
$arguments11['iteration'] = NULL;
$array13 = array (
);$arguments11['each'] = $renderingContext->getVariableProvider()->getByPath('Slider', $array13);
$arguments11['as'] = 'sliderContentElement';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments11, $renderChildrenClosure12, $renderingContext);

$output0 .= '
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#BannerSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#BannerSlider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                
            </div>              
        </section>

        <!-- Product Category -->
        <section id="produits-services" class="bni_prd-bg-grey mb-5">
            <div class="container">
                <div class="heading-block border-bottom-0 mt-1 text-center">
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure19 = function() use ($renderingContext, $self) {
$output21 = '';

$output21 .= '
                        <h2>';
$array22 = array (
);
$output21 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('categoryContentElement.data.header', $array22)]);

$output21 .= '</h2>
                        <span>';
$array23 = array (
);
$output21 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('categoryContentElement.data.subheader', $array23)]);

$output21 .= '</span>
                    ';
return $output21;
};
$arguments18 = array();
$arguments18['each'] = NULL;
$arguments18['as'] = NULL;
$arguments18['key'] = NULL;
$arguments18['reverse'] = false;
$arguments18['iteration'] = NULL;
$array20 = array (
);$arguments18['each'] = $renderingContext->getVariableProvider()->getByPath('CategorySectionTitle', $array20);
$arguments18['as'] = 'categoryContentElement';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments18, $renderChildrenClosure19, $renderingContext);

$output0 .= '
                </div>
                <div id="card-category" class="bni_prd-cards">
                    <div class="row row-cols-1 row-cols-md-2">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure25 = function() use ($renderingContext, $self) {
$output27 = '';

$output27 .= '
                            <div class="col px-5 mt-3">
                                <a href="';
$array28 = array (
);
$output27 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header_link', $array28)]);

$output27 .= '" class="card bni_card shadow bni_prd-cards_card bni_prd-cards-';
$array29 = array (
);
$output27 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header', $array29)]);

$output27 .= '" alt="';
$array30 = array (
);
$output27 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header', $array30)]);

$output27 .= '">
                                    <div class="bni_prdcards-card-container">
                                        <div class="bni_card_img mt-4 ms-4">
                                            <i class="';
$array31 = array (
);
$output27 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.subheader', $array31)]);

$output27 .= ' fa-5x"></i>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">';
$array32 = array (
);
$output27 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header', $array32)]);

$output27 .= '</h5>
                                            <p class="bni_card-text">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper
$renderChildrenClosure34 = function() use ($renderingContext, $self) {
$array35 = array (
);return $renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.bodytext', $array35);
};
$arguments33 = array();
$arguments33['parseFuncTSPath'] = 'lib.parseFunc_RTE';

$output27 .= TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper::renderStatic($arguments33, $renderChildrenClosure34, $renderingContext);

$output27 .= '</p>
                                        </div>
                                        <div class="bni-card-actions m-3 text-right">
                                            <button type="button" class="btn rounded-pill">En Savoir plus</button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ';
return $output27;
};
$arguments24 = array();
$arguments24['each'] = NULL;
$arguments24['as'] = NULL;
$arguments24['key'] = NULL;
$arguments24['reverse'] = false;
$arguments24['iteration'] = NULL;
$array26 = array (
);$arguments24['each'] = $renderingContext->getVariableProvider()->getByPath('ProductServiceCard', $array26);
$arguments24['as'] = 'ProductServiceContent';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments24, $renderChildrenClosure25, $renderingContext);

$output0 .= '
                            
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- Mobile Access -->
        <section id="mobile-access">
            <div class="container-fluid">
                <i class="fa-solid fa-calendar-clock fa-5x"></i>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-lg-6">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure37 = function() use ($renderingContext, $self) {
$output39 = '';

$output39 .= '
                            <h1 class="stl_title stl_title--2 p-3 mt-4 text-white">';
$array40 = array (
);
$output39 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileDescriptionContentElement.data.header', $array40)]);

$output39 .= '</h1>
                        ';
return $output39;
};
$arguments36 = array();
$arguments36['each'] = NULL;
$arguments36['as'] = NULL;
$arguments36['key'] = NULL;
$arguments36['reverse'] = false;
$arguments36['iteration'] = NULL;
$array38 = array (
);$arguments36['each'] = $renderingContext->getVariableProvider()->getByPath('MobileDescription', $array38);
$arguments36['as'] = 'MobileDescriptionContentElement';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments36, $renderChildrenClosure37, $renderingContext);

$output0 .= '
                        <div class="container bni_grid_row--application-sg">
                            <div class="row row-cols-2 bni_grid-application">
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure42 = function() use ($renderingContext, $self) {
$output44 = '';

$output44 .= '
                                    <div class="col mb-4 col-xs-12 col-sm-6">
                                        <div class="content__application-sg">
                                            <i class="';
$array45 = array (
);
$output44 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileIconDescContentElement.data.subheader', $array45)]);

$output44 .= ' fa-lg me-2"></i>
                                            <p>';
$array46 = array (
);
$output44 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileIconDescContentElement.data.header', $array46)]);

$output44 .= '</p>
                                        </div>
                                    </div>
                                ';
return $output44;
};
$arguments41 = array();
$arguments41['each'] = NULL;
$arguments41['as'] = NULL;
$arguments41['key'] = NULL;
$arguments41['reverse'] = false;
$arguments41['iteration'] = NULL;
$array43 = array (
);$arguments41['each'] = $renderingContext->getVariableProvider()->getByPath('MobileIconDesc', $array43);
$arguments41['as'] = 'MobileIconDescContentElement';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments41, $renderChildrenClosure42, $renderingContext);

$output0 .= '
                            </div>
                            <div class="row align-items-start mt-5">
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure48 = function() use ($renderingContext, $self) {
$output50 = '';

$output50 .= '
                                    <div class="col-lg-3 col-xs-6 col-sm-6">
                                        <a href="';
$array51 = array (
);
$output50 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileStoreLinkContentElement.data.header_link', $array51)]);

$output50 .= '" target="_blank" alt="';
$array52 = array (
);
$output50 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileStoreLinkContentElement.data.header', $array52)]);

$output50 .= '">
                                            <img src="fileadmin';
$array53 = array (
);
$output50 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileStoreLinkContentElement.MobileStoreImage.0.originalFile.identifier', $array53)]);

$output50 .= '"  alt="">
                                        </a>
                                    </div>
                                ';
return $output50;
};
$arguments47 = array();
$arguments47['each'] = NULL;
$arguments47['as'] = NULL;
$arguments47['key'] = NULL;
$arguments47['reverse'] = false;
$arguments47['iteration'] = NULL;
$array49 = array (
);$arguments47['each'] = $renderingContext->getVariableProvider()->getByPath('MobileStoreLink', $array49);
$arguments47['as'] = 'MobileStoreLinkContentElement';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments47, $renderChildrenClosure48, $renderingContext);

$output0 .= '
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-lg-6">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure55 = function() use ($renderingContext, $self) {
$output57 = '';

$output57 .= '
                            <img src="fileadmin';
$array58 = array (
);
$output57 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobilePicContentElement.MobileBackground.0.originalFile.identifier', $array58)]);

$output57 .= '" class="img-fluid" alt="BNI Mobile" />
                        ';
return $output57;
};
$arguments54 = array();
$arguments54['each'] = NULL;
$arguments54['as'] = NULL;
$arguments54['key'] = NULL;
$arguments54['reverse'] = false;
$arguments54['iteration'] = NULL;
$array56 = array (
);$arguments54['each'] = $renderingContext->getVariableProvider()->getByPath('MobilePic', $array56);
$arguments54['as'] = 'MobilePicContentElement';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments54, $renderChildrenClosure55, $renderingContext);

$output0 .= '
                    </div>
                </div>
            </div>
        </section>


        <!-- Campagne -->
        <section class="campagne_section m-5">
            <div class="container bg-white shadow mx-auto mx-5 p-5">
                <div class="row">
                  <div class="col-md-6">
                    <div class="heading-block">
                        <h2 class="mb-3">Campagne de Fiabilisation des  données Bancaires</h2>
                        <div class="d-flex flex-column">
                          <div class="card shadow mb-3">
                            <div class="card-body">
                              <h3 class="card-title">Accès au formulaire de mise à jour</h3>
                              <a href="https://pcdc.bnici.net/" target="_blank" class="btn btn-success">Accéder au formulaire</a>
                            </div>
                          </div>
                          <div class="card shadow">
                            <div class="card-body">
                              <h3 class="card-title">Accès au guide de connexion</h3>
                              <a href="/publications/telechargements" class="btn btn-success">Accéder au guide</a>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ZPrmGEzManI?rel=0" width="200px"></iframe>
                    </div>
                </div>
              </div>
            </div>
          </section>


          <section id="popup-start">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure60 = function() use ($renderingContext, $self) {
$output62 = '';

$output62 .= '
                <div class="col mb-5">
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure64 = function() use ($renderingContext, $self) {
$output79 = '';

$output79 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure81 = function() use ($renderingContext, $self) {
$output82 = '';

$output82 .= '
                            <a href="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper
$renderChildrenClosure84 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments83 = array();
$arguments83['src'] = '';
$arguments83['treatIdAsReference'] = false;
$arguments83['image'] = NULL;
$arguments83['crop'] = NULL;
$arguments83['cropVariant'] = 'default';
$arguments83['fileExtension'] = NULL;
$arguments83['width'] = NULL;
$arguments83['height'] = NULL;
$arguments83['minWidth'] = NULL;
$arguments83['minHeight'] = NULL;
$arguments83['maxWidth'] = NULL;
$arguments83['maxHeight'] = NULL;
$arguments83['absolute'] = false;
$array85 = array (
);$arguments83['src'] = $renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header_link', $array85);
// Rendering Boolean node
// Rendering Array
$array86 = array();
$array86['0'] = 1;

$expression87 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments83['treatIdAsReference'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression87(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array86)
					),
					$renderingContext
				);

$output82 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper::renderStatic($arguments83, $renderChildrenClosure84, $renderingContext)]);

$output82 .= '" data-imglink="fileadmin';
$array88 = array (
);
$output82 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array88)]);

$output82 .= '" class="bni-popup-start" alt="';
$array89 = array (
);
$output82 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array89)]);

$output82 .= '"> </a>
                        ';
return $output82;
};
$arguments80 = array();

$output79 .= '';

$output79 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure91 = function() use ($renderingContext, $self) {
$output92 = '';

$output92 .= '
                            <a href="" data-imglink="fileadmin';
$array93 = array (
);
$output92 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array93)]);

$output92 .= '" class="bni-popup-start" alt="';
$array94 = array (
);
$output92 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array94)]);

$output92 .= '"> </a>
                        ';
return $output92;
};
$arguments90 = array();
$arguments90['if'] = NULL;

$output79 .= '';

$output79 .= '
                    ';
return $output79;
};
$arguments63 = array();
$arguments63['then'] = NULL;
$arguments63['else'] = NULL;
$arguments63['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array76 = array();
$array77 = array (
);$array76['0'] = $renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header_link', $array77);

$expression78 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments63['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression78(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array76)
					),
					$renderingContext
				);
$arguments63['__thenClosure'] = function() use ($renderingContext, $self) {
$output65 = '';

$output65 .= '
                            <a href="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper
$renderChildrenClosure67 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments66 = array();
$arguments66['src'] = '';
$arguments66['treatIdAsReference'] = false;
$arguments66['image'] = NULL;
$arguments66['crop'] = NULL;
$arguments66['cropVariant'] = 'default';
$arguments66['fileExtension'] = NULL;
$arguments66['width'] = NULL;
$arguments66['height'] = NULL;
$arguments66['minWidth'] = NULL;
$arguments66['minHeight'] = NULL;
$arguments66['maxWidth'] = NULL;
$arguments66['maxHeight'] = NULL;
$arguments66['absolute'] = false;
$array68 = array (
);$arguments66['src'] = $renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header_link', $array68);
// Rendering Boolean node
// Rendering Array
$array69 = array();
$array69['0'] = 1;

$expression70 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments66['treatIdAsReference'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression70(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array69)
					),
					$renderingContext
				);

$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper::renderStatic($arguments66, $renderChildrenClosure67, $renderingContext)]);

$output65 .= '" data-imglink="fileadmin';
$array71 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array71)]);

$output65 .= '" class="bni-popup-start" alt="';
$array72 = array (
);
$output65 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array72)]);

$output65 .= '"> </a>
                        ';
return $output65;
};
$arguments63['__elseClosures'][] = function() use ($renderingContext, $self) {
$output73 = '';

$output73 .= '
                            <a href="" data-imglink="fileadmin';
$array74 = array (
);
$output73 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array74)]);

$output73 .= '" class="bni-popup-start" alt="';
$array75 = array (
);
$output73 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array75)]);

$output73 .= '"> </a>
                        ';
return $output73;
};

$output62 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments63, $renderChildrenClosure64, $renderingContext);

$output62 .= ' 
                </div>
            ';
return $output62;
};
$arguments59 = array();
$arguments59['each'] = NULL;
$arguments59['as'] = NULL;
$arguments59['key'] = NULL;
$arguments59['reverse'] = false;
$arguments59['iteration'] = NULL;
$array61 = array (
);$arguments59['each'] = $renderingContext->getVariableProvider()->getByPath('PopupImage', $array61);
$arguments59['as'] = 'PopupImageContent';

$output0 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments59, $renderChildrenClosure60, $renderingContext);

$output0 .= '
          </section>

    </div><!-- End Main -->

     <!--
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\CObjectViewHelper
$renderChildrenClosure96 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments95 = array();
$arguments95['data'] = NULL;
$arguments95['typoscriptObjectPath'] = NULL;
$arguments95['currentValueKey'] = NULL;
$arguments95['table'] = '';
$arguments95['typoscriptObjectPath'] = 'lib.dynamicContent';
// Rendering Array
$array97 = array();
$array97['colPos'] = 0;
$arguments95['data'] = $array97;
$renderChildrenClosure96 = ($arguments95['data'] !== null) ? function() use ($arguments95) { return $arguments95['data']; } : $renderChildrenClosure96;
$output0 .= TYPO3\CMS\Fluid\ViewHelpers\CObjectViewHelper::renderStatic($arguments95, $renderChildrenClosure96, $renderingContext);

$output0 .= '
    -->

    <script src="https://cdn.popupsmart.com/bundle.js" data-id="72418" async defer></script>
    
';

return $output0;
}
/**
 * Main Render function
 */
public function render(\TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output98 = '';

$output98 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\LayoutViewHelper
$renderChildrenClosure100 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments99 = array();
$arguments99['name'] = NULL;
$arguments99['name'] = 'Default';

$output98 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [NULL]);

$output98 .= '
';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\SectionViewHelper
$renderChildrenClosure102 = function() use ($renderingContext, $self) {
$output103 = '';

$output103 .= '
    <div role="main" class="main container p-0">
        <section id="main-head" class="banner-container">
            <div class="d-flex">

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
$arguments104['partial'] = 'LeftHomeNavigation';
$arguments104['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output103 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments104, $renderChildrenClosure105, $renderingContext);

$output103 .= '
                
                <!-- ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure108 = function() use ($renderingContext, $self) {
$output110 = '';

$output110 .= '
                    <div id="slider" class="slider-element dark py-5" style="background-image:url(fileadmin';
$array111 = array (
);
$output110 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.BackgroundImages.0.originalFile.identifier', $array111)]);

$output110 .= '); background-size: cover;">
                        <div class="bg-overlay"></div>
                        <div class="banner-title ms-3">
                            <div class="container">
                                <div class="row">
                                    <div id="slider-contain" class=" col-lg-6">
                                        <h2 class="display-2 text-white">';
$array112 = array (
);
$output110 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.header', $array112)]);

$output110 .= '</h2>
                                        <p class="text-white py-3">';
$array113 = array (
);
$output110 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.subheader', $array113)]);

$output110 .= '</p>
                                        <a href="" title="" class="btn btn-warning rounded-pill text-white px-4 py-2 h-op-09 op-ts">En savoir Plus <i class="fa-solid fa-arrow-right-long" style="margin-left: 8px"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
return $output110;
};
$arguments107 = array();
$arguments107['each'] = NULL;
$arguments107['as'] = NULL;
$arguments107['key'] = NULL;
$arguments107['reverse'] = false;
$arguments107['iteration'] = NULL;
$array109 = array (
);$arguments107['each'] = $renderingContext->getVariableProvider()->getByPath('Slider', $array109);
$arguments107['as'] = 'sliderContentElement';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments107, $renderChildrenClosure108, $renderingContext);

$output103 .= ' -->

                
                    <div id="BannerSlider" class="carousel slide carousel-fade slider-element" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure115 = function() use ($renderingContext, $self) {
$output117 = '';

$output117 .= '
                                <div class="carousel-item ';
$array118 = array (
);
$output117 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.subheader', $array118)]);

$output117 .= '">
                                    <img src="fileadmin';
$array119 = array (
);
$output117 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.BackgroundImages.0.originalFile.identifier', $array119)]);

$output117 .= '" class="d-block w-100" alt="';
$array120 = array (
);
$output117 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('sliderContentElement.data.header', $array120)]);

$output117 .= '">
                                </div>
                            ';
return $output117;
};
$arguments114 = array();
$arguments114['each'] = NULL;
$arguments114['as'] = NULL;
$arguments114['key'] = NULL;
$arguments114['reverse'] = false;
$arguments114['iteration'] = NULL;
$array116 = array (
);$arguments114['each'] = $renderingContext->getVariableProvider()->getByPath('Slider', $array116);
$arguments114['as'] = 'sliderContentElement';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments114, $renderChildrenClosure115, $renderingContext);

$output103 .= '
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#BannerSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#BannerSlider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                
            </div>              
        </section>

        <!-- Product Category -->
        <section id="produits-services" class="bni_prd-bg-grey mb-5">
            <div class="container">
                <div class="heading-block border-bottom-0 mt-1 text-center">
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure122 = function() use ($renderingContext, $self) {
$output124 = '';

$output124 .= '
                        <h2>';
$array125 = array (
);
$output124 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('categoryContentElement.data.header', $array125)]);

$output124 .= '</h2>
                        <span>';
$array126 = array (
);
$output124 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('categoryContentElement.data.subheader', $array126)]);

$output124 .= '</span>
                    ';
return $output124;
};
$arguments121 = array();
$arguments121['each'] = NULL;
$arguments121['as'] = NULL;
$arguments121['key'] = NULL;
$arguments121['reverse'] = false;
$arguments121['iteration'] = NULL;
$array123 = array (
);$arguments121['each'] = $renderingContext->getVariableProvider()->getByPath('CategorySectionTitle', $array123);
$arguments121['as'] = 'categoryContentElement';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments121, $renderChildrenClosure122, $renderingContext);

$output103 .= '
                </div>
                <div id="card-category" class="bni_prd-cards">
                    <div class="row row-cols-1 row-cols-md-2">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure128 = function() use ($renderingContext, $self) {
$output130 = '';

$output130 .= '
                            <div class="col px-5 mt-3">
                                <a href="';
$array131 = array (
);
$output130 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header_link', $array131)]);

$output130 .= '" class="card bni_card shadow bni_prd-cards_card bni_prd-cards-';
$array132 = array (
);
$output130 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header', $array132)]);

$output130 .= '" alt="';
$array133 = array (
);
$output130 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header', $array133)]);

$output130 .= '">
                                    <div class="bni_prdcards-card-container">
                                        <div class="bni_card_img mt-4 ms-4">
                                            <i class="';
$array134 = array (
);
$output130 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.subheader', $array134)]);

$output130 .= ' fa-5x"></i>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">';
$array135 = array (
);
$output130 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.header', $array135)]);

$output130 .= '</h5>
                                            <p class="bni_card-text">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper
$renderChildrenClosure137 = function() use ($renderingContext, $self) {
$array138 = array (
);return $renderingContext->getVariableProvider()->getByPath('ProductServiceContent.data.bodytext', $array138);
};
$arguments136 = array();
$arguments136['parseFuncTSPath'] = 'lib.parseFunc_RTE';

$output130 .= TYPO3\CMS\Fluid\ViewHelpers\Format\HtmlViewHelper::renderStatic($arguments136, $renderChildrenClosure137, $renderingContext);

$output130 .= '</p>
                                        </div>
                                        <div class="bni-card-actions m-3 text-right">
                                            <button type="button" class="btn rounded-pill">En Savoir plus</button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ';
return $output130;
};
$arguments127 = array();
$arguments127['each'] = NULL;
$arguments127['as'] = NULL;
$arguments127['key'] = NULL;
$arguments127['reverse'] = false;
$arguments127['iteration'] = NULL;
$array129 = array (
);$arguments127['each'] = $renderingContext->getVariableProvider()->getByPath('ProductServiceCard', $array129);
$arguments127['as'] = 'ProductServiceContent';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments127, $renderChildrenClosure128, $renderingContext);

$output103 .= '
                            
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- Mobile Access -->
        <section id="mobile-access">
            <div class="container-fluid">
                <i class="fa-solid fa-calendar-clock fa-5x"></i>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-lg-6">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure140 = function() use ($renderingContext, $self) {
$output142 = '';

$output142 .= '
                            <h1 class="stl_title stl_title--2 p-3 mt-4 text-white">';
$array143 = array (
);
$output142 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileDescriptionContentElement.data.header', $array143)]);

$output142 .= '</h1>
                        ';
return $output142;
};
$arguments139 = array();
$arguments139['each'] = NULL;
$arguments139['as'] = NULL;
$arguments139['key'] = NULL;
$arguments139['reverse'] = false;
$arguments139['iteration'] = NULL;
$array141 = array (
);$arguments139['each'] = $renderingContext->getVariableProvider()->getByPath('MobileDescription', $array141);
$arguments139['as'] = 'MobileDescriptionContentElement';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments139, $renderChildrenClosure140, $renderingContext);

$output103 .= '
                        <div class="container bni_grid_row--application-sg">
                            <div class="row row-cols-2 bni_grid-application">
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure145 = function() use ($renderingContext, $self) {
$output147 = '';

$output147 .= '
                                    <div class="col mb-4 col-xs-12 col-sm-6">
                                        <div class="content__application-sg">
                                            <i class="';
$array148 = array (
);
$output147 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileIconDescContentElement.data.subheader', $array148)]);

$output147 .= ' fa-lg me-2"></i>
                                            <p>';
$array149 = array (
);
$output147 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileIconDescContentElement.data.header', $array149)]);

$output147 .= '</p>
                                        </div>
                                    </div>
                                ';
return $output147;
};
$arguments144 = array();
$arguments144['each'] = NULL;
$arguments144['as'] = NULL;
$arguments144['key'] = NULL;
$arguments144['reverse'] = false;
$arguments144['iteration'] = NULL;
$array146 = array (
);$arguments144['each'] = $renderingContext->getVariableProvider()->getByPath('MobileIconDesc', $array146);
$arguments144['as'] = 'MobileIconDescContentElement';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments144, $renderChildrenClosure145, $renderingContext);

$output103 .= '
                            </div>
                            <div class="row align-items-start mt-5">
                                ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure151 = function() use ($renderingContext, $self) {
$output153 = '';

$output153 .= '
                                    <div class="col-lg-3 col-xs-6 col-sm-6">
                                        <a href="';
$array154 = array (
);
$output153 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileStoreLinkContentElement.data.header_link', $array154)]);

$output153 .= '" target="_blank" alt="';
$array155 = array (
);
$output153 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileStoreLinkContentElement.data.header', $array155)]);

$output153 .= '">
                                            <img src="fileadmin';
$array156 = array (
);
$output153 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobileStoreLinkContentElement.MobileStoreImage.0.originalFile.identifier', $array156)]);

$output153 .= '"  alt="">
                                        </a>
                                    </div>
                                ';
return $output153;
};
$arguments150 = array();
$arguments150['each'] = NULL;
$arguments150['as'] = NULL;
$arguments150['key'] = NULL;
$arguments150['reverse'] = false;
$arguments150['iteration'] = NULL;
$array152 = array (
);$arguments150['each'] = $renderingContext->getVariableProvider()->getByPath('MobileStoreLink', $array152);
$arguments150['as'] = 'MobileStoreLinkContentElement';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments150, $renderChildrenClosure151, $renderingContext);

$output103 .= '
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-lg-6">
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure158 = function() use ($renderingContext, $self) {
$output160 = '';

$output160 .= '
                            <img src="fileadmin';
$array161 = array (
);
$output160 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('MobilePicContentElement.MobileBackground.0.originalFile.identifier', $array161)]);

$output160 .= '" class="img-fluid" alt="BNI Mobile" />
                        ';
return $output160;
};
$arguments157 = array();
$arguments157['each'] = NULL;
$arguments157['as'] = NULL;
$arguments157['key'] = NULL;
$arguments157['reverse'] = false;
$arguments157['iteration'] = NULL;
$array159 = array (
);$arguments157['each'] = $renderingContext->getVariableProvider()->getByPath('MobilePic', $array159);
$arguments157['as'] = 'MobilePicContentElement';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments157, $renderChildrenClosure158, $renderingContext);

$output103 .= '
                    </div>
                </div>
            </div>
        </section>


        <!-- Campagne -->
        <section class="campagne_section m-5">
            <div class="container bg-white shadow mx-auto mx-5 p-5">
                <div class="row">
                  <div class="col-md-6">
                    <div class="heading-block">
                        <h2 class="mb-3">Campagne de Fiabilisation des  données Bancaires</h2>
                        <div class="d-flex flex-column">
                          <div class="card shadow mb-3">
                            <div class="card-body">
                              <h3 class="card-title">Accès au formulaire de mise à jour</h3>
                              <a href="https://pcdc.bnici.net/" target="_blank" class="btn btn-success">Accéder au formulaire</a>
                            </div>
                          </div>
                          <div class="card shadow">
                            <div class="card-body">
                              <h3 class="card-title">Accès au guide de connexion</h3>
                              <a href="/publications/telechargements" class="btn btn-success">Accéder au guide</a>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ZPrmGEzManI?rel=0" width="200px"></iframe>
                    </div>
                </div>
              </div>
            </div>
          </section>


          <section id="popup-start">
            ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper
$renderChildrenClosure163 = function() use ($renderingContext, $self) {
$output165 = '';

$output165 .= '
                <div class="col mb-5">
                    ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
$renderChildrenClosure167 = function() use ($renderingContext, $self) {
$output182 = '';

$output182 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ThenViewHelper
$renderChildrenClosure184 = function() use ($renderingContext, $self) {
$output185 = '';

$output185 .= '
                            <a href="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper
$renderChildrenClosure187 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments186 = array();
$arguments186['src'] = '';
$arguments186['treatIdAsReference'] = false;
$arguments186['image'] = NULL;
$arguments186['crop'] = NULL;
$arguments186['cropVariant'] = 'default';
$arguments186['fileExtension'] = NULL;
$arguments186['width'] = NULL;
$arguments186['height'] = NULL;
$arguments186['minWidth'] = NULL;
$arguments186['minHeight'] = NULL;
$arguments186['maxWidth'] = NULL;
$arguments186['maxHeight'] = NULL;
$arguments186['absolute'] = false;
$array188 = array (
);$arguments186['src'] = $renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header_link', $array188);
// Rendering Boolean node
// Rendering Array
$array189 = array();
$array189['0'] = 1;

$expression190 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments186['treatIdAsReference'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression190(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array189)
					),
					$renderingContext
				);

$output185 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper::renderStatic($arguments186, $renderChildrenClosure187, $renderingContext)]);

$output185 .= '" data-imglink="fileadmin';
$array191 = array (
);
$output185 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array191)]);

$output185 .= '" class="bni-popup-start" alt="';
$array192 = array (
);
$output185 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array192)]);

$output185 .= '"> </a>
                        ';
return $output185;
};
$arguments183 = array();

$output182 .= '';

$output182 .= '
                        ';
// Rendering ViewHelper TYPO3Fluid\Fluid\ViewHelpers\ElseViewHelper
$renderChildrenClosure194 = function() use ($renderingContext, $self) {
$output195 = '';

$output195 .= '
                            <a href="" data-imglink="fileadmin';
$array196 = array (
);
$output195 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array196)]);

$output195 .= '" class="bni-popup-start" alt="';
$array197 = array (
);
$output195 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array197)]);

$output195 .= '"> </a>
                        ';
return $output195;
};
$arguments193 = array();
$arguments193['if'] = NULL;

$output182 .= '';

$output182 .= '
                    ';
return $output182;
};
$arguments166 = array();
$arguments166['then'] = NULL;
$arguments166['else'] = NULL;
$arguments166['condition'] = false;
// Rendering Boolean node
// Rendering Array
$array179 = array();
$array180 = array (
);$array179['0'] = $renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header_link', $array180);

$expression181 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments166['condition'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression181(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array179)
					),
					$renderingContext
				);
$arguments166['__thenClosure'] = function() use ($renderingContext, $self) {
$output168 = '';

$output168 .= '
                            <a href="';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper
$renderChildrenClosure170 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments169 = array();
$arguments169['src'] = '';
$arguments169['treatIdAsReference'] = false;
$arguments169['image'] = NULL;
$arguments169['crop'] = NULL;
$arguments169['cropVariant'] = 'default';
$arguments169['fileExtension'] = NULL;
$arguments169['width'] = NULL;
$arguments169['height'] = NULL;
$arguments169['minWidth'] = NULL;
$arguments169['minHeight'] = NULL;
$arguments169['maxWidth'] = NULL;
$arguments169['maxHeight'] = NULL;
$arguments169['absolute'] = false;
$array171 = array (
);$arguments169['src'] = $renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header_link', $array171);
// Rendering Boolean node
// Rendering Array
$array172 = array();
$array172['0'] = 1;

$expression173 = function($context) {return TYPO3Fluid\Fluid\Core\Parser\BooleanParser::convertNodeToBoolean($context["node0"]);};
$arguments169['treatIdAsReference'] = TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(
					$expression173(
						TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\BooleanNode::gatherContext($renderingContext, $array172)
					),
					$renderingContext
				);

$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [TYPO3\CMS\Fluid\ViewHelpers\Uri\ImageViewHelper::renderStatic($arguments169, $renderChildrenClosure170, $renderingContext)]);

$output168 .= '" data-imglink="fileadmin';
$array174 = array (
);
$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array174)]);

$output168 .= '" class="bni-popup-start" alt="';
$array175 = array (
);
$output168 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array175)]);

$output168 .= '"> </a>
                        ';
return $output168;
};
$arguments166['__elseClosures'][] = function() use ($renderingContext, $self) {
$output176 = '';

$output176 .= '
                            <a href="" data-imglink="fileadmin';
$array177 = array (
);
$output176 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.PopupBackgroundImage.0.originalFile.identifier', $array177)]);

$output176 .= '" class="bni-popup-start" alt="';
$array178 = array (
);
$output176 .= call_user_func_array( function ($var) { return (is_string($var) || (is_object($var) && method_exists($var, '__toString')) ? htmlspecialchars((string) $var, ENT_QUOTES) : $var); }, [$renderingContext->getVariableProvider()->getByPath('PopupImageContent.data.header', $array178)]);

$output176 .= '"> </a>
                        ';
return $output176;
};

$output165 .= TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper::renderStatic($arguments166, $renderChildrenClosure167, $renderingContext);

$output165 .= ' 
                </div>
            ';
return $output165;
};
$arguments162 = array();
$arguments162['each'] = NULL;
$arguments162['as'] = NULL;
$arguments162['key'] = NULL;
$arguments162['reverse'] = false;
$arguments162['iteration'] = NULL;
$array164 = array (
);$arguments162['each'] = $renderingContext->getVariableProvider()->getByPath('PopupImage', $array164);
$arguments162['as'] = 'PopupImageContent';

$output103 .= TYPO3Fluid\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments162, $renderChildrenClosure163, $renderingContext);

$output103 .= '
          </section>

    </div><!-- End Main -->

     <!--
    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\CObjectViewHelper
$renderChildrenClosure199 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments198 = array();
$arguments198['data'] = NULL;
$arguments198['typoscriptObjectPath'] = NULL;
$arguments198['currentValueKey'] = NULL;
$arguments198['table'] = '';
$arguments198['typoscriptObjectPath'] = 'lib.dynamicContent';
// Rendering Array
$array200 = array();
$array200['colPos'] = 0;
$arguments198['data'] = $array200;
$renderChildrenClosure199 = ($arguments198['data'] !== null) ? function() use ($arguments198) { return $arguments198['data']; } : $renderChildrenClosure199;
$output103 .= TYPO3\CMS\Fluid\ViewHelpers\CObjectViewHelper::renderStatic($arguments198, $renderChildrenClosure199, $renderingContext);

$output103 .= '
    -->

    <script src="https://cdn.popupsmart.com/bundle.js" data-id="72418" async defer></script>
    
';
return $output103;
};
$arguments101 = array();
$arguments101['name'] = NULL;
$arguments101['name'] = 'Main';

$output98 .= NULL;

return $output98;
}


}
#