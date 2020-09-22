<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class UserAccountRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\UserAccountRepositoryInterface',
            'App\Repositories\UserAccountRepository'
        );
    }
}