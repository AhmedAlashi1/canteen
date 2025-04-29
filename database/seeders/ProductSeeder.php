<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create products
        \App\Models\Product::create([
            'cat_id' => 1,
            'name_ar' => 'شوكولاتة',
            'name_en' => 'Chocolate',
            'description_ar' => 'شوكولاتة لذيذة',
            'description_en' => 'Delicious chocolate',
            'image' => 'images/products/chocolate.jpg',
            'status' => 1,
            'school_id' => null,
            'price' => 10.00,
            'type' => 1,
            'supplier_id' => null,
            'quantity' => 100,
        ]);

        \App\Models\Product::create([
            'cat_id' => 2,
            'name_ar' => 'بسكويت',
            'name_en' => 'Biscuit',
            'description_ar' => 'بسكويت لذيذ',
            'description_en' => 'Delicious biscuit',
            'image' => 'images/products/biscuit.jpg',
            'status' => 1,
            'school_id' => null,
            'price' => 5.00,
            'type' => 1,
            'supplier_id' => null,
            'quantity' => 50,
        ]);

        \App\Models\Product::create([
            'cat_id' => 3,
            'name_ar' => 'مشروب غازي',
            'name_en' => 'Soda',
            'description_ar' => 'مشروب غازي منعش',
            'description_en' => 'Refreshing soda',
            'image' => 'images/products/soda.jpg',
            'status' => 1,
            'school_id' => null,
            'price' => 3.00,
            'type' => 1,
            'supplier_id' => null,
            'quantity' => 200,
        ]);
        \App\Models\Product::create([
            'cat_id' => 4,
            'name_ar' => 'فواكه',
            'name_en' => 'Fruits',
            'description_ar' => 'فواكه طازجة',
            'description_en' => 'Fresh fruits',
            'image' => 'images/products/fruits.jpg',
            'status' => 1,
            'school_id' => null,
            'price' => 2.00,
            'type' => 1,
            'supplier_id' => null,
            'quantity' => 150,
        ]);

        //SchoolProduct
        $school = School::first();
        \App\Models\SchoolProduct::create([
            'product_id' => 1,
            'school_id' => $school->id,
            'price' => 10.00,
            'quantity' => 100,
        ]);
        \App\Models\SchoolProduct::create([
            'product_id' => 2,
            'school_id' => $school->id,
            'price' => 5.00,
            'quantity' => 50,
        ]);
        \App\Models\SchoolProduct::create([
            'product_id' => 3,
            'school_id' => $school->id,
            'price' => 3.00,
            'quantity' => 200,
        ]);
        \App\Models\SchoolProduct::create([
            'product_id' => 4,
            'school_id' => $school->id,
            'price' => 2.00,
            'quantity' => 150,
        ]);
    }
}
