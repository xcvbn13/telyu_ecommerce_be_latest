<?php

use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::middleware(['is_admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('home_admin');
});