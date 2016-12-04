<?php

namespace Ntq\Tickit\Command;

use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Illuminate\Console\Command;
use Ntq\Tickit\Entity\Member;
use Ntq\Tickit\Entity\UserStory;

class UserStorySeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-story:seed {numberOfRecords}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed user stories';

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $faker = Factory::create();

        $members = $this->em->getRepository(Member::class)->findAll();

        for ($i = 0; $i < $this->input->getArgument('numberOfRecords'); $i++) {
            $userStory = new UserStory();
            $userStory->setName($faker->realText(50));
            $userStory->setDescription($faker->text(200));
            $userStory->setPriority($faker->randomElement([
                UserStory::PRIORITY_MINOR,
                UserStory::PRIORITY_NORMAL,
                UserStory::PRIORITY_IMPORTANT,
                UserStory::PRIORITY_URGENT,
            ]));
            $userStory->setAssignee($faker->randomElement($members));

            $this->em->persist($userStory);
        }

        $this->em->flush();
    }
}
