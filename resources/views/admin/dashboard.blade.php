@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">
            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
        </h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $lapangan }}</h4>
                        <p class="card-text">Total Lapangan</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-futbol fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $booking }}</h4>
                        <p class="card-text">Total Booking</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $pendingBooking }}</h4>
                        <p class="card-text">Pending Booking</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $confirmedBooking }}</h4>
                        <p class="card-text">Confirmed Booking</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-cogs me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.lapangan.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Lapangan Baru
                    </a>
                    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-success">
                        <i class="fas fa-calendar-plus me-2"></i>Tambah Jadwal Baru
                    </a>
                    <a href="{{ route('booking.index') }}" class="btn btn-info">
                        <i class="fas fa-list me-2"></i>Lihat Semua Booking
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Recent Activities
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-futbol text-primary me-2"></i>
                            <span>Total Lapangan Tersedia</span>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $lapangan }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-calendar-check text-success me-2"></i>
                            <span>Total Booking</span>
                        </div>
                        <span class="badge bg-success rounded-pill">{{ $booking }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-clock text-warning me-2"></i>
                            <span>Booking Pending</span>
                        </div>
                        <span class="badge bg-warning rounded-pill">{{ $pendingBooking }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-check-circle text-info me-2"></i>
                            <span>Booking Confirmed</span>
                        </div>
                        <span class="badge bg-info rounded-pill">{{ $confirmedBooking }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tools me-2"></i>Management Links
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('admin.lapangan.index') }}" class="btn btn-outline-primary w-100 mb-2">
                            <i class="fas fa-futbol me-2"></i>Kelola Lapangan
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-outline-success w-100 mb-2">
                            <i class="fas fa-calendar me-2"></i>Kelola Jadwal
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('booking.index') }}" class="btn btn-outline-info w-100 mb-2">
                            <i class="fas fa-list me-2"></i>Kelola Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 