@extends('layouts.app')

@section('title', 'Detail Jadwal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-eye me-2"></i>Detail Jadwal
            </h1>
            <div>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-warning">
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
                    <i class="fas fa-info-circle me-2"></i>Informasi Jadwal
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID Jadwal:</strong></td>
                                <td>{{ $jadwal->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lapangan:</strong></td>
                                <td>{{ $jadwal->lapangan->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Lapangan:</strong></td>
                                <td><span class="badge bg-info">{{ $jadwal->lapangan->jenis }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal:</strong></td>
                                <td>{{ $jadwal->tanggal->format('d/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Jam Mulai:</strong></td>
                                <td>{{ $jadwal->jam_mulai->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jam Selesai:</strong></td>
                                <td>{{ $jadwal->jam_selesai->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Durasi:</strong></td>
                                <td>
                                    @php
                                        $start = \Carbon\Carbon::parse($jadwal->jam_mulai);
                                        $end = \Carbon\Carbon::parse($jadwal->jam_selesai);
                                        $duration = $start->diffInHours($end);
                                    @endphp
                                    <span class="badge bg-primary">{{ $duration }} jam</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($jadwal->tanggal < now()->toDateString())
                                        <span class="badge bg-secondary">Selesai</span>
                                    @elseif($jadwal->tanggal == now()->toDateString())
                                        <span class="badge bg-warning">Hari Ini</span>
                                    @else
                                        <span class="badge bg-success">Mendatang</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-day me-2"></i>Informasi Tanggal
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Hari:</strong> {{ $jadwal->tanggal->format('l') }}</p>
                        <p><strong>Tanggal:</strong> {{ $jadwal->tanggal->format('d/m/Y') }}</p>
                        <p><strong>Bulan:</strong> {{ $jadwal->tanggal->format('F Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Dibuat:</strong> {{ $jadwal->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Diupdate:</strong> {{ $jadwal->updated_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Jumlah Hari Lagi:</strong> 
                            @if($jadwal->tanggal >= now()->toDateString())
                                <span class="badge bg-info">{{ $jadwal->tanggal->diffInDays(now()) }} hari</span>
                            @else
                                <span class="badge bg-secondary">Sudah lewat</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Jadwal Lainnya di Tanggal yang Sama
                </h5>
            </div>
            <div class="card-body">
                @php
                    $otherSchedules = \App\Models\Jadwal::where('tanggal', $jadwal->tanggal)
                                                       ->where('id', '!=', $jadwal->id)
                                                       ->with('lapangan')
                                                       ->get();
                @endphp
                
                @if($otherSchedules->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Lapangan</th>
                                    <th>Jam</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($otherSchedules as $schedule)
                                    <tr>
                                        <td>
                                            <strong>{{ $schedule->lapangan->nama }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $schedule->lapangan->jenis }}</small>
                                        </td>
                                        <td>{{ $schedule->jam_mulai->format('H:i') }} - {{ $schedule->jam_selesai->format('H:i') }}</td>
                                        <td>
                                            @php
                                                $start = \Carbon\Carbon::parse($schedule->jam_mulai);
                                                $end = \Carbon\Carbon::parse($schedule->jam_selesai);
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
                        <i class="fas fa-calendar-day fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Tidak ada jadwal lain di tanggal yang sama.</p>
                    </div>
                @endif
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
                @if($jadwal->lapangan->gambar)
                    <img src="{{ $jadwal->lapangan->gambar }}" alt="{{ $jadwal->lapangan->nama }}" class="img-fluid rounded mb-3">
                @else
                    <div class="bg-secondary text-white text-center py-4 rounded mb-3">
                        <i class="fas fa-futbol fa-3x"></i>
                        <p class="mt-2 mb-0">Tidak ada gambar</p>
                    </div>
                @endif
                
                <h6>{{ $jadwal->lapangan->nama }}</h6>
                <p class="text-muted">{{ $jadwal->lapangan->jenis }}</p>
                
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Harga:</strong></td>
                        <td>Rp {{ number_format($jadwal->lapangan->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi:</strong></td>
                        <td>{{ $jadwal->lapangan->lokasi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Jadwal:</strong></td>
                        <td><span class="badge bg-primary">{{ $jadwal->lapangan->jadwal()->count() }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Total Booking:</strong></td>
                        <td><span class="badge bg-success">{{ $jadwal->lapangan->booking()->count() }}</span></td>
                    </tr>
                </table>
                
                <div class="d-grid">
                    <a href="{{ route('admin.lapangan.show', $jadwal->lapangan->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>Lihat Lapangan
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
                        <h4 class="text-primary">{{ $jadwal->lapangan->jadwal()->count() }}</h4>
                        <p class="text-muted small">Total Jadwal</p>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ $jadwal->lapangan->jadwal()->where('tanggal', '>=', now()->toDateString())->count() }}</h4>
                        <p class="text-muted small">Mendatang</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-warning">{{ $jadwal->lapangan->booking()->count() }}</h4>
                        <p class="text-muted small">Total Booking</p>
                    </div>
                    <div class="col-6">
                        <h4 class="text-info">{{ $jadwal->lapangan->booking()->where('status', 'confirmed')->count() }}</h4>
                        <p class="text-muted small">Confirmed</p>
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
                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit Jadwal
                    </a>
                    <a href="{{ route('admin.lapangan.show', $jadwal->lapangan->id) }}" class="btn btn-info">
                        <i class="fas fa-futbol me-1"></i>Lihat Lapangan
                    </a>
                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                            <i class="fas fa-trash me-1"></i>Hapus Jadwal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 