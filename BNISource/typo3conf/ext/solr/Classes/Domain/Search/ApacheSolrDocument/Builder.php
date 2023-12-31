<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace ApacheSolrForTypo3\Solr\Domain\Search\ApacheSolrDocument;

use ApacheSolrForTypo3\Solr\Access\Rootline;
use ApacheSolrForTypo3\Solr\Domain\Site\Site;
use ApacheSolrForTypo3\Solr\Domain\Site\SiteRepository;
use ApacheSolrForTypo3\Solr\Domain\Variants\IdBuilder;
use ApacheSolrForTypo3\Solr\System\Solr\Document\Document;
use ApacheSolrForTypo3\Solr\Typo3PageContentExtractor;
use ApacheSolrForTypo3\Solr\Util;
use Doctrine\DBAL\Driver\Exception as DBALDriverException;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Builder class to build an ApacheSolrDocument
 *
 * Responsible to build \ApacheSolrForTypo3\Solr\System\Solr\Document\Document
 *
 * @author Timo Hund <timo.hund@dkd.de>
 */
class Builder
{
    /**
     * @var IdBuilder
     */
    protected $variantIdBuilder;

    /**
     * Builder constructor.
     * @param IdBuilder|null $variantIdBuilder
     */
    public function __construct(IdBuilder $variantIdBuilder = null)
    {
        $this->variantIdBuilder = $variantIdBuilder ?? GeneralUtility::makeInstance(IdBuilder::class);
    }

    /**
     * This method can be used to build a Document from a TYPO3 page.
     *
     * @param TypoScriptFrontendController $page
     * @param string $url
     * @param Rootline $pageAccessRootline
     * @param string $mountPointParameter
     * @return Document|object
     * @throws AspectNotFoundException
     * @throws DBALDriverException
     */
    public function fromPage(
        TypoScriptFrontendController $page,
        string $url,
        Rootline $pageAccessRootline,
        string $mountPointParameter = ''
    ): Document {
        /* @var Document $document */
        $document = GeneralUtility::makeInstance(Document::class);
        $site = $this->getSiteByPageId((int)$page->id);
        $pageRecord = $page->page;

        $accessGroups = $this->getDocumentIdGroups($pageAccessRootline);
        $documentId = $this->getPageDocumentId($page, $accessGroups, $mountPointParameter);

        $document->setField('id', $documentId);
        $document->setField('site', $site->getDomain());
        $document->setField('siteHash', $site->getSiteHash());
        $document->setField('appKey', 'EXT:solr');
        $document->setField('type', 'pages');

        // system fields
        $document->setField('uid', (int)$page->id);
        $document->setField('pid', $pageRecord['pid']);

        // variantId
        $variantId = $this->variantIdBuilder->buildFromTypeAndUid('pages', (int)$page->id);
        $document->setField('variantId', $variantId);

        $document->setField('typeNum', $page->type);
        $document->setField('created', $pageRecord['crdate']);
        $document->setField('changed', $pageRecord['SYS_LASTCHANGED']);

        $rootline = $this->getRootLineFieldValue((int)$page->id, $mountPointParameter);
        $document->setField('rootline', $rootline);

        // access
        $this->addAccessField($document, $pageAccessRootline);
        $this->addEndtimeField($document, $pageRecord);

        // content
        // @extensionScannerIgnoreLine
        $contentExtractor = $this->getExtractorForPageContent($page->content);
        $document->setField('title', $contentExtractor->getPageTitle());
        $document->setField('subTitle', $pageRecord['subtitle']);
        $document->setField('navTitle', $pageRecord['nav_title']);
        $document->setField('author', $pageRecord['author']);
        $document->setField('description', $pageRecord['description']);
        $document->setField('abstract', $pageRecord['abstract']);
        $document->setField('content', $contentExtractor->getIndexableContent());
        $document->setField('url', $url);

        $this->addKeywordsField($document, $pageRecord);
        $this->addTagContentFields($document, $contentExtractor->getTagContent());

        return $document;
    }

