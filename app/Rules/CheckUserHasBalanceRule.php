<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\App;

class CheckUserHasBalanceRule implements Rule
{
    public function passes($attribute, $value)
    {
        $model = App::make(UserRepositoryInterface::class);
        
        $user = $model->get($value);

        return $user->account->balance >= request()->input('value');
    }

    public function message()
    {
        return "The payer does not have enough balance to make this transaction";
    }
}