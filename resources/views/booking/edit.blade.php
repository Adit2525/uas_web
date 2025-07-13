@extends('layouts.app')

@section('title', 'Edit Status Booking')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-edit me-2"></i>Edit Status Booking
            </h1>
            <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Detail
            </a>
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
                        <p><strong>ID Booking:</strong> #{{ $booking->id }}</p>
                        <p><strong>User:</strong> {{ $booking->user->name }}</p>
                        <p><strong>Lapangan:</strong> {{ $booking->lapangan->nama }}</p>
                        <p><strong>Tanggal:</strong> {{ $booking->tanggal->format('d/m/Y') }}</p>
                        <p><strong>Jam:</strong> {{ $booking->jam->format('H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status Saat Ini:</strong> 
                            @if($booking->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($booking->status == 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </p>
                        <p><strong>Tanggal Dibuat:</strong> {{ $booking->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Terakhir Diupdate:</strong> {{ $booking->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Form Edit Status
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('booking.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Booking</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Penjelasan Status
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h6><i class="fas fa-clock me-1"></i>Pending</h6>
                    <p class="mb-0">Booking sedang menunggu konfirmasi dari admin.</p>
                </div>
                
                <div class="alert alert-success">
                    <h6><i class="fas fa-check-circle me-1"></i>Confirmed</h6>
                    <p class="mb-0">Booking telah dikonfirmasi dan user dapat menggunakan lapangan.</p>
                </div>
                
                <div class="alert alert-danger">
                    <h6><i class="fas fa-times-circle me-1"></i>Cancelled</h6>
                    <p class="mb-0">Booking telah dibatalkan dan tidak dapat digunakan.</p>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>Informasi User
                </h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $booking->user->name }}</p>
                <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                <p><strong>Role:</strong> 
                    @if($booking->user->isAdmin())
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-primary">User</span>
                    @endif
                </p>
                <p><strong>Total Booking:</strong> {{ $booking->user->booking()->count() }}</p>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-futbol me-2"></i>Informasi Lapangan
                </h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $booking->lapangan->nama }}</p>
                <p><strong>Jenis:</strong> {{ $booking->lapangan->jenis }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($booking->lapangan->harga, 0, ',', '.') }}</p>
                <p><strong>Lokasi:</strong> {{ $booking->lapangan->lokasi }}</p>
            </div>
        </div>
    </div>
</div>
@endsection 