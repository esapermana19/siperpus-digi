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
        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2">
                <div class="grid grid-cols-2 mt-4">
                    <label for="">NIM</label><br>
                    <input type="text" name="nim" value="{{ $anggota->nim }}"
                        class="p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="NIM..." required>
                </div>
                <div class="grid grid-cols-2 mt-4">
                    <label for="">Nama</label><br>
                    <input type="text" name="name" value="{{$anggota->name}}"
                        class="p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Nama Kategori..." required>
                </div>
                <div class="grid grid-cols-2 mt-4 ">
                    <label for="">Jenis Kelamin</label><br>
                    <select name="jenis_kelamin" id=""
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none">Jenis
                        Kelamin
                        <option value="Laki-laki" {{ $anggota->jenis_kelamin == 'Laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                        <option value="Perempuan" {{ $anggota->jenis_kelamin == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 mt-4 ">
                    <label for="">Kelas</label><br>
                    <input type="text" name="kelas" value="{{$anggota->kelas}}"
                        class="mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Kelas...">
                </div>
                <div class="grid grid-cols-2 mt-4">
                    <label for="">Jurusan</label><br>
                    <input type="text" name="jurusan" value="{{$anggota->jurusan}}"
                        class="p-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Jurusan">
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center gap-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                <span>Simpan</span>
            </button>
        </form>
    </div>
@endsection
