<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'keranjang_id',
        'produk_id',
        'qty',
        'subtotal'
    ];

    public function keranjang() {
        return $this->belongsTo(Keranjang::class);
    }

    public function produk() {
        return $this->belongsTo(Produk::class);
    }

    public function updatedetail($itemdetail, $qty, $harga) {
        $this->attributes['qty'] = $itemdetail->qty + $qty;
        $this->attributes['subtotal'] = $itemdetail->subtotal + ($qty * $harga);
        self::save();
    }
}
