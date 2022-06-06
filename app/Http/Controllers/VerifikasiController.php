<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function index_terverifikasi()
    {
        return view('Orderan.PembayaranTerverifikasi.index');
    }
    public function index_verifikasi_gagal()
    {
        return view('Orderan.VerifikasiGagal.index');
    }
    public function index_pesanan_selesai()
    {
        return view('Orderan.OrderSelesai.index');
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
