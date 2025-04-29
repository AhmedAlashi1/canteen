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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();  // الكود الفريد
            $table->decimal('discount', 8, 2);  // نسبة الخصم
            $table->timestamp('end_at');  // تاريخ انتهاء الكوبون
            $table->integer('use_number')->default(0);  // عدد مرات الاستخدام
            $table->integer('code_limit')->nullable();  // الحد الأقصى لاستخدام الكود
            $table->enum('type', ['percentage', 'fixed']);  // نوع الكوبون (نسبة أو مبلغ ثابت)
            $table->enum('status', ['active', 'inactive'])->default('active');  // حالة الكوبون
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
