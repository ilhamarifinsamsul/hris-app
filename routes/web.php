<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// route handle status done
Route::get('/tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
// route handle status pending
Route::get('/tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');
// route handle status in_progress
Route::get('/tasks/in_progress/{id}', [TaskController::class, 'in_progress'])->name('tasks.in_progress');
Route::resource('/tasks', TaskController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
