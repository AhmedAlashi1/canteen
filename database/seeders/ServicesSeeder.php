<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name_en' => 'Mobile App Design',
            'desc_en' => 'We offer innovative and effective mobile app design services, focusing on engaging user experiences and intuitive interfaces.',
            'name_ar' => 'تصميم تطبيقات الهاتف',
            'desc_ar' => 'نقدم خدمات تصميم تطبيقات الهاتف المبتكرة والفعالة، مع التركيز على تجارب مستخدم ممتعة وواجهات سهلة الاستخدام.',
            'image' => 'img/MobileIcon.svg'
        ]);

        Service::create([
            'name_en' => 'Website Design',
            'desc_en' => 'We offer expert website design services, creating visually appealing and user-friendly websites tailored to your needs.',
            'name_ar' => 'تصميم المواقع',
            'desc_ar' => 'نقدم خدمات تصميم مواقع احترافية، لإنشاء مواقع جذابة وسهلة الاستخدام تناسب احتياجاتك.',
            'image' => 'img/WorldIcon.svg'
        ]);

        Service::create([
            'name_en' => 'Graphic Designing',
            'desc_en' => 'We offer professional graphic design services that include creating visually striking and impactful designs tailored to your brand.',
            'name_ar' => 'التصميم الجرافيكي',
            'desc_ar' => 'نقدم خدمات تصميم جرافيكي احترافية تشمل إنشاء تصاميم لافتة ومؤثرة تناسب علامتك التجارية.',
            'image' => 'img/DesignIcon.svg'
        ]);

        Service::create([
            'name_en' => 'Digital Marketing',
            'desc_en' => 'We deliver targeted digital marketing strategies to boost your online visibility and drive growth.',
            'name_ar' => 'التسويق الرقمي',
            'desc_ar' => 'نقدم استراتيجيات تسويق رقمي مستهدفة لتعزيز ظهورك على الإنترنت ودعم النمو.',
            'image' => 'img/DigitalIcon.svg'
        ]);

    }
}
