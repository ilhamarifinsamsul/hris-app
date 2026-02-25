<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Presence;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\Task;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Employee::count();
        $presence = Presence::count();
        $department = Department::count();
        $payroll = Payroll::count();
        $tasks = Task::all();
        return view('dashboard.index', compact('employee', 'presence', 'department', 'payroll', 'tasks'));
    }
}
