<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPenjualan extends Model
{
    use HasFactory;

        protected $fillable = [
        'stock_id',
        'nama_produk',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'nama_pembeli',
        'tanggal',
        'bulan',
        'tahun',
        'status',
    ];
    
    
    // Jika nanti kamu tambahkan kolom penjualan_id di rekap_penjualans
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

}
