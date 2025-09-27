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

Route::get('/get-name', function (Request $request) {
    // php Request
    // dd($_REQUEST['name']); // يعطيني عنصر واحد فقط
    // Laravel Request Object
    $name = $request->input('name'); // يعطيني عنصر واحد فقط
    $age = $request->input('age'); // يعطيني عنصر واحد فقط
    $all_data = $request->all(); // يعطيني كل العناصر
    return [
        'name' => $name,
        'age' => $age,
        'allData' => $all_data,
    ];
});



Route::get('/get-headers', function (Request $request) {
    // get one header
    $oneHeader = $request->header('host');
    $host = $request->headers->get('host');
    // get All Headers
    $headers = $request->headers->all();
    return [
        'oneHeader' => $oneHeader,
        'host' => $host,
        'headers' => $headers
    ];
});


Route::get('/get-tasks', function () {
    // Use DB لعمليات الداتا بيز
    // get all
    $allTasks = DB::table('tasks')->get();
    // one column of all Records
    $titleRecords = DB::table('tasks')->get('title'); //as maps
    $titleRecords2 = DB::table('tasks')->pluck('title'); //as array With out Repeate  => 
    /*
        "title" : "programmer,
        "salary" : 5000,
        --
        "title" : "Desiner,
        "salary" : 6000,
        --
        "title" : "Teacher,
        "salary" : 6000,
        --
        $titleRecords2 = FacadesDB::table('tasks')->pluck('title' , 'salary');
        => 
        [
            'programmer' , 5000, 
            'Designer' , 6000,
            'Teacher' ,  6000
        ]
        -------------
        $titleRecords2 = FacadesDB::table('tasks')->pluck('salary' , 'title');
        => 
        [
            '5000' , "Programmer", 
            '6000' , "Designer",
            -----Teacher' ,  6000--- Does not show it cus is repeated
        ]


    */
    // get one record
    $task = DB::table('tasks')->find('1');
    // get by condition
    $taskCondition = DB::table('tasks')->where('id', 2)->get();
    $taskCondition2 = DB::table('tasks')->where('employee_id', '>', 1)->get();
    $firstTask = DB::table('tasks')->first();
    $orderByAcs = DB::table('tasks')->orderBy('title')->get();
    $orderByDes = DB::table('tasks')->orderBy('title', 'Desc')->get();
    $lastDeadlineAddedToDB = DB::table('tasks')->latest('deadline')->get();
    $lastIdAddedToDB = DB::table('tasks')->latest('id')->get();
    $maxElements = DB::table('tasks')
        ->limit(1)
        ->get();

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


// insert 

Route::get('create-task', function () {
    $maxElements = DB::table('tasks')
        ->insert([
            "title" => "مدير قاعده بيانات",
            "description" => "قوي في ادارة قواعج البيانات",
            "tasks" => "\"إعداد خطة المشاريع\", \"متابعة سير العمل\", \"التواصل مع الأطراف\", \"إدارة المخاطر\"",
            "skills" => "\"قيادة قوية\", \"Agile / Scrum\", \"أدوات إدارة المشاريع (Jira, Trello)\", \"اتخاذ قرارات سريعة\"",
            "experience" => "خبرة 3 سنوات في إدارة المشاريع",
            "created_at" => Carbon::now(), // تعطينا التاريخ الان
            "updated_at" => Carbon::now(),
            "deadline" => "20-11-2025",
            "employee_id" => 1
        ]);

    return [
        'message' => 'task aded successfully',
    ];
});

// update values
Route::get('update-task/{id}', function ($id) {
    if (!DB::table('tasks')->find($id)) {
        return response()->json('Not Found', 200);
    } else {
        DB::table('tasks')
            ->where('id', $id)
            ->update([
                "title" => "بروفشنال قواعد بيانات",
            ]);
        return ['message' => 'Task edited successfully'];
    }

    // return back(); //ترجعنا للصفحه الذي كنا فيها سابا
});


Route::get('delete-task/{id}', function ($id) {
    DB::table('tasks')->delete($id);

    return [
        'message' => 'task Deleted successfully',
    ];
});


// عشان تكتب اكواد بي اتش بي في الترمنال تكتب 
// php artisan tinker


Route::get('/paginate', function () {
    $allTasks = DB::table('tasks')->paginate(2);
    return [
        'tasks' => $allTasks
    ];
});
