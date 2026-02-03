<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Ubah 'detail_peminjamans' menjadi 'details' sesuai nama fungsi di Model Peminjaman
        $peminjamans = Peminjaman::with(['anggota', 'details.buku'])->latest()->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $anggotas = \App\Models\Anggota::orderBy('name', 'asc')->get();
        $bukus = \App\Models\Buku::where('tersedia', '>', 0)->orderBy('judul', 'asc')->get();

        // Konsisten gunakan format PJM sesuai desain form kamu
        $nextId = Peminjaman::count() + 1;
        $kode = 'PJM/' . date('Ymd') . '/' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        return view('peminjaman.create', compact('anggotas', 'bukus', 'kode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'buku_ids' => 'required|array',
            'buku_ids.*' => 'exists:bukus,id',
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Gunakan kode_peminjaman dari input form agar sesuai dengan yang digenerate
                $peminjaman = Peminjaman::create([
                    'kode_peminjaman' => $request->kode_peminjaman,
                    'anggota_id' => $request->anggota_id,
                    'tanggal_pinjam' => now(),
                    'tanggal_kembali' => $request->tanggal_kembali,
                ]);

                foreach ($request->buku_ids as $id_buku) {
                    DetailPeminjaman::create([
                        'peminjaman_id' => $peminjaman->id,
                        'buku_id' => $id_buku,
                        'jumlah_pinjam' => 1,
                        'status' => 'pinjam',
                    ]);

                    $buku = Buku::findOrFail($id_buku);
                    if ($buku->tersedia > 0) {
                        $buku->decrement('tersedia');
                        $buku->increment('dipinjam');
                    }
                }
            });

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
