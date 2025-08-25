@extends('layout.app')

@section('title', 'Produk')

@push('styles')
<style>
    .header-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2e7d32;
        text-align: center;
        margin: 1rem 0;
    }

    .card-custom {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        cursor: pointer;
        min-height: 350px;
    }

    .card-custom:hover {
        transform: translateY(-5px);
    }

    .card-img-circle {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin: 20px auto 0;
        display: block;
    }

    .search-form .form-control-lg {
        max-width: 500px;
    }

    .search-form .d-flex {
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')
<div class="container" style="max-width: 1020px; margin: 0 auto;">
    <div class="p-4 rounded" style="background-color: #e9f7ef;">
        <div class="header-title">Produk Kami</div>

        {{-- Form pencarian --}}
        <form action="{{ route('galleries.index') }}" method="GET" class="search-form mb-4">
            <div class="d-flex">
                <input type="text" name="search" class="form-control form-control-lg"
                    placeholder="Cari produk..." value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary btn-lg">Cari</button>
            </div>
        </form>

        {{-- Tombol Kirim Keranjang --}}
        <div class="text-center mb-4">
            <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#keranjangModal">
                <i class="bi bi-whatsapp"></i> CEK KERANJANG & CHAT ADMIN
            </button>
        </div>

        {{-- Produk --}}
        <div class="row justify-content-center g-4">
            @forelse ($categories as $category)
                <div class="col-md-3">
                    <div class="card card-custom text-center" data-bs-toggle="modal"
                        data-bs-target="#categoryModal{{ $category->id }}">
                        <img src="{{ asset('storage/' . $category->gambar) }}"
                            alt="{{ $category->nama_category }}" class="card-img-circle">
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $category->nama_category }}</h5>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1"
                    aria-labelledby="categoryModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $category->nama_category }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $category->gambar) }}"
                                    class="img-fluid mb-3" alt="{{ $category->nama_category }}">
                                <p class="text-justify whitespace-pre-wrap leading-relaxed">
                                    {{ $category->deskripsi }}
                                </p>
                                <p><strong>Harga:</strong> Rp. {{ number_format($category->harga, 0, ',', '.') }}</p>

                                {{-- Input jumlah dan tombol tambah --}}
                                <div class="mb-3">
                                    <label for="jumlah{{ $category->id }}">Jumlah:</label>
                                    <input type="number" id="jumlah{{ $category->id }}" value="1" min="1" class="form-control w-50 mx-auto">
                                </div>

                                <button class="btn btn-primary"
                                    onclick="tambahKeKeranjang({{ $category->id }}, '{{ $category->nama_category }}', {{ $category->harga }})">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-success text-center fw-bold fs-5">Tidak ada produk</div>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Modal Keranjang --}}
<div class="modal fade" id="keranjangModal" tabindex="-1" aria-labelledby="keranjangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-bold text-primary mb-3">🛒 Keranjang Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 mb-4 border rounded bg-light">
                    <label for="namaPembeli" class="form-label fw-bold text-success">🧑 Nama Pembeli:</label>
                    <input type="text" id="namaPembeli" class="form-control mb-3" placeholder="Masukkan nama Anda">
                </div>

                <div class="p-3 border rounded bg-white shadow-sm">
                    <h5 class="fw-bold text-black mb-3">🛒 Daftar Pembelian</h5>
                    <div id="daftarKeranjang"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="handleKirimWA()">
                    <i class="bi bi-whatsapp"></i> CHAT ADMIN
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
tampilkanKeranjang();

function tambahKeKeranjang(id, nama, harga) {
    const jumlah = parseInt(document.getElementById(`jumlah${id}`).value);
    if (!jumlah || jumlah <= 0) {
        alert("Masukkan jumlah yang valid.");
        return;
    }

    const index = keranjang.findIndex(item => item.id === id);
    if (index !== -1) {
        keranjang[index].jumlah += jumlah;
        keranjang[index].total = keranjang[index].jumlah * keranjang[index].harga;
    } else {
        keranjang.push({
            id: id,
            nama: nama,
            harga: harga,
            jumlah: jumlah,
            total: harga * jumlah,
            stock_id: id
        });
    }

    localStorage.setItem('keranjang', JSON.stringify(keranjang));
    document.getElementById(`jumlah${id}`).value = 1;
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Produk telah ditambahkan ke keranjang.',
        showConfirmButton: false,
        timer: 1500
    });
    tampilkanKeranjang();
}

function tampilkanKeranjang() {
    const daftar = document.getElementById('daftarKeranjang');
    if (keranjang.length === 0) {
        daftar.innerHTML = `<div class="alert alert-warning text-center">Keranjang masih kosong</div>`;
        return;
    }

    let html = `<table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>`;

    keranjang.forEach((item, index) => {
        html += `<tr>
                    <td>${index + 1}</td>
                    <td>${item.nama}</td>
                    <td>${item.jumlah}</td>
                    <td>Rp. ${Number(item.harga).toLocaleString('id-ID')}</td>
                    <td>Rp. ${Number(item.total).toLocaleString('id-ID')}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="hapusItem(${index})">Hapus</button>
                    </td>
                </tr>`;
    });

    const totalHarga = keranjang.reduce((sum, item) => sum + Number(item.total), 0);
    html += `</tbody><tfoot>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Total</td>
                    <td class="fw-bold">Rp. ${totalHarga.toLocaleString('id-ID')}</td>
                    <td></td>
                </tr>
            </tfoot></table>`;

    daftar.innerHTML = html;
}

function hapusItem(index) {
    Swal.fire({
        title: 'Konfirmasi',
        text: "Yakin ingin menghapus item ini dari keranjang?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            keranjang.splice(index, 1);
            localStorage.setItem('keranjang', JSON.stringify(keranjang));
            tampilkanKeranjang();
            Swal.fire({
                icon: 'success',
                title: 'Terhapus!',
                text: 'Item berhasil dihapus dari keranjang.',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}

function resetKeranjang() {
    keranjang = [];
    localStorage.removeItem('keranjang');
    tampilkanKeranjang();
}

function handleKirimWA() {
    const keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    const nama = document.getElementById('namaPembeli').value.trim();

    if (nama === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Silakan isi nama pembeli!',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }

    if (keranjang.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Keranjang Kosong',
            text: 'Silakan tambahkan barang ke keranjang terlebih dahulu.',
            confirmButtonColor: '#2e7d32',
            confirmButtonText: 'Oke, saya mengerti'
        });
        return false;
    }

    // Buat pesan WhatsApp
    let pesan = `Halo Kak 👋\n\n`;
    pesan += `Saya ingin memesan produk dari toko Kakak. Berikut detailnya:\n\n`;
    pesan += `Nama: ${nama}\n\n`;
    pesan += `🛒 Detail pesanan:\n`;

    keranjang.forEach(item => {
        pesan += `- ${item.nama} x${item.jumlah} = Rp ${Number(item.total).toLocaleString('id-ID')}\n`;
    });

    const totalHarga = keranjang.reduce((sum, item) => sum + Number(item.total), 0);
    pesan += `\n💰 Total Harga: Rp ${totalHarga.toLocaleString('id-ID')}`;
    pesan += `\n\nTerima kasih! 🙏`;

    const noAdmin = "+6283848093681";
    const waURL = `https://wa.me/${noAdmin}?text=${encodeURIComponent(pesan)}`;

    // Reset keranjang
    localStorage.removeItem('keranjang');
    tampilkanKeranjang();

    // Tutup modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('keranjangModal'));
    if (modal) modal.hide();

    // Buka WhatsApp
    window.open(waURL, '_blank');
    return false;
}
</script>
@endsection
