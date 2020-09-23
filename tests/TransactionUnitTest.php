<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Models\User;

class TransactionUnitTest extends TestCase
{
    private $payer;
    private $payee;

    use DatabaseMigrations, DatabaseTransactions;

    public function setUp():void {

        parent::setUp();

        $this->payer = factory(User::class)->create([
            'name' => 'Walter White',
            'document' => '12345678909',
            'email' => 'ww.heisenberg@gmail.com',
            'password' => 'imtheonewhoknocks',
            'type' => 'customer'
        ]);

        $this->payer->account()->create([
            'balance' => 2000
        ]);


        $this->payee = factory(User::class)->create([
            'name' => 'James Mcgill',
            'document' => '48760301000140',
            'email' => 'james@bettercallsaul.com',
            'password' => 'saulgoodman!@',
            'type' => 'shopkeeper'
        ]);

        $this->payee->account()->create([
            'balance' => 2000
        ]);
    }

    public function testInvalidPayerType()
    {
        $response = $this->post('/transaction', [
            'payer' => $this->payee->id,
            'payee' => $this->payer->id,
            'value' => 10
        ]);

        $response->assertResponseStatus(422);
        $response->seeJson([
            "payer" => [
                "Payer must be a customer. Shopkeepers can't make transfers"
            ]
        ]);
    }

    public function testZeroAmountTransactionProvided()
    {
        $response = $this->post('/transaction', [
            'payer' => $this->payer->id,
            'payee' => $this->payee->id,
            'value' => 0
        ]);

        $response->assertResponseStatus(422);
        $response->seeJson([
            "value" => [
                "The value must be at least 0.1."
            ]
        ]);        
    }

    public function testTransactionBetweenSameUsers()
    {
        $response = $this->post('/transaction', [
            'payer' => $this->payer->id,
            'payee' => $this->payer->id,
            'value' => 10
        ]);

        $response->assertResponseStatus(422);
        $response->seeJson([
            "payee" => [
                "The payee and payer must be different."
            ]
        ]);
    }

    public function testCreatTransactionWithValidParams()
    {
        $response = $this->post('/transaction', [
            'payer' => $this->payer->id,
            'payee' => $this->payee->id,
            'value' => 10
        ]);

        $response->assertResponseStatus(200);
    }
}
