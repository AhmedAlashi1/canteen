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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // يربط العنوان بالمستخدم
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('region_id');
            $table->string('location'); // مكان العنوان
            $table->string('block');
            $table->string('street_name');
            $table->string('building_no');
            $table->boolean('is_default')->default(false); // هل العنوان ديفولت
            $table->boolean('is_active')->default(true); // هل العنوان مفعل

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
