<?php

use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\CategoryMerchandiseController;

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

Route::get('/', function () {
    if (Auth::check()){
        return redirect()->route('home_admin');
    }else{
        return redirect()->route('login');
    }
});

Auth::routes();

// admin
Route::middleware(['is_admin','auth'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('home_admin');

    // merchandise 
    Route::get('admin/merchandise',[MerchandiseController::class,'index']);
    Route::get('admin/merchandise/detail_product/{id}',[MerchandiseController::class,'show']);
    Route::get('admin/merchandise/stok',[MerchandiseController::class,'index_stok']);

    Route::get('admin/merchandise/kategori',[CategoryMerchandiseController::class,'index']);
    Route::post('admin/merchandise/kategori/create',[CategoryMerchandiseController::class,'store']);
    Route::get('admin/merchandise/kategori/edit/{id}',[CategoryMerchandiseController::class,'edit'])->name('edit_kateogri');
    Route::put('admin/merchandise/kategori/update/{id}',[CategoryMerchandiseController::class,'update'])->name('update_kategori');
    Route::delete('admin/merchandise/kategori/delete/{id}',[CategoryMerchandiseController::class,'destroy'])->name('delete_kategori');

    // orderan 
    Route::get('admin/order/verfikasi_pembayaran',[VerifikasiController::class,'index']);
    Route::get('admin/order/pembayaran_terverifikasi',[VerifikasiController::class,'index_terverifikasi']);
    Route::get('admin/order/verifikasi_gagal',[VerifikasiController::class,'index_verifikasi_gagal']);
    Route::get('admin/order/pesanan_selesai',[VerifikasiController::class,'index_pesanan_selesai']);
});