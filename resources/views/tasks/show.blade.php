@extends('layouts.dashboard')
@section('title', 'Task Detail')
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
                <h3>Tasks Detail</h3>
                <p class="text-subtitle text-muted">Handle Employee Tasks</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
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
                    {{-- Title --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Title</div>
                            <div class="fw-semibold">{{ $task->title }}</div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Description</div>
                            <div class="fw-normal">
                                {{ $task->description ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Assigned To --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Assigned To</div>
                            <div class="fw-semibold">{{ $task->employee->fullname ?? '-' }}</div>
                        </div>
                    </div>

                    {{-- Due Date --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Due Date</div>
                            <div class="fw-semibold">
                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3">
                            <div class="text-muted small mb-1">Status</div>

                            @if ($task->status == 'pending')
                                <span class="badge bg-secondary">Pending</span>
                            @elseif ($task->status == 'in_progress')
                                <span class="badge bg-info">In Progress</span>
                            @else
                                <span class="badge bg-success">Done</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action --}}
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('tasks.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
