@extends('layouts.app')

@section('content')
<p>Jumlah Anggota: {{ count($anggotas) }}</p>
<p>Jumlah Buku: {{ count($bukus) }}</p>
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6">Tambah Peminjaman</h2>

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Kode Peminjaman</label>
                    <input type="text" name="kode_peminjaman" value="{{ $kode }}" readonly
                        class="w-full p-2 bg-gray-100 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Anggota</label>
                    <select name="anggota_id" required class="w-full p-2 border rounded">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($anggotas as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Tanggal Pinjam</label>
                    <input type="text" value="{{ date('d/m/Y') }}" readonly
                        class="w-full p-2 bg-gray-100 border rounded">
                </div>
            </div>

            <div class="mb-6 w-1/3">
                <label class="block text-sm font-semibold mb-1">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" required min="{{ date('Y-m-d') }}"
                    class="w-full p-2 border rounded">
            </div>

            <h3 class="font-bold mb-2">Daftar Buku</h3>
            <table class="w-full border mb-4" id="tableBuku">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left border">Buku</th>
                        <th class="p-2 text-center border w-20">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="item-buku">
                        <td class="p-2 border">
                            <select name="buku_ids[]" required class="w-full p-1 border rounded">
                                <option value="">-- Pilih Buku --</option>
                                {{-- Gunakan $bukus (dengan 's' di akhir) --}}
                                @foreach ($bukus as $buku)
                                    <option value="{{ $buku->id }}">{{ $buku->judul }} (Tersedia:
                                        {{ $buku->tersedia }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="p-2 border text-center">
                            <button type="button"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 btn-hapus">X</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" id="addBaris"
                class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm mb-6 hover:bg-green-700">+ Tambah Buku</button>

            <div class="mt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700">Simpan
                    Peminjaman</button>
            </div>
        </form>
    </div>

    <script>
        // Fungsi Tambah Baris
        document.getElementById('addBaris').addEventListener('click', function() {
            let table = document.getElementById('tableBuku').getElementsByTagName('tbody')[0];
            let newRow = table.rows[0].cloneNode(true);
            // Reset pilihan select di baris baru
            newRow.getElementsByTagName('select')[0].selectedIndex = 0;
            table.appendChild(newRow);
        });

        // Fungsi Hapus Baris (Delegation)
        document.getElementById('tableBuku').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-hapus')) {
                let rowCount = document.querySelectorAll('.item-buku').length;
                if (rowCount > 1) {
                    e.target.closest('tr').remove();
                } else {
                    alert("Minimal harus ada satu buku yang dipinjam!");
                }
            }
        });
    </script>
@endsection
