<?php

use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\MetodePembayaranController;
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
    Route::get('admin/dashboard/detail/{id}', [HomeController::class, 'index_detail']);

    // merchandise 
    Route::get('admin/merchandise/product',[MerchandiseController::class,'index']);
    Route::get('admin/merchandise/product/create',[MerchandiseController::class,'create']);
    Route::post('admin/merchandise/product/store',[MerchandiseController::class,'store']);
    Route::get('admin/merchandise/detail_product/{id}',[MerchandiseController::class,'show']);
    Route::get('admin/merchandise/product/edit/{id}',[MerchandiseController::class,'edit']);
    Route::PUT('admin/merchandise/product/update/{id}',[MerchandiseController::class,'update']);

    Route::get('admin/merchandise/stok',[MerchandiseController::class,'index_stok']);
    Route::get('admin/merchandise/stok/edit/{id}',[MerchandiseController::class,'edit_stok']);
    Route::put('admin/merchandise/stok/tambah/{id}',[MerchandiseController::class,'update_stok']);

    Route::get('admin/merchandise/kategori',[CategoryMerchandiseController::class,'index']);
    Route::post('admin/merchandise/kategori/create',[CategoryMerchandiseController::class,'store']);
    Route::get('admin/merchandise/kategori/edit/{id}',[CategoryMerchandiseController::class,'edit'])->name('edit_kateogri');
    Route::put('admin/merchandise/kategori/update/{id}',[CategoryMerchandiseController::class,'update'])->name('update_kategori');
    Route::delete('admin/merchandise/kategori/delete/{id}',[CategoryMerchandiseController::class,'destroy'])->name('delete_kategori');

    // orderan => menunggu verifikasi 
    Route::get('admin/order/verfikasi_pembayaran',[VerifikasiController::class,'index']);
    Route::get('admin/order/verfikasi_pembayaran/detail/{id}',[VerifikasiController::class,'index_verfikasi']);
    // -> terverifikasi  
    Route::get('admin/order/pembayaran_terverifikasi',[VerifikasiController::class,'index_terverifikasi']);
    Route::get('admin/order/pembayaran_terverifikasi/detail/{id}',[VerifikasiController::class,'index_terverfikasi_detail']);
    Route::post('admin/order/pembayaran_terverifikasi/{id}',[VerifikasiController::class,'store_verifikasi_berhasil']);
    // ->verifikasi gagal
    Route::get('admin/order/verifikasi_gagal',[VerifikasiController::class,'index_verifikasi_gagal']);
    Route::get('admin/order/verfikasi_gagal/detail/{id}',[VerifikasiController::class,'index_verfikasi_gagal_detail']);
    Route::post('admin/order/verifikasi_gagal/{id}',[VerifikasiController::class,'store_verifikasi_gagal']);
    // -> order selesai
    Route::get('admin/order/pesanan_selesai',[VerifikasiController::class,'index_pesanan_selesai']);
    Route::get('admin/order/pesanan_selesai/detail/{id}',[VerifikasiController::class,'index_pesanan_selesai_detail']);

    // metode pembayaran 
    Route::get('admin/metode_pembayaran',[MetodePembayaranController::class,'index']);
    Route::post('admin/metode_pembayaran/create',[MetodePembayaranController::class,'store']);
    Route::get('admin/metode_pembayaran/edit/{id}',[MetodePembayaranController::class,'edit']);
    Route::put('admin/metode_pembayaran/update/{id}',[MetodePembayaranController::class,'update']);
    Route::delete('admin/metode_pembayaran/delete/{id}',[MetodePembayaranController::class,'destroy']);

    Route::get('admin/metode_pembayaran/informasi',[MetodePembayaranController::class,'index_informasi']);
});