<?php
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
route::get('/kategori', [KategoriController::class, 'index']);
route::post('/kategori', [KategoriController::class, 'store']);

//Menampilkan Halaman Login
route::get('/login', function () {
    return view('auth.login');
})->name('login');

//Proses Login
route::post('/login', function(Request $request){
    if($request->email == "admin@lp3i.com" AND $request->password == "admin123") {
        return redirect()->route('dashboard');
    }
    return redirect()->back()->with('error','Email atau Password salah!');
})->name('login.post');

//Halaman Dashboard
route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
