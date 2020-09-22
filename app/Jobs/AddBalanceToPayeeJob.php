<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use App\Services\Transaction\TransferService;

class AddBalanceToPayeeJob extends Job
{
    private $transaction_id;

    public function __construct($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    public function handle(TransferService $transfer)
    {
        $transfer->addPayeeBalance($this->transaction_id);
    }
}
