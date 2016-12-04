<?php

namespace Ntq\Tickit\Gateway;

use Ntq\Contract\Pagination\PaginationInterface;
use Ntq\Tickit\Entity\Member;

/**
 * Member Gateway.
 *
 * @package Ntq\Tickit\Gateway
 */
interface MemberGatewayInterface
{
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $primaryKey The identifier.
     *
     * @return Member|null The entity instance or NULL if the entity can not be found.
     */
    public function findOne($primaryKey);

    /**
     * Finds and paginate members by a set of criteria.
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int   $currentPage
     * @param int   $pageSize
     *
     * @return PaginationInterface<Ntq\Tickit\Entity\Member>
     */
    public function paginate(array $criteria = [], array $orderBy = [], $currentPage = 1, $pageSize = 10);
}