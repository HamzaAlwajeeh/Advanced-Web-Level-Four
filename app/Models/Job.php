<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Job
{
    public static function all(): array
    {
        $jobs = [
            [
                "id" => 0,
                "title" => "مطور تطبيقات موبايل",
                "description" => "تطوير تطبيقات ذكية باستخدام Flutter أو React Native",
                "tasks" => ["تصميم وبناء التطبيقات", "التكامل مع APIs", "اختبار وإصلاح الأخطاء", "متابعة التطويرات الحديثة"],
                "skills" => ["Flutter/Dart أو React Native", "RESTful APIs", "إدارة الحالة (Bloc/Provider)", "Git"],
                "experience" => "خبرة سنة واحدة على الأقل أو مشاريع عملية مثبتة",
                "deadline" => "30-09-2025"
            ],
            [
                "id" => 1,
                "title" => "محلل نظم",
                "description" => "تحليل احتياجات المستخدم وتحويلها إلى حلول تقنية",
                "tasks" => ["جمع وتحليل المتطلبات", "تصميم مخططات النظام", "إعداد وثائق تفصيلية", "اختبار الحلول"],
                "skills" => ["تحليل قوي", "SQL وقواعد البيانات", "UML/ERD", "تواصل فعال"],
                "experience" => "خبرة سنتين في تحليل الأنظمة",
                "deadline" => "15-10-2025"
            ],
            [
                "id" => 2,
                "title" => "مدير مشروع تقني",
                "description" => "إدارة مشاريع تقنية وضمان إنجازها في الوقت المحدد",
                "tasks" => ["إعداد خطة المشاريع", "متابعة سير العمل", "التواصل مع الأطراف", "إدارة المخاطر"],
                "skills" => ["قيادة قوية", "Agile / Scrum", "أدوات إدارة المشاريع (Jira, Trello)", "اتخاذ قرارات سريعة"],
                "experience" => "خبرة 3 سنوات في إدارة المشاريع",
                "deadline" => "10-11-2025"
            ],
            [
                "id" => 3,
                "title" => "مهندس شبكات",
                "description" => "تصميم وإدارة شبكات المؤسسات",
                "tasks" => ["تركيب وصيانة الأجهزة", "مراقبة الأداء", "حل المشكلات", "تطبيق الأمن الشبكي"],
                "skills" => ["TCP/IP", "أجهزة Cisco أو Mikrotik", "CCNA أو Network+", "مهارات تحليلية"],
                "experience" => "خبرة سنة إلى سنتين",
                "deadline" => "20-10-2025"
            ],
            [
                "id" => 4,
                "title" => "محلل بيانات",
                "description" => "تحليل البيانات لتقديم تقارير تدعم القرار",
                "tasks" => ["تنظيف البيانات", "إنشاء Dashboards", "تقارير إحصائية", "دعم الإدارة"],
                "skills" => ["SQL", "Excel / Power BI / Tableau", "Python أو R", "التفكير النقدي"],
                "experience" => "بدون خبرة (يُفضل تدريب أو مشاريع جامعية)",
                "deadline" => "25-09-2025"
            ],
        ];

        return $jobs;
    }

    public static function find($id): array
    {
        $job = Arr::first(Job::all(), fn($jobs) => $jobs['id'] == $id);

        return $job;
    }
}
