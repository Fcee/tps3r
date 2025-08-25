@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4 p-3 rounded" style="background-color: rgba(102, 168, 105, 0.8);">
        <h2 class="fw-bold mb-0" style="color: #ffffff;">Edit Produk</h2>
    </div>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_category" class="form-label">Nama Produk</label>
            <input type="text" name="nama_category" id="nama_category" class="form-control" value="{{ old('nama_category', $category->nama_category) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $category->harga) }}" required>
        </div>

        <!-- Deskripsi -->
<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $category->deskripsi ?? '') }}</textarea>
</div>

<!-- Gambar -->
<div class="mb-3">
    <label for="gambar" class="form-label">Gambar Produk</label>
    <input type="file" name="gambar" class="form-control">
</div>
        <!-- Menampilkan Gambar Saat Ini -->
        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            @if($category->gambar)
                <img src="{{ asset('storage/' . $category->gambar) }}" alt="Gambar" width="100"><br>
                <small>Gambar ini akan dihapus jika Anda meng-upload gambar baru.</small>
            @else
                <p class="text-muted">Tidak ada gambar saat ini.</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-25">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary w-25">Kembali</a>
    </form>
</div>
@endsection
