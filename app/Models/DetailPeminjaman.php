<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjamans';
    protected $fillable = [
        'peminjaman_id',
        'buku_id',
        'jumlah_pinjam',
        'status',
        'tanggal_kembali',
        'terlambat',
        'denda'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // Relasi balik ke Peminjaman (Opsional tapi disarankan)
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
