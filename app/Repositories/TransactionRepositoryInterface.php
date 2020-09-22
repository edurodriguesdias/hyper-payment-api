<?php
namespace App\Repositories;

interface TransactionRepositoryInterface {
    public function get(int $transaction_id);
}