<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth', 'checkRole:pelanggan']], function () {
    Route::get('/', [BerandaController::class, 'tampilproduk']);
    Route::get('/produk/kategori/{kategoriId}', [BerandaController::class, 'tampilproduk']);
    Route::get('/produk/cari', [BerandaController::class, 'caridata']);

    Route::get('/keranjang', [KeranjangController::class, 'index']);

    Route::get('/item/{id}', [BerandaController::class, 'detailproduk'])->name('produk.detailproduk');

    Route::post('keranjangdetail/update/{id}', [KeranjangController::class, 'update'])->name('keranjangdetail.update');
    Route::post('keranjangdetail/hapus/{id}', [KeranjangController::class, 'hapusdetail'])->name('keranjangdetail.hapusdetail');
    Route::post('/tambah-keranjang', [KeranjangController::class, 'store']);
    Route::post('/chekout', [KeranjangController::class, 'chekout']);
});


Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('item-produk', [ProdukController::class, 'item']);
    Route::get('list-kategori', [KategoriController::class, 'kategori']);

    Route::post('/simpan-produk', [ProdukController::class, 'store']);
    Route::post('/rubah-produk', [ProdukController::class, 'edit']);
    Route::post('/simpan-kategori', [KategoriController::class, 'store']);

    Route::delete('/hapus-produk', [ProdukController::class, 'hapus']);
    Route::delete('/hapus-kategori', [KategoriController::class, 'hapus']);

    Route::get('/meja', [MejaController::class, 'index']);
    Route::post('/meja-tambah', [MejaController::class, 'store']);
    Route::get('list-meja', [MejaController::class, 'show']);
    Route::delete('/hapus-meja', [MejaController::class, 'destroy']);

    Route::get('/kasirr', [DashboardController::class, 'showKasir']);
    Route::get('data-kasir', [DashboardController::class, 'akunKasir']);
    Route::post('/simpan-kasir', [DashboardController::class, 'simpankasir']);
    Route::delete('/hapus-kasir', [DashboardController::class, 'hapuskasir']);
    Route::post('/ubah-kasir', [DashboardController::class, 'editkasir']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi-filter', [TransaksiController::class, 'index']);

    Route::get('/laporan-stok_barang', [DashboardController::class, 'laporanStok']);
    Route::get('/laporan-penjualan_barang', [DashboardController::class, 'laporanPenjualan']);
});

Route::group(['middleware' => ['auth', 'checkRole:kasir']], function () {
    Route::get('/kasir', [KasirController::class, 'index']);
    Route::get('item-bayar', [KasirController::class, 'itemm']);
    Route::get('/kasir-history', [KasirController::class, 'riwayat']);
    Route::get('list-history', [KasirController::class, 'itemh']);

    Route::get('/kasir-filter', [KasirController::class, 'filterdata']);

    Route::post('/selesai-bayar', [KasirController::class, 'bayar']);

    Route::get('/cetak-nota', [KasirController::class, 'cetaknota']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = response($file, 200)->header('Content-Type', $type);

    return $response;
});
