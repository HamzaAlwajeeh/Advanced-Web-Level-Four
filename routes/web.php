<?php

use App\Http\Controllers\TaskController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

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
    $allTasks = FacadesDB::table('tasks')->get();
    // one column of all Records
    $titleRecords = FacadesDB::table('tasks')->get('title'); //as maps
    $titleRecords2 = FacadesDB::table('tasks')->pluck('title'); //as array With out Repeate  => 
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
    $task = FacadesDB::table('tasks')->find('1');
    // get by condition
    $taskCondition = FacadesDB::table('tasks')->where('id', 1)->get();
    $firstTask = FacadesDB::table('tasks')->first()->get();
    return [
        'tasks' => $allTasks,
        'titleRecords' => $titleRecords,
        'titleRecords2' => $titleRecords2,
        'task' => $task,
        'taskCondition' => $taskCondition,
        'firstTask' => $firstTask,
    ];
});
