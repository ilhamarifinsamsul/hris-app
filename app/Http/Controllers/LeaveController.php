<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveRequests = LeaveRequest::all();
        return view('leaves.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('leaves.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // status
        $validated['status'] = 'pending';

        // simpan data ke database
        LeaveRequest::create($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $employees = Employee::all();

        return view('leaves.edit', compact('leaveRequest', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi data
        $validated = $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // status
        $validated['status'] = 'pending';

        // simpan data ke database
        LeaveRequest::findOrFail($id)->update($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully.');
    }

    // leave request approve
    public function approve(int $id)
    {
        // update status
        LeaveRequest::findOrFail($id)->update(['status' => 'approved']);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request approved successfully.');
    }
    // leave request reject
    public function reject(int $id)
    {
        // update status
        LeaveRequest::findOrFail($id)->update(['status' => 'rejected']);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request rejected successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete data
        LeaveRequest::findOrFail($id)->delete();
        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully.');
    }
}
