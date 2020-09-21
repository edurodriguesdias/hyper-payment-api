<?php

namespace App\Services\Transaction;

use Exception;

class TransferService extends AbstractTransaction
{
    public function processTransfer(int $payer, int $payee, decimal $amount)
    {
        DB::beginTransaction();
        try {
            
        } catch (Exception $e) {
            DB::rollback();
            return $this->badResponse($e);
        }
    }
}