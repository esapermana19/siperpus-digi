<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'kode_buku',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'stok',
        'tersedia',
        'dipinjam'
    ];

    public function kategori()
{
    // Pastikan nama modelnya 'Kategori' dan foreign key-nya 'kategori_id'
    return $this->belongsTo(Kategori::class, 'kategori_id');
}
}
