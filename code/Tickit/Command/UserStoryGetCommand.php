<?php

namespace Ntq\Tickit\Command;

use Illuminate\Console\Command;
use Ntq\Tickit\Adapter\Request\GetUserStoriesConsoleRequest;
use Ntq\Tickit\Entity\UserStory;
use Ntq\Tickit\UseCase\GetUserStories;
use Ntq\Tickit\UseCase\GetUserStoriesRequest;

class UserStoryGetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-story:filter {--orderBy=} {--currentPage=} {--pageSize=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and filter user stories';

    /**
     * @var GetUserStories
     */
    protected $getUserStories;

    public function __construct(GetUserStories $getUserStories)
    {
        $this->getUserStories = $getUserStories;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $useCaseRequest = new GetUserStoriesRequest(
            [],
            $this->parseOrderBy($this->input->getOption('orderBy')),
            (int) $this->input->getOption('currentPage') ?: 1,
            (int) $this->input->getOption('pageSize') ?: 10
        );

        $useCaseResponse = $this->getUserStories->handle($useCaseRequest);

        $this->table(
            ['ID', 'Name', 'Assignee ID', 'Assignee Full Name'],
            array_map(function(UserStory $userStory) {
                return [
                    $userStory->getId(),
                    $userStory->getName(),
                    $userStory->getAssignee()->getId(),
                    $userStory->getAssignee()->getFullName()
                ];
            }, (array) $useCaseResponse->pagination->items())
        );
    }

    /**
     * Parse order by from string format to array.
     *
     * @param string $orderString
     * @return array
     */
    private function parseOrderBy($orderString)
    {
        if (! $orderString) {
            return ['id' => 'desc'];
        }

        $orders = [];
        foreach (explode(',', $orderString) as $orderBy) {
            if (substr($orderBy, 0, 1) === '-')  {
                $orders[substr($orderBy, 1)] = 'desc';
            } else {
                $orders[$orderBy] = 'asc';
            }
        }

        return $orders;
    }
}
