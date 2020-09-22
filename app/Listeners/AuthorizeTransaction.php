<?php

namespace App\Listeners;

use App\Events\TransactionCreatedEvent;
use App\Services\Transaction\TransferService;
use App\Jobs\AddBalanceToPayeeJob;

use Illuminate\Support\Facades\Queue;

class AuthorizeTransaction
{
    private $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function handle(TransactionCreatedEvent $event)
    {
        $transaction = $event->transaction;

        if($this->transferService->authorizer()['code'] === 200) {
            $transaction->update([
                'status' => 'authorized'
            ]);

            Queue::pushOn('high', new AddBalanceToPayeeJob($transaction->id));
        } else {
            //Queue::pushOn('high', TransactionNotAuthorizedMessage($transaction->id));
        }
    }
}
