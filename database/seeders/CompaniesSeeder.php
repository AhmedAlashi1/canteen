<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name_en' =>'Domino`s',
            'image' => 'img/Icon1.svg',
        ]);
        Company::create([
            'name_en' =>'company 2',
            'image' => 'img/Icon2.png',
        ]);

        Company::create([
            'name_en' =>'Go Pro',
            'image' => 'img/Icon3.svg',
        ]);

        Company::create([
            'name_en' =>'Company4',
            'image' => 'img/Icon4.svg',
        ]);



        Company::create([
            'name_en' =>'Go Pro 2',
            'image' => 'img/Icon3.svg',
        ]);
        Company::create([
            'name_en' =>'Belle 2',
            'image' => 'img/Icon5.svg',
        ]);
        Company::create([
            'name_en' =>'ocean 2',
            'image' => 'img/Icon6.svg',
        ]);

        Company::create([
            'name_en' =>'Go Pro3',
            'image' => 'img/Icon3.svg',
        ]);

        Company::create([
            'name_en' =>'company 3',
            'image' => 'img/Icon2.png',
        ]);

    }
}
