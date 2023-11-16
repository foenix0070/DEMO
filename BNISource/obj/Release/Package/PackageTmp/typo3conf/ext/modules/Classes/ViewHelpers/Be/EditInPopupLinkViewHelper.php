<?php

namespace CodingMs\Modules\ViewHelpers\Be;

use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder as UriBuilderBackend;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class EditInPopupLinkViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * @var UriBuilderBackend
     */
    protected $uriBuilderBackend;

    /**
     * @param UriBuilderBackend $uriBuilderBackend
     */
    public function __construct(UriBuilderBackend $uriBuilderBackend)
    {
        $this->uriBuilderBackend = $uriBuilderBackend;
        parent::__construct();
    }

    /**
     * Initialize arguments
     *
     * @api
     */
    public function initializeArguments()
    {
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
        $this->registerArgument('table', 'string', 'Table');
        $this->registerArgument('uid', 'int', 'Unique identifier');
        $this->registerArgument('columnsOnly', 'string', 'Columns to edit (multiple must be comma separated)', false, '');
        $this->registerArgument('module', 'string', 'Module', false, 'record_edit');
    }

    /**
     * Crafts a link to edit a database record or create a new one
     *
     * @return string The <a> tag
     * @see \TYPO3\CMS\Backend\Utility::editOnClick()
     * @throws RouteNotFoundException
     */
    public function render()
    {
        $pageUid = (int)GeneralUtility::_GP('id');
        $closeUrl = ExtensionManagementUtility::siteRelPath('backend') . 'Resources/Private/Templates/Close.html';
        // Convert it to absolute, because of an path error issue
        $closeUrl = GeneralUtility::getFileAbsFileName($closeUrl);
        $closeUrl = PathUtility::getAbsoluteWebPath($closeUrl);
        // Parameter
        $parameter = [
            'returnUrl' => $closeUrl,
            'id' => $pageUid,
            'edit' => [
                $this->arguments['table'] => [
                    $this->arguments['uid'] => 'edit'
                ]
            ]
        ];
        // Columns are defined?
        if (trim($this->arguments['columnsOnly']) != '') {
            $parameter['columnsOnly'] = $this->arguments['columnsOnly'];
        }
        $onclickUrl = (string)$this->uriBuilderBackend->buildUriFromRoute($this->arguments['module'], $parameter);
        $onclick = "vHWin=window.open('" . $onclickUrl . "','" . md5($onclickUrl) . "','width=' + screen.width + ',height=' + screen.height + ',status=0,menubar=0,scrollbars=1,resizable=1');vHWin.focus();return false;";
        $this->tag->addAttribute('href', '#');
        $this->tag->addAttribute('onclick', $onclick);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
