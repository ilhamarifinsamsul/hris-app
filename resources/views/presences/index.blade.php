@extends('layouts.dashboard')
@section('title', 'Presences')
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
                <h3>Presences</h3>
                <p class="text-subtitle text-muted">Handle Employee Presences</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Presences</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('presences.create') }}" class="btn btn-primary ms-auto mb-3">Add New Presence</a>
                </div>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $presence)
                            <tr>
                                <td>{{ $presence->employee->fullname ?? 'N/A'}}</td>
                                <td>{{ $presence->check_in }}</td>
                                <td>{{ $presence->check_out }}</td>
                                <td>{{ $presence->date }}</td>
                                <td>
                                    @if ($presence->status == 'present')
                                        <span class="badge bg-success">{{ ucfirst($presence->status) }}</span>
                                    @elseif ($presence->status == 'absent')
                                        <span class="badge bg-danger">{{ ucfirst($presence->status) }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ ucfirst($presence->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('presences.edit', $presence->id) }}" class="btn btn-warning btn-sm mb-1"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('presences.destroy', $presence->id) }}" method="POST" class="d-inline form-delete" enctype="multipart/form-data">
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
