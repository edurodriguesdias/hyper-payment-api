<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $fillable = [
        'uuid',
        'payer',
        'payee',
        'amount',
        'status'
    ];

    protected $visible = [
        'uuid',
        'amount',
        'status'
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

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer', 'id');
    }

    public function payee()
    {
        return $this->belongsTo(User::class, 'payee', 'id');
    }
}
