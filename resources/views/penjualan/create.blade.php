@extends('layouts.app')

@section('content')
<div class="container p-4 rounded" style="background-color: #dff2e1;">
    <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
        <h2 class="fw-bold mb-0 text-white">Tambah Penjualan</h2>
    </div>

    <form method="POST" action="{{ route('penjualan.store') }}">
        @csrf
        <div class="form-group">
            <label>Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" required>
        </div>

        <div id="produk-wrapper">
            <div class="produk-item row mb-3">
                <div class="col">
                    <label>Nama Produk</label>
                    <select name="produk[0][nama_barang]" class="form-control produk-select" onchange="isiHarga(this)" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($stocks as $stock)
                            @if(!empty($stock->nama_barang))
                                <option value="{{ $stock->nama_barang }}">{{ $stock->nama_barang }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Harga Satuan</label>
                    <input type="number" name="produk[0][harga]" class="form-control harga-input" required readonly>
                </div>
                <div class="col">
                    <label>Jumlah</label>
                    <input type="number" name="produk[0][jumlah]" class="form-control" required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-info mb-3" onclick="tambahProduk()">+ Tambah Produk</button>

        <div class="form-group mt-2">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-warning">Reset</button>
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

    {{-- Script Harga Otomatis --}}
    <script>
        let index = 1;

        const hargaProduk = {
            @foreach($stocks as $stock)
                @if(!empty($stock->nama_barang) && $stock->category)
                    "{{ $stock->nama_barang }}": {{ $stock->category->harga }},
                @endif
            @endforeach
        };

        function tambahProduk() {
            const wrapper = document.getElementById('produk-wrapper');
            const html = `
                <div class="produk-item row mb-3">
                    <div class="col">
                        <label>Nama Produk</label>
                        <select name="produk[${index}][nama_barang]" class="form-control produk-select" onchange="isiHarga(this)" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($stocks as $stock)
                                @if(!empty($stock->nama_barang))
                                    <option value="{{ $stock->nama_barang }}">{{ $stock->nama_barang }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Harga Satuan</label>
                        <input type="number" name="produk[${index}][harga]" class="form-control harga-input" required readonly>
                    </div>
                    <div class="col">
                        <label>Jumlah</label>
                        <input type="number" name="produk[${index}][jumlah]" class="form-control" required>
                    </div>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', html);
            index++;
        }

        function isiHarga(selectElement) {
            const nama = selectElement.value;
            const hargaInput = selectElement.closest('.produk-item').querySelector('.harga-input');
            hargaInput.value = hargaProduk[nama] || 0;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const resetButton = document.querySelector('button[type="reset"]');
            if (resetButton) {
                resetButton.addEventListener('click', function () {
                    const wrapper = document.getElementById('produk-wrapper');
                    const items = wrapper.querySelectorAll('.produk-item');
                    items.forEach((item, i) => {
                        if (i > 0) item.remove();
                    });

                    const firstInputs = items[0].querySelectorAll('input, select');
                    firstInputs.forEach(el => el.value = '');
                    index = 1;
                });
            }

            const firstSelect = document.querySelector('.produk-item select');
            if (firstSelect) {
                firstSelect.addEventListener('change', function () {
                    isiHarga(this);
                });
            }
        });
    </script>
</div>
@endsection
