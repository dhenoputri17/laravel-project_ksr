<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use App\Models\Meja;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('keranjangdetail.produk')->where('status', 'aktif')->firstOrNew();

        $mejas = Meja::all();

        $cart = Keranjang::where('status', 'aktif')->firstOrNew();
        $jumlahItem = $cart ? $cart->keranjangdetail()->count() : 0;

        return view('pages.keranjang.index', compact('keranjang', 'mejas', 'jumlahItem'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id',
            'qty' => 'required|numeric|min:1'
        ]);

        $produk = Produk::findOrFail($request->id_produk);

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

        return back()->with(['berhasil' => 'Berhasil menambahkan produk']);
    }

    public function update(Request $request, $id)
    {
        $itemdetail = KeranjangDetail::findOrFail($id);
        $param = $request->param;

        if ($param == 'tambah') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->produk->harga);
            return back()->with('success', 'Item berhasil diupdate');
        }
        if ($param == 'kurang') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, '-' . $qty, $itemdetail->produk->harga);
            return back()->with('success', 'Item berhasil diupdate');
        }
    }

    public function hapusdetail($id)
    {
        $item = KeranjangDetail::findOrFail($id);
        if ($item->delete()) {
            return back()->with('success', 'Item berhasil dihapus');
        } else {
            return back()->with('error', 'Item gagal dihapus');
        }
    }

    public function chekout(Request $request)
    {
        try {
            $vali = Validator::make($request->all(), [
                'no_meja' => 'required',
            ], [
                "no_meja.required" => "Tanggal belum diisi"
            ]);
            if ($vali->fails()) {
                return back()->with(['gagalm' => $vali->errors()]);
            }

            $keranjang = Keranjang::where('status', 'aktif')->first();

            if ($keranjang) {
                $keranjang->total = Purify::clean($keranjang->hitungTotal());
                $keranjang->meja_id = Purify::clean($request->no_meja);
                $keranjang->status = Purify::clean('proses');

                if ($keranjang->save()) {
                    foreach ($keranjang->keranjangdetail as $cart) {
                        $barang = $cart->produk;
                        $barang->stok_akhir -= $cart->qty;

                        $stokmin = $barang->stok_minimal;
                        if ($barang->stok_akhir <= $stokmin) {
                            $barang->status = 'Habis';
                        }

                        $barang->save();
                    }
                    return back()->with(['berhasil' => 'Chekout Berhasil']);
                } else {
                    return back()->with(['gagal' => 'Chekout Gagal']);
                }
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }

    }
}
