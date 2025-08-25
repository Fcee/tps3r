<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\RekapPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GallerieController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ✅ Halaman publik
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/galleries', [GallerieController::class, 'index'])->name('galleries.index');
Route::get('/kegiatan', [KegiatanController::class, 'publicView'])->name('kegiatan.publik');
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');

// ✅ Halaman home untuk pengguna login
Route::get('/home', fn() => view('home'))->middleware('auth')->name('home');

// ✅ Halaman admin (dengan middleware auth)
Route::middleware(['auth'])->group(function () {

    // Stok & Kategori
    
    Route::resource('stock', StockController::class)->except(['show']); // Gunakan hanya satu
    Route::resource('categories', CategoryController::class)->except(['show']);
    // Pengguna
    Route::resource('users', UserController::class)->except(['show']);

    // Admin Kegiatan (CRUD)
    Route::resource('admin/kegiatans', KegiatanController::class);
    Route::get('kegiatans/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('kegiatans.edit');
    Route::put('kegiatans/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatans.update');

    // Rekap Barang
    Route::get('recaps', [RecapController::class, 'index'])->name('recaps.index');
    Route::get('recaps/download', [RecapController::class, 'download'])->name('recaps.download');

    // Penjualan
    Route::resource('penjualan', PenjualanController::class);
    Route::post('penjualan/{id}/selesai', [PenjualanController::class, 'selesai'])->name('penjualan.selesai');
    Route::post('/penjualan/{id}/batal', [PenjualanController::class, 'batal'])->name('penjualan.batal');
    Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');

    // Rekap Penjualan
    Route::get('/rekap-penjualan', [RekapPenjualanController::class, 'index'])->name('rekappenjualan.index');
    Route::get('/rekap-penjualan/export/{format}', [RekapPenjualanController::class, 'export'])->name('rekappenjualan.export');
    Route::get('/rekappenjualan/export-pdf', [RekapPenjualanController::class, 'exportPDF'])->name('rekappenjualan.export.pdf');
    Route::get('/rekappenjualan/export', [RekapPenjualanController::class, 'export'])->name('rekappenjualan.export');
    Route::get('/rekap-penjualan/export-word', [RekapPenjualanController::class, 'exportWord'])->name('rekappenjualan.exportWord');
    Route::delete('/rekappenjualan/reset', [RekapPenjualanController::class, 'reset'])->name('rekappenjualan.reset');
});

// ✅ Auth bawaan Laravel
Auth::routes();
