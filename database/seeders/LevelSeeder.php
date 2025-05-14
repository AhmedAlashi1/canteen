<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ////primary
        //        //intermediate
        //        //secondary
        $levels = [
            ['name_ar' => 'المرحلة الابتدائية', 'name_en' => 'primary'],
            ['name_ar' => 'المرحلة المتوسطة', 'name_en' => 'intermediate'],
            ['name_ar' => 'المرحلة الثانوية', 'name_en' => 'secondary'],
        ];
        foreach ($levels as $level) {
             Level::create($level);
        }
    }
}
