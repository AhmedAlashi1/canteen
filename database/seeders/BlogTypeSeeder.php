<?php

namespace Database\Seeders;

use App\Models\Blog_Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog_Type::create([
            'name_en'=>'Technology',
            'name_ar'=>'تكنولوجيا'
        ]);
    }
}
