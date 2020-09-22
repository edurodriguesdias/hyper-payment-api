<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\Transaction\TransferService;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct(TransferService $transfer)
    {
        $this->transaction = $transfer;
    }

    public function peerToPeer(TransactionRequest $request)
    {
        dd($this->transaction->process(5, 1, 10));

        return response()->json([
            'message' => 'we are processing the transaction'
        ], 200);
    }
}