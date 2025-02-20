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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->float('subtotal', 8, 2);
            $table->float('discount', 8, 2);
            $table->float('tax', 8, 2);
            $table->float('total', 8, 2);
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
           
            $table->integer('payment')->default(1);
            $table->string('country');
            $table->string('first_name');
            $table->string('last_name');
             $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('email');
            $table->string('phone');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
