<?php

namespace Ntq\Tickit\UseCase;


use Ntq\Tickit\Gateway\UserStoryGatewayInterface;

class GetUserStories
{
    /**
     * @var UserStoryGatewayInterface
     */
    private $userStoryGateway;

    /**
     * @param UserStoryGatewayInterface $userStoryGateway
     */
    public function __construct(UserStoryGatewayInterface $userStoryGateway)
    {
        $this->userStoryGateway = $userStoryGateway;
    }

    /**
     * Handle a GetUserStoriesRequest.
     *
     * @param GetUserStoriesRequest $request
     * @return GetUserStoriesResponse
     */
    public function handle(GetUserStoriesRequest $request)
    {
        $pagination = $this->userStoryGateway->paginate(
            $request->criteria,
            $request->orderBy,
            $request->currentPage,
            $request->pageSize
        );

        return new GetUserStoriesResponse($pagination);
    }
}