<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('pages.produk.index', compact('kategoris'));
    }


    public function item()
    {
        $produk = Produk::all();
        return response()->json($produk);
    }

    public function code()
    {
        $lastItem = Produk::latest()->first();

        if ($lastItem) {
            $lastCode = $lastItem->kode_produk;
            $lastNo = intval(substr($lastCode, -3));
            $newNo = $lastNo + 1;
            $newCode = 'PD' . str_pad($newNo, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'PD001';
        }
        return $newCode;
    }

    public function store(Request $request)
    {
        try {
            $vali = Validator::make($request->all(), [
                "nama" => "required",
                "awal" => "required",
                "akhir" => "required",
                "minimal" => "required",
                "beli" => "required",
                "jual" => "required",
                "deskripsi" => "required",
                "kategori" => "required"
            ], [
                "nama.required" => "Nama belum diisi",
                "awal.required" => "Stok awal belum diisi",
                "akhir.required" => "Stok akhir belum diisi",
                "minimal.required" => "Stok Minimal belum diisi",
                "beli.required" => "Harga beli belum diisi",
                "jual.required" => "Harga jual belum diisi",
                "deskripsi.required" => "Deskripsi belum ditambahkan",
                "kategori.required" => "Belum ada kategori yang dipilih"
            ]);
            if ($vali->fails()) {
                return back()->with(['gagal' => $vali->errors()]);
            }
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $produks = new Produk;
            $produks->kode_produk = Purify::clean($request->kode);
            $produks->nama_produk = Purify::clean($request->nama);
            $produks->stok_awal = Purify::clean($request->awal);
            $produks->stok_akhir = Purify::clean($request->akhir);
            $produks->stok_minimal = Purify::clean($request->minimal);
            $produks->harga_beli = Purify::clean($request->beli);
            $produks->harga = Purify::clean($request->jual);
            $produks->deskripsi_produk = Purify::clean($request->deskripsi);
            $produks->kategori_id = Purify::clean($request->kategori);
            $produks->status = Purify::clean($request->status);
            $file = $request->file('file');
            $relativePath = 'foto-produk/' . $file->hashName();
            $file->storeAs('public', $relativePath);
            $produks->foto = Purify::clean($relativePath);

            if ($produks->save()) {
                return back()->with(['berhasil' => 'Berhasil menambahkan produk']);
            } else {
                return back()->with(['gagal' => 'Gagal menambahkan produk']);
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }
    }

    public function edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "nama" => "required",
                "awal" => "required",
                "akhir" => "required",
                "minimal" => "required",
                "beli" => "required",
                "jual" => "required",
                "deskripsi" => "required",
                "kategori" => "required",
                'file2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                "nama.required" => "Nama belum diisi",
                "awal.required" => "Stok awal belum diisi",
                "akhir.required" => "Stok akhir belum diisi",
                "minimal.required" => "Stok Minimal belum diisi",
                "beli.required" => "Harga beli belum diisi",
                "jual.required" => "Harga jual belum diisi",
                "deskripsi.required" => "Deskripsi belum ditambahkan",
                "kategori.required" => "Belum ada kategori yang dipilih"
            ]);

            if ($validator->fails()) {
                return back()->with(['gagal' => $validator->errors()]);
            }

            $produk = Produk::findOrFail($request->id);
            $produk->nama_produk = Purify::clean($request->input('nama'));
            $produk->stok_awal = Purify::clean($request->input('awal'));
            $produk->stok_akhir = Purify::clean($request->input('akhir'));
            $produk->stok_minimal = Purify::clean($request->input('minimal'));
            $produk->harga_beli = Purify::clean($request->input('beli'));
            $produk->harga = Purify::clean($request->input('jual'));
            $produk->deskripsi_produk = Purify::clean($request->input('deskripsi'));
            $produk->kategori_id = Purify::clean($request->input('kategori'));

            $file = $request->file('file2');
                $relativePath = 'foto-produk/' . $file->hashName();
                $file->storeAs('public', $relativePath);
                if ($produk->foto) {
                    Storage::delete('public/' . $produk->foto);
                }
                $produk->foto = Purify::clean($relativePath);

                Storage::delete($produk->foto);
            if ($produk->save()) {
                return back()->with(['berhasil' => 'Perubahan berhasil disimpan']);
            } else {
                return back()->with(['gagal' => 'Perubahan gagal disimpan']);
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }
    }

    public function hapus(Request $request)
    {
        try {
            $valid = Validator::make($request->all(), [
                "id" => "required"
            ]);
            if ($valid->fails()) {
                return response()->json([
                    'status' => 2,
                    'message' => 'Tidak dapat menemukan data',
                    'title' => 'Informasi'
                ]);
            }

            $prd = Produk::findOrfail($request->id);
            if ($prd->delete()) {
                Storage::delete('public/' . $prd->foto);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Data berhasil dihapus. !',
                    'title' => 'Informasi',
                ]);
            } else {
                return response()->json([
                    'status'    => 3,
                    'message'   => 'Data gagal dihapus..!',
                    'title' => 'Informasi',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => 3,
                'message'   => 'Data gagal dihapus..!',
                'title' => 'Informasi',
            ]);
        }
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        //;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
