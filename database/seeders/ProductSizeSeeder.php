<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    public function run()
    {
        // مثال على إضافة مقاسات لمنتج معين
        $product = Product::first(); // اختيار أول منتج

        ProductSize::create([
            'product_id' => $product->id,
            'size' => 'Small',
            'quantity' => 10,
        ]);

        ProductSize::create([
            'product_id' => $product->id,
            'size' => 'Medium',
            'quantity' => 20,
        ]);

        ProductSize::create([
            'product_id' => $product->id,
            'size' => 'Large',
            'quantity' => 15,
        ]);
    }
}
