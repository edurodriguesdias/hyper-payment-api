<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface {
    
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        return $this->transaction = $transaction;
    }

    public function get(int $transaction_id) : Transaction
    {
        return $this->transaction->find($transaction_id);
    }
}