<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Transaction;
class UserRepository implements UserRepositoryInterface 
{
    private $user;

    public function __construct(User $user)
    {
        return $this->user = $user;
    }

    public function get(int $user_id) : User
    {
        return $this->user->find($user_id);
    }

    public function createTransaction(int $payer_id, int $payee, float $amount): Transaction
    {
        $user = $this->get($payer_id);
    
        return $user->transactions()->create([
            'payee' => $payee,
            'status' => 'processing',
            'amount' => $amount
        ]);
    }
}