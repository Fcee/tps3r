<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recap;
use App\Models\Category;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Exports\RecapsExport;

class RecapController extends Controller
{
    public function index(Request $request)
    {
        $query = Recap::with('category');

        if ($request->filled('category')) {
            $query->where('id_category', $request->category);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $recaps = $query->get();
        $totalSemuaBarang = $recaps->sum('total_barang');
        $totalSemuaHarga = $recaps->sum('total_harga');

        $categories = Category::all();

        return view('recaps.index', compact('recaps', 'totalSemuaBarang', 'totalSemuaHarga', 'categories'));
    }

    public function download(Request $request)
    {
        $format = $request->get('format', 'pdf');

        $query = Recap::with('category');

        if ($request->filled('category')) {
            $query->where('id_category', $request->category);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $recaps = $query->get();
        $totalSemuaBarang = $recaps->sum('total_barang');
        $totalSemuaHarga = $recaps->sum('total_harga');

        if ($format == 'pdf') {
            $pdf = Pdf::loadView('recaps.export', compact('recaps', 'totalSemuaBarang', 'totalSemuaHarga'));
            return $pdf->download('rekapitulasi.pdf');
        }

        if ($format == 'excel') {
            return Excel::download(new RecapsExport($recaps), 'rekapitulasi.xlsx');
        }

        if ($format == 'word') {
            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
            $section->addText('Rekapitulasi Data', ['bold' => true, 'size' => 16]);
            $table = $section->addTable();
            $table->addRow();
            $table->addCell()->addText('Nama Produk');
            $table->addCell()->addText('Total Barang');
            $table->addCell()->addText('Total Harga');

            foreach ($recaps as $recap) {
                $table->addRow();
                $table->addCell()->addText($recap->category->nama_category);
                $table->addCell()->addText($recap->total_barang);
                $table->addCell()->addText('Rp ' . number_format($recap->total_harga, 0, ',', '.'));
            }

            $table->addRow();
            $table->addCell()->addText('Jumlah');
            $table->addCell()->addText($totalSemuaBarang);
            $table->addCell()->addText('Rp ' . number_format($totalSemuaHarga, 0, ',', '.'));

            $tempFile = tempnam(sys_get_temp_dir(), 'word');
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($tempFile);

            return response()->download($tempFile, 'rekapitulasi.docx')->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Format tidak dikenali.');
    }
}
