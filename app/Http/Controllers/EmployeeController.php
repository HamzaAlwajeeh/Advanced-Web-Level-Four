<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public static function index()
    {
        $employees = Employee::all();
        return view('HW2.users', compact('employees'));
    }
}

/*******  0ce289b7-7be0-4273-b51d-6c9ae2b0e26c  *******/
