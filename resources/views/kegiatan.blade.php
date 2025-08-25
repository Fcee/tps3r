@extends('layout.app')

@section('title', 'Kegiatan')

@push('styles')
<style>
    body {
        background-color: #e8f5e9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .kegiatan-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
    }

    .kegiatan-header {
        background-color: rgb(44, 126, 48);
        color: white;
        padding: 20px 30px;
        border-radius: 10px;
        font-size: 25px; /* Sesuai dengan .logo-text */
        font-weight: bold; /* Sesuai dengan .logo-text */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Sesuai dengan .logo-text */
        margin-bottom: 30px;
    }

    .kegiatan-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .kegiatan-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        width: 300px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .kegiatan-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .kegiatan-card h5 {
        color: #388e3c;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .kegiatan-card .tanggal {
        margin: 10px 0;
        background: white;
        border: 2px solid #66bb6a;
        color: #388e3c;
        padding: 5px 15px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .kegiatan-card .deskripsi {
        font-size: 14px;
        padding: 0 15px 15px 15px;
        text-align: center;
        color: #444;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>

@endpush

@section('content')
<div class="kegiatan-container">
    <div class="kegiatan-header">KEGIATAN</div>
    <div class="kegiatan-list">
        @foreach ($kegiatans as $kegiatan)
            <div class="kegiatan-card">
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}">
                <h5>{{ $kegiatan->judul }}</h5>
                <div class="tanggal">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}</div>
                <div class="deskripsi">{{ $kegiatan->deskripsi }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection
