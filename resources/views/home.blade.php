@extends('layouts.app')

@section('title', 'Home - Booking Lapangan Olahraga')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="jumbotron p-5 rounded mb-4" style="background: linear-gradient(90deg, #A7C7E7 0%, #B5EAD7 100%); color: #222;">
            <h1 class="display-4 mb-2">
                <i class="fas fa-futbol me-3 text-primary"></i>Selamat Datang di Booking Lapangan Olahraga
            </h1>
            <p class="lead">Temukan dan booking lapangan olahraga favorit Anda dengan mudah dan cepat.</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-light btn-lg shadow-sm me-2"><i class="fas fa-user-plus me-1"></i>Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg shadow-sm"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
            @else
                <a href="{{ route('booking.create') }}" class="btn btn-success btn-lg shadow-sm me-2"><i class="fas fa-calendar-plus me-1"></i>Booking Lapangan</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-info btn-lg shadow-sm"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a>
                @endif
            @endguest
        </div>
    </div>
</div>

<div class="row mt-4 mb-2">
    <div class="col-12 d-flex align-items-center">
        <h2 class="mb-0 me-2" style="font-weight: 700; letter-spacing: 1px;">
            <i class="fas fa-list me-2 text-success"></i>Daftar Lapangan Tersedia
        </h2>
        <span class="badge rounded-pill" style="background: #FFFACD; color: #222; font-size: 1rem;">Olahraga Favoritmu</span>
    </div>
</div>

<div class="row">
    @forelse($lapangan as $lap)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow border-0" style="background: #F6F7FB; border-radius: 18px;">
                @if($lap->gambar)
                    <img src="{{ asset('storage/' . $lap->gambar) }}" class="card-img-top" alt="{{ $lap->nama }}" style="height: 200px; object-fit: cover; border-top-left-radius: 18px; border-top-right-radius: 18px;">
                @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px; border-top-left-radius: 18px; border-top-right-radius: 18px;">
                        <i class="fas fa-futbol fa-3x text-white"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title mb-1" style="font-weight: 600;">
                        <i class="fas fa-dumbbell me-1 text-warning"></i>{{ $lap->nama }}
                    </h5>
                    <p class="card-text mb-2">
                        <span class="badge" style="background: #B5EAD7; color: #222; font-size: 0.95rem;"><i class="fas fa-medal me-1"></i>{{ $lap->jenis }}</span>
                        <strong class="ms-2" style="color: #222;">Rp {{ number_format($lap->harga, 0, ',', '.') }}</strong>
                    </p>
                    <p class="card-text mb-2">
                        <i class="fas fa-map-marker-alt me-1 text-danger"></i>{{ $lap->lokasi }}
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <a href="{{ route('booking.create', ['lapangan_id' => $lap->id]) }}" class="btn btn-primary shadow-sm">
                            <i class="fas fa-calendar-plus me-1"></i>Booking
                        </a>
                        <a href="{{ route('lapangan.show', $lap->id) }}" class="btn btn-outline-info shadow-sm">
                            <i class="fas fa-info-circle me-1"></i>Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center shadow-sm">
                <i class="fas fa-info-circle me-2"></i>Tidak ada lapangan tersedia saat ini.
            </div>
        </div>
    @endforelse
</div>

<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 text-center" style="background: #FFFACD; border-radius: 18px;">
            <div class="card-body">
                <i class="fas fa-search fa-2x mb-2 text-primary"></i>
                <h5 class="card-title">Cari Lapangan</h5>
                <p class="card-text">Temukan lapangan olahraga yang sesuai dengan kebutuhan dan lokasi Anda.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 text-center" style="background: #B5EAD7; border-radius: 18px;">
            <div class="card-body">
                <i class="fas fa-calendar-check fa-2x mb-2 text-success"></i>
                <h5 class="card-title">Booking Online</h5>
                <p class="card-text">Booking lapangan dengan mudah melalui sistem online kami yang modern dan cepat.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 text-center" style="background: #A7C7E7; border-radius: 18px;">
            <div class="card-body">
                <i class="fas fa-clock fa-2x mb-2 text-warning"></i>
                <h5 class="card-title">24/7 Tersedia</h5>
                <p class="card-text">Sistem booking tersedia 24 jam untuk kenyamanan Anda berolahraga kapan saja.</p>
            </div>
        </div>
    </div>
</div>
@endsection 