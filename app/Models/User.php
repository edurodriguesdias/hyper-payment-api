<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'document',
        'type'
    ];

    protected $hidden = [
        'password'
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

    public function account()
    {
        return $this->hasOne(UserAccount::class);
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }
}
