<?php

namespace Ntq\Tickit;


use Illuminate\Support\ServiceProvider;
use Ntq\Adapter\Request;
use Ntq\Contract\RequestInterface;
use Ntq\Tickit\Command;
use Ntq\Tickit\Gateway\MemberGatewayInterface;
use Ntq\Tickit\Gateway\UserStoryGatewayInterface;
use Ntq\Tickit\Persistence\Repository\MemberRepository;
use Ntq\Tickit\Persistence\Repository\UserStoryRepository;

class TickitServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Command\MemberSeedCommand::class,
            Command\UserStoryGetCommand::class,
            Command\UserStoryAssignCommand::class,
            Command\UserStorySeedCommand::class,
        ]);

        $this->app->bind(UserStoryGatewayInterface::class, UserStoryRepository::class);

        $this->app->bind(MemberGatewayInterface::class, MemberRepository::class);

        $this->app->bind(RequestInterface::class, Request::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'tickit');
    }
}