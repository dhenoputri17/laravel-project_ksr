<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'deskripsi_produk',
        'foto',
        'stok_awal',
        'stok_minimal',
        'stok_akhir',
        'harga_beli',
        'harga',
        'status'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
