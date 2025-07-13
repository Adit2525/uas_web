@extends('layouts.app')

@section('title', 'Edit Lapangan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-edit me-2"></i>Edit Lapangan
            </h1>
            <a href="{{ route('admin.lapangan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Form Edit Lapangan
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.lapangan.update', $lapangan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lapangan</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama', $lapangan->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Lapangan</label>
                        <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                            <option value="">Pilih jenis lapangan...</option>
                            <option value="Futsal" {{ old('jenis', $lapangan->jenis) == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                            <option value="Basket" {{ old('jenis', $lapangan->jenis) == 'Basket' ? 'selected' : '' }}>Basket</option>
                            <option value="Tennis" {{ old('jenis', $lapangan->jenis) == 'Tennis' ? 'selected' : '' }}>Tennis</option>
                            <option value="Badminton" {{ old('jenis', $lapangan->jenis) == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                            <option value="Voli" {{ old('jenis', $lapangan->jenis) == 'Voli' ? 'selected' : '' }}>Voli</option>
                            <option value="Sepak Bola" {{ old('jenis', $lapangan->jenis) == 'Sepak Bola' ? 'selected' : '' }}>Sepak Bola</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga per Jam</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" 
                                   value="{{ old('harga', $lapangan->harga) }}" min="0" step="1000" required>
                        </div>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
                                  rows="3" required>{{ old('lokasi', $lapangan->lokasi) }}</textarea>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">URL Gambar (Opsional)</label>
                        <input type="url" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                               value="{{ old('gambar', $lapangan->gambar) }}" placeholder="https://example.com/image.jpg">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Masukkan URL gambar lapangan (opsional)</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.lapangan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Lapangan
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
                    <i class="fas fa-info-circle me-2"></i>Informasi Lapangan
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($lapangan->gambar)
                        <img src="{{ $lapangan->gambar }}" alt="{{ $lapangan->nama }}" class="img-fluid rounded" style="max-height: 200px;">
                    @else
                        <div class="bg-secondary text-white py-4 rounded">
                            <i class="fas fa-futbol fa-3x"></i>
                            <p class="mt-2 mb-0">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
                
                <table class="table table-borderless">
                    <tr>
                        <td><strong>ID:</strong></td>
                        <td>{{ $lapangan->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama:</strong></td>
                        <td>{{ $lapangan->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis:</strong></td>
                        <td><span class="badge bg-info">{{ $lapangan->jenis }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Harga:</strong></td>
                        <td>Rp {{ number_format($lapangan->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi:</strong></td>
                        <td>{{ $lapangan->lokasi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Booking:</strong></td>
                        <td><span class="badge bg-primary">{{ $lapangan->booking()->count() }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $lapangan->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate:</strong></td>
                        <td>{{ $lapangan->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Perhatian
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h6><i class="fas fa-info-circle me-1"></i>Peringatan</h6>
                    <p class="mb-0 small">Perubahan pada lapangan akan mempengaruhi semua booking yang terkait dengan lapangan ini.</p>
                </div>
                
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb me-1"></i>Tips</h6>
                    <ul class="mb-0 small">
                        <li>Pastikan informasi yang diupdate akurat</li>
                        <li>Harga yang diubah akan berlaku untuk booking baru</li>
                        <li>Booking yang sudah ada tidak akan terpengaruh</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 