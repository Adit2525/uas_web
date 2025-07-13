@extends('layouts.app')

@section('title', 'Tambah Lapangan Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0" style="background: #F6F7FB; border-radius: 18px;">
            <div class="card-header bg-white border-0 d-flex align-items-center" style="border-radius: 18px 18px 0 0;">
                <i class="fas fa-futbol fa-lg me-2 text-primary"></i>
                <h4 class="mb-0" style="font-weight: 600;">Tambah Lapangan Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lapangan</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required autofocus>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Olahraga</label>
                        <input type="text" name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis') }}" required>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga per Jam</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" min="0" step="1000" required>
                        </div>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" rows="3" required>{{ old('lokasi') }}</textarea>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Upload Gambar Lapangan</label>
                        <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Upload gambar lapangan (jpeg, png, max 2MB).</small>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
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
</div>
@endsection 