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
        Schema::create('school_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->decimal('price', 10, 2);  // يمكن تغيير 10, 2 بناءً على كيفية تخزين الأسعار
            $table->integer('quantity')->nullable();  // الكمية يمكن أن تكون فارغة
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');  // المورد يمكن أن يكون فارغ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_products');
    }
};
