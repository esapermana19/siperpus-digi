<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    //menampilkan data
    public function index()
    {
        $data_anggota = \App\Models\Anggota::all();
        return view('anggota.index',compact('data_anggota'));
    }

    //menampilkan form create anggota
    public function create()
    {
        return view('anggota.create');
    }

    //menyimpan data anggota
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:9|unique:anggotas,nim',
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required'
        ],
        [
            'nim.max' => 'NIM tidak boleh lebih dari 9 karakter',
            'nim.unique' => 'NIM sudah digunakan'
        ]);
        $anggota = new \App\Models\Anggota;
        $anggota->nim = $request->nim;
        $anggota->name = $request->name;
        $anggota->jenis_kelamin = $request->jenis_kelamin;
        $anggota->kelas = $request->kelas;
        $anggota->jurusan = $request->jurusan;
        $anggota->save();

        // 3. TAMBAHKAN BARIS INI: Mencatat log aktivitas tambah
        \App\Models\LogActivity::addToLog('Menambah Anggota baru: ' . $request->name);
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    //menngambil data untuk form edit
    public function edit($id)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);
        return view('anggota.edit',compact('anggota'));
    }

    //update anggota
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:9|unique:anggotas,nim,' . $id,
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required'
        ],
        [
            'nim.max' => 'NIM tidak boleh lebih dari 9 karakter',
            'nim.unique' => 'NIM sudah digunakan'
        ]);
        $anggota = \App\Models\Anggota::findOrFail($id);
        $anggota->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan
        ]);
        // 3. TAMBAHKAN BARIS INI: Mencatat log aktivitas tambah
        \App\Models\LogActivity::addToLog('Mengubah Anggota: ' . $request->name);
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diubah!');
    }

    //menghapus anggota
    public function destroy($id)
    {
        $anggota = \App\Models\Anggota::findOrFail($id);
        $anggota->delete();
        // 3. TAMBAHKAN BARIS INI: Mencatat log aktivitas tambah
        \App\Models\LogActivity::addToLog('Menghapus Anggota: ' . $anggota->name);
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
