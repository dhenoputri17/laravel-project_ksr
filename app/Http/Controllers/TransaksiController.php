<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kasir = User::where('role', 'kasir')->get();


        $request->validate([
            'tglawal' => 'nullable|date',
            'tglakhir' => 'nullable|date|after_or_equal:tglawal'
        ]);

        $tglAw = $request->input('tglawal');
        $tglAk = $request->input('tglakhir');
        $nmKas = $request->input('namakas');
        $usr = Auth::id();

        $query = Transaksi::query();

        if($tglAw && $tglAk) {
            $query->whereBetween('tanggal', [$tglAw, $tglAk]);
        }

        if ($nmKas) {
            // Jika Anda menyimpan 'id_kasir' pada tabel 'Transaksi'
            $query->whereHas('kasir', function ($subquery) use ($nmKas) {
                $subquery->where('name', 'like', '%' . $nmKas . '%');
            });
        }

        $data = $query->get();

        return view('pages.transaksi.index', compact('kasir', 'data', 'tglAw', 'tglAk', 'nmKas'));
    }

    public function cetaklapor(Request $req){
        $validasi = Validator::make($req->all(), [
            
        ]);
    }

}
