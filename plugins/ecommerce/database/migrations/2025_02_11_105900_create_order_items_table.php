<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'ecomm_order_items',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->string('thumbnail')->nullable();
                $table->decimal('price', 15);
                $table->decimal('line_price', 15);
                $table->integer('quantity');
                $table->decimal('compare_price', 15)->nullable();
                $table->string('sku_code', 100)->nullable()->index();
                $table->string('barcode', 100)->nullable()->index();
                $table->unsignedBigInteger('order_id')->index();
                $table->unsignedBigInteger('product_id')->nullable()->index();
                $table->timestamps();

                $table->foreign('order_id')
                    ->references('id')
                    ->on('ecomm_orders')
                    ->onDelete('cascade');

                $table->foreign('product_id')
                    ->references('id')
                    ->on('posts')
                    ->onDelete('set null');
                                
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
        Schema::dropIfExists('ecomm_order_items');
    }
}
