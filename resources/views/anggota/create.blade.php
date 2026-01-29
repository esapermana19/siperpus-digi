@extends('layouts.app') {{-- Memanggil file layouts/app.blade.php --}}
@section('title', 'Manajemen Kategori') {{-- Mengisi yield('title') --}}
@section('content') {{-- Mengisi yield('content') --}}
    <div class="mb-4">
        <a href="{{ route('anggota.index') }}"
            class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 rounded text-white px-2 py-2 transition ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left-icon lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Tambah Anggota Baru</h4>
        <form action="{{ route('anggota.store') }}" method="POST" class="flex gap-4">
            @csrf
            <input type="text" name="kode_anggota"
                class="flex-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                placeholder="Kode Kategori..." required>
            <input type="text" name="nama_anggota"
                class="flex-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                placeholder="Nama Kategori..." required>
            <button type="submit" class="inline-flex items-center gap-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                <span>Simpan</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-save-icon lucide-save">
                    <path
                        d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                    <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                    <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                </svg>
            </button>
        </form>
    </div>
@endsection
