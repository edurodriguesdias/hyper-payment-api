<?php

namespace App\Repositories;
interface UserRepositoryInterface
{
    public function get(int $user_id);
    public function createTransaction(int $payer_id, int $payee, float $amount);
}