@extends('layouts.app')

@section('title', 'Tambah Lapangan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-plus me-2"></i>Tambah Lapangan Baru
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
                    <i class="fas fa-edit me-2"></i>Form Tambah Lapangan
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.lapangan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lapangan</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Lapangan</label>
                        <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                            <option value="">Pilih jenis lapangan...</option>
                            <option value="Futsal" {{ old('jenis') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                            <option value="Basket" {{ old('jenis') == 'Basket' ? 'selected' : '' }}>Basket</option>
                            <option value="Tennis" {{ old('jenis') == 'Tennis' ? 'selected' : '' }}>Tennis</option>
                            <option value="Badminton" {{ old('jenis') == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                            <option value="Voli" {{ old('jenis') == 'Voli' ? 'selected' : '' }}>Voli</option>
                            <option value="Sepak Bola" {{ old('jenis') == 'Sepak Bola' ? 'selected' : '' }}>Sepak Bola</option>
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
                                   value="{{ old('harga') }}" min="0" step="1000" required>
                        </div>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
                                  rows="3" required>{{ old('lokasi') }}</textarea>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">URL Gambar (Opsional)</label>
                        <input type="url" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                               value="{{ old('gambar') }}" placeholder="https://example.com/image.jpg">
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
                            <i class="fas fa-save me-1"></i>Simpan Lapangan
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
                    <i class="fas fa-info-circle me-2"></i>Informasi
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb me-1"></i>Tips</h6>
                    <ul class="mb-0 small">
                        <li>Nama lapangan harus unik dan mudah diingat</li>
                        <li>Pilih jenis lapangan yang sesuai</li>
                        <li>Harga per jam dalam rupiah</li>
                        <li>Lokasi harus detail dan mudah ditemukan</li>
                        <li>Gambar akan ditampilkan di halaman utama</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle me-1"></i>Perhatian</h6>
                    <p class="mb-0 small">Setelah lapangan ditambahkan, user dapat langsung melakukan booking pada lapangan tersebut.</p>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Jenis Lapangan
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Futsal</span>
                        <span class="badge bg-primary rounded-pill">Indoor</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Basket</span>
                        <span class="badge bg-success rounded-pill">Indoor/Outdoor</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Tennis</span>
                        <span class="badge bg-info rounded-pill">Outdoor</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Badminton</span>
                        <span class="badge bg-warning rounded-pill">Indoor</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Voli</span>
                        <span class="badge bg-danger rounded-pill">Indoor/Outdoor</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Sepak Bola</span>
                        <span class="badge bg-dark rounded-pill">Outdoor</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 