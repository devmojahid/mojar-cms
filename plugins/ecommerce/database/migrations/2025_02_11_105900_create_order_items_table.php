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
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('type', 50)->index()->default('product'); // product, course, etc.
            $table->string('thumbnail')->nullable();
            $table->decimal('price', 15);
            $table->decimal('line_price', 15);
            $table->integer('quantity');
            $table->decimal('compare_price', 15)->nullable();
            $table->string('sku_code', 100)->nullable()->index();
            $table->string('barcode', 100)->nullable()->index();
            
            // Generic post reference
            $table->unsignedBigInteger('post_id')->nullable()->index();
            $table->unsignedBigInteger('order_id')->index();
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('set null');
        });

        // Order item metas for extensibility
        Schema::create('order_item_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_item_id')->index();
            $table->string('meta_key', 150)->index();
            $table->text('meta_value')->nullable();
            $table->unique(['order_item_id', 'meta_key']);

            $table->foreign('order_item_id')
                ->references('id')
                ->on('order_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_metas');
        Schema::dropIfExists('order_items');
    }
}
