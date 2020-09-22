<?php

namespace App\Services\Transaction;

use App\Repositories\UserAccountRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepositoryInterface;

use Exception;

class TransferService extends AbstractTransaction
{
    private $client;
    private $userModel;
    private $userAccountModel;

    public function __construct(UserRepositoryInterface $userRepository, UserAccountRepositoryInterface $userAccountModel)
    {
        $this->client = $this->initClient();
        $this->userModel = $userRepository;
        $this->userAccountModel = $userAccountModel;
    }

    public function process(int $payer, int $payee, float $amount)
    {
        $transaction = $this->userModel->createTransaction($payer, $payee, $amount);

        $this->userAccountModel->withdrawBalance($payer, $amount);

        return [
            'status' => 'success',
            'data' => $transaction->toArray(),
            'message' => 'transaction is processing'
        ];
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