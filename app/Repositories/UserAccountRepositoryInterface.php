<?php

namespace App\Repositories;
use App\Models\UserAccount;

interface UserAccountRepositoryInterface
{
    public function getAccountByUserId(int $user_id);
    public function withdrawBalance($payer_id, float $value);
    public function addBalance(int $user_id, float $value);
}