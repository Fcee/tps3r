@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
            <h2 class="fw-bold mb-0" style="color: #ffffff;">Rekapitulasi Data</h2>
        </div>

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('home') }}" class="btn btn-secondary w-30">Kembali</a>
            <button class="btn btn-success" id="download-btn" onclick="toggleDownloadOptions()">Download</button>
        </div>

        <div id="download-options"
            style="
            display: none;
            position: absolute;
            background: #ffffff;
            border: 1px solid #ced4da;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
            right: 0;
            z-index: 999;
        ">
            <a href="{{ route('recaps.download', array_merge(request()->all(), ['format' => 'excel'])) }}"
                class="btn btn-outline-secondary w-100 mb-2">
                Download Excel
            </a>
            <a href="{{ route('recaps.download', array_merge(request()->all(), ['format' => 'word'])) }}"
                class="btn btn-outline-secondary w-100">
                Download Word
            </a>
        </div>


        <form method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Produk</label>
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('recaps.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        @if ($recaps->isEmpty())
            <div class="alert alert-warning text-center">
                Tidak ada data rekap ditemukan.
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Total Barang</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recaps as $recap)
                        <tr>
                            <td>{{ $recap->category->nama_category }}</td>
                            <td class="text-center">{{ $recap->total_barang }}</td>
                            <td class="text-end">Rp {{ number_format($recap->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                    <tr>
                        <th>Jumlah</th>
                        <th class="text-center">{{ $totalSemuaBarang }}</th>
                        <th class="text-end">Rp {{ number_format($totalSemuaHarga, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        @endif
    </div>

    <script>
        function toggleDownloadOptions() {
            var downloadOptions = document.getElementById('download-options');
            // Toggle visibility of the download options
            if (downloadOptions.style.display === "none" || downloadOptions.style.display === "") {
                downloadOptions.style.display = "block";
            } else {
                downloadOptions.style.display = "none";
            }
        }
    </script>
@endsection
