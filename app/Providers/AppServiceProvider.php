<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    public function boot()
    {
        Validator::extend('is_customer', function($attribute, $value, $parameters, $validator) {
            $is_customer = User::find($value)->type === 'customer';

            return $is_customer;
        }, "Payer must be a customer. Shopkeepers can't make transfers");
    }
}
