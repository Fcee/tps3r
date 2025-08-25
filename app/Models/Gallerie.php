<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    use HasFactory;

    protected $fillable = ['id_category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
