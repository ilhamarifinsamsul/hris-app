@extends('layouts.dashboard')
@section('title', 'Departments')
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
                <h3>Departments</h3>
                <p class="text-subtitle text-muted">Handle Employee Departments</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Departments</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('departments.create') }}" class="btn btn-primary ms-auto mb-3">Add New Department</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description }}</td>
                                <td>
                                    @if ($department->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning btn-sm mb-1"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inlin form-delete" enctype="multipart/form-data">
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
