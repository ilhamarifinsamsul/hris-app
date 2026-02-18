@extends('layouts.dashboard')
@section('title', 'Payrolls')
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
                <h3>Payrolls</h3>
                <p class="text-subtitle text-muted">Handle Employee Payrolls</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payrolls</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('payrolls.create') }}" class="btn btn-primary ms-auto mb-3">Add New Payroll</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Salary</th>
                            <th>Bonus</th>
                            <th>Dedaction</th>
                            <th>Net Salary</th>
                            <th>Pay Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payrolls as $payroll)
                            <tr>
                                <td>{{ $payroll->employee->fullname ?? 'N/A'}}</td>
                                <td>Rp {{ number_format($payroll->salary ?? 0, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($payroll->bonuses ?? 0, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($payroll->deductions ?? 0, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($payroll->net_salary ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $payroll->pay_date }}</td>
                                <td>
                                    <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm mb-1"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm mb-1"><i class="bi bi-file-earmark-text"></i></a>
                                    <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" class="d-inlin form-delete" enctype="multipart/form-data">
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
