<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'ecomm_carts',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid('code');
                $table->json('items')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->decimal('discount', 20, 2)->default(0);
                $table->string('discount_codes', 150)->nullable();
                $table->string('discount_target_type', 50)->nullable();
                $table->unsignedBigInteger('site_id')->default(0)->index();
                $table->timestamps();
                
                $table->unique(['code', 'site_id']);
    
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('ecomm_carts');
    }
};
