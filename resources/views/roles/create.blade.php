@extends('layouts.dashboard')
@section('title', 'Roles Create')
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
                <h3>Roles Create</h3>
                <p class="text-subtitle text-muted">Handle Employee Roles</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title" placeholder="Input Role Title">
                    </div>
                    @error('title')
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

                    <div class="gap-2 mt-3 d-flex">
                        <a href="{{ route('roles.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>

                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </div>

                </form>
            </div>
        </div>

    </section>
</div>
@endsection
