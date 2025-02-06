<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->unique()->nullable();
            $table->bigInteger('shop_id')->index()->nullable();
            $table->unsignedBigInteger('payment_method_id')->index()->nullable();
            $table->string('transaction_reference')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('method', 50);
            $table->string('agreement_id');

            $table->string('payer_id');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
            $table->string('status')->default('pending'); // 'pending', 'completed', 'failed', etc.
            $table->json('metadata')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('payment_type', 50)->nullable();
            $table->string('error_message')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');


        });
    }
    
    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
}
