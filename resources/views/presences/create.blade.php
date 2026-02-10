@extends('layouts.dashboard')
@section('title', 'Presence Create')
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
                    <h3>Presence Create</h3>
                    <p class="text-subtitle text-muted">Handle Presence Information</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Presences</li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('presences.store') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="col-md-6">
                                {{-- CheckIn --}}
                                <div class="form-group">
                                    <label for="check_in" class="form-title">Check In</label>
                                    <input type="text" class="form-control datetime @error('check_in') is-invalid @enderror"
                                        value="{{ old('check_in') }}" id="check_in" name="check_in">
                                </div>
                                @error('check_in')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{-- CheckOut --}}
                                <div class="form-group">
                                    <label for="check_out" class="form-title">Check Out</label>
                                    <input type="text" class="form-control datetime @error('check_out') is-invalid @enderror"
                                        value="{{ old('check_out') }}" id="check_out" name="check_out">
                                </div>
                                @error('check_out')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        {{-- date --}}
                        <div class="form-group">
                            <label for="date" class="form-title">Date</label>
                            <input type="text" class="form-control date @error('date') is-invalid @enderror"
                                value="{{ old('date') }}" id="date" name="date">
                        </div>
                        @error('date')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                        {{-- status --}}
                        <div class="form-group">
                            <label for="status" class="form-title">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status">
                                <option value="">Select Status</option>
                                <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                <option value="leave" {{ old('status') == 'leave' ? 'selected' : '' }}>Leave</option>
                            </select>
                        </div>
                        @error('status')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror

                        <div class="gap-2 mt-3 d-flex">
                            <a href="{{ route('presences.index') }}" class="btn btn-light">
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
