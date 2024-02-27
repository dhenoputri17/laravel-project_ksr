<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function tampilproduk($kategoriId = null) {
        $kategoris = Kategori::all();

        if($kategoriId) {
            $produks = Produk::where('kategori_id', $kategoriId)->get();
        } else{
            $produks = Produk::all();
        }

        $cart = Keranjang::where('status' , 'aktif')->first();
        $jumlahItem = $cart ? $cart->keranjangdetail()->count() : 0;

        return view('pages.beranda.index', compact('produks', 'kategoris' ,'jumlahItem'));
    }

    public function detailproduk($id)  {
        $produk = Produk::find($id);

        if(!$produk){
            abort(404, 'Produk tidak ditemukan');
        }

        $cart = Keranjang::where('status' , 'aktif')->first();
        $jumlahItem = $cart ? $cart->keranjangdetail()->count() : 0;

        return view('pages.beranda.item', compact('produk', 'jumlahItem'));
    }

    public function caridata(Request $request) {
        $keyword = $request->input('p');

        $prd = Produk::where('nama_produk', 'like', "%$keyword%")->orWhere('deskripsi_produk', 'like', "%$keyword%")->get();

        $cart = Keranjang::where('status' , 'aktif')->first();
        $jumlahItem = $cart ? $cart->keranjangdetail()->count() : 0;

        return view('pages.beranda.cari', compact('prd', 'jumlahItem'));
    }

}
