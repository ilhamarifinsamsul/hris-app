@extends('layouts.dashboard')
@section('title', 'Payrolls Detail')
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
                <h3>Payrolls Detail</h3>
                <p class="text-subtitle text-muted">Handle Employee Payrolls</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payrolls</a></li>
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
                    {{-- Action --}}
                    <div class="mt-4 d-flex gap-2 justify-content-end">
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left me-2"></i>Back</a>
                        <a href="{{ route('payrolls.print', $payroll->id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-printer me-2"></i>Print</a>
                    </div>
                    {{-- Employee --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Employee</div>
                            <div class="fw-semibold">{{ $payroll->employee->fullname }}</div>
                        </div>
                    </div>

                    {{-- Salary --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Salary</div>
                            <div class="fw-normal">
                                Rp. {{ number_format($payroll->salary, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- Bonuses --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Bonus</div>
                            <div class="fw-semibold">Rp. {{ number_format($payroll->bonuses, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    {{-- Deductions --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Deductions</div>
                            <div class="fw-semibold">
                                Rp. {{ number_format($payroll->deductions, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- Net Salary --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Net Salary</div>
                            <div class="fw-semibold">
                                Rp. {{ number_format($payroll->net_salary, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- Pay date --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Pay Date</div>
                            <div class="fw-semibold">
                                {{ \Carbon\Carbon::parse($payroll->pay_date)->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
