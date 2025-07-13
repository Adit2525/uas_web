@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-eye me-2"></i>Detail Booking
            </h1>
            <div>
                <a href="{{ route('booking.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit Status
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi Booking
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID Booking:</strong></td>
                                <td>#{{ $booking->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge bg-warning fs-6">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge bg-success fs-6">Confirmed</span>
                                    @else
                                        <span class="badge bg-danger fs-6">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Booking:</strong></td>
                                <td>{{ $booking->tanggal->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jam Booking:</strong></td>
                                <td>{{ $booking->jam->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Dibuat:</strong></td>
                                <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate:</strong></td>
                                <td>{{ $booking->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nama Lapangan:</strong></td>
                                <td>{{ $booking->lapangan->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Lapangan:</strong></td>
                                <td>{{ $booking->lapangan->jenis }}</td>
                            </tr>
                            <tr>
                                <td><strong>Harga:</strong></td>
                                <td>Rp {{ number_format($booking->lapangan->harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi:</strong></td>
                                <td>{{ $booking->lapangan->lokasi }}</td>
                            </tr>
                            @if(auth()->user()->isAdmin())
                                <tr>
                                    <td><strong>Nama User:</strong></td>
                                    <td>{{ $booking->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email User:</strong></td>
                                    <td>{{ $booking->user->email }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-futbol me-2"></i>Informasi Lapangan
                </h5>
            </div>
            <div class="card-body">
                @if($booking->lapangan->gambar)
                    <img src="{{ asset('storage/' . $booking->lapangan->gambar) }}" class="img-fluid rounded mb-3" alt="{{ $booking->lapangan->nama }}">
                @else
                    <div class="bg-secondary text-white text-center py-4 rounded mb-3">
                        <i class="fas fa-futbol fa-3x"></i>
                        <p class="mt-2 mb-0">Tidak ada gambar</p>
                    </div>
                @endif
                
                <h6>{{ $booking->lapangan->nama }}</h6>
                <p class="text-muted">{{ $booking->lapangan->jenis }}</p>
                
                <div class="d-grid">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        <i class="fas fa-search me-1"></i>Lihat Lapangan Lain
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Status Booking
                </h5>
            </div>
            <div class="card-body">
                @if($booking->status == 'pending')
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-clock me-1"></i>Pending</h6>
                        <p class="mb-0">Booking Anda sedang menunggu konfirmasi dari admin.</p>
                    </div>
                @elseif($booking->status == 'confirmed')
                    <div class="alert alert-success">
                        <h6><i class="fas fa-check-circle me-1"></i>Confirmed</h6>
                        <p class="mb-0">Booking Anda telah dikonfirmasi. Silakan datang sesuai jadwal.</p>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-times-circle me-1"></i>Cancelled</h6>
                        <p class="mb-0">Booking Anda telah dibatalkan.</p>
                    </div>
                @endif
                
                @if($booking->status == 'pending')
                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                            <i class="fas fa-times me-1"></i>Batalkan Booking
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->isAdmin())
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>Informasi User
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama:</strong> {{ $booking->user->name }}</p>
                        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                        <p><strong>Role:</strong> 
                            @if($booking->user->isAdmin())
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-primary">User</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Terdaftar Sejak:</strong> {{ $booking->user->created_at->format('d/m/Y') }}</p>
                        <p><strong>Total Booking:</strong> {{ $booking->user->booking()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection 