@extends('layouts.app')

@section('title', 'Home - Booking Lapangan Olahraga')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="jumbotron bg-primary text-white p-5 rounded">
            <h1 class="display-4">
                <i class="fas fa-futbol me-3"></i>Selamat Datang di Booking Lapangan Olahraga
            </h1>
            <p class="lead">Temukan dan booking lapangan olahraga favorit Anda dengan mudah dan cepat.</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-light btn-lg">Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg ms-2">Login</a>
            @else
                <a href="{{ route('booking.create') }}" class="btn btn-light btn-lg">Booking Lapangan</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg ms-2">Dashboard</a>
                @endif
            @endguest
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-list me-2"></i>Daftar Lapangan Tersedia
        </h2>
    </div>
</div>

<div class="row">
    @forelse($lapangan as $lap)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($lap->gambar)
                    <img src="{{ asset('storage/' . $lap->gambar) }}" class="card-img-top" alt="{{ $lap->nama }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-futbol fa-3x text-white"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $lap->nama }}</h5>
                    <p class="card-text">
                        <span class="badge bg-info me-2">{{ $lap->jenis }}</span>
                        <strong>Rp {{ number_format($lap->harga, 0, ',', '.') }}</strong>
                    </p>
                    <p class="card-text">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $lap->lokasi }}
                    </p>
                    @auth
                        <a href="{{ route('booking.create', ['lapangan_id' => $lap->id]) }}" class="btn btn-primary">
                            <i class="fas fa-calendar-plus me-1"></i>Booking
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                            <i class="fas fa-sign-in-alt me-1"></i>Login untuk Booking
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>Tidak ada lapangan tersedia saat ini.
            </div>
        </div>
    @endforelse
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-search fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Cari Lapangan</h5>
                <p class="card-text">Temukan lapangan olahraga yang sesuai dengan kebutuhan Anda.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                <h5 class="card-title">Booking Online</h5>
                <p class="card-text">Booking lapangan dengan mudah melalui sistem online kami.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                <h5 class="card-title">24/7 Tersedia</h5>
                <p class="card-text">Sistem booking tersedia 24 jam untuk kenyamanan Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection 