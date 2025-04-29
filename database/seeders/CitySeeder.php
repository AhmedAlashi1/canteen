<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name_ar' => 'الكويت',
            'name_en' => 'Kuwait',
            'image' => null,
            'code' => 'KW',
            'country_code' => '+965',
            'status' => '1',
        ]);
    }
}
