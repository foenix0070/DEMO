<?php

namespace Imaya\BNI\Controller;
use TYPO3\CMS\Core\Http\ImmediateResponseException;
/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */


use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Frontend\Controller\ErrorController;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Portfolio controller
 */
class PortfolioController extends ActionController
{
    /**
     * Initializes the view before invoking an action method.
     * Override this method to solve assign variables common for all actions
     * or prepare the view in another way before the action is called.
     *
     * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view The view to be initialized
     *
     * @return void
     */
    protected function initializeView($view)
    {
        $view->assign('contentObjectData', $this->configurationManager->getContentObject()->data);
        $view->assign('emConfiguration', GeneralUtility::makeInstance(EmConfiguration::class));
        if (isset($GLOBALS['TSFE']) && is_object($GLOBALS['TSFE'])) {
            $view->assign('pageData', $GLOBALS['TSFE']->page);
        }
        parent::initializeView($view);
    }




    /**
     * Action show
     *
     * @return string
     */
    public function showAction($category)
    {
        $project = null;

        if($this->request->hasArgument('category')){
            $portfolio = $this->projectRepository->findByUid($this->request->getArgument('category'));
        }
        else{
            if($this->settings['singlerecord']){
                $portfolio = $this->projectRepository->findByUid($this->settings['singlerecord']);
            }
            else{
                $this->addFlashMessage(
                   'No single record uid given',
                   $messageTitle = 'Note',
                   $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::OK,
                   $storeInSession = FALSE
                );
            }
        }

        if($portfolio !== null){
            // Set page title
            $titleProvider = GeneralUtility::makeInstance(\SIMONKOEHLER\Showcase\PageTitle\TitleProvider::class);
            $titleProvider->setTitle($portfolio->getSeotitle() ?: $portfolio->getTitle());

            // Set meta description
            $metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('description');
            $metaTagManager->addProperty('description', $portfolio->getSeodescription());

            $this->view->assign('project',$portfolio);
        }

        $this->view->assign('portfolio',$this->settings);

    }


}