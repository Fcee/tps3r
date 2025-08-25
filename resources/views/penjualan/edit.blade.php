@extends('layouts.app')

@section('content')
<div class="container p-4 rounded" style="background-color: #dff2e1;">
    <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
        <h2 class="fw-bold mb-0 text-white">Edit Penjualan</h2>
    </div>

    <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" value="{{ $penjualan->nama_pembeli }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <select name="produk[0][nama_barang]" id="nama_barang" class="form-control produk-select" onchange="isiHarga()" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($stocks as $stock)
                    <option value="{{ $stock->nama_barang }}"
                        {{ $penjualan->stock->nama_barang == $stock->nama_barang ? 'selected' : '' }}>
                        {{ $stock->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Satuan</label>
            <input type="number" name="produk[0][harga]" id="harga" class="form-control harga-input" value="{{ $penjualan->harga }}" required readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $penjualan->jumlah }}" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary w-25">Update</button>
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary w-25">Batal</a>
        </div>
    </form>
</div>

{{-- Script Harga Otomatis --}}
<script>
    const hargaProduk = {
        @foreach($stocks as $stock)
            "{{ $stock->nama_barang }}": {{ $stock->category->harga }},
        @endforeach
    };

    function isiHarga() {
        const nama = document.getElementById('nama_barang').value;
        const hargaInput = document.getElementById('harga');
        hargaInput.value = hargaProduk[nama] || 0;
    }

    // Saat halaman dimuat, isi harga berdasarkan produk yang sudah dipilih
    document.addEventListener('DOMContentLoaded', function () {
        isiHarga();
    });
</script>
@endsection
