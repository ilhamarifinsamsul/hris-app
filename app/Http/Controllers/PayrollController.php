<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::all();

        return view('payrolls.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary' => 'required|numeric|min:0',
            'bonuses' => 'required|numeric|min:0',
            'deductions' => 'required|numeric|min:0',
            'net_salary' => 'required|numeric|min:0',
            'pay_date' => 'required|date',
        ]);
        // menghitung net salary
        $netSalary = $request->input('salary') + $request->input('bonuses') - $request->input('deductions');
        $validated['net_salary'] = $netSalary;
        // simpan data ke database
        Payroll::create($validated);

        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // show slip gaji/payroll
        $payroll = Payroll::findOrFail($id);
        return view('payrolls.show', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payroll = Payroll::findOrFail($id);
        $employees = Employee::all();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi data
        $validated = $request->validate([
            'salary' => 'required|numeric|min:0',
            'bonuses' => 'required|numeric|min:0',
            'deductions' => 'required|numeric|min:0',
            'net_salary' => 'required|numeric|min:0',
            'pay_date' => 'required|date',
        ]);
        // menghitung net salary
        $netSalary = $request->input('salary') + $request->input('bonuses') - $request->input('deductions');
        $validated['net_salary'] = $netSalary;
        // simpan data ke database
        $payroll = Payroll::findOrFail($id);
        $payroll->update($validated);

        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully.');
    }

    // function print slip gaji
    public function print(Payroll $payroll)
    {
        $payroll->load('employee');
        return view('payrolls.print', compact('payroll'));
    }
}
