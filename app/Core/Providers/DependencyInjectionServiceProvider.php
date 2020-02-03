<?php

namespace BlogApi\Core\Providers;

use BlogApi\Core\Auth\Authenticator;
use BlogApi\Core\Auth\PassportAuthenticator;
use Illuminate\Support\ServiceProvider;

class DependencyInjectionServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected static array $interfaces = [
        Authenticator::class => PassportAuthenticator::class
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
