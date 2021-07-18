<?php

use App\Repositories\UserRepository;
use App\Repositories\UserAccountRepository;
use App\Repositories\TransactionRepository;
use App\Services\Transaction\TransferService;
use Laravel\Lumen\Testing\WithoutEvents;

class TransferServiceTest extends TestCase
{
    use WithoutEvents;

    private $userRepository;
    private $userAccountModel;
    private $transactionRepository;
    private $payer = 10;
    private $payee = 20;
    private $amount = 50;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepository::class);
        $this->userAccountModel = $this->createMock(UserAccountRepository::class);
        $this->transactionRepository = $this->createMock(TransactionRepository::class);
    }

    /**
     * @test
     */
    public function shouldCreateTransactionWhenProcess()
    {
        $this->userRepository->expects($this->once())
            ->method('createTransaction');

        $transaction = new TransferService(
            $this->userRepository,
            $this->userAccountModel,
            $this->transactionRepository
        );

        $transaction->process($this->payer, $this->payee, $this->amount);
    }

    /**
     * @test
     */
    public function shouldCallWithdrawBalanceWhenProcess()
    {
        $this->userAccountModel->expects($this->once())
            ->method('withdrawBalance');

        $transaction = new TransferService(
            $this->userRepository,
            $this->userAccountModel,
            $this->transactionRepository
        );

        $transaction->process($this->payer, $this->payee, $this->amount);
    }
}
