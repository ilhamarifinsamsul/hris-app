<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Presence;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\Task;


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

    public function presence()
    {
        $data = Presence::where('status', 'present')
                ->selectRaw('MONTH(date) as month, YEAR(date) as year, COUNT(*) as total')
                ->groupBy('month', 'year')
                ->orderBy('year', 'asc')
                ->get();

                $temp = [];
                $i = 0;
                foreach ($data as $item) {
                    $temp[$i] = $item->total;
                    $i++;
                }
        return response()->json($temp);
    }
}
