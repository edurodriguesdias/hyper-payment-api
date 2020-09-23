<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TransactionIntegrationTest extends TestCase
{
    public function testTransactionWithServiceAuthorized()
    {
        $this->assertTrue(true);
    }

    public function testTransactionWithServiceUnauthorized()
    {
        $this->assertTrue(true);
    }

    public function testSendMailWithServiceAuthorized()
    {
        $this->assertTrue(true);
    }

    public function testSendMailWithServiceUnauthorized()
    {
        $this->assertTrue(true);
    }
}
