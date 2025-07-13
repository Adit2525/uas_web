@extends('layouts.app')

@section('title', 'Daftar Booking')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-list me-2"></i>
                @if(auth()->user()->isAdmin())
                    Semua Booking
                @else
                    Booking Saya
                @endif
            </h1>
            <a href="{{ route('booking.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Booking Baru
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    @if(auth()->user()->isAdmin())
                                        <th>User</th>
                                    @endif
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Tanggal Booking</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        @if(auth()->user()->isAdmin())
                                            <td>
                                                <strong>{{ $booking->user->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $booking->user->email }}</small>
                                            </td>
                                        @endif
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
                                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-info btn-sm" title="Lihat"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus booking ini?')"><i class="fas fa-times"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted">
                                    Total: <strong>{{ $bookings->count() }}</strong> booking
                                </p>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        Pending: <span class="badge bg-warning">{{ $bookings->where('status', 'pending')->count() }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm">
                                        Confirmed: <span class="badge bg-success">{{ $bookings->where('status', 'confirmed')->count() }}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm">
                                        Cancelled: <span class="badge bg-danger">{{ $bookings->where('status', 'cancelled')->count() }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4>Tidak ada booking</h4>
                        <p class="text-muted">
                            @if(auth()->user()->isAdmin())
                                Belum ada booking yang dibuat oleh user.
                            @else
                                Anda belum melakukan booking apapun.
                            @endif
                        </p>
                        <a href="{{ route('booking.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Buat Booking Pertama
                        </a>
                    </div>
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
                    <i class="fas fa-chart-bar me-2"></i>Statistik Booking
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-primary">{{ $bookings->where('status', 'pending')->count() }}</h3>
                            <p class="text-muted">Pending</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-success">{{ $bookings->where('status', 'confirmed')->count() }}</h3>
                            <p class="text-muted">Confirmed</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-danger">{{ $bookings->where('status', 'cancelled')->count() }}</h3>
                            <p class="text-muted">Cancelled</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-info">{{ $bookings->count() }}</h3>
                            <p class="text-muted">Total</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection 