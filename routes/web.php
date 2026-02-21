<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// route handle employee
Route::resource('/employees', EmployeeController::class);
// route handle department
Route::resource('/departments', DepartmentController::class);
// route handle role
Route::resource('/roles', RoleController::class);
// route handle presences
Route::resource('/presences', PresenceController::class);
// route handle payrolls
Route::resource('/payrolls', PayrollController::class);
// route handle print payrolls
Route::get('/payrolls/{payroll}/print', [PayrollController::class, 'print'])->name('payrolls.print');
// route handle leaves
Route::resource('/leave-requests', LeaveController::class);
// route handle approve leaves
Route::get('/leave-requests/approve/{id}', [LeaveController::class, 'approve'])->name('leave-requests.approve');
// route handle reject leaves
Route::get('/leave-requests/reject/{id}', [LeaveController::class, 'reject'])->name('leave-requests.reject');

// route handle Task
Route::get('/tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
Route::get('/tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');
Route::get('/tasks/in_progress/{id}', [TaskController::class, 'in_progress'])->name('tasks.in_progress');
Route::resource('/tasks', TaskController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
