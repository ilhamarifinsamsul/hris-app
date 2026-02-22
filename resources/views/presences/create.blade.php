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
                    {{-- Role HR --}}
                    @if (session('role') == 'HR')
                        <form action="{{ route('presences.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Employee --}}
                            <div class="form-group">
                                <label for="employee_id" class="form-title">Employee</label>
                                <select class="form-control select2 @error('employee_id') is-invalid @enderror"
                                    id="employee_id" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }} "
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
                                        <input type="text"
                                            class="form-control datetime @error('check_in') is-invalid @enderror"
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
                                        <input type="text"
                                            class="form-control datetime @error('check_out') is-invalid @enderror"
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
                                    <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present
                                    </option>
                                    <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent
                                    </option>
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
                    @else
                        {{-- Role Employee --}}
                        <form action="{{ route('presences.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <b>Note :</b>
                                <i> Please make sure to add your location presence </i>
                            </div>
                            {{-- latitude --}}
                            <div class="mb-3">
                                <label for="latitude" class="form-title">Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    value="{{ old('latitude') }}" id="latitude" name="latitude" required>
                            </div>
                            {{-- longitude --}}
                            <div class="mb-3">
                                <label for="longitude" class="form-title">longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                    value="{{ old('longitude') }}" id="longitude" name="longitude" required>
                            </div>

                            {{-- tampilkan map --}}
                            <div class="mb-3">
                                <iframe width="100%" height="300" frameborder="0" scrolling='no' margin-height="0"
                                    margin-width="0" src=""></iframe>
                            </div>

                            <button type="submit" id="button-present" class="btn btn-primary btn-sm">Present</button>
                        </form>
                    @endif
                </div>
            </div>

        </section>
    </div>
    <script>
        const iframe = document.querySelector('iframe');
        const officeLat = -6.564444;
        const officeLong = 107.767840;
        const threshold = 0.01;

        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lot = position.coords.longitude;

            iframe.src = `https://www.google.com/maps?q=${lat},${lot}&z=15&output=embed`;
        })

        document.addEventListener('DOMContentLoaded', function(event) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lot = position.coords.longitude;

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lot;

                    // compare lokasi sekarang dan lokasi kantornya
                    const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(lot - officeLong,
                        2));

                    if (distance <= threshold) {
                        // posisis ada di kantor
                        alert('You are at office, selamat bekerja');
                        document.getElementById('button-present').removeAttribute(
                            'disabled'); // remove disabled = false;
                    } else {
                        alert('You are not at office');
                    }
                });
            }
        })
    </script>
@endsection
