<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('token')->unique();
            $table->string('code', 150);
            $table->string('title', 250);  // Like posts table
            $table->string('type', 50)->index()->default('ecommerce'); // For different plugins
            $table->string('status', 50)->index()->default('pending');
            $table->string('payment_status')->default('pending');
            $table->string('delivery_status')->default('pending');
            
            // Customer info
            $table->string('name', 150);
            $table->string('email', 150)->nullable();
            $table->string('phone', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('country_code', 15)->nullable();
            
            // Order details
            $table->integer('quantity');
            $table->decimal('total_price', 20, 2);
            $table->decimal('total', 20, 2);
            $table->decimal('discount', 20, 2)->default(0);
            $table->string('discount_codes', 150)->nullable();
            
            // Payment info
            $table->unsignedBigInteger('payment_method_id')->nullable()->index();
            $table->string('payment_method_name', 250);
            
            // Additional info
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('site_id')->nullable()->index();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
                ->onDelete('set null');
        });

        // Order metas table for extensibility
        Schema::create('order_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index();
            $table->string('meta_key', 150)->index();
            $table->text('meta_value')->nullable();
            $table->unique(['order_id', 'meta_key']);

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('order_metas');
        Schema::dropIfExists('orders');
    }
}
