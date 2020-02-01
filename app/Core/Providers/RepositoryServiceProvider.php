<?php

namespace BlogApi\Core\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected static array $interfaces = [
        EloquentRepositoryInterface::class      => Repository::class,
        UserRepositoryInterface::class          => UserRepository::class,
    ];

    /**
     * Register any repositories.
     *
     * @return void
     */
    public function register()
    {
        foreach (self::$interfaces as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
