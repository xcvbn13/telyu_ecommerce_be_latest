<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Http\Request;

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
        $order_verifikasi = Order::where('id',$id)->where('status_order_id',3)->with(['metodepembayaran','pembayaran'])->first();

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    // order -> status -> 6
    // untuk admin 
    public function store_verifikasi_gagal($id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 6;
        $updateOrder->save();

        // penambahan jumlah produk 

        $cart = Cart::where('id',$updateOrder->id_cart)->first();
        $cartItem = CartItem::where('id_cart',$cart->id)->get();
        $jumlah_barang = 0;

        foreach ($cartItem as $key => $item) {
            $product = Products::where('id', $item['id_produk'])->first();
            $jumlah_barang = CartItem::where('id_produk',$product->id)->first();

            $product->jumlah_product = $product->jumlah_product + $jumlah_barang->jumlah_barang;
            $product->save();
        }

        return 'success';
    }

    public function store_verifikasi_berhasil($id){

        $updateOrder = Order::findOrFail($id);
        $updateOrder->status_order_id = 3;
        $updateOrder->save();

        return 'success';
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
