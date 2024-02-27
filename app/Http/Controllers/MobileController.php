<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class MobileController extends Controller
{
    public function getproduks($kategoriId = null){
        if($kategoriId){
            $produks = Produk::where('kategori_id', $kategoriId)->get();
        } else{
            $produks = Produk::all();
        }
        return response()->json(['data' => $produks]);
    }

    public function getkategori() {
        $kategori = Kategori::all();
        return response()->json(['data' => $kategori]);
    }

    public function addkeranjang(Request $request){
        $request->validate([
            'id_produk' => 'required|exists:produks,id',
            'qty' => 'required|numeric|min:1'
        ]);

        $produk = Produk::findOrFail($request->idProduk);

        $user = Auth::user()->id;
        $keranjang = Keranjang::firstOrCreate(['status' => 'aktif', 'total' => 0, 'user_id' => $user]);

        $keranjang = Keranjang::where('user_id', $user)->where('status', 'aktif')->firstOrNew();
        if (!$keranjang->exists) {
            $keranjang->user_id = Purify::clean($user);
            $keranjang->status = Purify::clean('aktif');
            $keranjang->total = Purify::clean(0);
            $keranjang->save();
        }

        $detail = new KeranjangDetail([
            'produk_id' => Purify::clean($request->id_produk),
            'qty' => Purify::clean($request->qty),
            'subtotal' => Purify::clean($produk->harga * $request->qty)
        ]);

        $keranjang->keranjangdetail()->save($detail);

        return response()->json(['message' => 'Product added to cart successfully']);
    }
}
