<?php

namespace App\Repositories;

use App\Models\User;

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
}