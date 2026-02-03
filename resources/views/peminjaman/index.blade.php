@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Peminjaman</h2>
            <p class="text-sm text-gray-500">Kelola transaksi peminjaman buku anggota.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Tambah Peminjaman
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">No</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Kode</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Peminjam</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Buku</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Tgl Pinjam</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600">Batas Kembali</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($peminjamans as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-blue-600">{{ $p->kode_peminjaman }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="font-medium text-gray-900">{{ $p->anggota->name }}</div>
                        <div class="text-xs text-gray-500">{{ $p->anggota->nim }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                            {{ $p->details->count() }} Buku
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('peminjaman.show', $p->id) }}" class="text-blue-500 hover:text-blue-700 font-medium">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">Belum ada transaksi peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
