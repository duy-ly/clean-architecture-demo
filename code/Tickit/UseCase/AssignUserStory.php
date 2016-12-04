<?php

namespace Ntq\Tickit\UseCase;

use Ntq\Tickit\Gateway\MemberGatewayInterface;
use Ntq\Tickit\Gateway\UserStoryGatewayInterface;

class AssignUserStory
{
    /**
     * @var UserStoryGatewayInterface
     */
    private $userStoryGateway;

    /**
     * @var MemberGatewayInterface
     */
    private $memberGateway;

    public function __construct(UserStoryGatewayInterface $userStoryGateway, MemberGatewayInterface $memberGateway)
    {
        $this->userStoryGateway = $userStoryGateway;
        $this->memberGateway = $memberGateway;
    }

    /**
     * Handle a GetUserStoriesRequest.
     *
     * @param AssignUserStoryRequest $request
     * @return GetUserStoriesResponse
     */
    public function handle(AssignUserStoryRequest $request)
    {
        $userStory = $this->userStoryGateway->findOne($request->userStoryId);
        if (! $userStory) {
            throw new \RuntimeException('User story can not be found');
        }

        $member = $this->memberGateway->findOne($request->memberId);
        if (! $member) {
            throw new \RuntimeException('Member can not be found');
        }

        $userStory->setAssignee($member);
        $this->userStoryGateway->save($userStory);
    }
}