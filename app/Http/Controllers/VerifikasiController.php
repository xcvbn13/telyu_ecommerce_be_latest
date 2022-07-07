<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\KalkulasiController;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  menunggu verifikasi 
    public function index()
    {
        $order = Order::where('status_order_id',2)->get();

        return view('Orderan.VerifikasiPembayaran.index',compact('order'));
    }

    public function index_verfikasi($id)
    {
        $order_verifikasi = Order::where('id',$id)->where('status_order_id',2)->with(['metodepembayaran','pembayaran'])->first();

        return $order_verifikasi;
    }

    // terverifikasi  

    public function index_terverifikasi()
    {
        $order = Order::where('status_order_id',3)->get();

        return view('Orderan.PembayaranTerverifikasi.index',compact('order'));
    }

    public function index_terverfikasi_detail($id)
    {
        $order_verifikasi = Order::where('id',$id)->with(['metodepembayaran','pembayaran','cart','opsikirim'])->first();

        return $order_verifikasi;
    }

    // verifikasi gagal 
    public function index_verifikasi_gagal()
    {
        $order = Order::where('status_order_id',6)->get();

        return view('Orderan.VerifikasiGagal.index',compact('order'));
    }

    public function index_verfikasi_gagal_detail($id)
    {
        $order_verifikasi = Order::where('id',$id)->where('status_order_id',6)->with(['metodepembayaran','pembayaran'])->first();

        return $order_verifikasi;
    }

    // order selesai 

    public function index_pesanan_selesai()
    {
        $order = Order::where('status_order_id',7)->get();
        return view('Orderan.OrderSelesai.index',compact('order'));
    }

    public function index_pesanan_selesai_detail($id)
    {
        $order_verifikasi = Order::where('id',$id)->where('status_order_id',7)->with(['metodepembayaran','pembayaran'])->first();

        return $order_verifikasi ;
    }
    // order -> status -> 6
    // untuk admin 
    public function store_verifikasi_gagal($id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 6;
        $updateOrder->save();

        // penambahan jumlah produk 
        $kalkulasi = new KalkulasiController();
        $kalkulasi->penambahanJumlahProductOnOrder($updateOrder->id_cart);

        return 'success';
    }

    public function store_verifikasi_berhasil($id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 3;
        $updateOrder->save();

        return 'success';
    }

    public function store_order_selesai($id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 7;
        $updateOrder->save();

        return 'success';
    }
}
