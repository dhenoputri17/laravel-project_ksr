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
    Route::post('/tambah', [MobileController::class, 'addkeranjang']);
});
