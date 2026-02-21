@extends('layouts.dashboard')
@section('title', 'Leave Edit')
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
                    <h3>Leave Edit</h3>
                    <p class="text-subtitle text-muted">Handle Leave Information</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leaves</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('leave-requests.update', $leaveRequest->id) }}" class="form-edit" method="POST" action="{{ route('leave-requests.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Employee --}}
                        <div class="form-group">
                            <label for="employee_id" class="form-title">Employee</label>
                            <select class="form-control select2 @error('employee_id') is-invalid @enderror" id="employee_id"
                                name="employee_id" disabled>
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}  "
                                        {{ old('employee_id', $leaveRequest->employee_id) == $employee->id ? 'selected' : '' }}>
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

                        {{-- Leave Type --}}
                        <div class="form-group">
                            <label for="leave_type" class="form-title">Leave Type</label>
                            <select name="leave_type" id="leave_type" class="form-control @error('leave_type') is-invalid @enderror">
                                <option value="">Select Leave Type</option>
                                <option value="Vocation" {{ $leaveRequest->leave_type == 'Vocation' ? 'selected' : '' }}>Vocation</option>
                                <option value="Sick Leave" {{ $leaveRequest->leave_type == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                                <option value="Personal Use" {{ $leaveRequest->leave_type == 'Personal Use' ? 'selected' : '' }}>Personal Use</option>
                                <option value="Birth Leave" {{ $leaveRequest->leave_type == 'Birth Leave' ? 'selected' : '' }}>Birth Leave</option>
                            </select>
                        </div>
                        @error('leave_type')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Start Date --}}
                                <div class="form-group">
                                    <label for="start_date" class="form-title">Start Date</label>
                                    <input type="text" class="form-control date @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date', $leaveRequest->start_date) }}" id="start_date" name="start_date">
                                </div>
                                @error('start_date')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{-- End Date --}}
                                <div class="form-group">
                                    <label for="end_date" class="form-title">End Date</label>
                                    <input type="text" class="form-control date @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date', $leaveRequest->end_date) }}" id="end_date" name="end_date">
                                </div>
                                @error('end_date')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="gap-2 mt-3 d-flex">
                            <a href="{{ route('leave-requests.index') }}" class="btn btn-light">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
