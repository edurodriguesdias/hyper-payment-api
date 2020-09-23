<?php

namespace App\Listeners;

use App\Events\TransactionCreatedEvent;
use App\Services\Transaction\TransferService;
use App\Jobs\AddBalanceToPayeeJob;
use App\Jobs\SendNotificationMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;

class AuthorizeTransaction implements ShouldQueue
{
    private $transferService;

    public $connection = 'database';

    public $queue = 'default';

    public $delay = 30;

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
            $this->transferService->addBalance($transaction->payer, $transaction->amount);

            $transaction->update([
                'status' => 'not_authorized'
            ]);

            Queue::pushOn('medium', new SendNotificationMessage($transaction->payer, 'Sua transferência não foi efetuada. Tente novamente mais tarde!'));
        }
    }
}
