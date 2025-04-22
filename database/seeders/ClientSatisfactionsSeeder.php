<?php

namespace Database\Seeders;

use App\Models\Client_Satisfcation;
use App\Traits\ImageTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSatisfactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Client_Satisfcation::create([
            'name_en' => 'Iman Ahmed',
            'name_ar' => 'ايمان أحمد',
            'nick_name_en' => 'Cloudexter',
            'nick_name_ar' => 'كلاودكستر',
            'ranked' => '5',
            'content_en' => 'Experience the high level of satisfaction our clients enjoy after partnering with us. Our dedicated approach ensures we exceed expectations, delivering results that not only meet but often surpass your goals.',
            'content_ar' => 'استمتع بمستوى الرضا العالي الذي يتمتع به عملاؤنا بعد الشراكة معنا. يضمن نهجنا المخصص تجاوزنا للتوقعات، وتقديم نتائج لا تلبي أهدافك فحسب، بل تتجاوزها في كثير من الأحيان.',
            'image' => 'img/person10.svg',
        ]);

        Client_Satisfcation::create([
            'name_en' => 'hoasm',
            'name_ar' => 'حسام',
            'nick_name_en' => 'dev hosam',
            'nick_name_ar' => 'المطور حسام',
            'ranked' => '5',
            'content_en' => 'Experience the high level of satisfaction our clients enjoy after partnering with us. Our dedicated approach ensures we exceed expectations, delivering results that not only meet but often surpass your goals.',
            'content_ar' => 'استمتع بمستوى الرضا العالي الذي يتمتع به عملاؤنا بعد الشراكة معنا. يضمن نهجنا المخصص تجاوزنا للتوقعات، وتقديم نتائج لا تلبي أهدافك فحسب، بل تتجاوزها في كثير من الأحيان.',
            'image' => 'img/hosam.jpeg',
        ]);

    }
}