    /**
     * Creates a Solr document with the basic / core fields set already.
     *
     * @param array $itemRecord
     * @param string $type
     * @param int $rootPageUid
     * @param string $accessRootLine
     * @return Document
     * @throws DBALDriverException
     */
    public function fromRecord(array $itemRecord, string $type, int $rootPageUid, string $accessRootLine): Document
    {
        /* @var $document Document */
        $document = GeneralUtility::makeInstance(Document::class);

        $site = $this->getSiteByPageId($rootPageUid);

        $documentId = $this->getDocumentId($type, $site->getRootPageId(), $itemRecord['uid']);

        // required fields
        $document->setField('id', $documentId);
        $document->setField('type', $type);
        $document->setField('appKey', 'EXT:solr');

        // site, siteHash
        $document->setField('site', $site->getDomain());
        $document->setField('siteHash', $site->getSiteHash());

        // uid, pid
        $document->setField('uid', $itemRecord['uid']);
        $document->setField('pid', $itemRecord['pid']);

        // variantId
        $variantId = $this->variantIdBuilder->buildFromTypeAndUid($type, $itemRecord['uid']);
        $document->setField('variantId', $variantId);

        // created, changed
        if (!empty($GLOBALS['TCA'][$type]['ctrl']['crdate'])) {
            $document->setField('created', $itemRecord[$GLOBALS['TCA'][$type]['ctrl']['crdate']]);
        }
        if (!empty($GLOBALS['TCA'][$type]['ctrl']['tstamp'])) {
            $document->setField('changed', $itemRecord[$GLOBALS['TCA'][$type]['ctrl']['tstamp']]);
        }

        // access, endtime
        $document->setField('access', $accessRootLine);
        if (!empty($GLOBALS['TCA'][$type]['ctrl']['enablecolumns']['endtime'])
            && $itemRecord[$GLOBALS['TCA'][$type]['ctrl']['enablecolumns']['endtime']] != 0
        ) {
            $document->setField('endtime', $itemRecord[$GLOBALS['TCA'][$type]['ctrl']['enablecolumns']['endtime']]);
        }

        return $document;
    }

    /**
     * @param TypoScriptFrontendController $frontendController
     * @param string $accessGroups
     * @param string $mountPointParameter
     * @return string
     * @throws AspectNotFoundException
     * @throws DBALDriverException
     */
    protected function getPageDocumentId(TypoScriptFrontendController $frontendController, string $accessGroups, string $mountPointParameter): string
    {
        return Util::getPageDocumentId($frontendController->id, $frontendController->type, Util::getLanguageUid(), $accessGroups, $mountPointParameter);
    }

    /**
     * @param string $type
     * @param int $rootPageId
     * @param int $recordUid
     * @return string
     * @throws DBALDriverException
     */
    protected function getDocumentId(string $type, int $rootPageId, int $recordUid): string
    {
        return Util::getDocumentId($type, $rootPageId, $recordUid);
    }

    /**
     * @param int $pageId
     * @return Site
     * @throws DBALDriverException
     */
    protected function getSiteByPageId(int $pageId): Site
    {
        $siteRepository = GeneralUtility::makeInstance(SiteRepository::class);
        return $siteRepository->getSiteByPageId($pageId);
    }

    /**
     * @param string $pageContent
     * @return Typo3PageContentExtractor
     */
    protected function getExtractorForPageContent(string $pageContent): Typo3PageContentExtractor
    {
        return GeneralUtility::makeInstance(Typo3PageContentExtractor::class, /** @scrutinizer ignore-type */ $pageContent);
    }

    /**
     * Builds the content for the rootline field.
     *
     * @param int $pageId
     * @param string $mountPointParameter
     * @return string
     */
    protected function getRootLineFieldValue(int $pageId, string $mountPointParameter = '')
    {
        $rootline = $pageId;
        if ($mountPointParameter !== '') {
            $rootline .= ',' . $mountPointParameter;
        }
        return $rootline;
    }

    /**
     * Gets a comma separated list of frontend user groups to use for the
     * document ID.
     *
     * @param Rootline $pageAccessRootline
     * @return string A comma separated list of frontend user groups.
     */
    protected function getDocumentIdGroups(Rootline $pageAccessRootline): string
    {
        $groups = $pageAccessRootline->getGroups();
        $groups = Rootline::cleanGroupArray($groups);

        if (empty($groups)) {
            $groups[] = 0;
        }

        return implode(',', $groups);
    }

    /**
     * Adds the access field to the document if needed.
     *
     * @param Document $document
     * @param Rootline $pageAccessRootline
     */
    protected function addAccessField(Document $document, Rootline $pageAccessRootline)
    {
        $access = (string)$pageAccessRootline;
        if (trim($access) !== '') {
            $document->setField('access', $access);
        }
    }

    /**
     * Adds the endtime field value to the Document.
     *
     * @param Document $document
     * @param array $pageRecord
     */
    protected function addEndtimeField(Document $document, array $pageRecord)
    {
        if (isset($pageRecord['endtime']) && $pageRecord['endtime'] > 0) {
            $document->setField('endtime', $pageRecord['endtime']);
        }
    }

    /**
     * Adds keywords, multi valued.
     *
     * @param Document $document
     * @param array $pageRecord
     */
    protected function addKeywordsField(Document $document, array $pageRecord)
    {
        if (!isset($pageRecord['keywords'])) {
            return;
        }

        $keywords = array_unique(GeneralUtility::trimExplode(',', $pageRecord['keywords'], true));
        foreach ($keywords as $keyword) {
            $document->addField('keywords', $keyword);
        }
    }

    /**
     * Add content from several tags like headers, anchors, ...
     *
     * @param Document $document
     * @param array $tagContent
     */
    protected function addTagContentFields(Document $document, array $tagContent = [])
    {
        foreach ($tagContent as $fieldName => $fieldValue) {
            $document->setField($fieldName, $fieldValue);
        }
    }
}
