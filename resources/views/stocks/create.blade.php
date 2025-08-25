@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
        <h2 class="fw-bold mb-0 text-white">Tambah Stok Baru</h2>
    </div>

    <form action="{{ route('stock.store') }}" method="POST">
        @csrf

       <select name="id_category" id="id_category" class="form-control" required>
    <option value="">Pilih Produk</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
    @endforeach
</select>

        <div class="mb-3">
            <label for="jumlah_stock">Jumlah Stok</label>
            <input type="number" name="jumlah_stock" id="jumlah_stock" class="form-control" min="1" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary w-25">Simpan</button>
            <a href="{{ route('stock.index') }}" class="btn btn-secondary w-25">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection
