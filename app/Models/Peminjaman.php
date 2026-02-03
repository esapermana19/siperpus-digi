<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    // Tambahkan baris ini agar Laravel tidak mencari 'peminjamen'
    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_peminjaman',
        'anggota_id',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function details()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }
}
