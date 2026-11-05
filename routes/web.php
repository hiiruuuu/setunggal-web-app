<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Publik (Landing Page) dengan Filter Pencarian dan Kategori
Route::get('/', function (Request $request) {
    $query = Menu::query();

    // Hanya tampilkan menu yang statusnya ready/tersedia untuk publik
    $query->where('is_available', true);

    // Filter Pencarian Nama Menu
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter Kategori Menu
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }

    $menus = $query->latest()->get();
    
    // Ambil daftar kategori unik untuk tombol filter di landing page
    $categories = Menu::select('category')->distinct()->pluck('category');

    return view('welcome', compact('menus', 'categories'));
});

// Mengarahkan default dashboard Breeze langsung ke manajemen menu admin
Route::get('/dashboard', function () {
    return redirect()->route('menus.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Rute yang Membutuhkan Autentikasi (Admin & Profil)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute Profil Pengguna (Memperbaiki error route [profile.edit] not defined)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute khusus untuk mengubah status ketersediaan menu (Ready / Habis)
    Route::patch('/menus/{menu}/toggle', [MenuController::class, 'toggleStatus'])->name('menus.toggle');
    
    // Rute Resource CRUD Menu Admin
    Route::resource('menus', MenuController::class);

});

// Memuat rute autentikasi bawaan Laravel Breeze (Login, Register, dll)
require __DIR__.'/auth.php';