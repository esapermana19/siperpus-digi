<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
route::get('/kategori', [KategoriController::class, 'index']);
route::post('/kategori', [KategoriController::class, 'store']);
Route::resource('kategori', KategoriController::class);

//Menampilkan Halaman Login
route::get('/login', function () {
    return view('auth.login');
})->name('login');

//Proses Login
route::post('/login', function (Request $request) {
    if ($request->email == "admin@lp3i.com" and $request->password == "admin123") {
        return redirect()->route('dashboard');
    }
    return redirect()->back()->with('error', 'Email atau Password salah!');
})->name('login.post');

//Form Input Kategori
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
//Form Edit Kategori
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');

//Halaman Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
