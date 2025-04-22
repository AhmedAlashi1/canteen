<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $work = Work::create([
            'title_en' => 'Z - Aura Perfume Website Design',
            'title_ar' => 'تصميم موقع عطر ز - أورا',
            'service_id' => 2,
            'is_contact_us' => '1',
            'status' => '1',
        ]);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);

        $work = Work::create([
            'title_en' => 'Forhelp Charity Website Design',
            'title_ar' => 'تصميم موقع مؤسسة فورهيلب الخيرية',
            'service_id' => 2,
            'is_contact_us' => '1',
            'status' => '1',
        ]);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);

        $work = Work::create([
            'title_en' => 'Skill Bridge Website Design',
            'title_ar' => 'تصميم موقع سكِل بريدج',
            'service_id' => 2,
            'is_contact_us' => '1',
            'status' => '1',
        ]);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);

// Repeating entries with Arabic titles
        $work = Work::create([
            'title_en' => 'Z - Aura Perfume Website Design',
            'title_ar' => 'تصميم موقع عطر ز - أورا',
            'service_id' => 2,
            'is_contact_us' => '1',
            'status' => '1',
        ]);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image1.svg']);

        $work = Work::create([
            'title_en' => 'Forhelp Charity Website Design',
            'title_ar' => 'تصميم موقع مؤسسة فورهيلب الخيرية',
            'service_id' => 2,
            'is_contact_us' => '1',
            'status' => '1',
        ]);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image2.svg']);

        $work = Work::create([
            'title_en' => 'Skill Bridge Website Design',
            'title_ar' => 'تصميم موقع سكِل بريدج',
            'service_id' => 2,
            'is_contact_us' => '1',
            'status' => '1',
        ]);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);
        Image::create(['work_id' => $work->id, 'image' => 'img/Image3.svg']);
    }
}
