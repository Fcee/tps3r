<?php

namespace App\Models;
// app/Models/Penjualan.php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

   protected $fillable = [
    'nama_pembeli', 'stock_id', 'nama_barang', 'harga', 'jumlah', 'total', 'status'
];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function rekap()
    {
        return $this->hasOne(RekapPenjualan::class);
    }
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
