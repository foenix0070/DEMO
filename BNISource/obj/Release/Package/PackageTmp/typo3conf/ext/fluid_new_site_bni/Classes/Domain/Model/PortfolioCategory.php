<?php

namespace Imaya\BNI\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;


/**
 * Category Model
 */
class PortfolioCategory extends AbstractEntity
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
    protected $parentcategory;



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

    public function getParentcategory(): ?\Imaya\BNI\Domain\Model\PortfolioCategory
    {
        return $this->parentcategory instanceof LazyLoadingProxy
            ? $this->parentcategory->_loadRealInstance()
            : $this->parentcategory;
    }

    public function setParentcategory(\GeorgRinger\News\Domain\Model\Category $category): void
    {
        $this->parentcategory = $category;
    }




}