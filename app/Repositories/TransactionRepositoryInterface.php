<?php
namespace App\Repositories;

interface TransactionRepositoryInterface {
    public function get(int $transaction_id);
    public function changeStatus(int $transaction_id, string $status);
}