<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class KategoriController extends Controller
{
    //menampilkan halaman kategori
    public function index() {
        //mengambil semua data
        $dataKategori = Kategori::all();
        // Mengirim data tersebut ke file view: resources/views/kategori/index.blade.php
        return view('kategori.index', compact('dataKategori'));
    }
    
    //menyimpan data kategori
    public function store(Request $request){
        //validasi inputan
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        // Perintah SQL Insert otomatis oleh Laravel
        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        // Setelah simpan, balikkan pengguna ke halaman sebelumnya
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }
}
