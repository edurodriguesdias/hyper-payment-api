<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\App;

class IsCustomerRule implements Rule
{
    public function passes($attribute, $value)
    {
        $model = App::make(UserRepositoryInterface::class);

        $is_customer = $model->get($value)->type === 'customer';
        
        return $is_customer;
    }

    public function message()
    {
        return "Payer must be a customer. Shopkeepers can't make transfers";
    }
}