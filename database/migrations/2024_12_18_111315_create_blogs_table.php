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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            $table->string('title_ar');
            $table->string('title_en');
            $table->text('overview_ar')->nullable();
            $table->text('overview_en')->nullable();
            $table->string('meta_description_ar')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('slug_ar')->nullable();
            $table->string('slug_en')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('tag_ar')->nullable();
            $table->string('tag_en')->nullable();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('photo')->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
