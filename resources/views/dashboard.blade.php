@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-8 rounded-3xl shadow-lg">
    <h2 class="text-2xl font-bold text-primary mb-4">Selamat Datang, Admin!</h2>
    <p class="text-slate-600">Ini adalah halaman dashboard Perpustakaan LP3I.</p>

    <div class="grid md:grid-cols-3 gap-6 mt-8">
        <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
            <h3 class="text-blue-800 font-bold text-lg">Total Buku</h3>
            <p class="text-3xl font-black text-blue-900">120</p>
        </div>
        <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
            <h3 class="text-red-800 font-bold text-lg">Peminjaman</h3>
            <p class="text-3xl font-black text-red-900">12</p>
        </div>
        <div class="bg-teal-50 p-6 rounded-2xl border border-teal-100">
            <h3 class="text-teal-800 font-bold text-lg">Anggota</h3>
            <p class="text-3xl font-black text-teal-900">45</p>
        </div>
    </div>
</div>
@endsection
