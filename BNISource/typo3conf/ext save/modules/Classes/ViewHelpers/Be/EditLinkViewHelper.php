<?php

namespace CodingMs\Modules\ViewHelpers\Be;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder as UriBuilderBackend;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class EditLinkViewHelper extends AbstractTagBasedViewHelper
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
        $this->registerArgument('pageUid', 'int', 'Page uid', false, -1);
        $this->registerArgument('invertState', 'bool', 'Inverts the set active7inactive', false, false);
        $this->registerArgument('action', 'string', 'Action', false, 'edit');
        $this->registerArgument('module', 'string', 'Module', false, '');
        $this->registerArgument('modal', 'array', 'Modal', false, []);
        $this->registerArgument('columnsOnly', 'string', 'Columns to edit (multiple must be comma separated)', false, '');
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
        $table = $this->arguments['table'];
        $uid = $this->arguments['uid'];
        $action = $this->arguments['action'];
        $module = $this->arguments['module'];
        $modal = $this->arguments['modal'];
        $invertState = (bool)$this->arguments['invertState'];
        $uri = '#';
        if (!isset($this->arguments['pageUid']) || $this->arguments['pageUid'] === -1) {
            $pageUid = (int)GeneralUtility::_GP('id');
        } else {
            $pageUid = $this->arguments['pageUid'];
        }
        $returnUrl = (string)$this->uriBuilderBackend->buildUriFromRoute($module, GeneralUtility::_GET());
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
                // Columns are defined?
                if (trim($this->arguments['columnsOnly']) != '') {
                    $parameter['columnsOnly'] = $this->arguments['columnsOnly'];
                }
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
                        $this->tag->addAttribute('title', $modal['title']);
                        $this->tag->addAttribute('data-title', $modal['title']);
                    }
                    if (isset($modal['content'])) {
                        if (version_compare((string)GeneralUtility::makeInstance(Typo3Version::class), '10.0.0', '<=')) {
                            $this->tag->addAttribute('data-content', $modal['content']);
                        } else {
                            $this->tag->addAttribute('data-bs-content', $modal['content']);
                        }
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
            case 'active':
                $parameter = [
                    'redirect' => $returnUrl,
                    'id' => $pageUid,
                    'data' => [
                        $table => [
                            $uid => [
                                'active' => ($invertState ? 0 : 1)
                            ]
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('tce_db', $parameter);
                break;
            case 'inactive':
                $parameter = [
                    'redirect' => $returnUrl,
                    'id' => $pageUid,
                    'data' => [
                        $table => [
                            $uid => [
                                'active' => ($invertState ? 1 : 0)
                            ]
                        ]
                    ]
                ];
                $uri = (string)$this->uriBuilderBackend->buildUriFromRoute('tce_db', $parameter);
                break;
        }
        // Build attribute
        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
