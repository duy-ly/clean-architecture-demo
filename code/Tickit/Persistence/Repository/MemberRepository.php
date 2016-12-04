<?php

namespace Ntq\Tickit\Persistence\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ntq\Adapter\Pagination\DoctrinePagination;
use Ntq\Tickit\Entity\Member;
use Ntq\Tickit\Gateway\MemberGatewayInterface;

class MemberRepository implements MemberGatewayInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function findOne($primaryKey)
    {
        return $this->em->find(Member::class, $primaryKey);
    }

    /**
     * @inheritDoc
     */
    public function paginate(array $criteria = [], array $orderBy = [], $currentPage = 1, $pageSize = 10)
    {
        $queryBuilder = $this->em->getRepository(Member::class)->createQueryBuilder('r')
            ->setFirstResult($pageSize * ($currentPage-1))
            ->setMaxResults($pageSize);

        foreach ($orderBy as $sort => $order) {
            $queryBuilder->addOrderBy('r.' . $sort, $order);
        }

        $paginator = new Paginator($queryBuilder);

        return new DoctrinePagination($currentPage, $pageSize, $paginator);
    }
}