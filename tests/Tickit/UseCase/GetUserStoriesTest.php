<?php

class GetUserStoriesTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanGetAllUserStories()
    {
        $paginationMock = Mockery::mock(\Ntq\Contract\Pagination\PaginationInterface::class);

        $gatewayMock = Mockery::mock(\Ntq\Tickit\Gateway\UserStoryGatewayInterface::class);
        $gatewayMock->shouldReceive('paginate')
            ->with([], [], 2, 50)
            ->andReturn($paginationMock);

        $useCase = new \Ntq\Tickit\UseCase\GetUserStories($gatewayMock);
        $request = new \Ntq\Tickit\UseCase\GetUserStoriesRequest([], [], 2, 50);

        $response = $useCase->handle($request);
        $this->assertInstanceOf(\Ntq\Tickit\UseCase\GetUserStoriesResponse::class, $response);
        $this->assertInstanceOf(\Ntq\Contract\Pagination\PaginationInterface::class, $response->pagination);
    }
}
