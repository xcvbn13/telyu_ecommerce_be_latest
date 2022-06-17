<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WishlistController;

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

Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    // order 
    Route::get('/order',[OrderController::class,'index']);
    Route::get('/order/detail/{id_order}',[OrderController::class,'show']);
    Route::post('/order',[OrderController::class,'store']);
    Route::post('/order/pembayaran/{id_order}',[OrderController::class,'store_pembayaran']);
    Route::post('/order/dibatalkan/{id_order}',[OrderController::class,'store_dibatalkan']);
    Route::post('/order/waktu_habis/{id_order}',[OrderController::class,'store_waktu_habis']);
    Route::post('/order/verifikasi_gagal/{id_order}',[OrderController::class,'store_verifikasi_gagal']);
    Route::post('/order/selesai/{id_order}',[OrderController::class,'store_selesai']);

    // user page
    Route::get('/user',[UserController::class,'index']);
    Route::patch('/user/edit',[UserController::class,'update']);

    // product page
    Route::get('/products',[ProductsController::class,'index']);
    Route::get('/products/{id}',[ProductsController::class,'product_detail']);

    // wishlist 
    Route::get('/wishlist',[WishlistController::class,'index']);
    Route::post('/wishlist/{id}',[WishlistController::class,'store']);
    Route::delete('/wishlist/delete/{id}',[WishlistController::class,'destroy']);

    // payment page
    Route::get('/payment',[OrderController::class,'payment']);

    // cart page
    Route::get('/cart',[CartController::class,'index']);
    Route::post('/cart/store',[CartController::class,'store']);
    Route::delete('/cart/delete/{id}',[CartController::class,'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
