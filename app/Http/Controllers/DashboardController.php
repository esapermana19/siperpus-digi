<?php

namespace App\Http\Controllers;

use App\Models\Kategori; // Pastikan model Kategori di-import
use App\Models\LogActivity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah data yang SUDAH ADA tabelnya
        $totalKategori = Kategori::count();

        // Memberikan nilai 0 untuk yang BELUM ADA tabelnya agar tidak error
        $totalBuku = 0;
        $totalAnggota = 0;
        $totalPinjam = 0;

        // Mengambil 5 aktivitas terbaru (Ini aman karena tabelnya sudah kamu migrate)
        $recentLogs = LogActivity::latest()->limit(5)->get();

        return view('dashboard', compact(
            'totalKategori',
            'totalBuku',
            'totalAnggota',
            'totalPinjam',
            'recentLogs'
        ));
    }
}
