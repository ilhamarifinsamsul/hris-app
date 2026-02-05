@extends('layouts.dashboard')
@section('title', 'Task')
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
                <h3>Tasks</h3>
                <p class="text-subtitle text-muted">Handle Employee Tasks</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tasks</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @csrf
                    {{-- spoping --}}
                    @method('PUT')
                    <div class="form-group">
                        <label for="title" class="form-title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}" id="title" name="title" placeholder="Input Task">
                    </div>
                    @error('title')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="form-group">
                        <label for="description" class="form-title">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">{{ old('description', $task->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="form-group">
                        <label for="assigned_to" class="form-title">Assigned To</label>
                        <select class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to">
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}  "
                                    {{ old('assigned_to', $task->assigned_to) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('assigned_to')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- due date --}}
                    <div class="form-group">
                        <label for="due_date" class="form-title">Due Date</label>
                        <input type="date" class="form-control date @error('due_date') is-invalid @enderror" value="{{ old('due_date', $task->due_date) }}" id="due_date" name="due_date">
                    </div>
                    @error('due_date')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- status --}}
                    <div class="form-group">
                        <label for="status" class="form-title">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="pending" @if (old('status', $task->status) == 'pending') selected
                            @endif>Pending</option>
                            <option value="in_progress" @if (old('status', $task->status) == 'in_progress') selected @endif>In Progress</option>
                            <option value="done" @if (old('status', $task->status) == 'done') selected @endif>Done</option>
                        </select>
                    </div>
                    @error('status')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror

                    <button type="submit" class="btn btn-primary mt-3">Update Task</button>

                </form>
            </div>
        </div>

    </section>
</div>
@endsection
