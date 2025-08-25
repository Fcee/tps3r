@extends('layouts.app')

@section('content')
<div class="container py-4" style="position: relative; padding-left: 15px; padding-right: 15px;">

   <div class="mb-4 p-3 rounded" style="background-color: #66a869;">
        <h2 class="fw-bold mb-0" style="color: #ffffff;">Daftar Kategori</h2>
    </div>

    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary w-30">Tambah</a>
        <a href="{{ route('home') }}" class="btn btn-secondary w-30">Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th>Nama Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->nama_category }}</td>
                        <td>Rp{{ number_format($category->harga, 0, ',', '.') }}</td>
                        <td>
                            @if(empty($category->deskripsi))
                                <span class="text-dark">Tidak Ada Deskripsi</span>
                            @else
                                {{ Str::limit($category->deskripsi, 50) }}
                            @endif
                        </td>
                        <td>
                            @if(empty($category->gambar))
                                <span class="text-dark">Tidak Ada Gambar</span>
                            @else
                                <img src="{{ asset('storage/' . $category->gambar) }}" width="60" alt="gambar">
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data produk akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
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
@endpush
