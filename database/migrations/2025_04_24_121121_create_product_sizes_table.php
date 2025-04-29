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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // ارتباط بالمنتجات
            $table->string('size');  // حجم المنتج (مثال: صغير، متوسط، كبير)
            $table->integer('quantity')->nullable(); // الكمية الخاصة بهذا الحجم
            $table->decimal('price', 10, 2)->default(0); // سعر المنتج لهذا الحجم
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
