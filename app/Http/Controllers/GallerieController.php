<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class GallerieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('nama_category', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
        })->get();

        return view('galleries.index', compact('categories'));
    }
}
