<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class KasirController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'kasir']);
    // }

    public function index()
    {
        $user = auth()->user();
        return view('pages.kasir.index')->with('user', $user);
    }

    public function notrans()
    {
        $lastItem = Transaksi::latest()->first();

        if ($lastItem) {
            $lastCode = $lastItem->nota;
            $lastNo = intval(substr($lastCode, -3));
            $newNo = $lastNo + 1;
            $newCode = 'NOTA' . str_pad($newNo, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'NOTA001';
        }
        return $newCode;
    }

    public function itemm()
    {

        $item = Keranjang::with('meja:id,meja')->where('status', 'proses')->get();
        return response()->json($item);
    }


    public function bayar(Request $request)
    {
        try {
            $vali = Validator::make($request->all(), [
                "tanggal" => "required"
            ], [
                "tanggal.required" => "Tanggal belum diisi"
            ]);
            if ($vali->fails()) {
                return back()->with(['gagal' => $vali->errors()]);
            }

            $byr = new Transaksi;
            $byr->nota = Purify::clean($request->nota);
            $byr->tanggal = Purify::clean($request->tanggal);
            $byr->tunai = Purify::clean($request->tunai);
            $byr->kembali = Purify::clean($request->kembali);
            $byr->kasir_id = Purify::clean($request->idkaa);
            $byr->keranjang_id = Purify::clean($request->idp);
            if ($byr->save()) {
                $cart = Keranjang::findOrFail($request->idp);
                if ($cart) {
                    $cart->status = Purify::clean('selesai');
                    $cart->save();
                }
                Session::put('transaksiId', $byr->id);

                return back()->with(['berhasil' => 'Berhasil Menyelesaikan Pembayaran']);
            } else {
                return back()->with(['gagal' => 'Gagal Menyelesaikan Pembayaran']);
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }
    }

    public function cetaknota(Request $req) {
        $nt = Transaksi::find($req->nota_id);

        if (!$nt) {
            return redirect()->back()->with('error', 'Nota tidak ditemukan');
        }

        $data = compact('nt');

        // Tampilkan view nota
        // $pdf = PDF::loadView('report.nota', $data);

        // Download file PDF
        // return $pdf->download('struk'. $nt->nota .'.pdf');

        $pdf = Pdf::loadHTML(View::make('report.nota', $data));
        return $pdf->stream('STRUK' . $nt->nota . '.pdf');
    }

    public function riwayat()
    {
        return view('pages.kasir.history');
    }

    public function itemh()
    {
        $usr = Auth::id();
        $item = Transaksi::with('kasir', 'cart.meja')->where('kasir_id', $usr)->get();
        return response()->json($item);
    }

    public function filterdata(Request $request)
    {
        $request->validate([
            'tglawal' => 'required|date',
            'tglakhir' => 'required|date|after_or_equal:tglawal'
        ]);

        $tglAw = $request->input('tglawal');
        $tglAk = $request->input('tglakhir');

        $usr = Auth::id();

        $filter =  Transaksi::whereBetween('tanggal', [$tglAw, $tglAk])->where('kasir_id', $usr)->get();

        return view('pages.kasir.filter', compact('filter'));
    }
}
