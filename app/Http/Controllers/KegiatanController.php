<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function publicView()
    {
        $kegiatans = Kegiatan::orderByDesc('tanggal')->get();
        return view('kegiatan', compact('kegiatans'));
    }

    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('kegiatans.index', compact('kegiatans'));
    }


    public function create()
    {
        return view('kegiatans.create'); // untuk create
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kegiatan', 'public');
            $validated['gambar'] = $path;
        }

        Kegiatan::create($validated);

        return redirect()->route('kegiatans.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }
    // Tampilkan detail kegiatan (opsional)
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatans.show', compact('kegiatan'));
    }

    // Tampilkan form edit kegiatan
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatans.edit', compact('kegiatan')); // untuk edit
    }

    // Update data kegiatan
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $path = $request->file('gambar')->store('kegiatan', 'public');
            $validated['gambar'] = $path;
        }

        $kegiatan->update($validated);

        return redirect()->route('kegiatans.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('kegiatans.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
    
}