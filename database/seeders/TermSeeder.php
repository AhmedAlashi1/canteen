<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Term::create([
            'service_name_en' => 'Programming Services',
            'desc_en' => 'Custom Software Development: Creation of bespoke software solutions tailored to client specifications, including web applications, desktop software, and mobile apps.',
            'service_name_ar' => 'خدمات البرمجة',
            'desc_ar' => 'تطوير البرمجيات حسب الطلب: إنشاء حلول برمجية مخصصة وفقًا لمواصفات العميل، بما في ذلك تطبيقات الويب وبرامج سطح المكتب وتطبيقات الهاتف المحمول.'
        ]);

        Term::create([
            'service_name_en' => 'Programming Services',
            'desc_en' => 'Website Development: Building and maintaining websites with functionalities ranging from basic informational sites to complex e-commerce platforms.',
            'service_name_ar' => 'خدمات البرمجة',
            'desc_ar' => 'تطوير المواقع: بناء وصيانة المواقع مع وظائف تتراوح من المواقع التعريفية البسيطة إلى منصات التجارة الإلكترونية المعقدة.'
        ]);

        Term::create([
            'service_name_en' => 'Programming Services',
            'desc_en' => 'API Integration: Connecting different software systems to ensure seamless data exchange and functionality.',
            'service_name_ar' => 'خدمات البرمجة',
            'desc_ar' => 'تكامل API: ربط أنظمة البرمجيات المختلفة لضمان تبادل البيانات بسلاسة وتوفير وظائف متكاملة.'
        ]);

        Term::create([
            'service_name_en' => 'Programming Services',
            'desc_en' => 'Software Maintenance and Support: Ongoing support and updates for existing software to ensure it remains functional and up-to-date.',
            'service_name_ar' => 'خدمات البرمجة',
            'desc_ar' => 'صيانة ودعم البرمجيات: دعم وتحديث مستمر للبرمجيات الحالية لضمان بقائها فعّالة ومحدثة.'
        ]);

        Term::create([
            'service_name_en' => 'Design Services',
            'desc_en' => 'Graphic Design: Development of visual content including logos, brochures, flyers, and other marketing materials.',
            'service_name_ar' => 'خدمات التصميم',
            'desc_ar' => 'التصميم الجرافيكي: تطوير محتوى مرئي يشمل الشعارات، الكتيبات، المنشورات، ومواد التسويق الأخرى.'
        ]);

        Term::create([
            'service_name_en' => 'Design Services',
            'desc_en' => 'UI/UX Design: Designing user interfaces and user experiences for websites and applications to enhance usability and engagement.',
            'service_name_ar' => 'خدمات التصميم',
            'desc_ar' => 'تصميم واجهات وتجربة المستخدم: تصميم واجهات وتجارب المستخدم للمواقع والتطبيقات لتحسين سهولة الاستخدام وزيادة التفاعل.'
        ]);

        Term::create([
            'service_name_en' => 'Design Services',
            'desc_en' => 'Brand Identity Design: Creating cohesive brand elements such as logos, color schemes, and typography to establish a strong brand presence.',
            'service_name_ar' => 'خدمات التصميم',
            'desc_ar' => 'تصميم هوية العلامة التجارية: إنشاء عناصر متناسقة للعلامة التجارية مثل الشعارات، الألوان، والخطوط لتأسيس حضور قوي للعلامة التجارية.'
        ]);

        Term::create([
            'service_name_en' => 'Design Services',
            'desc_en' => 'Print Design: Designing materials for print, such as business cards, posters, and packaging.',
            'service_name_ar' => 'خدمات التصميم',
            'desc_ar' => 'تصميم الطباعة: تصميم مواد للطباعة، مثل بطاقات العمل، الملصقات، والتغليف.'
        ]);

        Term::create([
            'service_name_en' => 'Marketing Services',
            'desc_en' => 'Digital Marketing: Strategies and execution for online marketing including search engine optimization (SEO), pay-per-click (PPC) advertising, and social media marketing.',
            'service_name_ar' => 'خدمات التسويق',
            'desc_ar' => 'التسويق الرقمي: استراتيجيات وتنفيذ للتسويق عبر الإنترنت بما في ذلك تحسين محركات البحث، الإعلانات بالنقرة، وتسويق وسائل التواصل الاجتماعي.'
        ]);

        Term::create([
            'service_name_en' => 'Marketing Services',
            'desc_en' => 'Content Marketing: Development and promotion of content to attract and engage target audiences, including blog posts, articles, and video content.',
            'service_name_ar' => 'خدمات التسويق',
            'desc_ar' => 'التسويق بالمحتوى: تطوير وترويج المحتوى لجذب وتفاعل الجمهور المستهدف، بما في ذلك المدونات، المقالات، ومحتوى الفيديو.'
        ]);

        Term::create([
            'service_name_en' => 'Marketing Services',
            'desc_en' => 'Email Marketing: Designing and managing email campaigns to nurture leads and engage with customers.',
            'service_name_ar' => 'خدمات التسويق',
            'desc_ar' => 'التسويق عبر البريد الإلكتروني: تصميم وإدارة حملات البريد الإلكتروني لتطوير العملاء المحتملين والتفاعل مع العملاء.'
        ]);

        Term::create([
            'service_name_en' => 'Marketing Services',
            'desc_en' => 'Market Research and Analysis: Conducting research to understand market trends, customer preferences, and competitive landscape to inform marketing strategies.',
            'service_name_ar' => 'خدمات التسويق',
            'desc_ar' => 'أبحاث وتحليل السوق: إجراء أبحاث لفهم اتجاهات السوق وتفضيلات العملاء والمشهد التنافسي لإثراء استراتيجيات التسويق.'
        ]);

        Term::create([
            'service_name_en' => 'Consulting Services',
            'desc_en' => 'Technical Consulting: Providing expert advice on technology choices, software development practices, and IT infrastructure.',
            'service_name_ar' => 'خدمات الاستشارات',
            'desc_ar' => 'الاستشارات التقنية: تقديم المشورة المتخصصة بشأن اختيارات التقنية، وممارسات تطوير البرمجيات، والبنية التحتية لتكنولوجيا المعلومات.'
        ]);

        Term::create([
            'service_name_en' => 'Consulting Services',
            'desc_en' => 'Design Consulting: Offering insights and recommendations on design strategies to improve visual impact and user experience.',
            'service_name_ar' => 'خدمات الاستشارات',
            'desc_ar' => 'الاستشارات التصميمية: تقديم رؤى وتوصيات بشأن استراتيجيات التصميم لتحسين التأثير البصري وتجربة المستخدم.'
        ]);

        Term::create([
            'service_name_en' => 'Consulting Services',
            'desc_en' => 'Marketing Consulting: Advising on marketing strategies, campaign effectiveness, and brand positioning.',
            'service_name_ar' => 'خدمات الاستشارات',
            'desc_ar' => 'الاستشارات التسويقية: تقديم المشورة بشأن استراتيجيات التسويق، فعالية الحملات، ووضع العلامة التجارية.'
        ]);

        Term::create([
            'service_name_en' => 'Additional Services',
            'desc_en' => 'Project Management: Overseeing and managing projects from initiation to completion to ensure timely delivery and adherence to client requirements.',
            'service_name_ar' => 'خدمات إضافية',
            'desc_ar' => 'إدارة المشاريع: الإشراف وإدارة المشاريع من البداية إلى النهاية لضمان التسليم في الوقت المناسب والالتزام بمتطلبات العميل.'
        ]);

        Term::create([
            'service_name_en' => 'Additional Services',
            'desc_en' => 'Training and Workshops: Offering training sessions and workshops on various topics related to programming, design, and marketing to help clients build their own skills.',
            'service_name_ar' => 'خدمات إضافية',
            'desc_ar' => 'التدريب وورش العمل: تقديم جلسات تدريب وورش عمل حول موضوعات مختلفة متعلقة بالبرمجة، التصميم، والتسويق لمساعدة العملاء على بناء مهاراتهم.'
        ]);

    }
}
