<?php

namespace CodingMs\Modules\ViewHelpers\Be;

use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder as UriBuilderBackend;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class EditInModalLinkViewHelper extends AbstractTagBasedViewHelper
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
        $this->registerArgument('action', 'string', 'Action', false, 'edit');
        $this->registerArgument('modal', 'array', 'Modal', false, []);
    }

    /**
     * Crafts a link to edit a database record or create a new one
     *
     * @return string The <a> tag
     * @throws RouteNotFoundException
     * @see \TYPO3\CMS\Backend\Utility::editOnClick()
     */
    public function render()
    {
        $table = $this->arguments['table'];
        $uid = $this->arguments['uid'];
        $action = $this->arguments['action'];
        $modal = $this->arguments['modal'];
        $uri = '#';
        $pageUid = (int)GeneralUtility::_GP('id');
        $returnUrl = GeneralUtility::getFileAbsFileName('EXT:modules/Resources/Public/Html/Close.html');
        $returnUrl = PathUtility::getAbsoluteWebPath($returnUrl);
        //
        switch ($action) {
            case 'edit':
                $parameter = [
                    'returnUrl' => $returnUrl,
                    'id' => $pageUid,
                    'edit' => [
                        $table => [
                            $uid => 'edit'
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('record_edit', $parameter);
                break;
            case 'delete':
                $parameter = [
                    'redirect' => $returnUrl,
                    'id' => $pageUid,
                    'cmd' => [
                        $table => [
                            $uid => [
                                'delete' => 1
                            ]
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('tce_db', $parameter);
                // Add a modal
                if (!empty($modal)) {
                    if (isset($modal['severity'])) {
                        $this->tag->addAttribute('data-severity', $modal['severity']);
                    }
                    if (isset($modal['title'])) {
                        $this->tag->addAttribute('data-title', $modal['title']);
                    }
                    if (isset($modal['content'])) {
                        $this->tag->addAttribute('data-content', $modal['content']);
                    }
                    if (isset($modal['buttonCloseText'])) {
                        $this->tag->addAttribute('data-button-close-text', $modal['buttonCloseText']);
                    }
                }
                break;
            case 'hide':
                $parameter = [
                    'redirect' => $returnUrl,
                    'id' => $pageUid,
                    'data' => [
                        $table => [
                            $uid => [
                                'hidden' => 1
                            ]
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('tce_db', $parameter);
                break;
            case 'show':
                $parameter = [
                    'redirect' => $returnUrl,
                    'id' => $pageUid,
                    'data' => [
                        $table => [
                            $uid => [
                                'hidden' => 0
                            ]
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('tce_db', $parameter);
                break;
            case 'enable':
                $parameter = [
                    'redirect' => $returnUrl,
                    'id' => $pageUid,
                    'data' => [
                        $table => [
                            $uid => [
                                'disable' => 0
                            ]
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('tce_db', $parameter);
                break;
            case 'disable':
                $parameter = [
                    'redirect' => $returnUrl,
                    'id' => $pageUid,
                    'data' => [
                        $table => [
                            $uid => [
                                'disable' => 1
                            ]
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('tce_db', $parameter);
                break;
        }
        // Build attribute
        $this->tag->addAttribute('href', $uri);
        $this->tag->addAttribute('data-modules-modal-iframe', 'open-modal-' . $uid);
        $this->tag->addAttribute('data-modules-modal-iframe-title', $this->arguments['title']);
        $this->tag->addAttribute('data-modules-modal-iframe-url', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
