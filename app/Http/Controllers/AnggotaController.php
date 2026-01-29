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
        $anggota = new \App\Models\Anggota;
        $anggota->nim = $request->nim;
        $anggota->name = $request->name;
        $anggota->jenis_kelamin = $request->jenis_kelamin;
        $anggota->kelas = $request->kelas;
        $anggota->jurusan = $request->jurusan;
        $anggota->save();
        return redirect()->route('anggota.index');
    }
}
