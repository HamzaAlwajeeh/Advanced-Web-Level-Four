<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public static function index()
    {
        $jobs = Task::All();
        return view('HW.new_jobs', compact('jobs'));
    }

    public static function find($id)
    {
        $job = Task::find($id);
        if (!$job) {
            abort(404);
        }
        return view(
            'HW.new_jobs',
            compact('job')
        );
    }
}
