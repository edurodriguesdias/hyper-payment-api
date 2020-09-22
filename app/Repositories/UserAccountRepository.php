<?php

namespace App\Repositories;

use App\Models\UserAccount;
use Exception;

class UserAccountRepository implements UserAccountRepositoryInterface 
{
    private $userAccount;

    public function __construct(UserAccount $userAccount)
    {
        return $this->userAccount = $userAccount;
    }
    
    public function getAccountByUserId($user_id)
    {
        return UserAccount::where('user_id', $user_id)->first();
    }

    public function addBalance($payee, $amount)
    {
        $account = UserAccount::where('user_id', $payee)->first();

        $account->balance += $amount;

        $account->save();

        return $account;
    }

    public function withdrawBalance($payer_id, $value)
    {
        $account = $this->getAccountByUserId($payer_id);
        $user = $account->user;
        $balance = $user->account->balance;

        if($balance < $value) {
            throw new Exception('The payer does not have enough balance to make this transaction');
        }
        
        $account->balance -= $value;

        $account->save();

        return $account;
    }
}