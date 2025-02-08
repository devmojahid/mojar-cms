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
            'evman_event_bookings',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('event_id');
                $table->unsignedBigInteger('user_id')->nullable();
                // $table->unsignedBigInteger('ticket_id')->nullable();
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('zip')->nullable();
                $table->string('country')->nullable();
                $table->string('status')->default('pending');
                $table->unsignedBigInteger('payment_method_id')->nullable();
                $table->string('payment_status')->nullable();



                $table->foreign('event_id')->references('id')->on('posts')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                // $table->foreign('ticket_id')->references('id')->on('evman_event_tickets')->onDelete('set null');
                $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
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
        Schema::dropIfExists('evman_event_bookings');
    }
};
