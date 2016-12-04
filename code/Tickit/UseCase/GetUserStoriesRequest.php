<?php

namespace Ntq\Tickit\UseCase;

class GetUserStoriesRequest
{
    /**
     * @var array
     */
    public $criteria;

    /**
     * @var array
     */
    public $orderBy;

    /**
     * @var int|null
     */
    public $currentPage;

    /**
     * @var int|null
     */
    public $pageSize;

    /**
     * GetUserStoriesRequest constructor.
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int $currentPage
     * @param int $pageSize
     */
    public function __construct(array $criteria = [], array $orderBy = [], $currentPage = 1, $pageSize = 10)
    {
        $this->criteria = $criteria;
        $this->orderBy = $orderBy;
        $this->currentPage = $currentPage;
        $this->pageSize = $pageSize;
    }
}