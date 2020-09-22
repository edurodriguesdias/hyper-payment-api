<?php

namespace App\Services\Transaction;

use App\Events\TransactionCreatedEvent;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\UserAccountRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

use Illuminate\Support\Facades\Log;

use Exception;

class TransferService extends AbstractTransaction
{
    private $client;
    private $userModel;
    private $userAccountModel;

    public function __construct(UserRepositoryInterface $userRepository, UserAccountRepositoryInterface $userAccountModel, TransactionRepositoryInterface $transactionRepository)
    {
        $this->client = $this->initClient();
        $this->userModel = $userRepository;
        $this->userAccountModel = $userAccountModel;
        $this->transactionRepository = $transactionRepository;
    }

    public function process(int $payer, int $payee, float $amount)
    {
        $transaction = $this->userModel->createTransaction($payer, $payee, $amount);

        $this->userAccountModel->withdrawBalance($payer, $amount);

        event(new TransactionCreatedEvent($transaction));
        
        return [
            'status' => 'success',
            'data' => $transaction->toArray(),
            'message' => 'transaction is processing'
        ];
    }

    public function addPayeeBalance($transaction_id)
    {
        $transaction = $this->transactionRepository->get($transaction_id);

        $this->userAccountModel->addBalance($transaction->payee, $transaction->amount);
    }

    public function authorizer()
    {
        try {
            $req = $this->client->get('', []);

            $authorizer = json_decode($req->getBody()->getContents(), true);

            return [
                'message' => $authorizer['message'],
                'code' => $req->getStatusCode(),
                'status' => 'error'    
            ];
        } catch (Exception $e) {
            return $this->badResponse($e);
        }
    }
}