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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('meta_description_ar')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->bigInteger('price')->default(1);
            $table->bigInteger('price1')->default(1);
            $table->bigInteger('tax')->default(0);

            $table->string('slug_ar')->nullable();
            $table->string('slug_en')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('overview_ar')->nullable();
            $table->text('overview_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('photo')->nullable();
            $table->string('video')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
