<?php

use App\Http\Controllers\TaskController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

// this will show all jobs 
Route::get('/new-jobs', [TaskController::class, 'index'])->name('new-jobs');
// this will show one job by id
Route::get('/job-details/{id}', [TaskController::class, 'find'])->name('job-details');
//this will show all users
Route::get('/users', [EmployeeController::class, 'index'])->name('users');






// جلب البيانات من الريكوست
Route::get('/get-name', function (Request $request) {
    // استدعاء قيمة معينة من الريكوست باستخدام PHP العادي
    // dd($_REQUEST['name']); // يعرض عنصر واحد فقط ويتوقف التنفيذ

    // استدعاء البيانات باستخدام كائن Request في Laravel
    $name = $request->input('name'); // جلب قيمة الحقل "name" من الريكوست
    $age = $request->input('age'); // جلب قيمة الحقل "age" من الريكوست
    $all_data = $request->all(); // جلب جميع البيانات القادمة من الريكوست

    return [
        'name' => $name,
        'age' => $age,
        'allData' => $all_data,
    ];
});


// جلب الهيدر من الريكوست
Route::get('/get-headers', function (Request $request) {
    $oneHeader = $request->header('host'); // جلب هيدر محدد بالاسم
    $host = $request->headers->get('host'); // نفس العمل بطريقة أخرى
    $headers = $request->headers->all(); // جلب جميع الهيدرز

    return [
        'oneHeader' => $oneHeader,
        'host' => $host,
        'headers' => $headers
    ];
});


// عمليات القراءة من قاعدة البيانات
Route::get('/get-tasks', function () {
    $allTasks = DB::table('tasks')->get(); // جلب جميع المهام

    $titleRecords = DB::table('tasks')->get('title'); // جلب عمود العناوين فقط
    $titleRecords2 = DB::table('tasks')->pluck('title'); // جلب العناوين كمصفوفة بدون تكرار

    // جلب سجل واحد فقط بالمعرف
    $task = DB::table('tasks')->find('1');

    // جلب بيانات بشرط معين
    $taskCondition = DB::table('tasks')->where('id', 2)->get();
    $taskCondition2 = DB::table('tasks')->where('employee_id', '>', 1)->get();

    $firstTask = DB::table('tasks')->first(); // جلب أول سجل في الجدول
    $orderByAcs = DB::table('tasks')->orderBy('title')->get(); // ترتيب تصاعدي
    $orderByDes = DB::table('tasks')->orderBy('title', 'Desc')->get(); // ترتيب تنازلي

    $lastDeadlineAddedToDB = DB::table('tasks')->latest('deadline')->get(); // أحدث تاريخ نهاية
    $lastIdAddedToDB = DB::table('tasks')->latest('id')->get(); // آخر معرف أضيف للجدول

    $maxElements = DB::table('tasks')->limit(1)->get(); // تحديد عدد النتائج

    return [
        'tasks' => $allTasks,
        'titleRecords' => $titleRecords,
        'titleRecords2' => $titleRecords2,
        'task' => $task,
        'taskCondition' => $taskCondition,
        'taskCondition2' => $taskCondition2,
        'firstTask' => $firstTask,
        'orderByAcs' => $orderByAcs,
        'orderByDes' => $orderByDes,
        'lastDeadlineAddedToDB' => $lastDeadlineAddedToDB,
        'lastIdAddedToDB' => $lastIdAddedToDB,
        'maxElements' => $maxElements,
    ];
});


// إضافة مهمة جديدة للجدول
Route::get('create-task', function () {
    $maxElements = DB::table('tasks')
        ->insert([
            "title" => "مدير قاعده بيانات",
            "description" => "قوي في ادارة قواعج البيانات",
            "tasks" => "\"إعداد خطة المشاريع\", \"متابعة سير العمل\", \"التواصل مع الأطراف\", \"إدارة المخاطر\"",
            "skills" => "\"قيادة قوية\", \"Agile / Scrum\", \"أدوات إدارة المشاريع (Jira, Trello)\", \"اتخاذ قرارات سريعة\"",
            "experience" => "خبرة 3 سنوات في إدارة المشاريع",
            "created_at" => Carbon::now(), // تاريخ الإنشاء الحالي
            "updated_at" => Carbon::now(), // تاريخ التحديث الحالي
            "deadline" => "20-11-2025",
            "employee_id" => 1
        ]);

    return [
        'message' => 'task aded successfully',
    ];
});


