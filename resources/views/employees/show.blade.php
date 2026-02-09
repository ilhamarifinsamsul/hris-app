@extends('layouts.dashboard')
@section('title', 'Employee Detail')
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
                <h3>Employee Detail</h3>
                <p class="text-subtitle text-muted">Handle Employee Information</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">

                <div class="row g-3">

                    {{-- Fullname --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Full Name</div>
                            <div class="fw-semibold">{{ $employee->fullname }}</div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Email</div>
                            <div class="fw-semibold">{{ $employee->email }}</div>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Phone Number</div>
                            <div class="fw-semibold">{{ $employee->phone_number ?? '-' }}</div>
                        </div>
                    </div>

                    {{-- Birth Date --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Birth Date</div>
                            <div class="fw-semibold">
                                {{ $employee->birth_day ? \Carbon\Carbon::parse($employee->birth_day)->format('d M Y') : '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Hire Date --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Hire Date</div>
                            <div class="fw-semibold">
                                {{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('d M Y') : '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Department</div>
                            <div class="fw-semibold">
                                {{ $employee->department->description ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Role</div>
                            <div class="fw-semibold">
                                {{ $employee->role->title ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Status</div>

                            @if ($employee->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </div>
                    </div>

                    {{-- Salary --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Salary</div>
                            <div class="fw-semibold">
                                Rp {{ number_format($employee->salary ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Address</div>
                            <div class="fw-normal">
                                {{ $employee->address ?? '-' }}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Action --}}
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('employees.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>

                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
