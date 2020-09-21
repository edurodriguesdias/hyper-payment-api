<?php

namespace App\Services\Transaction;

abstract class AbstractTransaction
{
    protected function initClient()
    {
        return new Client([
            'base_uri' => env('HYPER_AUTORIZER_TRANSACTION_URL'),
            'headers' => [],
            'timeout' => 90
        ]);
    }

    protected function badResponse($exception)
    {
        return [
            'message' => $exception->getMessage()
        ];
    }
}