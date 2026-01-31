<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


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

//Full CRUD (Index, Create, Store, Edit, Update, Destroy)
Route::resource('kategori', KategoriController::class);

//Halaman Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Full CRUD (Index, Create, Store, Edit, Update, Destroy)
Route::resource('anggota', AnggotaController::class);

//Full CRUD (Index, Create, Store, Edit, Update, Destroy)
Route::resource('buku', BukuController::class);
