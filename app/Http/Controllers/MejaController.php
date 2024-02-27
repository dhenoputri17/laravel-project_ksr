<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class MejaController extends Controller
{

    public function index()
    {
        return view('pages.meja.index');
    }

    public function nomormeja()
    {
        $lastItem = Meja::latest()->first();

        if ($lastItem) {
            $lastCode = $lastItem->meja;
            $lastNo = intval(substr($lastCode, -3));
            $newNo = $lastNo + 1;
            $newCode = 'ME' . str_pad($newNo, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'ME001';
        }
        return $newCode;
    }

    public function store(Request $request)
    {
        try {
            $valida = Validator::make($request->all(), [
                "nomeja" => "required"
            ], [
                "nomeja.required" => "Nama belum diisi"
            ]);
            if ($valida->fails()) {
                return back()->with(['gagal' => $valida->errors()]);
            }

            $meja = new Meja;
            $meja->meja = Purify::clean($request->nomeja);
            if ($meja->save()) {
                return back()->with(['tambah' => 'Berhasil menambahkan Nomor Meja']);
            } else {
                return back()->with(['gagal' => 'Gagal menambahkan Nomor Meja']);
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }
    }

    public function show()
    {
        $mejaa = Meja::all();
        return response()->json($mejaa);
    }

    
    public function destroy(Request $request)
    {
        try {
            $vald = Validator::make($request->all(), [
                "id" => "required"
            ]);
            if ($vald->fails()) {
                return response()->json([
                    'status' => 2,
                    'message' => 'Tidak dapat menemukan data',
                    'title' => 'Informasi'
                ]);
            }

            $meja = Meja::findOrfail($request->id);
            if ($meja->delete()) {
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
}
