<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use App\Models\Meja;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Auth;

class MobileController extends Controller
{
    public function getproduks($kategoriId = null)
    {
        if ($kategoriId) {
            $produks = Produk::where('kategori_id', $kategoriId)->get();
        } else {
            $produks = Produk::all();
        }
        return response()->json(['data' => $produks]);
    }

    public function getkategori()
    {
        $kategori = Kategori::all();
        return response()->json(['data' => $kategori]);
    }

    public function getKeranjang($idUser)
    {
        $troli = Keranjang::with('keranjangdetail.produk')->where('status', 'aktif')->where('user_id', $idUser)->firstOrNew();
        $dataproduk = $troli->keranjangdetail->pluck('produk');

        return response()->json(['data' => $dataproduk]);
    }

    public function dataCart($idUser)
    {
        $troli = Keranjang::where('status', 'aktif')->where('user_id', $idUser)->firstOrNew();
        return response()->json(['data' => $troli]);
    }

    public function dataDetail($idUser)
    {
        $troli = Keranjang::where('status', 'aktif')->where('user_id', $idUser)->first();
        $detail = KeranjangDetail::where('keranjang_id', $troli->id)->firstOrNew();
        return response()->json(['data' => $detail]);
    }

    public function dataMeja()
    {
        $meja = Meja::all();
        return response()->json(['data' => $meja]);
    }


    public function cartProses(Request $request)
    {
        $usr = $request->input('idUser');
        $troli = Keranjang::with('keranjangdetail.produk')->where('status', 'proses')->where('user_id', $usr)->firstOrNew();
        return response()->json(['data' => $troli]);
    }
    public function cartSelesai(Request $request)
    {
        $usr = $request->input('idUser');
        $troli = Keranjang::with('keranjangdetail.produk')->where('status', 'selesai')->where('user_id', $usr)->firstOrNew();
        return response()->json(['data' => $troli]);
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
            'pass' => 'required|string'
        ]);

        $email = $request->input('mail');
        $password = $request->input('pass');

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password) && $user->role == 'pelanggan') {
            $accessToken = $user->createToken('authToken')->accessToken;
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'role' => $user->role
            ];
            return response()->json(['message' => 'login berhasil', 'user' => $userData, 'access_token' => $accessToken], 200);
        } else {
            return response()->json(['message' => 'login gagal, username & password tidak sesuai'], 200);
        }
        return response()->json(['message' => 'Login gagal, Silahkan coba lagi'], 401);
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'pass' => 'required|string'
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $role = "pelanggan";
        $password = $request->input('pass');


        $newUser = new User;
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = Hash::make($password);
        $newUser->role = $role;

        if ($newUser->save()) {
            return response()->json(['message' => 'register berhasil']);
        } else {
            return response()->json(['message' => 'register gagal']);
        }
    }




    public function searchdata(Request $request)
    {
        $keyword = $request->input('p');

        $prd = Produk::where('nama_produk', 'like', "%$keyword%")->get();
        return response()->json(['data' => $prd]);
    }

    public function addkeranjang(Request $request)
    {
        $user = $request->input('userId');
        $barang = $request->input('produkId');
        $qty = $request->input('quantity');

        $cartAktif = Keranjang::where('user_id', $user)->where('status', 'aktif')->first();
        if (!$cartAktif) {
            $cartAktif = new Keranjang;
            $cartAktif->user_id = $user;
            $cartAktif->status = "aktif";
            $cartAktif->total = 0;
            $cartAktif->save();
        }

        $produk = Produk::findOrFail($barang);
        $subtotal = $qty * $produk->harga;

        $detail = $cartAktif->keranjangdetail()->updateOrCreate(
            ['produk_id' => $barang],
            ['qty' => $qty, 'subtotal' => $subtotal]
        );

        $cartAktif->total += $detail->subtotal;
        $cartAktif->save();

        return response()->json(['message' => 'Berhasil menambahkan detail keranjang']);
    }

    public function hapusItem(Request $request)
    {

        $idUser = $request->input('user');
        $id = $request->input('produk');
        $troli = Keranjang::where('status', 'aktif')->where('user_id', $idUser)->first();
        $idCart = $troli->id;
        $item = KeranjangDetail::where('keranjang_id', $idCart)->where('produk_id', $id)->first();
        $total = $troli->total;
        $produk = Produk::where('id', $id)->first();
        $total_harga = $produk->harga * $item->qty;

        if ($item->delete()) {
            $troli->total = $total - $total_harga;
            $troli->save();
            return response()->json(['message' => 'item berhasil dihapus dari keranjang']);
        } else {
            return response()->json(['message' => 'gagal menghapus item'], 500);
        }
    }

    public function chekoutPesan(Request $request)
    {
        try {
            $user = $request->input('userId');
            $meja = $request->input('noMeja');
            $total = $request->input('total');

            $keranjang = Keranjang::where('user_id', $user)->where('status', 'aktif')->first();
            if (!$keranjang) {
                return response()->json(['message' => 'Keranjang tidak ditemukan'], 404);
            }

            $keranjang->meja_id = $meja;
            $keranjang->total = $total;
            $keranjang->status = 'proses';

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

                return response()->json(['message' => 'chekout berhasil'], 200);
            } else {
                return response()->json(['message' => 'chekout gagal'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'chekout gagal, coba lagi'], 500);
        }
    }

    public function tambahQty(Request $request)
    {
        try {
            $idUser = $request->input('userId');
            $idProduk = $request->input('produkId');

            $troli = Keranjang::where('status', 'aktif')->where('user_id', $idUser)->first();
            $idCart = $troli->id;
            $item = KeranjangDetail::where('keranjang_id', $idCart)->where('produk_id', $idProduk)->first();

            if ($item) {
                $item->qty += 1;
                $item->save();

                return response()->json(['message' => 'berhasil tambah'], 200);
            } else {
                return response()->json(['message' => 'gagal, tidak ditemukan'], 404);
                // return response()->json(['data' => $idUser], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'terjadi kesalahan dalam proses'], 500);
        }
    }

    public function kurangQty(Request $request)
    {
        try {
            $idUser = $request->input('userId');
            $idProduk = $request->input('produkId');

            $troli = Keranjang::where('status', 'aktif')->where('user_id', $idUser)->first();
            $idCart = $troli->id;
            $item = KeranjangDetail::where('keranjang_id', $idCart)->where('produk_id', $idProduk)->first();

            if ($item) {
                $item->qty -= 1;
                $item->save();

                return response()->json(['message' => 'berhasil kurang'], 200);
            } else {
                return response()->json(['message' => 'gagal, tidak ditemukan'], 404);
                // return response()->json(['data' => $idCart], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'terjadi kesalahan dalam proses'], 500);
        }
    }
}
