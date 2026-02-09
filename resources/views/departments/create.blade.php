@extends('layouts.dashboard')
@section('title', 'Departments Create')
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
                <h3>Departments Create</h3>
                <p class="text-subtitle text-muted">Handle Employee Departments</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Departments</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('departments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-title">Title</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="Input Department Name">
                    </div>
                    @error('name')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="form-group">
                        <label for="description" class="form-title">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" id="description" name="description" placeholder="Description"></textarea>
                    </div>
                    @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

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

                    <div class="gap-2 mt-3 d-flex">
                        <a href="{{ route('departments.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>

                        <button type="submit" class="btn btn-primary">Create Department</button>
                    </div>

                </form>
            </div>
        </div>

    </section>
</div>
@endsection
