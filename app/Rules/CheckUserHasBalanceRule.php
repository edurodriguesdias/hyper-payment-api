<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

use App\Models\User;

class CheckUserHasBalanceRule implements Rule
{
    public function passes($attribute, $value)
    {
        $user = User::find($value);

        return $user->account->balance >= request()->input('value');
    }

    public function message()
    {
        return "The payer does not have enough balance to make this transaction";
    }
}