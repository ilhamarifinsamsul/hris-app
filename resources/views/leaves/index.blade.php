@extends('layouts.dashboard')
@section('title', 'Leaves')
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
                <h3>Leaves</h3>
                <p class="text-subtitle text-muted">Handle Employee Leaves</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Leaves</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('leave-requests.create') }}" class="btn btn-primary ms-auto mb-3">Add New Leave</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaveRequests as $leave)
                            <tr>
                                <td>{{ $leave->employee->fullname ?? 'N/A'}}</td>
                                <td>{{ $leave->leave_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y')  }}</td>
                                <td>
                                    @if ($leave->status == 'pending')
                                        <span class="badge bg-secondary">{{ ucfirst($leave->status) }}</span>
                                    @elseif ($leave->status == 'approved')
                                        <span class="badge bg-success">{{ ucfirst($leave->status) }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ ucfirst($leave->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="mb-2">
                                        @if ($leave->status !== 'approved')
                                            <a href="{{ route('leave-requests.approve', $leave->id) }}"
                                            class="btn btn-success btn-sm">
                                                <i class="bi bi-check"></i>
                                            </a>
                                        @endif

                                        @if ($leave->status !== 'rejected')
                                            <a href="{{ route('leave-requests.reject', $leave->id) }}"
                                            class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-x"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <a href="{{ route('leave-requests.edit', $leave->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('leave-requests.destroy', $leave->id) }}" method="POST" class="d-inline form-delete" enctype="multipart/form-data">
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
