<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\User;

class CheckUserHasBalanceRule implements Rule
{
    public function passes($attribute, $value)
    {   
        $user = User::find($value);
        
        if($user) {
            return $user->account->balance >= request()->input('value');
        }
        return true;
    }

    public function message()
    {
        return "Payer has no balance to make this transaction";
    }
}