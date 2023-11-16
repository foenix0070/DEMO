<?php

namespace Imaya\BNI\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;


/**
 * Portfolio Model
 */
class Portfolio extends AbstractEntity
{

    /**
     * @var string
     */
    protected $title = '';


    /**
     * @var string
     */
    protected $description = '';


    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $images;


     /**
     * @var \Imaya\BNI\Domain\Model\PortfolioCategory
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $portfoliocategory;



    public function __construct()
    {
        $this->images = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPortfoliocategorycategory(): ?\Imaya\BNI\Domain\Model\PortfolioCategory
    {
        return $this->portfoliocategory instanceof LazyLoadingProxy
            ? $this->portfoliocategory->_loadRealInstance()
            : $this->portfoliocategory;
    }

    public function setPortfoliocategory(\Imaya\BNI\Domain\Model\PortfolioCategory $category): void
    {
        $this->portfoliocategory = $category;
    }




}