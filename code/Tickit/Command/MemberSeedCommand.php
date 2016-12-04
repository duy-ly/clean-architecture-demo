<?php

namespace Ntq\Tickit\Command;

use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Illuminate\Console\Command;
use Ntq\Tickit\Entity\Member;

class MemberSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:seed {numberOfRecords}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed members';

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
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

        for ($i = 0; $i < $this->input->getArgument('numberOfRecords'); $i++) {
            $userStory = new Member();
            $userStory->setFirstName($faker->firstName);
            $userStory->setLastName($faker->lastName);
            $userStory->setEmail($faker->freeEmail);

            $this->em->persist($userStory);
        }

        $this->em->flush();
    }
}
