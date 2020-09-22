<?php

namespace App\Services\Transaction;
use GuzzleHttp\Client;
abstract class AbstractTransaction
{
    protected function initClient()
    {
        return new Client([
            'base_uri' => env('HYPER_AUTORIZER_TRANSACTION_URL'),
            'timeout' => 90
        ]);
    }

    protected function badResponse($exception)
    {
        return [
            'message' => $exception->getMessage(),
            'code' => $exception->getStatusCode(),
            'status' => 'error'
        ];
    }
}