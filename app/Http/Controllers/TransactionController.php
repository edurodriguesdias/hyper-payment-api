<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function peerToPeer(TransactionRequest $request)
    {
        // $this->transaction->processTransfer($request->payer, $request->payee, $request->value);

        return response()->json([
            'message' => 'we are processing the transaction'
        ], 200);
    }
}