<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

   protected $fillable = ['id_category', 'jumlah_stock', 'nama_barang'];

    // Jika kamu tidak pakai kategori, relasi ini bisa dihapus
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'id_category');
    // }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'nama_produk', 'nama_barang');
    }
    // app/Models/Stock.php
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
