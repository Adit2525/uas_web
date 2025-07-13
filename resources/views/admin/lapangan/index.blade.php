@extends('layouts.app')

@section('title', 'Kelola Lapangan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-futbol me-2"></i>Kelola Lapangan
            </h1>
            <a href="{{ route('admin.lapangan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Tambah Lapangan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($lapangan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Lokasi</th>
                                    <th>Total Booking</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lapangan as $lap)
                                    <tr>
                                        <td>{{ $lap->id }}</td>
                                        <td>
                                            @if($lap->gambar)
                                                <img src="{{ asset('storage/' . $lap->gambar) }}" alt="{{ $lap->nama }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white text-center" style="width: 50px; height: 50px; line-height: 50px;">
                                                    <i class="fas fa-futbol"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $lap->nama }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $lap->jenis }}</span>
                                        </td>
                                        <td>
                                            <strong>Rp {{ number_format($lap->harga, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>{{ $lap->lokasi }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $lap->booking()->count() }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.lapangan.show', $lap->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.lapangan.edit', $lap->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.lapangan.destroy', $lap->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Yakin ingin menghapus lapangan ini?')" title="Hapus">
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
                            Total: <strong>{{ $lapangan->count() }}</strong> lapangan
                        </p>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-futbol fa-4x text-muted mb-3"></i>
                        <h4>Belum ada lapangan</h4>
                        <p class="text-muted">Anda belum menambahkan lapangan apapun.</p>
                        <a href="{{ route('admin.lapangan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Lapangan Pertama
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
                    <i class="fas fa-chart-bar me-2"></i>Statistik Lapangan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-primary">{{ $lapangan->count() }}</h3>
                            <p class="text-muted">Total Lapangan</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-success">{{ $lapangan->where('jenis', 'Futsal')->count() }}</h3>
                            <p class="text-muted">Lapangan Futsal</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-info">{{ $lapangan->where('jenis', 'Basket')->count() }}</h3>
                            <p class="text-muted">Lapangan Basket</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h3 class="text-warning">{{ $lapangan->where('jenis', 'Tennis')->count() }}</h3>
                            <p class="text-muted">Lapangan Tennis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 