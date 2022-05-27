<?php

use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    Route::get('admin/merchandise/stok',[MerchandiseController::class,'index_stok']);
    Route::get('admin/merchandise/kategori',[CategoryMerchandiseController::class,'index']);
});