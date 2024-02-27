<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'total',
        'meja_id',
        'status',
        'user_id'
    ];

    public function keranjangdetail() {
        return $this->hasMany(KeranjangDetail::class);
    }

    public function meja() {
        return $this->belongsTo(Meja::class, 'meja_id');
    }

    public function pelanggan(){
        return $this->belongsTo(User::class);
    }

    public function updatetotal($itemcart, $subtotal) {
        $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
        $this->attributes['total'] = $itemcart->total + $subtotal;
        self::save();
    }

    public function hitungTotal()
    {
        $total = 0;

        foreach ($this->keranjangdetail as $detail) {
            $total += $detail->qty * $detail->produk->harga;
        }

        return $total;
    }
}
