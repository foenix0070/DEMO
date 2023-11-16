<?php

class partial_Footer_0e73a44cb609e1ee1bee71cce6d3d32c8737ab0f extends \TYPO3Fluid\Fluid\Core\Compiler\AbstractCompiledTemplate {

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

$output0 .= '<section id="bourse-container">
    <div class="container-fluid">
        <div class="row pt-2">
            <div class="col-2 label" style="color:#007749; text-align:center; font-weight:bold;"><i class="fa fa-signal fa-2x ">&nbsp;</i>COURS DES ACTIONS</div>
            <div class="col-10" id="brvm-list">
                <marquee behavior="stop" id="brvm"></marquee>
            </div>
        </div>
    </div>
</section>

<footer>
    <div id="footer" class=" pt-5">
        <div class="container">
            <div class="row text-white">
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <h3 class="font-weight-bold mb-3">Nous contacter:</h3>
                    <ul class="footer-menu text-muted">
                        <li class="mb-1"><i class="bi bi-telephone-fill"></i>(+225) 27 20 20 98 78 </li>
                        <li class="mb-1"><i class="bi bi-telephone-fill"></i>  (+225) 27 20 20 98 00 </li>
                        <li class="mb-1"> <i class="bi bi-envelope-fill"></i> info@bni.ci </li>
                        <li class="mb-1"><i class="bi bi-geo-alt-fill"></i>Abidjan Plateau, Avenue<br> Marchand, Immeuble SCIAM (Siège) </li>
                    </ul>
                    <h3 class="font-weight-bold mt-2">BNIONLINE</h3>
                    <div class="d-inline-block">
                        <a href="https://apps.apple.com/fr/app/bnionline/id1126787790?l=en&amp;mt=8 _blank" target="_blank" alt="BNI Apple Store">
                            <img src="/fileadmin/user_upload/btn-apple-1x.png"  alt="">
                        </a>
                    </div>
                    <div class="d-inline-block">
                        <a href="https://play.google.com/store/apps/details?id=com.mediasoft.bni" target="_blank" alt="BNI Android Store">
                            <img src="/fileadmin/user_upload/btn-google-1x.png"  alt="">
                        </a>
                    </div>
                </div>   
                <div class="col-lg-3 col-md-6 col-12">
                    <h3 class="font-weight-bold mb-3">Infos Générales</h3>
                    <ul class="footer-menu text-muted">
                        <li class="mb-1"><a href="/groupe-bni/mot-du-directeur-general.html" >Mot du Directeur Général</a></li>
                        <li class="mb-1"><a href="/groupe-bni/historique-de-la-bni.html">Historique de la BNI</a></li>
                        <li class="mb-1"><a href="/groupe-bni/informations-generales/la-bni-en-bref.html" >BNI en bref</a></li>
                        <li class="mb-1"><a href="/groupe-bni/la-gestion-des-fonds-nationaux.html" >Gestion des fonds</a></li>
                        <li class="mb-1"><a href="/groupe-bni/parteariats.html">Partenariats</a></li>
                        <li class="mb-1"><a href="/reseau-bni.html">Agences et GAB </a></li>                        
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <h3 class="font-weight-bold mb-3">Produits et services</h3>
                    <ul class="footer-menu text-muted">
                        <li class="mb-1"><a href="/produits-services/particuliers.html" >Particuliers</a></li>
                        <li class="mb-1"><a href="/produits-services/entreprises.html">Entreprises/Professionnels</a></li>
                    </ul>
                    <h3 class="font-weight-bold mb-2">Accès rapides</h3>
                    <ul class="footer-menu text-muted">
                        <li class="mb-1"><a href="https://pcdc.bnici.net/" target="_blank">Mettre à jour vos données</a></li>
                        <li class="mb-4"><a href="https://res.bnici.net/" target="_blank">Réclamations </a></li>
                        <!-- <li><button type="button" class="btn btn-outline-primary rounded-pill text-color-white">Prise de rendez-vous</button></li> -->
                    </ul>
                    <!-- <h3 class="font-weight-bold mb-3">Abonnez-vous à la Newsletter</h3>
                    <div class="formulaire">
                        <form action="#">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nom et prénom">
                            </div>
                            <div class="input-group">
                                <input type="email" class="form-control" id="" placeholder="Adresse email">
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-send" >S\'abonner</button>
                            </div>
                        </form>
                    </div> -->
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="footer-contact-us">
                        <h3 class="mb-3">Nous contacter:</h3>
                        <ul class="footer-social-icons">
                            <li><a href="https://twitter.com/bni_ci" target="_blank"><i class="fa-brands fa-square-twitter fa-3x"></i></a></li>
                            <li><a href="https://www.facebook.com/BNI.Cotedivoire/" target="_blank"><i class="fa-brands fa-square-facebook fa-3x"></i></a></li>
                            <li><a href="https://www.instagram.com/bni.ci/?utm_source=ig_profile_share&igshid=v930zf6gmi4z" target="_blank"><i class="fa-brands fa-square-instagram fa-3x"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/national-bank-of-investment-bni---c-te-d\'ivoire-/" target="_blank"><i class="fa-brands fa-linkedin fa-3x"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCTofLuAx-ZOagpPl0hOfWkg" target="_blank"><i class="fa-brands fa-square-youtube fa-3x"></i></a></li>
                        </ul>
                    </div>
                    <div class="footer-apps">
                        <h3 class="mb-3">Applications utiles:</h3>
                            <a href="/convertisseur-de-devise.html" data-bs-toggle="tooltip" data-bs-placement="top" title="CONVERTISSEUR DE DEVISE" class="text-decoration-none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
return NULL;
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
$arguments1['alt'] = NULL;
$arguments1['ismap'] = NULL;
$arguments1['longdesc'] = NULL;
$arguments1['usemap'] = NULL;
$arguments1['loading'] = NULL;
$arguments1['decoding'] = NULL;
$arguments1['src'] = '';
$arguments1['treatIdAsReference'] = false;
$arguments1['image'] = NULL;
$arguments1['crop'] = NULL;
$arguments1['cropVariant'] = 'default';
$arguments1['fileExtension'] = NULL;
$arguments1['width'] = NULL;
$arguments1['height'] = NULL;
$arguments1['minWidth'] = NULL;
$arguments1['minHeight'] = NULL;
$arguments1['maxWidth'] = NULL;
$arguments1['maxHeight'] = NULL;
$arguments1['absolute'] = false;
$arguments1['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/convertisseur.png';
$arguments1['maxWidth'] = 50;
$arguments1['alt'] = 'CONVERTISSEUR DE DEVISE';
$arguments1['width'] = '60px';
$arguments1['class'] = 'convertisseur';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments1, $renderChildrenClosure2, $renderingContext);

$output0 .= '</a>
                            <a href="https://bni.activactions.net/pages/login.aspx" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="SIMULATEUR DE CREDIT" class="text-decoration-none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure4 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments3 = array();
$arguments3['additionalAttributes'] = NULL;
$arguments3['data'] = NULL;
$arguments3['aria'] = NULL;
$arguments3['class'] = NULL;
$arguments3['dir'] = NULL;
$arguments3['id'] = NULL;
$arguments3['lang'] = NULL;
$arguments3['style'] = NULL;
$arguments3['title'] = NULL;
$arguments3['accesskey'] = NULL;
$arguments3['tabindex'] = NULL;
$arguments3['onclick'] = NULL;
$arguments3['alt'] = NULL;
$arguments3['ismap'] = NULL;
$arguments3['longdesc'] = NULL;
$arguments3['usemap'] = NULL;
$arguments3['loading'] = NULL;
$arguments3['decoding'] = NULL;
$arguments3['src'] = '';
$arguments3['treatIdAsReference'] = false;
$arguments3['image'] = NULL;
$arguments3['crop'] = NULL;
$arguments3['cropVariant'] = 'default';
$arguments3['fileExtension'] = NULL;
$arguments3['width'] = NULL;
$arguments3['height'] = NULL;
$arguments3['minWidth'] = NULL;
$arguments3['minHeight'] = NULL;
$arguments3['maxWidth'] = NULL;
$arguments3['maxHeight'] = NULL;
$arguments3['absolute'] = false;
$arguments3['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/simulateur.png';
$arguments3['maxWidth'] = 50;
$arguments3['alt'] = 'SIMULATEUR DE CREDIT';
$arguments3['width'] = '60px';
$arguments3['class'] = 'simulateur';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments3, $renderChildrenClosure4, $renderingContext);

$output0 .= '</a>
                            <a href="/entreprise-citoyenne.html.html" data-bs-toggle="tooltip" data-bs-placement="top" title="ENTREPRISE CITOYENNE" class="text-decoration-none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure6 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments5 = array();
$arguments5['additionalAttributes'] = NULL;
$arguments5['data'] = NULL;
$arguments5['aria'] = NULL;
$arguments5['class'] = NULL;
$arguments5['dir'] = NULL;
$arguments5['id'] = NULL;
$arguments5['lang'] = NULL;
$arguments5['style'] = NULL;
$arguments5['title'] = NULL;
$arguments5['accesskey'] = NULL;
$arguments5['tabindex'] = NULL;
$arguments5['onclick'] = NULL;
$arguments5['alt'] = NULL;
$arguments5['ismap'] = NULL;
$arguments5['longdesc'] = NULL;
$arguments5['usemap'] = NULL;
$arguments5['loading'] = NULL;
$arguments5['decoding'] = NULL;
$arguments5['src'] = '';
$arguments5['treatIdAsReference'] = false;
$arguments5['image'] = NULL;
$arguments5['crop'] = NULL;
$arguments5['cropVariant'] = 'default';
$arguments5['fileExtension'] = NULL;
$arguments5['width'] = NULL;
$arguments5['height'] = NULL;
$arguments5['minWidth'] = NULL;
$arguments5['minHeight'] = NULL;
$arguments5['maxWidth'] = NULL;
$arguments5['maxHeight'] = NULL;
$arguments5['absolute'] = false;
$arguments5['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/citoyenne.png';
$arguments5['maxWidth'] = 50;
$arguments5['alt'] = 'ENTREPRISE CITOYENNE';
$arguments5['width'] = '60px';
$arguments5['class'] = 'citoyenne';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments5, $renderChildrenClosure6, $renderingContext);

$output0 .= '</a>
                            <a href="/faq.html" data-bs-toggle="tooltip" data-bs-placement="top" title="DICTIONNAIRE BANCAIRE" class="text-decoration-none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure8 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments7 = array();
$arguments7['additionalAttributes'] = NULL;
$arguments7['data'] = NULL;
$arguments7['aria'] = NULL;
$arguments7['class'] = NULL;
$arguments7['dir'] = NULL;
$arguments7['id'] = NULL;
$arguments7['lang'] = NULL;
$arguments7['style'] = NULL;
$arguments7['title'] = NULL;
$arguments7['accesskey'] = NULL;
$arguments7['tabindex'] = NULL;
$arguments7['onclick'] = NULL;
$arguments7['alt'] = NULL;
$arguments7['ismap'] = NULL;
$arguments7['longdesc'] = NULL;
$arguments7['usemap'] = NULL;
$arguments7['loading'] = NULL;
$arguments7['decoding'] = NULL;
$arguments7['src'] = '';
$arguments7['treatIdAsReference'] = false;
$arguments7['image'] = NULL;
$arguments7['crop'] = NULL;
$arguments7['cropVariant'] = 'default';
$arguments7['fileExtension'] = NULL;
$arguments7['width'] = NULL;
$arguments7['height'] = NULL;
$arguments7['minWidth'] = NULL;
$arguments7['minHeight'] = NULL;
$arguments7['maxWidth'] = NULL;
$arguments7['maxHeight'] = NULL;
$arguments7['absolute'] = false;
$arguments7['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/dico.png';
$arguments7['maxWidth'] = 50;
$arguments7['alt'] = 'DICTIONNAIRE BANCAIRE';
$arguments7['width'] = '60px';
$arguments7['class'] = 'dico';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments7, $renderChildrenClosure8, $renderingContext);

$output0 .= '</a>
                            <a href="https://bfree-ci.com/"  target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="B.FREE" class="text-decoration-none">';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure10 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments9 = array();
$arguments9['additionalAttributes'] = NULL;
$arguments9['data'] = NULL;
$arguments9['aria'] = NULL;
$arguments9['class'] = NULL;
$arguments9['dir'] = NULL;
$arguments9['id'] = NULL;
$arguments9['lang'] = NULL;
$arguments9['style'] = NULL;
$arguments9['title'] = NULL;
$arguments9['accesskey'] = NULL;
$arguments9['tabindex'] = NULL;
$arguments9['onclick'] = NULL;
$arguments9['alt'] = NULL;
$arguments9['ismap'] = NULL;
$arguments9['longdesc'] = NULL;
$arguments9['usemap'] = NULL;
$arguments9['loading'] = NULL;
$arguments9['decoding'] = NULL;
$arguments9['src'] = '';
$arguments9['treatIdAsReference'] = false;
$arguments9['image'] = NULL;
$arguments9['crop'] = NULL;
$arguments9['cropVariant'] = 'default';
$arguments9['fileExtension'] = NULL;
$arguments9['width'] = NULL;
$arguments9['height'] = NULL;
$arguments9['minWidth'] = NULL;
$arguments9['minHeight'] = NULL;
$arguments9['maxWidth'] = NULL;
$arguments9['maxHeight'] = NULL;
$arguments9['absolute'] = false;
$arguments9['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/bfree.png';
$arguments9['maxWidth'] = 50;
$arguments9['alt'] = 'B.FREE';
$arguments9['width'] = '60px';
$arguments9['class'] = 'bfree';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments9, $renderChildrenClosure10, $renderingContext);

$output0 .= '</a>
                    </div>
                </div>
            </div>
			<div class="menu-informations">
				<ul class="nav justify-content-end">
				  <li class="nav-item"><a href="#" class="nav-link px-2 text-white"><small>Condition générales</small></a></li>
				  <li class="nav-item"><a href="#" class="nav-link px-2 text-white"><small>Politique de confidentialité</small></a></li>
				  <li class="nav-item"><a href="/mentions-legales" class="nav-link px-2 text-white"><small>Mentions légales</small></a></li>
				</ul>
			</div>
        </div>
		