// تعديل مهمة موجودة
Route::get('update-task/{id}', function ($id) {
    if (!DB::table('tasks')->find($id)) { // التحقق إذا كانت المهمة موجودة
        return response()->json('Not Found', 200);
    } else {
        DB::table('tasks')
            ->where('id', $id)
            ->update([
                "title" => "بروفشنال قواعد بيانات",
            ]);
        return ['message' => 'Task edited successfully'];
    }
});


// حذف مهمة من الجدول
Route::get('delete-task/{id}', function ($id) {
    DB::table('tasks')->delete($id);
    return [
        'message' => 'task Deleted successfully',
    ];
});


// عمل تصفح للبيانات بالصفحات
Route::get('/paginate', function () {
    $allTasks = DB::table('tasks')->paginate(2); // عرض عنصرين فقط في الصفحة
    return [
        'tasks' => $allTasks
    ];
});

// لإنشاء Seeder: 
// php artisan make:seeder
// لتجربة الأوامر داخل الطرفية: 
// php artisan tinker



//Saturday - 4/10/2025
//--Response--//
/*
== Response Types: ==
[1] String
[2] Array
[3] jsonData
[4] view
[5] response
[6] responseWithHeaders
[7] fileDownLoad
[8] fileDownLoad
[8] redirect
*/

// [1] String
Route::get('/text-response', function () {
    return 'simple text';
});

// [2] Array
Route::get('/array-response', function () {
    return [
        'name' => 'Hamza',
        'age' => 22
    ];
});

// [3] jsonData => you can control of status and headers
Route::get('/jsonData-response', function () {
    return response()->json(['firstName' => 'Hamza', 'lastName' => 'Alwajeeh'], 200,);
});

// [4] view
Route::get('/view-response', function () {
    $user = ['id' => 1, 'name' => 'Hamza', 'age' => 22];
    // return view('home' , compact('user'));
    // return view('home' , ['user' => $user ]);
    return view('home')->with('user', $user);
});

Route::get('/view2-response', function () {
    $user = ['id' => 1, 'name' => 'Hamza', 'age' => 22];

    return response()->view('home', ['user' => $user], 200)
        ->header('Content-Type', 'text/html');
});


// [5] response => for control of status and headers
Route::get('/response-response', function () {
    return response(['firstName' => 'Hamza', 'lastName' => 'Alwajeeh'], 200);
});

// [6] responseWithHeaders => for control of status and headers
// status like this: 200 , 201 ...,400
Route::get('/headers-response', function () {
    return response('Hamza', 200)
        ->header('Content-Type', 'text/plain') // يحدد نوع المحتوى
        ->header('x-Frame-Options', 'DENEY') // يمنع تضمين الصفحه في مشروع اخر
        ->header('Strict-Transport-Security', 'max-age=3176054') //يعطي المستخدم وقت محدد لعرض الصفحه
        ->header('x-Content-Type-Option', 'nosiff') //يحدد لل (اتش تي ام ال) محتوى محدد لعرضه يلتزم فيه
    ;
});

// [7] showfile
Route::get('/showFile-response', function () {
    $path = public_path('files/الفصل الاول.pdf');
    return response()->file($path);
});

// [8] fileDownLoad
Route::get('/downLoadFile-response', function () {
    $path = public_path('files/myFile.pdf');
    return response()->download($path);
});


// [9] redirect
Route::get('/redi', function () {
    return redirect('/home'); //route path
    // return redirect()->route('home'); //route name
    // return redirect()->away('https://www.google.com'); //for url
});

// [9] redirect
Route::get('/back', function () {
    return back(); //back to same page

});

// [9] redirect input
Route::get('/back-input', function () {
    return back()->withInput(); //يرجع لنفس الصفحه مع الاحتفاظ بالمدخلات ان وجدت

});


//The Cookies
Route::get('/cookies-response', function () {
    return response('Hamza', 200)
        ->cookie(
            'session|_id', //Name of Cookie
            'xyz123', //Value of Cookie
            120, //Time of Cookie => وقت بقاء الكوكيز بالدقيقه
            null,
            true,
            true,
            'strict'
        );
});
