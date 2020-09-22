<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Queue;

use App\Repositories\TransactionRepositoryInterface;
use App\Services\Transaction\TransferService;
use Illuminate\Support\Facades\Log;

class AddBalanceToPayeeJob extends Job
{
    private $transaction_id;

    public function __construct($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    public function handle(TransferService $transferService, TransactionRepositoryInterface $model)
    {
        $transferService->addPayeeBalance($this->transaction_id);
        $transferService->setAsProcessed($this->transaction_id);

        $transfer = $model->get($this->transaction_id);

        $amount = number_format($transfer->balance, 2, ',', '.');

        Queue::pushOn('medium', new SendNotificationMessage($transfer->payee, "Você recebeu uma nova transferência no valor de R$ ${amount}"));
    }
}
