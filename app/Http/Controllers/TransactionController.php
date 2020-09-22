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
        $this->transaction->process($request->payer, $request->payee, $request->value);

        return response()->json([
            'message' => 'we are processing the transaction'
        ], 200);
    }
}