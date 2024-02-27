<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota',
        'tanggal',
        'kasir_id',
        'keranjang_id'
    ];

    public function cart() {
        return $this->belongsTo(Keranjang::class, 'keranjang_id');
    }

    public function mejaa() {
        return $this->cart->meja();
    }

    public function cartdetail(){
        return $this->cart->keranjangdetail();
    }

    public function kasir() {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
