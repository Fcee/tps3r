@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
        <h2 class="fw-bold mb-0 text-white">Edit Stok</h2>
    </div>

    <form action="{{ route('stock.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_category" class="form-label">Nama Produk</label>
            <select name="id_category" id="id_category" class="form-select" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $stock->id_category == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah_stock">Jumlah Stok</label>
            <input type="number" name="jumlah_stock" id="jumlah_stock" class="form-control" min="1" value="{{ $stock->jumlah_stock }}" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary w-25">Update</button>
            <a href="{{ route('stock.index') }}" class="btn btn-secondary w-25">Batal</a>
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
