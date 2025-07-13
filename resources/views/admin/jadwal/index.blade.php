@extends('layouts.app')

@section('title', 'Kelola Jadwal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-calendar me-2"></i>Kelola Jadwal
            </h1>
            <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Tambah Jadwal
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($jadwal->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Durasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwal as $jad)
                                    <tr>
                                        <td>{{ $jad->id }}</td>
                                        <td>
                                            <strong>{{ $jad->lapangan->nama }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $jad->lapangan->jenis }}</small>
                                        </td>
                                        <td>{{ $jad->tanggal->format('d/m/Y') }}</td>
                                        <td>{{ $jad->jam_mulai->format('H:i') }}</td>
                                        <td>{{ $jad->jam_selesai->format('H:i') }}</td>
                                        <td>
                                            @php
                                                $start = \Carbon\Carbon::parse($jad->jam_mulai);
                                                $end = \Carbon\Carbon::parse($jad->jam_selesai);
                                                $duration = $start->diffInHours($end);
                                            @endphp
                                            <span class="badge bg-info">{{ $duration }} jam</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.jadwal.show', $jad->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.jadwal.edit', $jad->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.jadwal.destroy', $jad->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Yakin ingin menghapus jadwal ini?')" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-muted">
                            Total: <strong>{{ $jadwal->count() }}</strong> jadwal
                        </p>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                        <h4>Belum ada jadwal</h4>
                        <p class="text-muted">Anda belum menambahkan jadwal apapun.</p>
                        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Jadwal Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Statistik Jadwal
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-primary">{{ $jadwal->count() }}</h3>
                            <p class="text-muted">Total Jadwal</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-success">{{ $jadwal->where('tanggal', '>=', now()->toDateString())->count() }}</h3>
                            <p class="text-muted">Jadwal Mendatang</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-warning">{{ $jadwal->where('tanggal', '<', now()->toDateString())->count() }}</h3>
                            <p class="text-muted">Jadwal Terlalu</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-info">{{ $jadwal->groupBy('lapangan_id')->count() }}</h3>
                            <p class="text-muted">Lapangan Terjadwal</p>
                        </div>
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
                    <i class="fas fa-calendar-week me-2"></i>Jadwal Minggu Ini
                </h5>
            </div>
            <div class="card-body">
                @php
                    $thisWeek = $jadwal->where('tanggal', '>=', now()->startOfWeek())
                                      ->where('tanggal', '<=', now()->endOfWeek());
                @endphp
                
                @if($thisWeek->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Hari</th>
                                    <th>Lapangan</th>
                                    <th>Jam</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($thisWeek as $jad)
                                    <tr>
                                        <td>{{ $jad->tanggal->format('l, d/m/Y') }}</td>
                                        <td>{{ $jad->lapangan->nama }}</td>
                                        <td>{{ $jad->jam_mulai->format('H:i') }} - {{ $jad->jam_selesai->format('H:i') }}</td>
                                        <td>
                                            @php
                                                $start = \Carbon\Carbon::parse($jad->jam_mulai);
                                                $end = \Carbon\Carbon::parse($jad->jam_selesai);
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
                        <p class="text-muted mb-0">Tidak ada jadwal untuk minggu ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 