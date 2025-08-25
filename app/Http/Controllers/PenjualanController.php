<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Stock;
use App\Models\RekapPenjualan;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    // Tampilkan semua data penjualan
    public function index()
    {
        $penjualans = Penjualan::with('stock')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    // Tampilkan form tambah
    public function create()
    {
        $stocks = Stock::with('category')->get();
        return view('penjualan.create', compact('stocks'));
    }

    // ✅ Simpan penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string',
            'produk' => 'required|array',
            'produk.*.nama_barang' => 'required|string',
            'produk.*.harga' => 'required|numeric',
            'produk.*.jumlah' => 'required|integer|min:1',
        ]);

        $data = $request->produk;

        foreach ($data as $item) {
            $stock = Stock::where('nama_barang', $item['nama_barang'])->first();

            if ($stock) {
                Penjualan::create([
                    'nama_pembeli' => $request->nama_pembeli,
                    'stock_id'     => $stock->id,
                    'nama_barang'  => $item['nama_barang'],
                    'harga'        => $item['harga'],
                    'jumlah'       => $item['jumlah'],
                    'total'        => $item['harga'] * $item['jumlah'],
                    'status'       => 'pending',
                ]);
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
    }

    // Edit penjualan
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $stocks = Stock::all();
        return view('penjualan.edit', compact('penjualan', 'stocks'));
    }

    // Update data
   public function update(Request $request, $id)
{
    $request->validate([
        'nama_pembeli'           => 'required|string',
        'produk.0.nama_barang'   => 'required|string',
        'produk.0.harga'         => 'required|numeric',
        'jumlah'                 => 'required|numeric|min:1',
    ]);

    $produk = $request->input('produk')[0];

    // Temukan data penjualan yang akan diubah
    $penjualan = Penjualan::findOrFail($id);

    // Temukan ID stok berdasarkan nama_barang
    $stock = Stock::where('nama_barang', $produk['nama_barang'])->first();
    if (!$stock) {
        return back()->with('error', 'Produk tidak ditemukan di stok.');
    }

    // Update data
    $penjualan->update([
        'nama_pembeli' => $request->nama_pembeli,
        'stock_id'     => $stock->id,
        'nama_barang'  => $produk['nama_barang'],
        'harga'        => $produk['harga'],
        'jumlah'       => $request->jumlah,
    ]);

    return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diupdate.');
}

    // Hapus penjualan
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }

    // ✅ Selesaikan penjualan
    public function selesai($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $stock = Stock::find($penjualan->stock_id);

        if (!$stock) {
            return back()->with('error', 'Data stok tidak ditemukan.');
        }

        if ($stock->jumlah_stock < $penjualan->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Kurangi stok
        $stock->jumlah_stock -= $penjualan->jumlah;
        $stock->save();

        // Catat ke rekap
        RekapPenjualan::create([
            'stock_id'      => $penjualan->stock_id,
            'nama_produk'   => $penjualan->nama_barang, // harus ada kolom ini
            'jumlah'        => $penjualan->jumlah,
            'harga_satuan'  => $penjualan->harga,
            'total_harga'   => $penjualan->harga * $penjualan->jumlah,
            'nama_pembeli'  => $penjualan->nama_pembeli,
            'tanggal'       => now()->toDateString(),
            'bulan'         => now()->format('F'),
            'tahun'         => now()->format('Y'),
            'status'        => 'selesai',
        ]);

        $penjualan->delete();

        return back()->with('success', 'Transaksi diselesaikan dan stok diperbarui.');
    }

    // Batalkan transaksi
    public function batal($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Pesanan dibatalkan dan dihapus.');
    }

    // Perbaiki harga yang terlalu kecil
    public function perbaikiHarga()
    {
        $data = Penjualan::where('harga', '<', 1000)->get();
        foreach ($data as $item) {
            $item->harga = $item->harga * 100000;
            $item->save();
        }
        return "Harga berhasil diperbaiki.";
    }
}
