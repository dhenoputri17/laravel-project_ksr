<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('pages.kategori.index');

    }

    public function kategori() {
        $ktr = Kategori::all();
        return response()->json($ktr);
    }

    public function hapus(Request $request)
    {
        try {
            $vald = Validator::make($request->all(),[
                "id" => "required"
            ]);
            if($vald->fails()){
                return response()->json([
                    'status' => 2,
                    'message' => 'Tidak dapat menemukan data',
                    'title' => 'Informasi'
                ]);
            }

            $ktg = Kategori::findOrfail($request->id);
            if($ktg->delete()){
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $vali = Validator::make($request->all(), [
                "namak" => "required"
            ], [
                "namak.required" => "Nama belum diisi"
            ]);
            if($vali->fails()){
                return back()->with(['gagal' => $vali->errors()]);
            }

            $ktr = new Kategori;
            $ktr->nama_kategori = Purify::clean($request->namak);
            if($ktr->save()){
                return back()->with(['berhasil' => 'Berhasil menambahkan kategori']);
            }else{
                return back()->with(['gagal' => 'Gagal menambahkan kategori']);
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
