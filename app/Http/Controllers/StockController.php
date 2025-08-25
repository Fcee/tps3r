<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Category;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('category')->get();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('stocks.create', compact('categories'));
    }

   public function store(Request $request)
{
    $request->validate([
        'id_category' => 'required|exists:categories,id',
        'jumlah_stock' => 'required|numeric|min:1',
    ]);

    $category = Category::find($request->id_category);

    if (!$category) {
        return back()->with('error', 'Kategori tidak ditemukan.');
    }

    Stock::create([
        'id_category'  => $category->id, // atau category_id jika sesuai dengan DB
        'nama_barang'  => $category->nama_category,
        'jumlah_stock' => $request->jumlah_stock,
    ]);

    return redirect()->route('stocks.index')->with('success', 'Stok berhasil ditambahkan.');
}


    public function edit(Stock $stock)
    {
        $categories = Category::all();
        return view('stocks.edit', compact('stock', 'categories'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'id_category' => 'required|exists:categories,id',
            'jumlah_stock' => 'required|integer|min:1'
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stok berhasil dihapus.');
    }
}