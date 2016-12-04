<?php

namespace Ntq\Tickit\Gateway;

use Ntq\Contract\Pagination\PaginationInterface;
use Ntq\Tickit\Entity\UserStory;

/**
 * User Story Gateway.
 *
 * @package Ntq\Tickit\Gateway
 */
interface UserStoryGatewayInterface
{
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $primaryKey The identifier.
     *
     * @return UserStory|null The entity instance or NULL if the entity can not be found.
     */
    public function findOne($primaryKey);

    /**
     * Finds and paginate user stories by a set of criteria.
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int   $currentPage
     * @param int   $pageSize
     *
     * @return PaginationInterface<Ntq\Tickit\Entity\UserStory>
     */
    public function paginate(array $criteria = [], array $orderBy = [], $currentPage = 1, $pageSize = 10);

    /**
     * Save an user story and its relationships.
     *
     * @param UserStory $userStory
     */
    public function save(UserStory $userStory);
}