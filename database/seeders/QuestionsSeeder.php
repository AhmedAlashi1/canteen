<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'question_en' => 'Can you work with clients remotely?',
            'answer_en' => 'Absolutely! I have experience working with clients from all around the world. Through effective communication channels such as email, video calls, and project management tools, I ensure seamless collaboration regardless of geographical location.',
            'question_ar' => 'هل يمكنك العمل مع العملاء عن بُعد؟',
            'answer_ar' => 'بالتأكيد! لدي خبرة في العمل مع عملاء من جميع أنحاء العالم. من خلال قنوات الاتصال الفعّالة مثل البريد الإلكتروني والمكالمات المرئية وأدوات إدارة المشاريع، أضمن تعاونًا سلسًا بغض النظر عن الموقع الجغرافي.'
        ]);

        Question::create([
            'question_en' => 'How long does it typically take to complete a web design project?',
            'answer_en' => 'The time to complete a web design project varies based on its complexity and the specific requirements. Generally, it can range from a few weeks to a few months, depending on the scope and the features needed.',
            'question_ar' => 'كم من الوقت يستغرق عادةً لإكمال مشروع تصميم موقع؟',
            'answer_ar' => 'يختلف الوقت اللازم لإكمال مشروع تصميم الموقع بناءً على تعقيداته والمتطلبات المحددة. عمومًا، قد يستغرق من بضعة أسابيع إلى عدة أشهر حسب النطاق والميزات المطلوبة.'
        ]);

        Question::create([
            'question_en' => 'Do you offer website maintenance services?',
            'answer_en' => 'Yes, I offer ongoing website maintenance services to ensure that your website remains up-to-date, secure, and optimized. This includes regular updates, backups, and performance checks.',
            'question_ar' => 'هل تقدم خدمات صيانة المواقع؟',
            'answer_ar' => 'نعم، أقدم خدمات صيانة مستمرة للمواقع لضمان بقاء موقعك محدثًا وآمنًا ومحسنًا. يتضمن ذلك التحديثات الدورية والنسخ الاحتياطي وفحص الأداء.'
        ]);

        Question::create([
            'question_en' => 'Can you optimize my website for search engines?',
            'answer_en' => 'Yes, I can optimize your website for search engines by implementing best practices like keyword optimization, meta tags, speed improvements, and mobile responsiveness to help improve your website\'s visibility in search results.',
            'question_ar' => 'هل يمكنك تحسين موقعي لمحركات البحث؟',
            'answer_ar' => 'نعم، يمكنني تحسين موقعك لمحركات البحث من خلال تطبيق أفضل الممارسات مثل تحسين الكلمات المفتاحية، وتحديث العلامات الوصفية، وزيادة السرعة، وجعل الموقع متوافقًا مع الأجهزة المحمولة للمساعدة في تحسين ظهوره في نتائج البحث.'
        ]);


    }
}
