<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create categories
        //شوكلات
        \App\Models\Category::create([
            'name_ar' => 'شوكلات',
            'name_en' => 'Chocolate',
            'description_ar' => 'شوكلات',
            'description_en' => 'Chocolate',
            'status' => 1,
            'type' => 1,
            'image' => 'images/categories/chocolate.jpg',
        ]);
        // بسكوت
        \App\Models\Category::create([
            'name_ar' => 'بسكوت',
            'name_en' => 'Biscuit',
            'description_ar' => 'بسكوت',
            'description_en' => 'Biscuit',
            'status' => 1,
            'type' => 1,
            'image' => 'images/categories/biscuit.jpg',
        ]);

        // مشروبات
        \App\Models\Category::create([
            'name_ar' => 'مشروبات',
            'name_en' => 'Drinks',
            'description_ar' => 'مشروبات',
            'description_en' => 'Drinks',
            'status' => 1,
            'type' => 1,
            'image' => 'images/categories/drinks.jpg',
        ]);
        // فواكه
        \App\Models\Category::create([
            'name_ar' => 'فواكه',
            'name_en' => 'Fruits',
            'description_ar' => 'فواكه',
            'description_en' => 'Fruits',
            'status' => 1,
            'type' => 1,
            'image' => 'images/categories/fruits.jpg',
        ]);

    }
}
