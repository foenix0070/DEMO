<?php

class partial_Header_ec514ac1d30cf048fb40f99ce73ad3afc75c7f51 extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

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

$output0 .= '<header id="header">
    <div class="header-body">
        <div class="header-top header-top-default header-top-borders border-bottom-0">
            <div class="container p-0">
                <div class="header-row">
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <div class="header-nav-top d-inline-flex flex-wrap ps-5">
                                <div class="d-flex custom-header-top-nav-background">
                                    <div class="nav-item flex-fill me-2 p-1">
                                        <form class="d-flex border-bottom ms-3" id="bni-search" action="/search" method="get">
                                            <div class="input-group">
                                                <input class="form-control border-0" id="forminput" type="search" autocomplete="off" name="tx_kesearch_pi1[sword]" placeholder="Recherche..." aria-label="Search" style="color: rgb(255, 255, 255);">
                                                <button class="btn btn-outline-light border-0" id="btnsearch" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <nav class="navbar navbar-expand-md flex-fill p-0">	
                                        <div class="container-fluid">
                                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="collapse navbar-collapse" id="navbarNav">
                                                <ul class="nav nav-pills d-inline-flex flex-wrap">
                                                    <!-- <li class="nav-item flex-grow-1 me-4"></li>											 -->
                                                    <li class="nav-item nav-item-left-border nav-item-left-border-sm-show py-2 d-inline-flex pe-3 flex-grow-1 flex-md-grow-0" style="z-index:2;">													
                                                        <span class="ws-nowrap text-light text-decoration-none"><i class="fas fa-envelope"></i>  info@bni.ci  </span>												
                                                    </li>
                                                    <li class="nav-item nav-item-anim-icon d-md-block" style="z-index:2;">													
                                                        <span class="nav-link ps-0 text-light text-decoration-none"><i class="fas fa-phone"></i>  (+225) 27 20 20 98 00  </span>												
                                                    </li>
                                                    <li class="nav-item dropdown nav-item-left-border d-md-block py-2">
                                                        <ul class="header-social-icons social-icons d-inline-flex">
                                                            <li class="social-icons-facebook"><a href="https://www.facebook.com/BNI.Cotedivoire/" target="_blank" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                                                            <li class="social-icons-twitter"><a href="https://twitter.com/bni_ci" target="_blank" title="Twitter"><i class="fa-brands fa-twitter"></i></a></li>
                                                            <li class="social-icons-instagram"><a href="https://www.instagram.com/bni.ci/?utm_source=ig_profile_share&igshid=v930zf6gmi4z" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                                                            <li class="social-icons-linkedin"><a href="https://www.linkedin.com/company/national-bank-of-investment-bni---c-te-d\'ivoire-/" target="_blank" title="Linkedin"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                                            <li class="social-icons-youtube"><a href="https://www.youtube.com/channel/UCTofLuAx-ZOagpPl0hOfWkg" target="_blank" title="youtube"><i class="fa-brands fa-youtube"></i></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item nav-item-anim-icon ms-3 flex-grow-1 flex-md-grow-0" style="z-index:2;">												
                                                        <span class="nav-link ps-0 text-light text-decoration-none" id="today_date"></span>	
                                                    </li>
                                                </ul>	
                                            </div>
                                        </div>									
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main mt-3">
            <div class="container p-0">
                <div class="header-row flex-column flex-lg-row justify-content-center justify-content-lg-start">
                    <div class="header-column">
                        <div id="logo" class="ms-5">
                            <!-- ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\Link\PageViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure5 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments4 = array();
