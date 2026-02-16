@extends('layouts.dashboard')
@section('title', 'Payroll Create')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Payroll Create</h3>
                    <p class="text-subtitle text-muted">Handle Payroll Information</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payrolls</li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('payrolls.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Employee --}}
                        <div class="form-group">
                            <label for="employee_id" class="form-title">Employee</label>
                            <select class="form-control select2 @error('employee_id') is-invalid @enderror" id="employee_id"
                                name="employee_id">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}  "
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->fullname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('employee_id')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        {{-- salary & bonuses --}}
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Salary --}}
                                <div class="form-group">
                                    <label for="salary" class="form-title">Salary</label>
                                    <input type="number" class="form-control @error('salary') is-invalid @enderror"
                                        value="{{ old('salary') }}" id="salary" name="salary">
                                </div>
                                @error('salary')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{-- Bonuses --}}
                                <div class="form-group">
                                    <label for="bonuses" class="form-title">Bonus</label>
                                    <input type="number" class="form-control @error('bonuses') is-invalid @enderror"
                                        value="{{ old('bonuses') }}" id="bonuses" name="bonuses">
                                </div>
                                @error('bonuses')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- deductions & net salary --}}
                        <div class="row">
                            <div class="col-md-6">
                                {{-- deductions --}}
                                <div class="form-group">
                                    <label for="deductions" class="form-title">Deductions</label>
                                    <input type="number" class="form-control @error('deductions') is-invalid @enderror"
                                        value="{{ old('deductions') }}" id="deductions" name="deductions">
                                </div>
                                @error('deductions')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{-- net salary --}}
                                <div class="form-group">
                                    <label for="net_salary" class="form-title">Net Salary</label>
                                    <input type="number" class="form-control @error('net_salary') is-invalid @enderror"
                                        value="{{ old('net_salary') }}" id="net_salary" name="net_salary" readonly>
                                </div>
                                @error('net_salary')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- pay date --}}
                        <div class="form-group">
                            <label for="pay_date" class="form-title">Pay Date</label>
                            <input type="text" class="form-control date @error('pay_date') is-invalid @enderror"
                                value="{{ old('pay_date') }}" id="pay_date" name="pay_date">
                        </div>
                        @error('pay_date')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <div class="gap-2 mt-3 d-flex">
                            <a href="{{ route('payrolls.index') }}" class="btn btn-light">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
    <script>
        function calculateNetSalary() {
            const salary = parseFloat(document.getElementById('salary').value || 0);
            const bonuses = parseFloat(document.getElementById('bonuses').value || 0);
            const deductions = parseFloat(document.getElementById('deductions').value || 0);

            const netSalary = salary + bonuses - deductions;
            document.getElementById('net_salary').value = netSalary;
        }

        document.getElementById('salary').addEventListener('input', calculateNetSalary);
        document.getElementById('bonuses').addEventListener('input', calculateNetSalary);
        document.getElementById('deductions').addEventListener('input', calculateNetSalary);

        // hitung pertama kali saat halaman load
        calculateNetSalary();
    </script>
@endpush
