<?php

namespace App\Events;

use App\Models\Transaction;

class TransactionCreatedEvent extends Event
{
    public $transaction;
    
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
