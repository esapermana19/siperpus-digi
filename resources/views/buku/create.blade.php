@extends('layouts.app')

@section('title', 'Manajemen Buku')

@section('content')
    <div class="mb-4">
        <a href="{{ route('buku.index') }}"
            class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 rounded text-white px-2 py-2 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left-icon lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h4 class="mb-4 text-lg font-semibold text-gray-700">Tambah Buku Baru</h4>
        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2">
                <div class="grid grid-cols-2 mb-4">
                    <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul Buku</label><br>
                    <input type="text" name="judul" id="judul"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Judul Buku..." required>
                </div>
                <div class="grid grid-cols-2 mb-4">
                    <label for="pengarang" class="block text-gray-700 font-semibold mb-2">Pengarang</label><br>
                    <input type="text" name="pengarang" id="pengarang"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Pengarang..." required>
                </div>
                <div class="grid grid-cols-2 mb-4">
                    <label for="penerbit" class="block text-gray-700 font-semibold mb-2">Penerbit</label><br>
                    <input type="text" name="penerbit" id="penerbit"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Penerbit..." required>
                </div>
                <div class="grid grid-cols-2 mb-4">
                    <label for="tahun_terbit" class="block text-gray-700 font-semibold mb-2">Tahun Terbit</label><br>
                    <select name="tahun_terbit" id=""
                        class="text-gray-700 w-full p-2 border border-gray-300 rounded-md outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">--Pilih Tahun--</option>
                        @foreach (range(date('Y'), 1990) as $tahun)
                            <option value="{{ $tahun }}" {{ old('tahun_terbit') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 mb-4">
                    <label for="kategori_id" class="block text-gray-700 font-semibold mb-2">Kategori</label><br>
                    <input type="text" name="kategori_id" id="kategori_id"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Kategori..." required>
                </div>
                <div class="grid grid-cols-2 mb-4">
                    <label for="stok" class="block text-gray-700 font-semibold mb-2">Stok</label><br>
                    <input type="text" name="stok" id="stok"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Stok..." required>
                </div>
                <div class="grid grid-cols-2 mb-4">
                    <label for="tersedia" class="block text-gray-700 font-semibold mb-2">Tersedia</label><br>
                    <input type="text" name="tersedia" id="tersedia"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Tersedia..." required>
                </div>
                <div class="grid grid-cols-2 mb-4">
                    <label for="dipinjam" class="block text-gray-700 font-semibold mb-2">Dipinjam</label><br>
                    <input type="text" name="dipinjam" id="dipinjam"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Dipinjam..." required>
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center gap-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                <span>Simpan</span>
            </button>
            <button type="reset"
                class="inline-flex items-center gap-1 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                <span>Reset</span>
            </button>
        </form>
    </div>
@endsection
