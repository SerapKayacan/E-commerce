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

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_name');
            $table->integer('product_id')->references('id')->on('products');
            $table->timestamps();
        });
        Schema::table('product_images', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
