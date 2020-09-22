<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('payer');
            $table->unsignedBigInteger('payee');
            $table->decimal('amount', 10, 2);
            $table->enum('status', [
                'processing',
                'canceled',
                'processed',
                'not_authorized'
            ])->default('processing');

            $table->foreign('payer')
            ->references('id')
            ->on('users');

            $table->foreign('payee')
            ->references('id')
            ->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
