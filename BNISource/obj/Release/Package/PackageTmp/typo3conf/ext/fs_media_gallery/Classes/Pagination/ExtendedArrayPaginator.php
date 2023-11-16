<?php
declare(strict_types=1);

namespace MiniFranske\FsMediaGallery\Pagination;

use TYPO3\CMS\Core\Pagination\AbstractPaginator;

class ExtendedArrayPaginator extends AbstractPaginator
{
    /**
     * @var array
     */
    private $items;

    /**
     * @var array
     */
    private $paginatedItems = [];

    /**
     * @var array
     */
    private $itemsBefore = [];

    /**
     * @var array
     */
    private $itemsAfter = [];

    public function __construct(
        array $items,
        int   $currentPageNumber = 1,
        int   $itemsPerPage = 10
    )
    {
        $this->items = $items;
        $this->setCurrentPageNumber($currentPageNumber);
        $this->setItemsPerPage($itemsPerPage);

        $this->updateInternalState();
    }

    /**
     * @return iterable|array
     */
    public function getPaginatedItems(): iterable
    {
        return $this->paginatedItems;
    }

    protected function updatePaginatedItems(int $itemsPerPage, int $offset): void
    {
        $this->itemsBefore = array_slice($this->items, 0, $offset);
        $this->paginatedItems = array_slice($this->items, $offset, $itemsPerPage);
        $this->itemsAfter = array_slice($this->items, $offset + $itemsPerPage);
    }

    protected function getTotalAmountOfItems(): int
    {
        return count($this->items);
    }

    protected function getAmountOfItemsOnCurrentPage(): int
    {
        return count($this->paginatedItems);
    }

    public function getItemsBefore(): iterable
    {
        return $this->itemsBefore;
    }

    public function getItemsAfter(): iterable
    {
        return $this->itemsAfter;
    }
}

