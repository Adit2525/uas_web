@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-edit me-2"></i>Edit Jadwal
            </h1>
            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
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
                    <i class="fas fa-edit me-2"></i>Form Edit Jadwal
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="lapangan_id" class="form-label">Pilih Lapangan</label>
                        <select name="lapangan_id" id="lapangan_id" class="form-select @error('lapangan_id') is-invalid @enderror" required>
                            <option value="">Pilih lapangan...</option>
                            @foreach($lapangan as $lap)
                                <option value="{{ $lap->id }}" {{ old('lapangan_id', $jadwal->lapangan_id) == $lap->id ? 'selected' : '' }}>
                                    {{ $lap->nama }} - {{ $lap->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('lapangan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                               value="{{ old('tanggal', $jadwal->tanggal->format('Y-m-d')) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                       value="{{ old('jam_mulai', $jadwal->jam_mulai->format('H:i')) }}" required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                       value="{{ old('jam_selesai', $jadwal->jam_selesai->format('H:i')) }}" required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Jadwal
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
                    <i class="fas fa-info-circle me-2"></i>Informasi Jadwal
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>ID:</strong></td>
                        <td>{{ $jadwal->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lapangan:</strong></td>
                        <td>{{ $jadwal->lapangan->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis:</strong></td>
                        <td><span class="badge bg-info">{{ $jadwal->lapangan->jenis }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal:</strong></td>
                        <td>{{ $jadwal->tanggal->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jam:</strong></td>
                        <td>{{ $jadwal->jam_mulai->format('H:i') }} - {{ $jadwal->jam_selesai->format('H:i') }}</td>
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
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $jadwal->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate:</strong></td>
                        <td>{{ $jadwal->updated_at->format('d/m/Y H:i') }}</td>
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
                    <p class="mb-0 small">Perubahan pada jadwal akan mempengaruhi ketersediaan lapangan untuk booking.</p>
                </div>
                
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb me-1"></i>Tips</h6>
                    <ul class="mb-0 small">
                        <li>Pastikan jadwal tidak bentrok dengan booking</li>
                        <li>Jam selesai harus lebih besar dari jam mulai</li>
                        <li>Perubahan akan berlaku segera</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-futbol me-2"></i>Informasi Lapangan
                </h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $jadwal->lapangan->nama }}</p>
                <p><strong>Jenis:</strong> {{ $jadwal->lapangan->jenis }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($jadwal->lapangan->harga, 0, ',', '.') }}</p>
                <p><strong>Lokasi:</strong> {{ $jadwal->lapangan->lokasi }}</p>
                <p><strong>Total Jadwal:</strong> <span class="badge bg-primary">{{ $jadwal->lapangan->jadwal()->count() }}</span></p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validate time
    document.getElementById('jam_selesai').addEventListener('change', function() {
        const startTime = document.getElementById('jam_mulai').value;
        const endTime = this.value;
        
        if (startTime && endTime && startTime >= endTime) {
            alert('Jam selesai harus lebih besar dari jam mulai!');
            this.value = '';
        }
    });
});
</script>
@endsection 