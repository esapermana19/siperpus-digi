@extends('layouts.app') {{-- Memanggil file layouts/app.blade.php --}}

@section('title', 'Manajemen Anggota') {{-- Mengisi yield('title') --}}

@section('content') {{-- Mengisi yield('content') --}}
    <div class="max-w-4xl mx-auto">
        <div class="mb-4 flex gap-2">
            <a href="{{ route('anggota.create') }}"
                class="inline-flex gap-1 px-4 items-center bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-square-plus-icon lucide-square-plus">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M8 12h8" />
                    <path d="M12 8v8" />
                </svg>
                <span>Tambah</span>
            </a>
            <form action="{{ route('anggota.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, kelas, atau nim..."
                    class="p-2 border border-gray-500 rounded-md focus:ring-2 focus:ring-blue-500 outline-none w-64">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('anggota.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                        Reset
                    </a>
                @endif
            </form>
        </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">NIM</th>
                        <th class="px-6 py-3">Nama Anggota</th>
                        <th class="px-6 py-3">Jenis Kelamin</th>
                        <th class="px-6 py-3">Kelas</th>
                        <th class="px-6 py-3">Jurusan</th>
                        <th class="px-6 py-3 w-40 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_anggota as $key => $k)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>
                            <td class="px-6 py-4">{{ $k->nim }}</td>
                            <td class="px-6 py-4">{{ $k->name }}</td>
                            <td class="px-6 py-4">{{ $k->jenis_kelamin }}</td>
                            <td class="px-6 py-4">{{ $k->kelas }}</td>
                            <td class="px-6 py-4">{{ $k->jurusan }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('anggota.edit', $k->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 text-sm rounded transition">
                                        Edit</a>
                                    <form id="delete-form-{{ $k->id }}"
                                        action="{{ route('anggota.destroy', $k->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $k->id }}','Anggota: ', '{{ $k->name }}')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 text-sm rounded transition">
                                            Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
