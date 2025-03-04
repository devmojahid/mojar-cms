<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'contact_form_contacts',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('email')->index();
                $table->string('subject');
                $table->text('message')->nullable();
                $table->json('metas')->nullable();
                $table->unsignedBigInteger('site_id')->default(0)->index();
                $table->timestamps();
                $table->index(['created_at']);
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
        Schema::dropIfExists('contact_form_contacts');
    }
};
