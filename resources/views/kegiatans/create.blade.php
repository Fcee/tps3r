@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
            <h2 class="fw-bold mb-0" style="color: #ffffff;">Tambah Kegiatan</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kegiatans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label fw-bold">Nama Kegiatan</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label fw-bold">Gambar</label>
                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary w-25">Simpan</button>
                <a href="{{ route('kegiatans.index') }}" class="btn btn-secondary w-25">Batal</a>
            </div>
        </form>
    </div>
@endsection