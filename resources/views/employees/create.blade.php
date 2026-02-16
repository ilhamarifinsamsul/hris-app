@extends('layouts.dashboard')
@section('title', 'Employee Create')
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
                <h3>Employee Create</h3>
                <p class="text-subtitle text-muted">Handle Employee Information</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Employees</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fullname" class="form-title">Full Name</label>
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}" id="fullname" name="fullname" placeholder="Full Name">
                    </div>
                    @error('fullname')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="form-group">
                        <label for="email" class="form-title">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="example@gmail.com">
                    </div>
                    @error('email')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="form-group">
                        <label for="phone_number" class="form-title">Phone</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" id="phone_number" name="phone_number" placeholder="0812345xxxx">
                    </div>
                    @error('phone_number')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="row">
                        <div class="col-md-6">
                            {{-- birth day --}}
                            <div class="form-group">
                                <label for="birth_day" class="form-title">Birth Day</label>
                                <input type="text" class="form-control date @error('birth_day') is-invalid @enderror" value="{{ old('birth_day') }}" id="birth_day" name="birth_day">
                            </div>
                            @error('birth_day')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            {{-- hire date --}}
                            <div class="form-group">
                                <label for="hire_date" class="form-title">Hire Date</label>
                                <input type="text" class="form-control date @error('hire_date') is-invalid @enderror" value="{{ old('hire_date') }}" id="hire_date" name="hire_date">
                            </div>
                            @error('hire_date')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    {{-- address --}}
                    <div class="form-group">
                        <label for="address" class="form-title">Address</label>
                        <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Jl. Jend. Sudirman No. 123">{{ old('address') }}</textarea>
                    </div>
                    @error('address')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="row">
                        <div class="col-md-6">
                            {{-- department --}}
                            <div class="form-group">
                                <label for="department_id" class="form-title">Department</label>
                                <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}  "
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('department_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            {{-- roles --}}
                            <div class="form-group">
                                <label for="role_id" class="form-title">Roles</label>
                                <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                                    <option value="">Select Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}  "
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>



                    {{-- status --}}
                    <div class="form-group">
                        <label for="status" class="form-title">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    @error('status')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="form-group">
                    <label for="salary" class="form-title">Salary</label>
                    <input type="number"
                        class="form-control @error('salary') is-invalid @enderror"
                        value="{{ old('salary', 0) }}"
                        id="salary"
                        name="salary"
                        readonly>
                    </div>


                    <div class="gap-2 mt-3 d-flex">
                        <a href="{{ route('employees.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>

                        <button type="submit" class="btn btn-primary">Create Employee</button>
                    </div>

                </form>
            </div>
        </div>

    </section>
</div>
@endsection
