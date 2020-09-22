<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class TransactionRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\TransactionRepositoryInterface',
            'App\Repositories\TransactionRepository'
        );
    }
}