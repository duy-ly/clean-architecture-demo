<?php

namespace Ntq\Tickit\Controller\Web;

use Ntq\Adapter\Controller\AbstractController;
use Ntq\Contract\RequestInterface;
use Ntq\Tickit\UseCase\AssignUserStory;
use Ntq\Tickit\UseCase\AssignUserStoryRequest;
use Ntq\Tickit\UseCase\GetAllMembers;
use Ntq\Tickit\UseCase\GetUserStories;
use Ntq\Tickit\UseCase\GetUserStoriesRequest;

class UserStoryController extends AbstractController
{
    public function index(RequestInterface $request, GetUserStories $getUserStories)
    {
        $useCaseRequest = new GetUserStoriesRequest(
            $request->getQuery('criteria', []),
            $request->getQuery('order_by', ['id' => 'desc']),
            $request->getQuery('current_page', 1),
            $request->getQuery('page_size', 10)
        );

        $useCaseResponse = $getUserStories->handle($useCaseRequest);

        return $this->responseView('tickit::index', [
            'userStories' => $useCaseResponse->pagination,
        ]);
    }

    public function getAssign($userStoryId, GetAllMembers $getAllMembers)
    {
        $members = $getAllMembers->handle();

        return $this->responseView('tickit::assign', [
            'userStoryId' => $userStoryId,
            'members' => $members,
        ]);
    }

    public function postAssign($userStoryId, RequestInterface $request, AssignUserStory $assignUserStory)
    {
        $userCaseRequest = new AssignUserStoryRequest($userStoryId, $request->getPost('member_id'));
        $assignUserStory->handle($userCaseRequest);

        return $this->redirect('home');
    }
}