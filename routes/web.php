<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    DepartmentController,
    EmployeeController,
    LeaveController,
    PayrollController,
    PresenceController,
    RoleController,
    TaskController,
    ProfileController
};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('role:HR,Employee');

    /*
    |--------------------------------------------------------------------------
    | HR ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:HR')->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('roles', RoleController::class);

        Route::patch('leave-requests/{id}/approve', [LeaveController::class, 'approve'])
            ->name('leave-requests.approve');

        Route::patch('leave-requests/{id}/reject', [LeaveController::class, 'reject'])
            ->name('leave-requests.reject');
    });

    /*
    |--------------------------------------------------------------------------
    | HR & Employee
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:HR,Employee')->group(function () {

        Route::resource('presences', PresenceController::class);
        Route::resource('payrolls', PayrollController::class);
        Route::resource('leave-requests', LeaveController::class);
        Route::resource('tasks', TaskController::class);

        Route::get('payrolls/{payroll}/print', [PayrollController::class, 'print'])
            ->name('payrolls.print');

        Route::patch('tasks/{id}/done', [TaskController::class, 'done'])
            ->name('tasks.done');

        Route::patch('tasks/{id}/pending', [TaskController::class, 'pending'])
            ->name('tasks.pending');

        Route::patch('tasks/{id}/in-progress', [TaskController::class, 'in_progress'])
            ->name('tasks.in_progress');
    });

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';
