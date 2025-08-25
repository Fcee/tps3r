<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

protected $fillable = ['nama_category', 'harga', 'deskripsi', 'gambar'];

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'category_id');
    }

    public function recaps()
    {
        return $this->hasMany(Recap::class, 'category_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallerie::class, 'category_id');
    }
        
}
