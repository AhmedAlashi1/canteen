<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key_id' => 'instagram',
            'title_en'=>'instagram url',
            'title_ar'=>'رابط انستجرام',
            'value' => 'https://www.instagram.com/',
            'set_group' => 'app',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'whatsApp',
            'title_en'=>'whatsApp number',
            'title_ar'=>'رقم الواتس',
            'value' => '96554647655',
            'set_group' => 'app',
            'is_object' => '0',
        ]);
        Setting::create([
            'key_id' => 'facebook',
            'title_en'=>'facebook url',
            'title_ar'=>'رابط فيسبوك',
            'value' => 'https://www.facebook.com/',
            'set_group' => 'app',
            'is_object' => '0',
        ]);
        Setting::create([
            'key_id' => 'Linkedin',
            'title_en'=>'Linkedin url',
            'title_ar'=>'رابط لينكدان',
            'value' => 'https://www.Linkedin.com/',
            'set_group' => 'app',
            'is_object' => '0',
        ]);
        Setting::create([
            'key_id' => 'twitter',
            'title_en'=>'X url',
            'title_ar'=>'رابط اكس',
            'value' => 'https://www.twitter.com/',
            'set_group' => 'app',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'youtube',
            'title_en'=>'YouTube url',
            'title_ar'=>'رابط يوتيوب',
            'value' => 'https://www.youtube.com/',
            'set_group' => 'app',
            'is_object' => '0',
        ]);
        Setting::create([
            'key_id' => 'tiktok',
            'title_en'=>'tiktok url',
            'title_ar'=>'رابط تيك توك',
            'value' => 'https://www.tiktok.com/',
            'set_group' => 'app',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'phone',
            'title_en'=>'phone number',
            'title_ar'=>'رقم التلفون',
            'value' => '96554647655',
            'set_group' => 'app',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'email_contact',
            'title_en'=>'email contact',
            'title_ar'=>'ايميل التواصل',
            'value' => 'admin@admin.com',
            'set_group' => 'app',
            'is_object' => '0',
        ]);
        //Rules&conditions
        Setting::create([
            'key_id' => 'rules_conditions_ar',
            'title_en'=>'rules&conditions',
            'title_ar'=>'قوانين وشروط',
            'value' => 'قوانين وشروط',
            'set_group' => 'app',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'rules_conditions_en',
            'title_en'=>'rules&conditions',
            'title_ar'=>'قوانين وشروط',
            'value' => 'rules&conditions',
            'set_group' => 'app',
            'is_object' => '1',
        ]);
        //privacy policy
        Setting::create([
            'key_id' => 'privacy_policy_ar',
            'title_en'=>'privacy policy',
            'title_ar'=>'سياسة الخصوصية',
            'value' => 'سياسة الخصوصية',
            'set_group' => 'app',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'privacy_policy_en',
            'title_en'=>'privacy policy',
            'title_ar'=>'سياسة الخصوصية',
            'value' => 'privacy policy',
            'set_group' => 'app',
            'is_object' => '1',
        ]);




    }
}
