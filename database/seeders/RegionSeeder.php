<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = City::where('name_ar', 'الكويت')->first();

        if ($city) {
            $regions = [
                ['name_ar' => 'العاصمة', 'name_en' => 'Capital'],
                ['name_ar' => 'حولي', 'name_en' => 'Hawalli'],
                ['name_ar' => 'الفروانية', 'name_en' => 'Farwaniya'],
                ['name_ar' => 'الأحمدي', 'name_en' => 'Ahmadi'],
                ['name_ar' => 'الجهراء', 'name_en' => 'Jahra'],
                ['name_ar' => 'مبارك الكبير', 'name_en' => 'Mubarak Al-Kabeer'],
            ];

            foreach ($regions as $region) {
                Region::create([
                    'city_id' => $city->id,
                    'name_ar' => $region['name_ar'],
                    'name_en' => $region['name_en'],
                    'status' => '1',
                ]);
            }
        }
    }
}
