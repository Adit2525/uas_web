@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">
            <i class="fas fa-user me-2"></i>Dashboard Saya
        </h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $myBookings->count() }}</h4>
                        <p class="card-text">Total Booking Saya</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $myBookings->where('status', 'confirmed')->count() }}</h4>
                        <p class="card-text">Booking Dikonfirmasi</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $myBookings->where('status', 'pending')->count() }}</h4>
                        <p class="card-text">Booking Pending</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Riwayat Booking Saya
                </h5>
                <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Booking Baru
                </a>
            </div>
            <div class="card-body">
                @if($myBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myBookings as $booking)
                                    <tr>
                                        <td>
                                            <strong>{{ $booking->lapangan->nama }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->lapangan->jenis }}</small>
                                        </td>
                                        <td>{{ $booking->tanggal->format('d/m/Y') }}</td>
                                        <td>{{ $booking->jam->format('H:i') }}</td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge bg-success">Confirmed</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5>Belum ada booking</h5>
                        <p class="text-muted">Anda belum melakukan booking lapangan apapun.</p>
                        <a href="{{ route('booking.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Booking Lapangan Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <h6 class="mb-1">Status Booking</h6>
                        <small class="text-muted">
                            <span class="badge bg-warning me-1">Pending</span> Menunggu konfirmasi admin
                        </small>
                    </div>
                    <div class="list-group-item">
                        <h6 class="mb-1">Booking Confirmed</h6>
                        <small class="text-muted">
                            <span class="badge bg-success me-1">Confirmed</span> Booking sudah dikonfirmasi
                        </small>
                    </div>
                    <div class="list-group-item">
                        <h6 class="mb-1">Booking Cancelled</h6>
                        <small class="text-muted">
                            <span class="badge bg-danger me-1">Cancelled</span> Booking dibatalkan
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-question-circle me-2"></i>Bantuan
                </h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Jika Anda memiliki pertanyaan atau masalah dengan booking, silakan hubungi admin.
                </p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-home me-1"></i>Lihat Lapangan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 