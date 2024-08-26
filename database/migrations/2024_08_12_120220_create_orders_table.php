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
            $table->enum('order_status',['Pending','Deliverd','Out of delivery','Canceled','Accepted'])->default('Pending');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('campaign_id')->references('id')->on('campaigns')->nullable();
            $table->decimal('cargo_price');
            $table->decimal('total_price');
            $table->decimal('discount_price');
            $table->timestamps();

        });
        Schema::table('orders', function (Blueprint $table) {
            $table->softDeletes();
         });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::table('orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
