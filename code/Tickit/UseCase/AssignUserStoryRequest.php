<?php

namespace Ntq\Tickit\UseCase;

class AssignUserStoryRequest
{
    /**
     * @var int
     */
    public $userStoryId;

    /**
     * @var int
     */
    public $memberId;

    /**
     * @param int $userStoryId
     * @param int $memberId
     */
    public function __construct($userStoryId, $memberId)
    {
        $this->userStoryId = $userStoryId;
        $this->memberId = $memberId;
    }
}