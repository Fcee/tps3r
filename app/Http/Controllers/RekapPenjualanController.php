<?php

namespace App\Http\Controllers;

use App\Models\RekapPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Exports\RekapPenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class RekapPenjualanController extends Controller
{
    public function index(Request $request)
{
    $query = RekapPenjualan::query();

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
    $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
}


    if ($request->filled('nama_pembeli')) {
        $query->where('nama_pembeli', 'like', '%' . $request->nama_pembeli . '%');
    }

    if ($request->filled('nama_produk')) {
        $query->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
    }

    // Grouping berdasarkan nama pembeli
    $rekaps = $query->orderBy('tanggal', 'desc')->get()->groupBy('nama_pembeli');

    $totalBarang = $rekaps->flatten()->sum('jumlah');
    $totalHarga = $rekaps->flatten()->sum('total_harga');

    $uniqueProducts = RekapPenjualan::select('nama_produk')->distinct()->pluck('nama_produk');

    return view('rekappenjualan.index', compact('rekaps', 'totalBarang', 'totalHarga', 'uniqueProducts'));
}

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
        'nama_produk'   => $penjualan->nama_barang,
        'jumlah'        => $penjualan->jumlah,
        'harga_satuan'  => $penjualan->harga,
        'total_harga'   => $penjualan->harga * $penjualan->jumlah,
        'nama_pembeli'  => $penjualan->nama_pembeli,
        'tanggal'       => now()->toDateString(),
        'bulan'         => now()->format('F'),
        'tahun'         => now()->format('Y'),
        'status'        => 'selesai',
    ]);

    // Hapus dari penjualan
    $penjualan->delete();

    return back()->with('success', 'Transaksi diselesaikan dan stok dikurangi.');
}

        public function batal($id)
        {
            $penjualan = Penjualan::findOrFail($id);

          RekapPenjualan::create([
    'stock_id'      => $penjualan->stock_id,
    'nama_produk'   => $penjualan->nama_produk ?? $penjualan->stock->nama_barang ?? 'Tidak diketahui', // pastikan tidak null
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

            return redirect()->route('penjualan.index')->with('success', 'Transaksi dibatalkan dan dicatat di rekap.');
        }

        public function export(Request $request)
    {
    $query = RekapPenjualan::query();

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
    }

    if ($request->filled('nama_pembeli')) {
        $query->where('nama_pembeli', 'like', '%' . $request->nama_pembeli . '%');
    }

    if ($request->filled('nama_produk')) {
        $query->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
    }

    $rekaps = $query->get();
    $totalBarang = $rekaps->sum('jumlah');
    $totalHarga = $rekaps->sum('total_harga');

    $format = $request->input('format');

    if ($format === 'pdf') {
        $pdf = PDF::loadView('rekappenjualan.export_pdf', compact('rekaps', 'totalBarang', 'totalHarga'));
        return $pdf->download('rekap-penjualan.pdf');
    }

    if ($format === 'excel') {
        return Excel::download(
            new \App\Exports\RekapPenjualanExport($rekaps, $totalBarang, $totalHarga),
            'rekap-penjualan.xlsx'
        );
    }

    if ($format === 'word') {
        return response()->view('rekappenjualan.export_word', compact('rekaps', 'totalBarang', 'totalHarga'))
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment; filename="rekap-penjualan.doc"');
    }

    return redirect()->route('rekappenjualan.index');
    }

    public function exportExcel()
{
    $rekaps = RekapPenjualan::all();
    $totalBarang = $rekaps->sum('jumlah');
    $totalHarga = $rekaps->sum('total_harga');

    return Excel::download(new RekapPenjualanExport($rekaps, $totalBarang, $totalHarga), 'rekappenjualan.xlsx');
}

    public function exportPDF()
    {
        $data = RekapPenjualan::all();
        $pdf = Pdf::loadView('exports.rekap_pdf', compact('data'));
        return $pdf->download('rekappenjualan.pdf');
    }

    public function exportWord(Request $request)
    {
        $rekaps = RekapPenjualan::query();

        // Filter tanggal jika ada
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $rekaps->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        // Ambil data
        $rekaps = $rekaps->get();

        // Hitung total
        $totalHarga = $rekaps->sum('total_harga');
        $totalBarang = $rekaps->sum('jumlah'); // ⬅️ Tambahan penting

        // Kirim ke view Word
        $html = view('rekappenjualan.export_word', compact('rekaps', 'totalHarga', 'totalBarang'))->render();

        // Simpan & unduh file
        $fileName = 'rekap-penjualan.doc';
        file_put_contents(public_path($fileName), $html);

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string',
            'produk' => 'required|array',
            'produk.*.nama_barang' => 'required|string',
            'produk.*.harga' => 'required|numeric',
            'produk.*.jumlah' => 'required|integer',
        ]);

        foreach ($request->produk as $item) {
            Penjualan::create([
                'nama_pembeli' => $request->nama_pembeli,
                'nama_barang' => $item['nama_barang'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil disimpan.');
    }

}
