@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-plus me-2"></i>Tambah Jadwal Baru
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
                    <i class="fas fa-edit me-2"></i>Form Tambah Jadwal
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="lapangan_id" class="form-label">Pilih Lapangan</label>
                        <select name="lapangan_id" id="lapangan_id" class="form-select @error('lapangan_id') is-invalid @enderror" required>
                            <option value="">Pilih lapangan...</option>
                            @foreach($lapangan as $lap)
                                <option value="{{ $lap->id }}" {{ old('lapangan_id') == $lap->id ? 'selected' : '' }}>
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
                               value="{{ old('tanggal') }}" min="{{ date('Y-m-d') }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                       value="{{ old('jam_mulai') }}" required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                       value="{{ old('jam_selesai') }}" required>
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
                            <i class="fas fa-save me-1"></i>Simpan Jadwal
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
                        <li>Pilih lapangan yang akan dijadwalkan</li>
                        <li>Tanggal minimal hari ini</li>
                        <li>Jam selesai harus lebih besar dari jam mulai</li>
                        <li>Jadwal akan mempengaruhi ketersediaan lapangan</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle me-1"></i>Perhatian</h6>
                    <p class="mb-0 small">Jadwal yang dibuat akan mempengaruhi ketersediaan lapangan untuk booking.</p>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>Jam Operasional
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Senin - Jumat</span>
                        <span class="badge bg-primary rounded-pill">06:00 - 22:00</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Sabtu - Minggu</span>
                        <span class="badge bg-success rounded-pill">06:00 - 22:00</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Lapangan Tersedia
                </h5>
            </div>
            <div class="card-body">
                @if($lapangan->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($lapangan as $lap)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $lap->nama }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $lap->jenis }}</small>
                                </div>
                                <span class="badge bg-info rounded-pill">{{ $lap->jadwal()->count() }} jadwal</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">Tidak ada lapangan tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tanggal').min = today;
    
    // Set default time
    if (!document.getElementById('jam_mulai').value) {
        document.getElementById('jam_mulai').value = '06:00';
    }
    if (!document.getElementById('jam_selesai').value) {
        document.getElementById('jam_selesai').value = '07:00';
    }
    
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