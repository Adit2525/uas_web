@extends('layouts.app')

@section('title', 'Booking Lapangan')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">
            <i class="fas fa-calendar-plus me-2"></i>Booking Lapangan
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Form Booking
                </h5>
            </div>
            <div class="card-body">
                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="lapangan_id" class="form-label">Pilih Lapangan</label>
                        <select name="lapangan_id" id="lapangan_id" class="form-select @error('lapangan_id') is-invalid @enderror" required>
                            <option value="">Pilih lapangan...</option>
                            @forelse($lapangan as $lap)
                                <option value="{{ $lap->id }}" {{ request('lapangan_id') == $lap->id ? 'selected' : '' }}>
                                    {{ $lap->nama }} - {{ $lap->jenis }} (Rp {{ number_format($lap->harga, 0, ',', '.') }})
                                </option>
                            @empty
                                <option value="" disabled>Belum ada lapangan tersedia</option>
                            @endforelse
                        </select>
                        @error('lapangan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Booking</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                               value="{{ old('tanggal') }}" min="{{ date('Y-m-d') }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jam" class="form-label">Jam Booking</label>
                        <input type="time" name="jam" id="jam" class="form-control @error('jam') is-invalid @enderror" 
                               value="{{ old('jam') }}" min="06:00" max="22:00" required>
                        @error('jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Pilih jam antara 06:00 - 22:00</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('booking.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary" id="btnBooking" disabled>
                            <i class="fas fa-save me-1"></i>Buat Booking
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
                    <i class="fas fa-info-circle me-2"></i>Informasi Booking
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-clock me-1"></i>Jam Operasional</h6>
                    <p class="mb-1">Senin - Minggu</p>
                    <p class="mb-0">06:00 - 22:00 WIB</p>
                </div>
                
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle me-1"></i>Ketentuan Booking</h6>
                    <ul class="mb-0 small">
                        <li>Booking minimal 1 hari sebelumnya</li>
                        <li>Durasi booking 1 jam per sesi</li>
                        <li>Pembayaran dilakukan di tempat</li>
                        <li>Booking dapat dibatalkan maksimal 2 jam sebelum jadwal</li>
                    </ul>
                </div>
                
                <div class="alert alert-success">
                    <h6><i class="fas fa-check-circle me-1"></i>Status Booking</h6>
                    <p class="mb-1">Setelah booking dibuat, status akan menjadi <strong>Pending</strong> dan menunggu konfirmasi dari admin.</p>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-question-circle me-2"></i>Bantuan
                </h5>
            </div>
            <div class="card-body">
                <p class="card-text small">
                    Jika Anda mengalami kesulitan dalam melakukan booking, silakan hubungi admin atau kunjungi halaman bantuan.
                </p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-home me-1"></i>Lihat Lapangan
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tanggal').min = today;
    
    // Set default time to 06:00
    if (!document.getElementById('jam').value) {
        document.getElementById('jam').value = '06:00';
    }

    // Enable/disable button
    function checkForm() {
        const lapangan = document.getElementById('lapangan_id').value;
        const tanggal = document.getElementById('tanggal').value;
        const jam = document.getElementById('jam').value;
        const btn = document.getElementById('btnBooking');
        btn.disabled = !(lapangan && tanggal && jam);
    }
    document.getElementById('lapangan_id').addEventListener('change', checkForm);
    document.getElementById('tanggal').addEventListener('input', checkForm);
    document.getElementById('jam').addEventListener('input', checkForm);
    checkForm();

    // Validasi jam booking
    document.getElementById('jam').addEventListener('change', function() {
        const jam = this.value;
        if (jam < '06:00' || jam > '22:00') {
            alert('Jam booking hanya diperbolehkan antara 06:00 - 22:00');
            this.value = '';
            checkForm();
        }
    });
});
</script>
@endsection 