$arguments4['additionalAttributes'] = NULL;
$arguments4['data'] = NULL;
$arguments4['aria'] = NULL;
$arguments4['class'] = NULL;
$arguments4['dir'] = NULL;
$arguments4['id'] = NULL;
$arguments4['lang'] = NULL;
$arguments4['style'] = NULL;
$arguments4['title'] = NULL;
$arguments4['accesskey'] = NULL;
$arguments4['tabindex'] = NULL;
$arguments4['onclick'] = NULL;
$arguments4['alt'] = NULL;
$arguments4['ismap'] = NULL;
$arguments4['longdesc'] = NULL;
$arguments4['usemap'] = NULL;
$arguments4['loading'] = NULL;
$arguments4['decoding'] = NULL;
$arguments4['src'] = '';
$arguments4['treatIdAsReference'] = false;
$arguments4['image'] = NULL;
$arguments4['crop'] = NULL;
$arguments4['cropVariant'] = 'default';
$arguments4['fileExtension'] = NULL;
$arguments4['width'] = NULL;
$arguments4['height'] = NULL;
$arguments4['minWidth'] = NULL;
$arguments4['minHeight'] = NULL;
$arguments4['maxWidth'] = NULL;
$arguments4['maxHeight'] = NULL;
$arguments4['absolute'] = false;
$arguments4['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/logo.jpeg';
$arguments4['alt'] = 'BNI Logo';
return TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments4, $renderChildrenClosure5, $renderingContext);
};
$arguments1 = array();
$arguments1['additionalAttributes'] = NULL;
$arguments1['data'] = NULL;
$arguments1['aria'] = NULL;
$arguments1['class'] = NULL;
$arguments1['dir'] = NULL;
$arguments1['id'] = NULL;
$arguments1['lang'] = NULL;
$arguments1['style'] = NULL;
$arguments1['title'] = NULL;
$arguments1['accesskey'] = NULL;
$arguments1['tabindex'] = NULL;
$arguments1['onclick'] = NULL;
$arguments1['target'] = NULL;
$arguments1['rel'] = NULL;
$arguments1['pageUid'] = NULL;
$arguments1['pageType'] = NULL;
$arguments1['noCache'] = NULL;
$arguments1['language'] = NULL;
$arguments1['section'] = NULL;
$arguments1['linkAccessRestrictedPages'] = NULL;
$arguments1['additionalParams'] = NULL;
$arguments1['absolute'] = NULL;
$arguments1['addQueryString'] = NULL;
$arguments1['argumentsToBeExcludedFromQueryString'] = NULL;
$arguments1['addQueryStringMethod'] = NULL;
$array3 = array (
);$arguments1['pageUid'] = $renderingContext->getVariableProvider()->getByPath('1', $array3);

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\Link\PageViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext);

$output0 .= ' -->
                            <a href="/">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure7 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments6 = array();
$arguments6['additionalAttributes'] = NULL;
$arguments6['data'] = NULL;
$arguments6['aria'] = NULL;
$arguments6['class'] = NULL;
$arguments6['dir'] = NULL;
$arguments6['id'] = NULL;
$arguments6['lang'] = NULL;
$arguments6['style'] = NULL;
$arguments6['title'] = NULL;
$arguments6['accesskey'] = NULL;
$arguments6['tabindex'] = NULL;
$arguments6['onclick'] = NULL;
$arguments6['alt'] = NULL;
$arguments6['ismap'] = NULL;
$arguments6['longdesc'] = NULL;
$arguments6['usemap'] = NULL;
$arguments6['loading'] = NULL;
$arguments6['decoding'] = NULL;
$arguments6['src'] = '';
$arguments6['treatIdAsReference'] = false;
$arguments6['image'] = NULL;
$arguments6['crop'] = NULL;
$arguments6['cropVariant'] = 'default';
$arguments6['fileExtension'] = NULL;
$arguments6['width'] = NULL;
$arguments6['height'] = NULL;
$arguments6['minWidth'] = NULL;
$arguments6['minHeight'] = NULL;
$arguments6['maxWidth'] = NULL;
$arguments6['maxHeight'] = NULL;
$arguments6['absolute'] = false;
$arguments6['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/logo.jpeg';
$arguments6['alt'] = 'BNI Logo';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments6, $renderChildrenClosure7, $renderingContext);

$output0 .= '</a>
                        </div>
                    </div>
                    <div class="header-column">
                        <div class="header-row d-flex bd-highlight">
                            <div class="header-misc w-100 bd-highlight">
                                <div class="w-100 text-right">
                                    <a href="https://bni.activactions.net/pages/login.aspx" target="_blank" class="btn btn-warning btn-sm rounded-pill text-white"><i class="fa fa-hand-holding-dollar"></i>  Crédit en ligne</a>
                                    <a href="https://www.bnionline.ci/FR/index.html" target="_blank" class="btn btn-outline-success btn-sm rounded-pill ms-2"><i class="fa-solid fa-user"></i>  Devenir Client</a>
                                    <a href="https://www.bnionline.ci/FR/public/connexion.awp" target="_blank" class="btn btn-outline-success btn-sm rounded-pill ms-2"><i class="fa-solid fa-user"></i>  Accès à mes comptes</a>
                                    <a href="#" target="_blank" class="btn btn-outline-success btn-sm rounded-pill ms-2"><i class="fa fa-address-book"></i>  Prise de rendez-vous</a>
                                </div>
                            </div>
                        </div>
                        <div class="header-row">
                            <div class="d-block w-100">
                                <div class="p-0">
                                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$renderChildrenClosure9 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments8 = array();
$arguments8['section'] = NULL;
$arguments8['partial'] = NULL;
$arguments8['delegate'] = NULL;
$arguments8['renderable'] = NULL;
$arguments8['arguments'] = array (
);
$arguments8['optional'] = false;
$arguments8['default'] = NULL;
$arguments8['contentAs'] = NULL;
$arguments8['debug'] = true;
$arguments8['partial'] = 'MainNavigation';
$arguments8['arguments'] = $renderingContext->getVariableProvider()->getAll();

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper::renderStatic($arguments8, $renderChildrenClosure9, $renderingContext);

$output0 .= ' 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



';

return $output0;
}


}
#