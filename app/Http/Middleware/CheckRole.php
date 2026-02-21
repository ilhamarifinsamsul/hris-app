<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Employee;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // ambil employee id dari yang login
        $employeeId = auth()->user()->employee_id;
        // cek role berdasarkan employee id
        $employee = Employee::find($employeeId);

        $request->session()->put('role', $employee->role->title);
        $request->session()->put('employee_id', $employee->id);

        // jika role tidak sesuai, kembalikan error
        if (! in_array($employee->role->title, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
