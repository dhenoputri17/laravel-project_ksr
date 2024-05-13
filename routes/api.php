<?php

use App\Http\Controllers\MobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware(['cors'])->group(function () {
    Route::get('/produk/{kategoriId?}', [MobileController::class, 'getproduks']);
    Route::get('/kategori', [MobileController::class, 'getkategori']);
    Route::get('/meja', [MobileController::class, 'dataMeja']);
    Route::get('/cari', [MobileController::class, 'searchdata']);
    Route::post('/login', [MobileController::class, 'loginUser']);
    Route::post('/register', [MobileController::class, 'registerUser']);
    Route::post('/hapusitem', [MobileController::class, 'hapusItem']);
    Route::post('/cart', [MobileController::class, 'addkeranjang']);
    Route::get('/detail/{idUser?}', [MobileController::class, 'getKeranjang']);
    Route::get('/troli/{idUser?}', [MobileController::class, 'dataCart']);
    Route::post('/checkout', [MobileController::class, 'chekoutPesan']);
    Route::post('/tmbQty', [MobileController::class, 'tambahQty']);
    Route::post('/krgQty', [MobileController::class, 'kurangQty']);
    Route::get('/dataDetail/{idUser?}', [MobileController::class, 'dataDetail']);
    
});
