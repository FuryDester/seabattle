<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\UserRepository;
use App\Services\Contracts\UserServiceContract;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DependencyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $bindings = [];

    public array $singletons = [
        UserRepositoryContract::class => UserRepository::class,
        UserServiceContract::class => UserService::class,
    ];

    public function provides(): array
    {
        return [
            ...array_keys($this->bindings),
            ...array_keys($this->singletons),
        ];
    }
}
