<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();


            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreignId('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->string('meeting_id');
            $table->string('topic');
            $table->dateTime('start_at');
            $table->integer('duration')->comment('minutes');
             $table->text('start_url');
            $table->text('join_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
