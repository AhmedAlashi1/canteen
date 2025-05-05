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
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('school_product_id')->nullable();
            $table->integer('quantity');
            $table->unsignedBigInteger('product_size_id');
            $table->string('type');
             $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
             $table->foreign('product_id')->references('id')->on('products');
             $table->foreign('school_product_id')->references('id')->on('school_products');
             $table->foreign('product_size_id')->references('id')->on('product_sizes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
