<?php

namespace Ntq\Tickit\UseCase;

use Ntq\Contract\Pagination\PaginationInterface;

class GetUserStoriesResponse
{
    /**
     * @var PaginationInterface
     */
    public $pagination;

    /**
     * GetUserStoriesResponse constructor.
     *
     * @param PaginationInterface $pagination
     */
    public function __construct(PaginationInterface $pagination)
    {
        $this->pagination = $pagination;
    }
}