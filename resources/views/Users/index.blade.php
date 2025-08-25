@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="mb-4 p-3 rounded" style="background-color: rgba(102, 168, 105, 0.8);">
        <h2 class="fw-bold mb-0" style="color: #ffffff;">Daftar Pengguna</h2>
    </div>

    @if(auth()->user()->role == 'admin')
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
    </div>
    @endif

    <div class="bg-white p-4 rounded shadow-sm">
        <table class="table table-bordered table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="text-center">
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Tombol Hapus dengan SweetAlert -->
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">Hapus</button>

                                <!-- Form tersembunyi -->
                                <form id="form-delete-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script Pop-up Konfirmasi -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data pengguna akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-delete-' + userId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
