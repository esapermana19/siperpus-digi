@extends('layouts.app') {{-- Memanggil file layouts/app.blade.php --}}

@section('title', 'Manajemen Kategori') {{-- Mengisi yield('title') --}}

@section('content') {{-- Mengisi yield('content') --}}
    <div class="max-w-4xl mx-auto">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h4 class="text-lg font-semibold text-gray-700 mb-4">Tambah Kategori Baru</h4>
            <form action="{{ url('/kategori') }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" name="nama_kategori"
                    class="flex-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                    placeholder="Nama Kategori..." required>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Simpan</button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKategori as $key => $k)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>
                            <td class="px-6 py-4">{{ $k->nama_kategori }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
