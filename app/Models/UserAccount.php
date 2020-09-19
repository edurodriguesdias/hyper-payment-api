<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserAccount extends Model
{
    protected $table = 'user_accounts';

    protected $fillable = [
        'uuid',
        'user_id',
        'balance'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if(!$model->uuid) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
