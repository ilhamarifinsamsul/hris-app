@extends('layouts.dashboard')
@section('title', 'Employees')
@section('content')
{{-- @include('components.alert-success') --}}
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Employees</h3>
                <p class="text-subtitle text-muted">Handle Employee Data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Employees</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary ms-auto mb-3">Add New Employee</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Hire Date</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->fullname }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->hire_date }}</td>
                                <td>{{ $employee->department->description ?? 'N/A' }}</td>
                                <td>{{ $employee->role->title ?? 'N/A' }}</td>
                                <td>
                                    @if ($employee->status == 'active')
                                        <span class="badge bg-success">{{ ucfirst($employee->status) }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ ucfirst($employee->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inlin form-delete" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
