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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('counter1')->default(0);
            $table->integer('counter2')->default(0);
            $table->integer('counter3')->default(0);
            $table->integer('counter4')->default(0);
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('x')->nullable(); // تويتر سابقاً
            $table->string('instagram')->nullable();
            $table->string('name')->nullable();
            $table->string('photo_contact')->nullable();
            $table->string('photo_faq')->nullable();
            $table->string('photo_products')->nullable();
            $table->string('photo_services')->nullable();
            $table->string('photo_about')->nullable();
            $table->string('color')->nullable();
            $table->string('background_color')->nullable();
            $table->string('color_h')->nullable();
            $table->integer('Blogs')->default(1);
            $table->integer('Story')->default(1);
            $table->integer('About')->default(1);
            $table->integer('Services')->default(1);
            $table->integer('Products')->default(1);
            $table->integer('Sessions')->default(1);
            $table->integer('FAQ')->default(1);
            $table->integer('Contact')->default(1);




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
