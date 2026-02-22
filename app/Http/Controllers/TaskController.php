<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check if user is logged in
        if (session('role') == 'HR' ) {
            // HR role
            $tasks = Task::all();
        } else {
            // employee role
            $tasks = Task::where('assigned_to', auth()->user()->employee_id)->latest()->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('tasks.create', [ 'employees' => $employees ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date',
            'status' => 'required|string'
        ]);
        // jika berhasil divalidasi, simpan data
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // langsung farshing data pake model
    public function edit(Task $task)
    {
        $employees = Employee::all();
        return view('tasks.edit', [ 'task' => $task, 'employees' => $employees ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date',
            'status' => 'required|string'
        ]);
        // jika berhasil divalidasi, simpan data
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // handle mark as done
    public function done(int $id){
        $task = Task::findOrFail($id);
        $task->update(['status' => 'done']);
        return redirect()->route('tasks.index')->with('success', 'Task marked as done.');
    }

    // handle mark as pending
    public function pending(int $id){
        $task = Task::findOrFail($id);
        $task->update(['status' => 'pending']);
        return redirect()->route('tasks.index')->with('success', 'Task marked as pending.');
    }

    // handle mark as in_progress
    public function in_progress(int $id){
        $task = Task::findOrFail($id);
        $task->update(['status' => 'in_progress']);
        return redirect()->route('tasks.index')->with('success', 'Task marked as in progress.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
