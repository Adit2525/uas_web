@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex align-items-center mb-3">
            <h1 class="mb-0 me-2" style="font-weight: 700; letter-spacing: 1px;">
                <i class="fas fa-tachometer-alt me-2 text-info"></i>Dashboard Admin
            </h1>
            <span class="badge rounded-pill" style="background: #B5EAD7; color: #222; font-size: 1rem;">Statistik &amp; Kontrol</span>
        </div>
        <hr style="border-top: 2px solid #A7C7E7;">
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card shadow border-0 text-center" style="background: #A7C7E7; border-radius: 18px;">
            <div class="card-body">
                <i class="fas fa-futbol fa-2x mb-2 text-primary"></i>
                <h4 class="card-title mb-1">{{ $lapangan }}</h4>
                <p class="card-text mb-0">Total Lapangan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow border-0 text-center" style="background: #B5EAD7; border-radius: 18px;">
            <div class="card-body">
                <i class="fas fa-calendar-check fa-2x mb-2 text-success"></i>
                <h4 class="card-title mb-1">{{ $booking }}</h4>
                <p class="card-text mb-0">Total Booking</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow border-0 text-center" style="background: #FFFACD; border-radius: 18px;">
            <div class="card-body">
                <i class="fas fa-users fa-2x mb-2 text-warning"></i>
                <h4 class="card-title mb-1">{{ $user }}</h4>
                <p class="card-text mb-0">Total User</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow border-0 text-center" style="background: #F6F7FB; border-radius: 18px;">
            <div class="card-body">
                <i class="fas fa-calendar-alt fa-2x mb-2 text-info"></i>
                <h4 class="card-title mb-1">{{ $jadwal }}</h4>
                <p class="card-text mb-0">Total Jadwal</p>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-info shadow-sm d-flex align-items-center" style="background: #B5EAD7; color: #222;">
            <i class="fas fa-info-circle fa-lg me-2"></i>
            <div>
                Selamat datang di dashboard admin! Kelola data lapangan, jadwal, dan booking dengan mudah melalui menu di atas.
            </div>
        </div>
    </div>
</div>
@endsection 