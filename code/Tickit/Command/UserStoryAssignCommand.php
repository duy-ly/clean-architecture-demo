<?php

namespace Ntq\Tickit\Command;

use Illuminate\Console\Command;
use Ntq\Tickit\UseCase\AssignUserStory;
use Ntq\Tickit\UseCase\AssignUserStoryRequest;

class UserStoryAssignCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-story:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a member to an user story';

    /**
     * @var AssignUserStory
     */
    protected $assignUserStory;

    /**
     * @param AssignUserStory $assignUserStory
     */
    public function __construct(AssignUserStory $assignUserStory)
    {
        $this->assignUserStory = $assignUserStory;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userStoryId = $this->output->ask('Please provide user story ID');
        $memberId = $this->output->ask('Please provide member ID');

        try {
            $useCaseRequest = new AssignUserStoryRequest($userStoryId, $memberId);
            $this->assignUserStory->handle($useCaseRequest);

            $this->info("User Story #{$userStoryId} has been assign to member #{$memberId}");
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
