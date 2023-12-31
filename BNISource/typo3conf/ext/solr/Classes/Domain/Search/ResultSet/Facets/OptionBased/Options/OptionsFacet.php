<?php

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

namespace ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Facets\OptionBased\Options;

use ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Facets\OptionBased\AbstractOptionsFacet;
use ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\SearchResultSet;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

/**
 * Value object that represent a options facet.
 *
 * @author Frans Saris <frans@beech.it>
 * @author Timo Hund <timo.hund@dkd.de>
 */
class OptionsFacet extends AbstractOptionsFacet
{
    const TYPE_OPTIONS = 'options';

    /**
     * String
     * @var string
     */
    protected static string $type = self::TYPE_OPTIONS;

    /**
     * OptionsFacet constructor
     *
     * @param SearchResultSet $resultSet
     * @param string $name
     * @param string $field
     * @param string $label
     * @param array $configuration Facet configuration passed from typoscript
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        SearchResultSet $resultSet,
        $name,
        $field,
        $label = '',
        array $configuration = [],
        ObjectManagerInterface $objectManager = null
    ) {
        parent::__construct($resultSet, $name, $field, $label, $configuration, $objectManager);
    }
}
