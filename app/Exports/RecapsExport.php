<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RecapsExport implements FromView
{
    protected $recaps;

    public function __construct($recaps)
    {
        $this->recaps = $recaps;
    }

    public function view(): View
    {
        return view('recaps.export_excel', [
            'recaps' => $this->recaps
        ]);
    }
}
