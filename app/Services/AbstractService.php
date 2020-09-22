<?php

namespace App\Services;
use GuzzleHttp\Client;

abstract class AbstractService
{
    protected function initClient($base_url)
    {
        return new Client([
            'base_uri' => $base_url,
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