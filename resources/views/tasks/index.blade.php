@extends('layouts.dashboard')
@section('title', 'Tasks')
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
                <div class="d-flex">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary ms-auto mb-3">Add New Task</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Assigned To</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->employee->fullname }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    @if ($task->status == 'done')
                                        <span class="badge bg-success">Done</span>
                                    @elseif ($task->status == 'in_progress')
                                        <span class="badge bg-info">In Progress</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                    {{-- handle status --}}
                                    @if ($task->status == 'pending')
                                        <a href="{{ route('tasks.in_progress', $task->id) }}" class="btn btn-secondary btn-sm"><i class="bi bi-hourglass-split"></i></a>
                                    @elseif ($task->status == 'in_progress')
                                        <a href="{{ route('tasks.done', $task->id) }}" class="btn btn-info btn-sm"><i class="bi bi-arrow-repeat"></i></a>
                                    @else
                                        <a href="{{ route('tasks.pending', $task->id) }}" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i></a>
                                    @endif
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inlin form-delete" enctype="multipart/form-data">
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
