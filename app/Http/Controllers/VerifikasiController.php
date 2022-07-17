<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Products;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\KalkulasiController;
use App\Http\Controllers\UpdateStatusOrderController;

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
        $getStatusOrder = StatusOrder::findOrFail(2);
        $order = Order::where('status_order',$getStatusOrder->status)->get();

        return view('Orderan.VerifikasiPembayaran.index',compact('order'));
    }

    public function index_verfikasi($id)
    {
        $order_verifikasi = Order::where('id',$id)->with(['metodepembayaran','pembayaran'])->first();

        return $order_verifikasi;
    }

    // terverifikasi  

    public function index_terverifikasi()
    {
        $getStatusOrder = StatusOrder::findOrFail(3);
        $order = Order::where('status_order',$getStatusOrder->status)->get();

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
        $getStatusOrder = StatusOrder::findOrFail(6);
        $order = Order::where('status_order',$getStatusOrder->status)->get();

        return view('Orderan.VerifikasiGagal.index',compact('order'));
    }

    public function index_verfikasi_gagal_detail($id)
    {
        $order_verifikasi = Order::where('id',$id)->with(['metodepembayaran','pembayaran'])->first();

        return $order_verifikasi;
    }

    // order selesai 

    public function index_pesanan_selesai()
    {
        $getStatusOrder = StatusOrder::findOrFail(7);
        $order = Order::where('status_order',$getStatusOrder->status)->get();
        return view('Orderan.OrderSelesai.index',compact('order'));
    }

    public function index_pesanan_selesai_detail($id)
    {
        $order_verifikasi = Order::where('id',$id)->with(['metodepembayaran','pembayaran'])->first();

        return $order_verifikasi ;
    }
    // order -> status -> 6
    // untuk admin 
    public function store_verifikasi_gagal($id){

        $updateOrder = Order::findOrFail($id);
        // update status order 
        $updateStatusOrder = new UpdateStatusOrderController();
        $updateStatusOrder->updateStatusOrder(6,$id);

        // penambahan jumlah produk 
        $kalkulasi = new KalkulasiController();
        $kalkulasi->penambahanJumlahProductOnOrder($updateOrder->id_cart);

        return 'success';
    }

    public function store_verifikasi_berhasil($id){
        // update status order 
        $updateStatusOrder = new UpdateStatusOrderController();
        $updateStatusOrder->updateStatusOrder(3,$id);

        return 'success';
    }

    public function store_order_selesai($id){
        // update status order 
        $updateStatusOrder = new UpdateStatusOrderController();
        $updateStatusOrder->updateStatusOrder(7,$id);

        return 'success';
    }
}
