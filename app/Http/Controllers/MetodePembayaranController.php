<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\MetodePembayaran;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodepembayaran = MetodePembayaran::all();

        $data = ['metodepembayaran'=>$metodepembayaran];
        return view('MetodePembayaran.index',$data);
    }

    public function index_informasi()
    {
        $metodepembayaran = MetodePembayaran::with(['order'])->get();

        $data = [
            'metodepembayaran'=>$metodepembayaran
        ];
        return view('MetodePembayaran.detail',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $metodepembayaran = MetodePembayaran::create([
            'metode' => $request->metode_pembayaran,
            'no_rek' => $request->no_rek
        ]);

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
        $metodepembayaran = MetodePembayaran::findOrFail($id);
        
        return $metodepembayaran;
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
        $update = MetodePembayaran::findOrFail($id);
        $update->metode = $request->metode_pembayaran;
        $update->no_rek = $request->no_rek;
        $update->save();
        
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Order::where('id_metode_pembayaran',$id)->count();
        if($transaksi > 0){
            return 'warning';
        }

        $metodepembayaran = MetodePembayaran::findOrFail($id);
        $metodepembayaran->delete();

        return 'success';
    }
}
