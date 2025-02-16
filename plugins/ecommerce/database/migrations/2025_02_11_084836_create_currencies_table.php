<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'ecomm_currencies',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('code')->nullable();
                $table->string('symbol')->nullable();
                $table->float('exchange_rate')->default(1);
                $table->boolean('is_default')->default(false);
                $table->boolean('is_enabled')->default(true);
                $table->string('name')->nullable();
                $table->string('symbol_position')->nullable();
                $table->string('thousand_separator')->nullable();
                $table->string('decimal_separator')->nullable();
                $table->string('decimal_place')->nullable();
                $table->string('decimal_point')->nullable();
                $table->string('currency_format')->nullable();
                $table->string('custom_price_format')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('ecomm_currencies');
    }
}
