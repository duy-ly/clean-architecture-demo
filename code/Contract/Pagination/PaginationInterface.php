<?php

namespace Ntq\Contract\Pagination;

/**
 * Data Pagination interface.
 *
 * @package Ntq\Contract\Pagination
 */
interface PaginationInterface
{
    /**
     * Get current page results.
     *
     * @return array
     */
    public function items();

    /**
     * Get the count.
     *
     * @return int
     */
    public function count();

    /**
     * Get the current page.
     *
     * @return int
     */
    public function getCurrentPage();

    /**
     * Get the total.
     *
     * @return int
     */
    public function getTotal();

    /**
     * Get the last page.
     *
     * @return int
     */
    public function getLastPage();

    /**
     * Get the number per page.
     *
     * @return int
     */
    public function getPageSize();
}