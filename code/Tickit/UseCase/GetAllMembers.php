<?php

namespace Ntq\Tickit\UseCase;

use Ntq\Tickit\Entity\Member;
use Ntq\Tickit\Gateway\MemberGatewayInterface;

class GetAllMembers
{
    /**
     * @var MemberGatewayInterface
     */
    private $memberGateway;

    /**
     * @param MemberGatewayInterface $memberGateway
     */
    public function __construct(MemberGatewayInterface $memberGateway)
    {
        $this->memberGateway = $memberGateway;
    }

    /**
     * Get all members.
     *
     * @return Member[]
     */
    public function handle()
    {
        return $this->memberGateway->paginate()->items();
    }
}