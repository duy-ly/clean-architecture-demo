<?php

namespace Ntq\Adapter\Pagination;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Ntq\Contract\Pagination\PaginationInterface;

/**
 * Pagination adapter for Doctrine Paginator.
 *
 * @package Ntq\Adapter\Pagination
 */
class DoctrinePagination implements PaginationInterface
{
    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $pageSize;

    /**
     * DoctrinePagination constructor.
     *
     * @param int $currentPage
     * @param int $pageSize
     * @param Paginator $paginator
     */
    public function __construct($currentPage, $pageSize, Paginator $paginator)
    {
        $this->currentPage = $currentPage;
        $this->pageSize = $pageSize;
        $this->paginator = $paginator;
    }

    /**
     * @inheritDoc
     */
    public function items()
    {
        return (array) $this->paginator->getIterator();
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->items());
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @inheritDoc
     */
    public function getTotal()
    {
        return $this->paginator->count();
    }

    /**
     * @inheritDoc
     */
    public function getLastPage()
    {
        return ceil($this->getTotal() / $this->getPageSize());
    }

    /**
     * @inheritDoc
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }
}