<?php

use Illuminate\Support\Facades\Route;

class Job
{
    public $title;
    public $description;
    public $tasks;
    public $skills;
    public $experience;
    public $deadline;

    public function __construct($title, $description, $tasks, $skills, $experience, $deadline)
    {
        $this->title = $title;
        $this->description = $description;
        $this->tasks = $tasks;
        $this->skills = $skills;
        $this->experience = $experience;
        $this->deadline = $deadline;
    }
}

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


$jobs1 = [
    [
        'id' => 0,
        'title' => 'مبرمج',
        'salary' => '10000$'
    ],
    [
        'id' => 1,
        'title' => 'مصمم',
        'salary' => '2500$'
    ],
    [
        'id' => 2,
        'title' => 'مسوق',
        'salary' => '5000$'
    ],
];

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/team', function () {
    return view('team');
})->name('team');

Route::get('/projects', function () {
    return view('projects');
})->name('projects');

Route::get('/jobs', function () use ($jobs1) {
    return view('jobs', compact('jobs1'));
})->name('jobs');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/job/{id}', function ($id) use ($jobs1) {
    return view('job', ["job" => $jobs1[$id]]);
})->name('job');

Route::get('/new-jobs', function () use ($jobs) {
    return view('HW.new_jobs', compact('jobs'));
})->name('new-jobs');

Route::get('/job-details/{id}', function ($id) use ($jobs) {
    return view('HW.job_details', ["job" => $jobs[$id]]);
})->name('job-details');
