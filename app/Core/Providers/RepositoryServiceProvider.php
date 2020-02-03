<?php

namespace BlogApi\Core\Providers;

use BlogApi\Blog\Repositories\ArticleRepositoryInterface;
use BlogApi\Blog\Repositories\Eloquent\ArticleRepository;
use BlogApi\Core\Repositories\Eloquent\Repository;
use BlogApi\Core\Repositories\Eloquent\UserRepository;
use BlogApi\Core\Repositories\EloquentRepositoryInterface;
use BlogApi\Core\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected static array $interfaces = [
        EloquentRepositoryInterface::class      => Repository::class,
        UserRepositoryInterface::class          => UserRepository::class,
        ArticleRepositoryInterface::class       => ArticleRepository::class
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
