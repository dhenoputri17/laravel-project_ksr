<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class DashboardController extends Controller
{
    public function index(){
        return view('pages.dashboard.dashboard');
    }

    public function showKasir() {
        return view('pages.dashboard.kasir');
    }

    public function akunKasir() {
        $kasir = User::where('role', 'kasir')->get();
        return response()->json($kasir);
    }

    public function kodeKasir()
    {
        $lastItem = User::latest()->first();

        if ($lastItem) {
            $lastCode = $lastItem->code;
            $lastNo = intval(substr($lastCode, -3));
            $newNo = $lastNo + 1;
            $newCode = 'KASIR' . str_pad($newNo, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'KASIR001';
        }
        return $newCode;
    }

    public function simpankasir(Request $request) {
        try {
            $vali = Validator::make($request->all(), [
                "kode_kasir" => "required",
                "nama_kasir" => "required",
                "email_kasir" => "required",
                "pass_kasir" => "required"
            ], [
                "kode_kasir.required" => "Nama belum diisi",
                "nama_kasir.required" => "Nama belum diisi",
                "email_kasir.required" => "Nama belum diisi",
                "pass_kasir.required" => "Nama belum diisi"
            ]);
            if($vali->fails()){
                return back()->with(['gagal' => $vali->errors()]);
            }

            $pass = Purify::clean($request->pass_kasir);

            $ksr = new User;
            $ksr->code = Purify::clean($request->kode_kasir);
            $ksr->name = Purify::clean($request->nama_kasir);
            $ksr->email = Purify::clean($request->email_kasir);
            $ksr->password = password_hash($pass, PASSWORD_BCRYPT);
            $ksr->role = Purify::clean('kasir');
            if($ksr->save()){
                return back()->with(['berhasil' => 'Berhasil menambahkan Akun']);
            }else{
                return back()->with(['gagal' => 'Gagal menambahkan Akun']);
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }
    }

    public function hapuskasir(Request $req) {
        try {
            $vald = Validator::make($req->all(),[
                "id" => "required"
            ]);
            if($vald->fails()){
                return response()->json([
                    'status' => 2,
                    'message' => 'Tidak dapat menemukan data',
                    'title' => 'Informasi'
                ]);
            }

            $kasir = User::findOrfail($req->id);
            if($kasir->delete()){
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

    public function editkasir(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                "nm_kasir" => "required",
                "eml_kasir" => "required"
            ], [
                "nm_kasir.required" => "Nama belum diisi",
                "eml_kasir.required" => "Email belum diisi"
            ]);

            if ($validator->fails()) {
                return back()->with(['gagal' => $validator->errors()]);
            }

            $user = User::findOrFail($request->id);
            $user->name = Purify::clean($request->input('nm_kasir'));
            $user->email = Purify::clean($request->input('eml_kasir'));

            if ($user->save()) {
                return back()->with(['berhasil' => 'Perubahan berhasil disimpan']);
            } else {
                return back()->with(['gagal' => 'Perubahan gagal disimpan']);
            }
        } catch (\Throwable $th) {
            return back()->with(['gagal' => 'Data yang Anda masukkan tidak sesuai']);
        }
    }

    public function laporanStok(){
        $prdk = Produk::all();

        $data = compact('prdk');
        $pdf = Pdf::loadHTML(View::make('report.stok', $data));

        return $pdf->stream('laporan-stok_barang.pdf');
    }

    public function laporanPenjualan(){
        $prd = Produk::all();

        $data = compact('prd');
        $pdf = Pdf::loadHTML(View::make('report.penjualan', $data));

        return $pdf->stream('laporan-penjualan.pdf');
    }
}
