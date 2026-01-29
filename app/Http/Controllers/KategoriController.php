<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class KategoriController extends Controller
{
    //menampilkan halaman kategori
    public function index()
    {
        //mengambil semua data
        $dataKategori = Kategori::all();
        // Mengirim data tersebut ke file view: resources/views/kategori/index.blade.php
        return view('kategori.index', compact('dataKategori'));
    }

    //menampilkan form create
    public function create()
    {
        return view('kategori.create');
    }

    //menyimpan data kategori
    public function store(Request $request)
    {
        //validasi inputan
        $request->validate([
            'kode_kategori' => 'required|string|max:5|unique:kategoris,kode_kategori',
            'nama_kategori' => 'required'
        ], [
            'kode_kategori.max' => 'kode tidak boleh lebih dari 5 karakter',
            'kode_kategori.unique' => 'kode kategori sudah digunakan',
        ]);

        // Perintah SQL Insert otomatis oleh Laravel
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'kode_kategori' => $request->kode_kategori
        ]);
        // 3. TAMBAHKAN BARIS INI: Mencatat log aktivitas tambah
        \App\Models\LogActivity::addToLog('Menambah Kategori baru: ' . $request->nama_kategori);
        // Setelah simpan, balikkan pengguna ke halaman sebelumnya
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    //Hapus data
    public function destroy($id)
    {
        //Mencari datanya berdasarkan id
        $kategori = \App\Models\Kategori::findOrFail($id);
        //SIMPAN namanya ke variabel (Ini kuncinya!)
        $namaKategori = $kategori->nama_kategori;
        //Catat ke Log (Sekarang variabel $namaKategori sudah ada isinya)
        LogActivity::addToLog('Menghapus Kategori: ' . $namaKategori);
        //Hapus Datanya
        $kategori->delete();
        //Redirect ke index
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

    //edit kategori(menampilkan data)
    public function edit($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }
    //update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kategori' => 'required|string|max:5|unique:kategoris,kode_kategori,' . $id,
            'nama_kategori' => 'required'
        ], [
            'kode_kategori.max' => 'kode tidak boleh lebih dari 5 karakter',
            'kode_kategori.unique' => 'kode kategori sudah digunakan',
        ]);

        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'kode_kategori' => $request->kode_kategori
        ]);
        // 3. TAMBAHKAN BARIS INI: Mencatat log aktivitas tambah
        \App\Models\LogActivity::addToLog('Mengubah Kategori: ' . $request->nama_kategori);
        // Setelah simpan, balikkan pengguna ke halaman sebelumnya
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah!');
    }
}