        <div class="footer-copyright container bg-transparent p-0">
            <div class="row pb-2">
                <div class="col-lg-12 text-center m-0">
                    <hr class="bg-light opacity-1 mt-1 mb-4">
                    ';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
$renderChildrenClosure12 = function() use ($renderingContext, $self) {
return NULL;
};
$arguments11 = array();
$arguments11['additionalAttributes'] = NULL;
$arguments11['data'] = NULL;
$arguments11['aria'] = NULL;
$arguments11['class'] = NULL;
$arguments11['dir'] = NULL;
$arguments11['id'] = NULL;
$arguments11['lang'] = NULL;
$arguments11['style'] = NULL;
$arguments11['title'] = NULL;
$arguments11['accesskey'] = NULL;
$arguments11['tabindex'] = NULL;
$arguments11['onclick'] = NULL;
$arguments11['alt'] = NULL;
$arguments11['ismap'] = NULL;
$arguments11['longdesc'] = NULL;
$arguments11['usemap'] = NULL;
$arguments11['loading'] = NULL;
$arguments11['decoding'] = NULL;
$arguments11['src'] = '';
$arguments11['treatIdAsReference'] = false;
$arguments11['image'] = NULL;
$arguments11['crop'] = NULL;
$arguments11['cropVariant'] = 'default';
$arguments11['fileExtension'] = NULL;
$arguments11['width'] = NULL;
$arguments11['height'] = NULL;
$arguments11['minWidth'] = NULL;
$arguments11['minHeight'] = NULL;
$arguments11['maxWidth'] = NULL;
$arguments11['maxHeight'] = NULL;
$arguments11['absolute'] = false;
$arguments11['src'] = 'EXT:fluid_new_site_bni/Resources/Public/Images/logo.jpeg';
$arguments11['maxWidth'] = 50;
$arguments11['alt'] = 'BNI Logo';

$output0 .= TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper::renderStatic($arguments11, $renderChildrenClosure12, $renderingContext);

$output0 .= '
                    <p class="text-3-4 text-white">Banque Nationale d\'Investissement de Côte d\'Ivoire. © 2023. All Rights Reserved. Powered & Design by <a href="http://www.groupeimaya.net" target="_blank"> Imaya</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>';

return $output0;
}


}
#