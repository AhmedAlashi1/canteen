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
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'whatsApp',
            'title_en'=>'whatsApp number',
            'title_ar'=>'رقم الواتس',
            'value' => '',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'facebook',
            'title_en'=>'facebook url',
            'title_ar'=>'رابط فيسبوك',
            'value' => 'https://www.facebook.com/',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'Linkedin',
            'title_en'=>'Linkedin url',
            'title_ar'=>'رابط لينكدان',
            'value' => 'https://www.Linkedin.com/',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'twitter',
            'title_en'=>'X url',
            'title_ar'=>'رابط اكس',
            'value' => 'https://www.twitter.com/',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'youtube',
            'title_en'=>'YouTube url',
            'title_ar'=>'رابط يوتيوب',
            'value' => 'https://www.youtube.com/',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'phone',
            'title_en'=>'phone number',
            'title_ar'=>'رقم التلفون',
            'value' => '+91 98765 43210',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'email_contact',
            'title_en'=>'email contact',
            'title_ar'=>'ايميل التواصل',
            'value' => 'ezaden.herzallah@gmail.com',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'location',
            'title_en'=>'company location',
            'title_ar'=>'موقع الشركة',
            'value' => '20 Al Khail Road,
Business Bay Tower,
Dubai, United Arab Emirates',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);
        Setting::create([
            'key_id' => 'website',
            'title_en'=>'website url',
            'title_ar'=>'رابط الموقع',
            'value' => 'https://Effect.io',
            'set_group' => 'web',
            'type_ar' => 'الاعدادات العامة',
            'type_en' => 'General Settings',
            'is_object' => '1',
        ]);

        // home page
        Setting::create([
            'key_id' => 'main_title_en1',
            'title_en'=>'First Main title english',
            'title_ar'=>' العنوان الرئيسي الأول انجليزي',
            'value' => 'The Leading Digital Company in Innovation 🤗',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'main_title_ar1',
            'title_en'=>'First Main title arabic',
            'title_ar'=>' العنوان الرئيسي الأول عربي',
            'value' => 'الشركة الرقمية الرائدة في الابتكار 🤗',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'main_title_en2',
            'title_en'=>'Second Main title arabic',
            'title_ar'=>' العنوان الرئيسي الثاني عربي',
            'value' => 'Elevating Your Business To New Horizons',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'main_title_ar2',
            'title_en'=>'Third Main title english',
            'title_ar'=>' العنوان الرئيسي الثاني انجليزي',
            'value' => 'رفع أعمالك إلى آفاق جديدة',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'main_title_ar3',
            'title_en'=>'Third Main title arabic',
            'title_ar'=>' العنوان الرئيسي الثالث عربي',
            'value' => 'ابدأ الآن وحقق النجاح الرقمي الذي تستحقه',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'main_title_en3',
            'title_en'=>'Second Main title english',
            'title_ar'=>' العنوان الرئيسي الثالث انجليزي',
            'value' => 'Start Now and Achieve the Digital Success You Deserve',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        // services
        Setting::create([
            'key_id' => 'service_title_ar',
            'title_en'=>'Service title arabic',
            'title_ar'=>'عنوان الخدمات عربي',
            'value' => 'خدمات تقودك نحو أعمال أفضل',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'service_title_en',
            'title_en'=>'Service title english',
            'title_ar'=>'عنوان الخدمات انجليزي',
            'value' => 'Services That Lead The Way To Better Business',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'service_title_desc_ar',
            'title_en'=>'Service description arabic',
            'title_ar'=>'وصف الخدمات عربي',
            'value' => 'نقدم حلولاً شاملة بتصميم مواقع حديث، خدمات برمجية مخصصة، واستراتيجيات تسويق رقمية ديناميكية لرفع مستوى تواجدك على الإنترنت وتعزيز تفاعل العملاء. تعاون معنا لتحقيق نتائج رقمية استثنائية.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'service_title_desc_en',
            'title_en'=>'Service description english',
            'title_ar'=>'وصف الخدمات انجليزي',
            'value' => 'We provide end-to-end solutions with cutting-edge website design, tailored programming services, and dynamic digital marketing strategies to elevate your online presence and drive customer engagement. Partner with us to achieve exceptional digital results.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

//======= company
        Setting::create([
            'key_id' => 'company_title_ar',
            'title_en'=>'Company title arabic',
            'title_ar'=>'عنوان الشركة عربي',
            'value' => 'الشركات التي نعمل معها',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'company_title_en',
            'title_en'=>'Company title english',
            'title_ar'=>'عنوان الشركة انجليزي',
            'value' => 'Companies We Work With',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'company_desc_ar',
            'title_en'=>'Company description arabic',
            'title_ar'=>'وصف الشركة عربي',
            'value' => 'نحن نتعاون بفخر مع الشركات في مختلف الصناعات لتحقيق نتائج استثنائية ودفع النجاح.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'company_desc_en',
            'title_en'=>'Company description arabic',
            'title_ar'=>'وصف الشركة انجليزي',
            'value' => 'We proudly partner with ng companies across various industries to deliver exceptional results and drive success.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        //======= Our process
        Setting::create([
            'key_id' => 'process_title_ar',
            'title_en'=>'Our Process title arabic',
            'title_ar'=>'عنوان نهجنا عربي',
            'value' => 'نهجنا',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'process_title_en',
            'title_en'=>'Our Process title english',
            'title_ar'=>'عنوان نهجنا انجليزي',
            'value' => 'Our Process',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'process_desc_ar',
            'title_en'=>'Our Process description arabic',
            'title_ar'=>'وصف نهجنا عربي',
            'value' => 'نتبع نهجاً سلساً: فهم احتياجاتك، صياغة حلول مخصصة، التنفيذ بدقة، والتحسين المستمر لضمان تحقيق نتائج متميزة.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'process_desc_en',
            'title_en'=>'Our Process description english',
            'title_ar'=>'وصف نهجنا انجليزي',
            'value' => 'We follow a streamlined approach: understanding your needs, crafting customized solutions, executing with precision, and continuously optimizing to ensure outstanding results.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'process_image',
            'title_en'=>'Our Process Image',
            'title_ar'=>' صورة نهجنا',
            'value' => 'img/Photo1.png',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        //======= Our works
        Setting::create([
            'key_id' => 'works_title_ar',
            'title_en'=>'Works title arabic',
            'title_ar'=>'عنوان الأعمال عربي',
            'value' => 'شاهد أعمالنا',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'works_title_en',
            'title_en'=>'Works title english',
            'title_ar'=>'عنوان الأعمال انجليزي',
            'value' => 'See Our Work',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'works_desc_ar',
            'title_en'=>'Works description arabic',
            'title_ar'=>'وصف الأعمال عربي',
            'value' => 'استعرض محفظتنا لمشاهدة مجموعة من مشاريعنا الناجحة ورؤية كيفية تحويل الأفكار إلى نتائج مؤثرة.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'works_desc_en',
            'title_en'=>'Works description english',
            'title_ar'=>'وصف الأعمال انجليزي',
            'value' => 'Explore our portfolio to view a selection of our successful projects and see how we have transformed ideas into impactful results.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        //======= About us
        Setting::create([
            'key_id' => 'about_title_ar',
            'title_en'=>'About Us title arabic',
            'title_ar'=>'عنوان من نحن عربي',
            'value' => 'تصميم وإنشاء من فريق إبداعي مذهل.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'about_title_en',
            'title_en'=>'About Us title english',
            'title_ar'=>'عنوان من نحن انجليزي',
            'value' => 'Designed And Built By An Astonishing Creative Team.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'about_desc_ar',
            'title_en'=>'About Us description arabic',
            'title_ar'=>'وصف من نحن عربي',
            'value' => 'بتصميم وإعداد من فريق إبداعي مذهل، تجمع مشاريعنا بين التصميم المبتكر والتقنية الحديثة. يتم تنفيذ كل حل بعناية فائقة لضمان التميز الجمالي والوظيفي.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'about_desc_en',
            'title_en'=>'About Us description english',
            'title_ar'=>'وصف من نحن انجليزي',
            'value' => 'Designed and built by an astonishing creative team, our projects combine innovative design with cutting-edge technology. Each solution is crafted with meticulous attention to detail, ensuring both aesthetic excellence and functional brilliance.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'about_image',
            'title_en'=>'About Us Image',
            'title_ar'=>' صورة من نحن',
            'value' => 'img/AboutPhoto.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);



         //======= Client Satisfications
         Setting::create([
            'key_id' => 'satisfy_title_ar',
            'title_en'=>'Client Satisfaction title arabic',
            'title_ar'=>'عنوان رضا العملاء عربي',
            'value' => 'تصميم وإنشاء من فريق إبداعي مذهل.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'satisfy_title_en',
            'title_en'=>'Client Satisfaction title english',
            'title_ar'=>'عنوان رضا العملاء انجليزي',
            'value' => 'Meet Client Satisfaction After Working With Us',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image1',
            'title_en'=>'Client Satisfaction First Image',
            'title_ar'=>'رضا العملاء الصورة الأولى',
            'value' => 'img/person1.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image2',
            'title_en'=>'Client Satisfaction Second Image',
            'title_ar'=>'رضا العملاء الصورة القانية',
            'value' => 'img/person2.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image3',
            'title_en'=>'Client Satisfaction Third Image',
            'title_ar'=>'رضا العملاء الصورة الثالثة',
            'value' => 'img/person3.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image4',
            'title_en'=>'Client Satisfaction Forth Image',
            'title_ar'=>'رضا العملاء الصورة الرابعة',
            'value' => 'img/person4.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image5',
            'title_en'=>'Client Satisfaction five Image',
            'title_ar'=>'رضا العملاء الصورة الخامسة',
            'value' => 'img/person5.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image6',
            'title_en'=>'Client Satisfaction six Image',
            'title_ar'=>'رضا العملاء الصورة السادسة',
            'value' => 'img/person6.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image7',
            'title_en'=>'Client Satisfaction seven Image',
            'title_ar'=>'رضا العملاء الصورة السابعة',
            'value' => 'img/person7.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image8',
            'title_en'=>'Client Satisfaction eight Image',
            'title_ar'=>'رضا العملاء الصورة الثامنة',
            'value' => 'img/person8.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([// image
            'key_id' => 'satisfy_image9',
            'title_en'=>'Client Satisfaction nine Image',
            'title_ar'=>'رضا العملاء الصورة التاسعة',
            'value' => 'img/person9.svg',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        //======= Get in Touch (Connect)
        Setting::create([
            'key_id' => 'connect_title_ar',
            'title_en'=>'Get in Touch title arabic',
            'title_ar'=>'عنوان تواصل معنا عربي',
            'value' => 'تواصل معنا',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'connect_title_en',
            'title_en'=>'Get in Touch title english',
            'title_ar'=>'عنوان تواصل معنا انجليزي',
            'value' => 'Get in Touch',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'connect_desc_ar',
            'title_en'=>'Get in Touch description arabic',
            'title_ar'=>'وصف تواصل معنا عربي',
            'value' => 'تواصل مع فريقنا لمناقشة مشروعك، وطرح الأسئلة، أو الحصول على المزيد من المعلومات حول كيفية مساعدتك في تحقيق أهدافك.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'connect_desc_en',
            'title_en'=>'Get in Touch description english',
            'title_ar'=>'وصف تواصل معنا انجليزي',
            'value' => 'Connect with our team to discuss your project, ask questions, or get more information on how we can help you achieve your goals.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        //======= Frequently Asked Questions
        Setting::create([
            'key_id' => 'questions_title_ar',
            'title_en'=>'Questions title arabic',
            'title_ar'=>'عنوان الأسئلة عربي',
            'value' => 'الأسئلة الشائعة',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'questions_title_en',
            'title_en'=>'Questions title english',
            'title_ar'=>'عنوان الأسئلة انجليزي',
            'value' => 'Frequently Asked Questions',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'questions_desc_ar',
            'title_en'=>'Questions description arabic',
            'title_ar'=>'وصف الأسئلة عربي',
            'value' => 'نحن هنا للإجابة على جميع استفساراتك وتوضيح ما نقدمه من خدمات بكل شفافية. سواء كنت تبحث عن تصميم موقع مبتكر، تطوير حلول برمجية مخصصة، أو خدمات مونتاج احترافية، هذا القسم يضم جميع التفاصيل التي تحتاج لمعرفتها. وإذا كانت لديك أي أسئلة إضافية، فريقنا جاهز لدعمك في كل خطوة من خطوات مشروعك.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'questions_desc_en',
            'title_en'=>'Questions description english',
            'title_ar'=>'وصف الأسئلة انجليزي',
            'value' => 'We’re here to answer all your questions and provide complete transparency about our services. Whether you’re looking for innovative web design, customized development solutions, or professional editing services, this section includes all the details you need. If you have any additional questions, our team is ready to support you every step of the way..',
            'set_group' => 'web',
            'type_ar' => 'اعدادات الصفحة الرئيسية',
            'type_en' => 'Home Page Settings',
            'is_object' => '1',
        ]);


        //======= Services Page
        Setting::create([
            'key_id' => 'service_title_ar',
            'title_en'=>'Services title arabic',
            'title_ar'=>'عنوان الخدمات عربي',
            'value' => 'الخدمات التي نقدمها',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الخدمات',
            'type_en' => 'Services Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'service_title_en',
            'title_en'=>'Services title english',
            'title_ar'=>'عنوان الخدمات انجليزي',
            'value' => 'Services We Provide',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الخدمات',
            'type_en' => 'Services Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'service_desc_ar',
            'title_en'=>'Services description arabic',
            'title_ar'=>'وصف الخدمات عربي',
            'value' => 'نقدم مجموعة من الخدمات المتخصصة، بما في ذلك [الخدمات المحددة]، مصممة لتلبية احتياجاتك الفريدة. فريقنا ملتزم بتقديم حلول عالية الجودة ودعم استثنائي لمساعدتك على تحقيق أهدافك بكفاءة.نقدم مجموعة من الخدمات المتخصصة، بما في ذلك [الخدمات المحددة]، مصممة لتلبية احتياجاتك الفريدة. فريقنا ملتزم بتقديم حلول عالية الجودة ودعم استثنائي لمساعدتك على تحقيق أهدافك بكفاءة.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الخدمات',
            'type_en' => 'Services Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'service_desc_en',
            'title_en'=>'Services description english',
            'title_ar'=>'وصف الخدمات انجليزي',
            'value' => 'We offer a range of expert services, including [specific services], designed to meet your unique needs. Our team is committed to delivering high-quality solutions and exceptional support to help you achieve your goals efficiently.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الخدمات',
            'type_en' => 'Services Page Settings',
            'is_object' => '1',
        ]);


        //======= About Us Page
        Setting::create([
            'key_id' => 'about_title1_ar',
            'title_en'=>'About Us First title arabic',
            'title_ar'=>'العنوان الأول من نحن عربي',
            'value' => 'من نحن',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'about_title1_en',
            'title_en'=>'About Us First title english',
            'title_ar'=>'العنوان الأول من نحن انجليزي',
            'value' => 'About Us',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'about_desc1_ar',
            'title_en'=>'About Us First description arabic',
            'title_ar'=>'الوصف الأول من نحن عربي',
            'value' => 'استكشف المحترفين الموهوبين الذين يقودون نجاحنا في Effect بفضل خبراتهم وابتكاراتهم',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'about_desc1_en',
            'title_en'=>'About Us First description english',
            'title_ar'=>'الوصف الأول من نحن انجليزي',
            'value' => 'Explore the talented professionals behind Effect who drive our success with their expertise and innovation',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'about_title2_ar',
            'title_en'=>'About Us second title arabic',
            'title_ar'=>'العنوان الثاني من نحن عربي',
            'value' => 'تعرف على فريقنا الديناميكي',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'about_title2_en',
            'title_en'=>'About Us second title english',
            'title_ar'=>'العنوان الثاني من نحن انجليزي',
            'value' => 'Meet Our Dynamic Team',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'about_desc2_ar',
            'title_en'=>'About Us second description arabic',
            'title_ar'=>'الوصف الثاني من نحن عربي',
            'value' => 'في Effect، يعمل فريقنا من المحترفين المهرة في البرمجة والتصميم والتسويق على دفع عجلة الابتكار والتميز. نتعاون بشكل إبداعي لتحويل الأفكار الطموحة إلى حلول مؤثرة. انضم إلينا وكن جزءًا من مجموعة ديناميكية مكرسة لإحداث الفارق.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'about_desc2_en',
            'title_en'=>'About Us second description english',
            'title_ar'=>'الوصف الثاني من نحن انجليزي',
            'value' => 'At Effect, our team of skilled professionals in programming, design, and marketing drives innovation and excellence. We collaborate creatively to turn ambitious ideas into impactful solutions. Join us and be part of a dynamic group dedicated to making a difference.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'team_title_ar',
            'title_en'=>'Team title arabic',
            'title_ar'=>'عنوان الفريق عربي',
            'value' => 'فريق القيادة لدينا',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'team_title_en',
            'title_en'=>'Team title english',
            'title_ar'=>'عنوان الفريق انجليزي',
            'value' => 'Our Leadership Team',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'team_desc_ar',
            'title_en'=>'Team description arabic',
            'title_ar'=>'وصف الفريق عربي',
            'value' => 'فريق القيادة في Effect يتكون من خبراء رؤيويين يقودون توجهنا الاستراتيجي بالتزام نحو الابتكار والتميز.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'team_desc_en',
            'title_en'=>'Team description english',
            'title_ar'=>'وصف الفريق انجليزي',
            'value' => 'Our leadership team at Effect is composed of visionary experts who guide our strategic direction with a commitment to innovation and excellence.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة من نحن',
            'type_en' => 'About Us Page Settings',
            'is_object' => '1',
        ]);


        //======= Contact Us Page
        Setting::create([
            'key_id' => 'connect_title_ar',
            'title_en'=>'Contact Us title arabic',
            'title_ar'=>'عنوان اتصل بنا عربي',
            'value' => 'تواصل معنا',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة اتصل بنا',
            'type_en' => 'Contact Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'connect_title_en',
            'title_en'=>'Contact Us title english',
            'title_ar'=>'عنوان اتصل بنا انجليزي',
            'value' => 'Get in Touch',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة اتصل بنا',
            'type_en' => 'Contact Us Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'connect_desc_ar',
            'title_en'=>'Contact Us description arabic',
            'title_ar'=>'وصف اتصل بنا عربي',
            'value' => 'تواصل مع فريقنا لمناقشة مشروعك، وطرح الأسئلة، أو الحصول على المزيد من المعلومات حول كيفية مساعدتك في تحقيق أهدافك.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة اتصل بنا',
            'type_en' => 'Contact Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'connect_desc_en',
            'title_en'=>'Contact Us description english',
            'title_ar'=>'وصف اتصل بنا انجليزي',
            'value' => 'Connect with our team to discuss your project, ask questions, or get more information on how we can help you achieve your goals.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة اتصل بنا',
            'type_en' => 'Contact Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'work_title_ar',
            'title_en'=>'Works title arabic',
            'title_ar'=>'عنوان الأعمال عربي',
            'value' => 'شاهد أعمالنا',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة اتصل بنا',
            'type_en' => 'Contact Us Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'work_title_en',
            'title_en'=>'Works title english',
            'title_ar'=>'عنوان الأعمال انجليزي',
            'value' => 'See Our Work',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة اتصل بنا',
            'type_en' => 'Contact Us Page Settings',
            'is_object' => '1',
        ]);


//======= Blogs Page
        Setting::create([
            'key_id' => 'blog_title_ar',
            'title_en'=>'Blogs title arabic',
            'title_ar'=>'عنوان المدونة عربي',
            'value' => 'المدونات',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة المدونة',
            'type_en' => 'Blogs Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'blog_title_en',
            'title_en'=>'Blogs title english',
            'title_ar'=>'عنوان المدونة انجليزي',
            'value' => 'Blogs',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة المدونة',
            'type_en' => 'Blogs Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'blog_desc_ar',
            'title_en'=>'Blogs description arabic',
            'title_ar'=>'وصف المدونة عربي',
            'value' => 'ابقَ على اطلاع بآخر الرؤى والاتجاهات والابتكارات من فريقنا في Effect.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة المدونة',
            'type_en' => 'Blogs Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'blog_desc_en',
            'title_en'=>'Blogs description english',
            'title_ar'=>'وصف المدونة انجليزي',
            'value' => 'Stay updated with the latest insights, trends, and innovations from our team at Effect.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة المدونة',
            'type_en' => 'Blogs Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'blog_video',
            'title_en'=>'featured video on blogs page',
            'title_ar'=>' الفيديو المميز على صفحة المدونات',
            'value' => '',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة المدونة',
            'type_en' => 'Blogs Page Settings',
            'is_object' => '1',
        ]);


//======= Terms & Conditions Page
        Setting::create([
            'key_id' => 'term_title_ar',
            'title_en'=>'Terms & Conditions title arabic',
            'title_ar'=>'عنوان المدونة عربي',
            'value' => 'الشروط والأحكام',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الشروط والأحكام',
            'type_en' => 'Terms & Conditions Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'term_title_en',
            'title_en'=>'Terms & Conditions title english',
            'title_ar'=>'عنوان المدونة انجليزي',
            'value' => 'Terms & Conditions',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الشروط والأحكام',
            'type_en' => 'Terms & Conditions Page Settings',
            'is_object' => '1',
        ]);


        Setting::create([
            'key_id' => 'term_desc_ar',
            'title_en'=>'Terms & Conditions description arabic',
            'title_ar'=>'وصف الشروط والأحكام عربي',
            'value' => 'تقديم الخدمة في المجالات المختلفة.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الشروط والأحكام',
            'type_en' => 'Terms & Conditions Page Settings',
            'is_object' => '1',
        ]);

        Setting::create([
            'key_id' => 'term_desc_en',
            'title_en'=>'Terms & Conditions description english',
            'title_ar'=>'وصف الشروط والأحكام انجليزي',
            'value' => 'Id sagittis bibendum tortor praesent. Sit viverra.',
            'set_group' => 'web',
            'type_ar' => 'اعدادات صفحة الشروط والأحكام',
            'type_en' => 'Terms & Conditions Page Settings',
            'is_object' => '1',
        ]);



    }
}
