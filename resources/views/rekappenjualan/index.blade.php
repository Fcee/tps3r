@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1020px; margin: 0 auto;">
<div class="p-4 rounded" style="background-color: #e9f7ef;">
    <!-- Header -->
    <div class="mb-4 p-3 rounded text-white d-flex justify-content-between align-items-center" style="background-color: #4caf50;">
        <h3 class="fw-bold mb-0">Rekap Penjualan</h3>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Kembali</a>

    <!-- Filter & Export -->
    <div class="row g-3 mb-4 align-items-end">
    <form method="GET" action="{{ route('rekappenjualan.index') }}" class="col-md-9 row g-3">
        <div class="col-md-4">
            <label class="form-label">Kategori</label>
            <select name="nama_produk" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($uniqueProducts as $product)
                    <option value="{{ $product }}" {{ request('nama_produk') == $product ? 'selected' : '' }}>{{ $product }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Dari Tanggal</label>
            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal', now()->toDateString()) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir', now()->toDateString()) }}">
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Filter</button>
        </div>
    </form>

    <div class="col-md-3 d-flex gap-2">
        <form action="{{ route('rekappenjualan.reset') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data rekap penjualan?')">
            @csrf
            @method('DELETE')
            <a href="{{ route('rekappenjualan.index') }}" class="btn btn-secondary w-100">Reset Filter</a>
        </form>

        <div class="dropdown">
            <button class="btn btn-success" type="button" data-bs-toggle="dropdown">Download</button>
            <ul class="dropdown-menu">
              
                <a class="dropdown-item" href="{{ route('rekappenjualan.export', ['format' => 'excel']) }}">Export Excel</a>
                <a class="dropdown-item" href="{{ route('rekappenjualan.exportWord') }}">Export Word</a>
            </ul>
        </div>
    </div>
</div>
</form>

     <!-- Tabel -->
            <table class="table table-bordered table-hover">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>Kategori</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekaps as $namaPembeli => $items)
                        @php $rowspan = $items->count(); @endphp
                        @foreach($items as $i => $item)
                            <tr>
                                @if($i === 0)
                                    <td class="text-center align-middle" rowspan="{{ $rowspan }}">{{ $loop->parent->iteration }}</td>
                                    <td class="align-middle" rowspan="{{ $rowspan }}">{{ $namaPembeli }}</td>
                                @endif
                                <td>{{ $item->nama_produk }}</td>
                                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td class="text-center">
                                    @if($item->status === 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($item->status === 'batal')
                                        <span class="badge bg-danger">Batal</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr><td colspan="8" class="text-center">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="row mt-4">
            <div class="col-md-6 offset-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-secondary text-dark">
                        <tbody>
                            <tr>
                                <th style="width: 50%;">Total Barang</th>
                                <td>{{ $totalBarang }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Download Script -->
<script>
    function toggleDownloadOptions() {
        var options = document.getElementById('download-options');
        options.style.display = (options.style.display === 'block') ? 'none' : 'block';
    }

    // Optional: klik luar untuk tutup
    document.addEventListener('click', function(e) {
        var options = document.getElementById('download-options');
        var button = e.target.closest('button');
        if (!e.target.closest('#download-options') && !button?.onclick) {
            options.style.display = 'none';
        }
    });
</script>
@endsection
