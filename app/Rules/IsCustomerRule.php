<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\User;

class IsCustomerRule implements Rule
{
    public function passes($attribute, $value)
    {
        $is_customer = User::find($value)->type === 'customer';

        return $is_customer;
    }

    public function message()
    {
        return "Payer must be a customer. Shopkeepers can't make transfers";
    }
}