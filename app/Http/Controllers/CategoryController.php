<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_category' => 'required|string|max:255|unique:categories',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $data = $request->only(['nama_category', 'harga', 'deskripsi']);
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->storeAs('kategori', time() . '-' . $gambar->getClientOriginalName(), 'public');
            $data['gambar'] = $gambarPath;
        }
        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_category' => 'required|string|max:255|unique:categories,nama_category,' . $category->id,
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:2000',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $data = $request->only(['nama_category', 'harga', 'deskripsi']);
        if ($request->hasFile('gambar')) {
            if ($category->gambar && Storage::disk('public')->exists($category->gambar)) {
                Storage::disk('public')->delete($category->gambar);
            }
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->storeAs('kategori', time() . '-' . $gambar->getClientOriginalName(), 'public');
            $data['gambar'] = $gambarPath;
        }
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }
    public function destroy(Category $category)
    {
        if ($category->gambar && Storage::disk('public')->exists($category->gambar)) {
            Storage::disk('public')->delete($category->gambar);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}