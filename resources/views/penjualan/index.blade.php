@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1020px; margin: 0 auto;">
    <div class="p-4 rounded" style="background-color: #e9f7ef;">
        <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
            <h2 class="fw-bold mb-0" style="color: #ffffff;">Penjualan</h2>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex gap-2 mb-3">
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary w-30">Tambah</a>
            <a href="{{ route('home') }}" class="btn btn-secondary w-30">Kembali</a>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Tabel Penjualan -->
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grouped = $penjualans->groupBy('nama_pembeli');
                @endphp

                @forelse ($grouped as $pembeli => $items)
                    <tr>
                        <td>{{ $pembeli }}</td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach($items as $item)
                                    <li>{{ $item->stock->nama_barang ?? $item->nama_barang }} (x{{ $item->jumlah }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach($items as $item)
                                    <li>Rp {{ number_format($item->harga, 0, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach($items as $item)
                                    <li>{{ $item->jumlah }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                @foreach($items as $item)
                                    <li>
                                        @if($item->status === 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($item->status === 'batal')
                                            <span class="badge bg-secondary">Batal</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0 text-center">
                                @foreach($items as $item)
                                    <li class="mb-1">
                                        <a href="{{ route('penjualan.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('penjualan.selesai', $item->id) }}" method="POST" class="d-inline form-selesai">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-success btn-selesai">Selesai</button>
                                        </form>

                                        <form id="form-batal-{{ $item->id }}" action="{{ route('penjualan.batal', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-secondary" onclick="confirmBatal({{ $item->id }})">Batal</button>
                                        </form>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data penjualan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Tambahkan SweetAlert2 dan script konfirmasi -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi untuk tombol BATAL
    function confirmBatal(id) {
        Swal.fire({
            title: 'Yakin ingin membatalkan?',
            text: "Pesanan ini akan dibatalkan dan tidak akan diproses.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Tidak Jadi'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-batal-' + id).submit();
            }
        });
    }

    // Fungsi untuk tombol SELESAI
    document.addEventListener('DOMContentLoaded', function () {
        const selesaiButtons = document.querySelectorAll('.btn-selesai');

        selesaiButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Tandai pesanan sebagai selesai?',
                    text: "Status akan diubah menjadi 'selesai'.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, selesai!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
