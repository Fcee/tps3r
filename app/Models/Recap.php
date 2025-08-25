<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\Category;

class Recap extends Model
{
    use HasFactory;

    protected $fillable = ['id_category', 'total_barang', 'total_harga'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public static function updateRecap()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $total_barang = Stock::where('id_category', $category->id)->sum('jumlah_stock');
            $total_harga = $total_barang * $category->harga;

            Recap::updateOrCreate(
                ['id_category' => $category->id],
                ['total_barang' => $total_barang, 'total_harga' => $total_harga]
            );
        }
    }
}
