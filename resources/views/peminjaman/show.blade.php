@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-blue-600 p-6 text-white flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold">Detail Peminjaman</h2>
                <p class="text-blue-100">{{ $peminjaman->kode_peminjaman }}</p>
                <p class="text-lg font-bold text-white">{{ $peminjaman->anggota->name }}</p>
                <p class="text-white">{{ $peminjaman->anggota->nim }}</p>
            </div>
            <a href="{{ route('peminjaman.index') }}"
                class="bg-blue-500 hover:bg-blue-400 px-4 py-2 rounded-lg text-sm transition">Kembali</a>
        </div>

        <div class="p-4 w-full overflow-x-auto border rounded-lg shadow-sm">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm border-b">
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Judul Buku</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Terlambat</th>
                        <th class="py-3 px-4 text-center">Tgl Pengembalian</th>
                        <th class="py-3 px-4 text-center">Keterangan</th>
                        <th class="py-3 px-4 text-center">Denda</th>
                        <th class="py-3 px-4 text-center">Pengembalian</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($peminjaman->details as $detail)
                        @php
                            if ($detail->status == 'kembali') {
                                // Jika sudah kembali, ambil data yang sudah "dikunci" di database
                                $hariTerlambat = $detail->terlambat;
                                $tampilkanDenda = $detail->denda;
                            } else {
                                // Jika masih dipinjam, hitung secara real-time
                                $today = \Carbon\Carbon::today();
                                $jatuhTempo = \Carbon\Carbon::parse($peminjaman->tanggal_kembali);
                                $selisih = $today->diffInDays($jatuhTempo, false);

                                $hariTerlambat = $selisih < 0 ? abs($selisih) : 0;
                                $tampilkanDenda = $hariTerlambat * 1000;
                            }
                        @endphp
                        <tr>
                            <td class="py-4 px-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="py-4 px-4 font-medium text-gray-800">{{ $detail->buku->judul }}</td>
                            <td class="py-4 px-4 text-center">
                                <span
                                    class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full border border-yellow-200">
                                    {{ ucfirst($detail->status) }}
                                </span>
                            </td>

                            <td class="py-4 px-4 text-center">
                                <span
                                    class="px-2 py-1 text-xs font-bold rounded-full border {{ $hariTerlambat > 0 ? 'bg-red-100 text-red-800 border-red-200' : 'bg-green-100 text-green-800 border-green-200' }}">
                                    {{ $hariTerlambat }} Hari
                                </span>
                            </td>

                            <td class="py-4 px-4 text-center text-sm text-gray-600">
                                {{-- Ambil dari kolom tanggal_kembali sesuai database --}}
                                {{ $detail->status == 'kembali' && $detail->tanggal_kembali ? \Carbon\Carbon::parse($detail->tanggal_kembali)->format('d/m/Y') : '-' }}
                            </td>

                            {{-- Kolom Keterangan --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    @if ($detail->status == 'kembali')
                                        {{-- Jika sudah dikonfirmasi, langsung tampilkan Selesai --}}
                                        <span
                                            class="whitespace-nowrap px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200">
                                            Selesai
                                        </span>
                                    @else
                                        {{-- Logika selisih hari hanya untuk yang masih status 'pinjam' --}}
                                        @php
                                            $selisih = \Carbon\Carbon::today()->diffInDays(
                                                \Carbon\Carbon::parse($peminjaman->tanggal_kembali),
                                                false,
                                            );
                                        @endphp

                                        @if ($selisih > 0)
                                            <span
                                                class="whitespace-nowrap px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-700 border border-blue-200">
                                                Belum Jatuh Tempo
                                            </span>
                                        @elseif ($selisih == 0)
                                            <span
                                                class="whitespace-nowrap px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                Jatuh Tempo Hari Ini
                                            </span>
                                        @else
                                            <span
                                                class="whitespace-nowrap px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200">
                                                Terlambat {{ abs($selisih) }} Hari
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if ($detail->status == 'pinjam')
                                    {{-- Tampilan saat masih dipinjam --}}
                                    <span
                                        class="whitespace-nowrap px-3 py-1 text-xs font-bold rounded-full {{ $tampilkanDenda > 0 ? 'bg-red-100 text-red-700 border-red-200' : 'bg-blue-100 text-blue-700 border-blue-200' }} shadow-sm">
                                        Rp {{ number_format($tampilkanDenda, 0, ',', '.') }}
                                    </span>
                                @else
                                    {{-- Tampilan setelah kembali: Denda tetap muncul tapi warna hijau (Selesai) --}}
                                    <span
                                        class="whitespace-nowrap px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200 shadow-sm">
                                        @if ($tampilkanDenda > 0)
                                            Rp {{ number_format($tampilkanDenda, 0, ',', '.') }}
                                        @else
                                            Rp 0
                                        @endif
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if ($detail->status == 'pinjam')
                                    <form action="{{ route('peminjaman.konfirmasi', $detail->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" onclick="return confirm('Konfirmasi pengembalian buku ini?')"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-bold transition shadow-sm">
                                            Konfirmasi
                                        </button>
                                    </form>
                                @else
                                    <span class="text-green-600 font-bold text-xs uppercase tracking-wider">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
