<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //meta title  and description  ar/en for all page home, about, contact, blogs, terms set_group = wep

        Setting::create([
            'key_id' => 'meta_title_ar_home',
            'title_en'=>'Meta Title Arabic Home Page',
            'title_ar'=>'عنوان الصفحة الرئيسية',
            'value' => 'Effect - تصميم وتطوير مواقع الويب',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_en_home',
            'title_en'=>'Meta Title English Home Page',
            'title_ar'=>'عنوان الصفحة الرئيسية',
            'value' => 'Effect - Web Design & Development',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_ar_home',
            'title_en'=>'Meta Description Arabic Home Page',
            'title_ar'=>'وصف الصفحة الرئيسية',
            'value' => 'Effect هو استوديو تصميم وتطوير مواقع الويب الذي يقدم حلولًا مبتكرة ومخصصة لتحقيق أهدافك الرقمية.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_en_home',
            'title_en'=>'Meta Description English Home Page',
            'title_ar'=>'وصف الصفحة الرئيسية',
            'value' => 'Effect is a web design and development studio that offers innovative, customized solutions to achieve your digital goals.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_ar_about',
            'title_en'=>'Meta Title Arabic About Page',
            'title_ar'=>'عنوان صفحة من نحن',
            'value' => 'Effect - من نحن',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_en_about',
            'title_en'=>'Meta Title English About Page',
            'title_ar'=>'عنوان صفحة من نحن',
            'value' => 'Effect - About Us',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_ar_about',
            'title_en'=>'Meta Description Arabic About Page',
            'title_ar'=>'وصف صفحة من نحن',
            'value' => 'تعرف على Effect، وكيف يمكننا مساعدتك في تحقيق أهدافك الرقمية من خلال حلولنا المبتكرة.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_en_about',
            'title_en'=>'Meta Description English About Page',
            'title_ar'=>'وصف صفحة من نحن',
            'value' => 'Learn about Effect, and how we can help you achieve your digital goals through our innovative solutions.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_ar_contact',
            'title_en'=>'Meta Title Arabic Contact Page',
            'title_ar'=>'عنوان صفحة اتصل بنا',
            'value' => 'Effect - اتصل بنا',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_en_contact',
            'title_en'=>'Meta Title English Contact Page',
            'title_ar'=>'عنوان صفحة اتصل بنا',
            'value' => 'Effect - Contact Us',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_ar_contact',
            'title_en'=>'Meta Description Arabic Contact Page',
            'title_ar'=>'وصف صفحة اتصل بنا',
            'value' => 'تواصل مع فريقنا لمناقشة مشروعك، وطرح الأسئلة، أو الحصول على المزيد من المعلومات حول كيفية مساعدتك في تحقيق أهدافك.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_en_contact',
            'title_en'=>'Meta Description English Contact Page',
            'title_ar'=>'وصف صفحة اتصل بنا',
            'value' => 'Connect with our team to discuss your project, ask questions, or get more information on how we can help you achieve your goals.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_ar_blogs',
            'title_en'=>'Meta Title Arabic Blogs Page',
            'title_ar'=>'عنوان صفحة المدونات',
            'value' => 'Effect - المدونات',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_en_blogs',
            'title_en'=>'Meta Title English Blogs Page',
            'title_ar'=>'عنوان صفحة المدونات',
            'value' => 'Effect - Blogs',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_ar_blogs',
            'title_en'=>'Meta Description Arabic Blogs Page',
            'title_ar'=>'وصف صفحة المدونات',
            'value' => 'ابقَ على اطلاع بآخر الرؤى والاتجاهات والابتكارات من فريقنا في Effect.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_en_blogs',
            'title_en'=>'Meta Description English Blogs Page',
            'title_ar'=>'وصف صفحة المدونات',
            'value' => 'Stay up to date with the latest insights, trends, and innovations from our team at Effect.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_ar_terms',
            'title_en'=>'Meta Title Arabic Terms Page',
            'title_ar'=>'عنوان صفحة الشروط والأحكام',
            'value' => 'Effect - الشروط والأحكام',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_title_en_terms',
            'title_en'=>'Meta Title English Terms Page',
            'title_ar'=>'عنوان صفحة الشروط والأحكام',
            'value' => 'Effect - Terms & Conditions',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_ar_terms',
            'title_en'=>'Meta Description Arabic Terms Page',
            'title_ar'=>'وصف صفحة الشروط والأحكام',
            'value' => 'تعرف على الشروط والأحكام التي تحكم استخدامك لموقعنا وخدماتنا.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'meta_desc_en_terms',
            'title_en'=>'Meta Description English Terms Page',
            'title_ar'=>'وصف صفحة الشروط والأحكام',
            'value' => 'Learn about the terms and conditions that govern your use of our site and services.',
            'set_group' => 'wep',
            'type_ar' => 'ميتا تاج',
            'type_en' => 'Meta Tag',
            'is_object' => '1',
        ]);

        
    }
}
