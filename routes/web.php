<?php

use App\Http\Controllers\TaskController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;

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

Route::get('/new-jobs', [TaskController::class, 'index'])->name('new-jobs');
Route::get('/job-details/{id}', [TaskController::class, 'find'])->name('job-details');

Route::get('/users', [EmployeeController::class, 'index'])->name('users');



//  public static function all(): array
//     {
//         $jobs = [
//             [
//                 "id" => 0,
//                 "title" => ",
//                 "description" => "",
//                 "tasks" => [],
//                 "skills" => ["],
//                 "experience" => ",
//                 "deadline" => ""
//             ],
//             [
//                 "id" => 1,
//                 "title" => ",
//                 "description" => "",
//                 "tasks" => [],
//                 "skills" => [],
//                 "experience" => ,
//                 "deadline" => ""
//             ],
//             [
//                 "id" => 2,
//                 "title" => "مدير مشروع تقني",
//                 "description" => "إدارة مشاريع تقنية وضمان إنجازها في الوقت المحدد",
//                 "tasks" => ["إعداد خطة المشاريع", "متابعة سير العمل", "التواصل مع الأطراف", "إدارة المخاطر"],
//                 "skills" => [],
//                 "experience" => ",
//                 "deadline" => ""
//             ],
//             [
//                 "id" => 3,
//                 "title" => ",
//                 "description" => ",
//                 "tasks" => [],
//                 "skills" => ["],
//                 "experience" => ",
//                 "deadline" => ""
//             ],
//             [
//                 "id" => 4,
//                 "title" => "محلل بيانات",
//                 "description" => "تحليل البيانات لتقديم تقارير تدعم القرار",
//                 "tasks" => ["تنظيف البيانات", "إنشاء Dashboards", "تقارير إحصائية", "دعم الإدارة"],
//                 "skills" => ["SQL", "Excel / Power BI / Tableau", "Python أو R", "التفكير النقدي"],
//                 "experience" => "بدون خبرة (يُفضل تدريب أو مشاريع جامعية)",
//                 "deadline" => "25-09-2025"
//             ],
//         ];

//         return $jobs;
//     }

//     public static function find($id): array
//     {
//         $job = Arr::first(Job::all(), fn($jobs) => $jobs['id'] == $id);
//         if (!$job) {
//             abort(404);
//         }
//         return $job;
//     }
