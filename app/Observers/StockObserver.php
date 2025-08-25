<?php

namespace App\Observers;

use App\Models\Stock;
use App\Models\Recap;
use Illuminate\Support\Facades\Log;

class StockObserver
{
    public function created(Stock $stock)
    {
        Log::info('Stock ditambahkan, update recap dipanggil');
        Recap::updateRecap();
    }

    public function updated(Stock $stock)
    {
        Recap::updateRecap();
    }

    public function deleted(Stock $stock)
    {
        Recap::updateRecap();
    }
}
