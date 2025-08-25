<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapPenjualanExport implements FromView
{
    public $rekaps, $totalBarang, $totalHarga;

    public function __construct($rekaps, $totalBarang, $totalHarga)
    {
        $this->rekaps = $rekaps;
        $this->totalBarang = $totalBarang;
        $this->totalHarga = $totalHarga;
    }

    public function view(): View
    {
        return view('rekappenjualan.export_excel', [
            'rekaps' => $this->rekaps,
            'totalBarang' => $this->totalBarang,
            'totalHarga' => $this->totalHarga,
        ]);
    }
}
