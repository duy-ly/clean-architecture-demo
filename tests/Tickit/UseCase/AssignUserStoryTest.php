<?php

use Mockery\MockInterface;
use Ntq\Tickit\Entity\Member;
use Ntq\Tickit\Entity\UserStory;
use Ntq\Tickit\Gateway\MemberGatewayInterface;
use Ntq\Tickit\Gateway\UserStoryGatewayInterface;
use Ntq\Tickit\UseCase\AssignUserStory;
use Ntq\Tickit\UseCase\AssignUserStoryRequest;

class AssignUserStoryTest extends TestCase
{
    /**
     * @var MockInterface
     */
    private $userStoryGatewayMock;

    /**
     * @var MockInterface
     */
    private $memberGatewayMock;

    public function setUp()
    {
        parent::setUp();

        $this->userStoryGatewayMock = Mockery::mock(UserStoryGatewayInterface::class);
        $this->memberGatewayMock = Mockery::mock(MemberGatewayInterface::class);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCanAssignUserStoryToMember()
    {
        // prepare stub objects
        $userStory = new UserStory();
        $userStory->setId(1);

        $member = new Member();
        $member->setId(2);

        // prepare mock objects
        $this->userStoryGatewayMock->shouldReceive('findOne')
            ->once()
            ->with(1)
            ->andReturn($userStory);

        $this->memberGatewayMock->shouldReceive('findOne')
            ->once()
            ->with(2)
            ->andReturn($member);

        $this->userStoryGatewayMock->shouldReceive('save')
            ->once()
            ->with($userStory)
            ->andReturn();

        // initiate use case
        $useCase = new AssignUserStory($this->userStoryGatewayMock, $this->memberGatewayMock);
        $request = new AssignUserStoryRequest(1, 2);

        // execute use case
        $useCase->handle($request);

        // assertions
        $this->assertInstanceOf(Member::class, $userStory->getAssignee());
        $this->assertSame($member, $userStory->getAssignee());
    }

    public function testShouldThrowExceptionForInvalidUserStoryId()
    {
        // assertions
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('User story can not be found');

        // prepare mock objects
        $this->userStoryGatewayMock->shouldReceive('findOne')
            ->once()
            ->with(1)
            ->andReturn();

        // initiate use case
        $useCase = new AssignUserStory($this->userStoryGatewayMock, $this->memberGatewayMock);
        $request = new AssignUserStoryRequest(1, 2);

        // execute use case
        $useCase->handle($request);
    }

    public function testShouldThrowExceptionForInvalidMemberId()
    {
        // assertions
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Member can not be found');

        // prepare stub objects
        $userStory = new UserStory();
        $userStory->setId(1);

        // prepare mock objects
        $this->userStoryGatewayMock->shouldReceive('findOne')
            ->once()
            ->with(1)
            ->andReturn($userStory);

        $this->memberGatewayMock->shouldReceive('findOne')
            ->once()
            ->with(2)
            ->andReturn();

        // initiate use case
        $useCase = new AssignUserStory($this->userStoryGatewayMock, $this->memberGatewayMock);
        $request = new AssignUserStoryRequest(1, 2);

        // execute use case
        $useCase->handle($request);
    }
}
