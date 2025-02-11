<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'ecomm_addons',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('slug');
                $table->string('description')->nullable();
                $table->string('version')->nullable();
                $table->string('author')->nullable();
                $table->string('author_email')->nullable();
                $table->string('author_url')->nullable();
                $table->boolean('enabled')->default(false);
                $table->boolean('is_premium')->default(false);
                $table->string('license_key')->nullable();
                $table->string('license_email')->nullable();
                $table->json('metadata')->nullable();
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
        Schema::dropIfExists('ecomm_addons');
    }
};
