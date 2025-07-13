@extends('layouts.app')

@section('title', 'Detail Lapangan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-eye me-2"></i>Detail Lapangan
            </h1>
            <div>
                <a href="{{ route('admin.lapangan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <a href="{{ route('admin.lapangan.edit', $lapangan->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi Lapangan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID Lapangan:</strong></td>
                                <td>{{ $lapangan->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lapangan:</strong></td>
                                <td>{{ $lapangan->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Lapangan:</strong></td>
                                <td><span class="badge bg-info">{{ $lapangan->jenis }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Harga per Jam:</strong></td>
                                <td><strong>Rp {{ number_format($lapangan->harga, 0, ',', '.') }}</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Lokasi:</strong></td>
                                <td>{{ $lapangan->lokasi }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total Booking:</strong></td>
                                <td><span class="badge bg-primary">{{ $lapangan->booking()->count() }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Dibuat:</strong></td>
                                <td>{{ $lapangan->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate:</strong></td>
                                <td>{{ $lapangan->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar me-2"></i>Jadwal Lapangan
                </h5>
            </div>
            <div class="card-body">
                @if($lapangan->jadwal->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lapangan->jadwal as $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->tanggal->format('d/m/Y') }}</td>
                                        <td>{{ $jadwal->jam_mulai->format('H:i') }}</td>
                                        <td>{{ $jadwal->jam_selesai->format('H:i') }}</td>
                                        <td>
                                            @php
                                                $start = \Carbon\Carbon::parse($jadwal->jam_mulai);
                                                $end = \Carbon\Carbon::parse($jadwal->jam_selesai);
                                                $duration = $start->diffInHours($end);
                                            @endphp
                                            {{ $duration }} jam
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Belum ada jadwal untuk lapangan ini.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Riwayat Booking
                </h5>
            </div>
            <div class="card-body">
                @if($lapangan->booking->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>User</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Tanggal Booking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lapangan->booking as $booking)
                                    <tr>
                                        <td>
                                            <strong>{{ $booking->user->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->user->email }}</small>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Belum ada booking untuk lapangan ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-futbol me-2"></i>Gambar Lapangan
                </h5>
            </div>
            <div class="card-body">
                @if($lapangan->gambar)
                    <img src="{{ $lapangan->gambar }}" alt="{{ $lapangan->nama }}" class="img-fluid rounded mb-3">
                @else
                    <div class="bg-secondary text-white text-center py-4 rounded mb-3">
                        <i class="fas fa-futbol fa-3x"></i>
                        <p class="mt-2 mb-0">Tidak ada gambar</p>
                    </div>
                @endif
                
                <div class="d-grid">
                    <a href="{{ route('admin.lapangan.edit', $lapangan->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i>Edit Lapangan
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Statistik
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $lapangan->booking()->count() }}</h4>
                        <p class="text-muted small">Total Booking</p>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ $lapangan->booking()->where('status', 'confirmed')->count() }}</h4>
                        <p class="text-muted small">Confirmed</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-warning">{{ $lapangan->booking()->where('status', 'pending')->count() }}</h4>
                        <p class="text-muted small">Pending</p>
                    </div>
                    <div class="col-6">
                        <h4 class="text-danger">{{ $lapangan->booking()->where('status', 'cancelled')->count() }}</h4>
                        <p class="text-muted small">Cancelled</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tools me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-success">
                        <i class="fas fa-calendar-plus me-1"></i>Tambah Jadwal
                    </a>
                    <a href="{{ route('booking.index') }}" class="btn btn-info">
                        <i class="fas fa-list me-1"></i>Lihat Semua Booking
                    </a>
                    <form action="{{ route('admin.lapangan.destroy', $lapangan->id) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus lapangan ini?')">
                            <i class="fas fa-trash me-1"></i>Hapus Lapangan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 