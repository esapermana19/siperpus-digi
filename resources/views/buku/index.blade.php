@extends('layouts.app')

@section('title', 'Manajemen Buku')

@section('content')
    <div class="mb-4">
        <a href="{{ route('buku.create') }}"
            class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 rounded text-white px-2 py-2 transition ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-square-plus-icon lucide-square-plus">
                <rect width="18" height="18" x="3" y="3" rx="2" />
                <path d="M8 12h8" />
                <path d="M12 8v8" />
            </svg>
            <span>Tambah Buku</span>
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-left border-b bg-gray-50">
                    <th class="px-6 py-3 tracking-wider">No</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Kode Buku</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Judul Buku</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Penulis</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Penerbit</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Tahun Terbit</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Tersedia</th>
                    <th class="px-6 py-3 text-sm tracking-wider">Dipinjam</th>
                    <th class="px-6 py-3 text-sm tracking-wider w-40 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($buku as $key => $b)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                        <td class="px-6 py-4">{{ $b->kode_buku }}</td>
                        <td class="px-6 py-4">{{ $b->judul }}</td>
                        <td class="px-6 py-4">{{ $b->pengarang }}</td>
                        <td class="px-6 py-4">{{ $b->penerbit }}</td>
                        <td class="px-6 py-4">{{ $b->tahun_terbit }}</td>
                        <td class="px-6 py-4">{{ $b->kategori->nama_kategori }}</td>
                        <td class="px-6 py-4 text-center">{{ $b->stok }}</td>
                        <td class="px-6 py-4 text-center">{{ $b->tersedia }}</td>
                        <td class="px-6 py-4 text-center">{{ $b->dipinjam }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('buku.edit', $b->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 text-sm rounded transition">
                                    Edit</a>
                                <form id="delete-form-{{ $b->id }}" action="{{ route('buku.destroy', $b->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $b->id }}','Buku: ', '{{ $b->judul }}')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 text-sm rounded transition">
                                        Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- <div class="mt-4">
        {{ $buku->links() }}
    </div> --}}
@endsection
