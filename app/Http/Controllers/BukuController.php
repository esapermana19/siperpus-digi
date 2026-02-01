<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnArgument;

class BukuController extends Controller
{
    //menampilkan halaman buku
    public function index(Request $request)
    {
        $search = $request->input('search');
        $buku = \App\Models\Buku::with('kategori')
        ->when($search, function($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('pengarang', 'like', "%{$search}%")
                        ->orWhere('penerbit', 'like', "%{$search}%");

        })
        ->get();
        return view('buku.index',compact('buku'));
    }

        //menampilkan form create buku
        public function create()
        {
            $kategori = \App\Models\Kategori::all();
            return view('buku.create',compact('kategori'));
        }

        //menyimpan buku
        public function store(Request $request)
        {
            $request->validate([
                'judul' => 'required',
                'pengarang' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required',
                'kategori_id' => 'required',
            ]);
            $kategori = \App\Models\Kategori::findOrFail($request->kategori_id);
            $prefix = $kategori->kode_kategori;
            $urutan = \App\Models\Buku::where('kategori_id', $request->kategori_id)->count();
            $nomorUrut = str_pad($urutan, 3, '0', STR_PAD_LEFT);
            $kodeBukuOtomatis = $prefix .'-'. $nomorUrut;

            \App\Models\Buku::create([
                'kode_buku' => $kodeBukuOtomatis,
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'tersedia' => $request->stok,
                'dipinjam' => 0
            ]);
            // 3. TAMBAHKAN BARIS INI: Mencatat log aktivitas tambah
            \App\Models\LogActivity::addToLog('Menambah Buku baru: ' . $request->judul);
            // Setelah simpan, balikkan pengguna ke halaman sebelumnya
            return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
        }
        //Hapus data
        public function destroy($id)
        {
            //Mencari datanya berdasarkan id
            $buku = \App\Models\Buku::findOrFail($id);
            //SIMPAN namanya ke variabel (Ini kuncinya!)
            $namaBuku = $buku->judul;
            //Catat ke Log (Sekarang variabel $namaBuku sudah ada isinya)
            \App\Models\LogActivity::addToLog('Menghapus Buku: ' . $namaBuku);
            //Hapus Datanya
            $buku->delete();
            //Redirect ke index
            return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
        }

        //menampilkan form edit buku
        public function edit($id)
        {
            $buku = \App\Models\Buku::findOrFail($id);
            $kategori = \App\Models\Kategori::all();
            return view('buku.edit',compact('buku','kategori'));
        }

        //update
        public function update(Request $request,$id)
        {
            request()->validate([
                'judul' => 'required',
                'pengarang' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required',
                'kategori_id' => 'required',
                'stok' => 'required',
            ]);
            $buku = \App\Models\Buku::findOrFail($id);
            $buku->update([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
            ]);
            // 3. TAMBAHKAN BARIS INI: Mencatat log aktivitas tambah
            \App\Models\LogActivity::addToLog('Mengubah Buku: ' . $request->judul);
            return redirect()->route('buku.index')->with('success', 'Buku berhasil diubah!');
        }

}
