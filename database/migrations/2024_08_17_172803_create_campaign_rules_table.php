<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('campaign_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id')->references('id')->on('campaigns')->nullable();
            $table->integer('author_id')->references('id')->on('authors')->nullable();
            $table->integer('category_id')->references('id')->on('categories')->nullable();
            $table->enum('campaign_type', ['buy_2_pay_1', 'author_type_discount', 'percentage_discount']);
            $table->enum('author_type', ['Local', 'Foreign'])->nullable();
            $table->enum('discount_type',['Free','Percentage']);
            $table->decimal('discount_value', 5, 2)->nullable();
            $table->decimal('min_total_price', 10, 2)->nullable();
            $table->timestamps();
        });
        Schema::table('campaign_rules', function (Blueprint $table) {
            $table->softDeletes();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns_rules');
        Schema::table('campaigns_rules', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
