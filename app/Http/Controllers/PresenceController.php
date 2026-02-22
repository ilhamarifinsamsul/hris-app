<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check if user is logged in
        if (session('role') == 'HR' ) {
            // HR role
            $presences = Presence::all();
        } else {
            // employee role
            $presences = Presence::where('employee_id', auth()->user()->employee_id)->latest()->get();
        }

        return view('presences.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data role HR
        if (session('role') == 'HR') {
            $validated = $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'check_in' => 'required|date',
                'check_out' => 'required|date',
                'date' => 'required|date',
                'status' => 'required|in:present,absent,leave',
            ]);
            Presence::create($validated);
        } else {
            // validasi data role employee
            Presence::create([
                'employee_id' => session('employee_id'),
                'check_in' => Carbon::now()->format('Y-m-d H:i:s'), // $request->check_in,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date' => Carbon::now()->format('Y-m-d'), // $request->date,
                'status' => 'present',
            ]);
        }
        return redirect()->route('presences.index')->with('success', 'Presence Recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $presence = Presence::findOrFail($id);
        $employees = Employee::all();
        return view('presences.edit', compact('presence', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi data
        $validated = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
        ]);
        Presence::findOrFail($id)->update($validated);
        return redirect()->route('presences.index')->with('success', 'Presence updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Presence::findOrFail($id)->delete();
        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully.');
    }
}
