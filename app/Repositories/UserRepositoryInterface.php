<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function get(int $user_id);
}