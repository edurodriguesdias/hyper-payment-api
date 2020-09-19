<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table = 'user_accounts';

    protected $fillable = [
        'uuid',
        'user_id',
        'balance'
    ];
}
