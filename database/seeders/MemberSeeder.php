<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'name_en'=>'Ezaden Herzallah',
            'name_ar'=>'عز الدين حرزالله',
            'job_name_en'=>'UI UX',
            'job_name_ar'=>'واجهة المستخدم وتجربة المستخدم',
            'image'=>'img/Leader1.svg',
        ]);
        Member::create([
            'name_en'=>'Tariq Khanfar',
            'name_ar'=>'طارق خنفر',
            'job_name_en'=>'CTO',
            'job_name_ar'=>'مدير التكنولوجيا التنفيذي',
            'image'=>'img/Leader2.svg',
        ]);
        Member::create([
            'name_en'=>'Anas Muhammad',
            'name_ar'=>'أنس محمد',
            'job_name_en'=>'CEO',
            'job_name_ar'=>'المدير التنفيذي',
            'image'=>'img/Leader3.svg',
        ]);
        Member::create([
            'name_en'=>'Dianne Russell',
            'name_ar'=>'ديان راسل',
            'job_name_en'=>'Digital Marketing',
            'job_name_ar'=>'التسويق الرقمي',
            'image'=>'img/Leader4.svg',
        ]);
        Member::create([
            'name_en'=>'Leslie Alexander',
            'name_ar'=>'ليزلي الكسندر',
            'job_name_en'=>'Website Design',
            'job_name_ar'=>'تصميم المواقع',
            'image'=>'img/Leader5.svg',
        ]);
        Member::create([
            'name_en'=>'Esther Howard',
            'name_ar'=>'إستر هوارد',
            'job_name_en'=>'Mobile App Design',
            'job_name_ar'=>'تصميم تطبيقات الهاتف المحمول',
            'image'=>'img/Leader6.svg',
        ]);
    }
}
