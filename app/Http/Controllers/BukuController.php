<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    //menampilkan halaman buku
    public function index()
    {
        $buku = \App\Models\Buku::all();
        return view('buku.index',compact('buku'));
    }

    //menampilkan form create buku
    public function create()
    {
        return view('buku.create');
    }
}
