@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <div class="mb-4">
                <h2 class="text-xl font-bold text-gray-800">Daftar Peminjaman</h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('peminjaman.create') }}"
                    class="inline-flex gap-1 items-center bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md leading-tight uppercase text-sm text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-square-plus-icon lucide-square-plus">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M8 12h8" />
                        <path d="M12 8v8" />
                    </svg>
                    <span>Tambah</span>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">No</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Kode</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Peminjam</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Tanggal Pinjam</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Batas Kembali</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Jumlah Buku</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($peminjamans as $p)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-bold">{{ $p->kode_peminjaman }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="font-medium text-gray-900">{{ $p->anggota->name }}</div>
                                <div class="text-xs text-gray-500">{{ $p->anggota->nim }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                                    {{ $p->details->count() }} Buku
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('peminjaman.show', $p->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 font-medium text-white text-xs px-2 py-2 rounded-lg">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">Belum ada transaksi peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
