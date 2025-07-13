@extends('layouts.app')

@section('title', 'Detail Lapangan')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mb-4">
            @if($lapangan->gambar)
                <img src="{{ asset('storage/' . $lapangan->gambar) }}" class="card-img-top" alt="{{ $lapangan->nama }}">
            @endif
            <div class="card-body">
                <h3 class="card-title">{{ $lapangan->nama }}</h3>
                <p><span class="badge bg-info">{{ $lapangan->jenis }}</span></p>
                <p><strong>Harga:</strong> Rp {{ number_format($lapangan->harga, 0, ',', '.') }}</p>
                <p><strong>Lokasi:</strong> {{ $lapangan->lokasi }}</p>
                <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection 