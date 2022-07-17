<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use App\Models\StatusMetodePembayaran;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodepembayaran = MetodePembayaran::where('status_metode','Aktif')->get();

        $data = ['metodepembayaran'=>$metodepembayaran];
        return view('MetodePembayaran.index',$data);
    }

    public function index_informasi()
    {
        $metodepembayaran = MetodePembayaran::all();

        $data = [
            'metodepembayaran'=>$metodepembayaran
        ];
        return view('MetodePembayaran.detail',$data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran'=> 'required|string',
            'no_rek'=> 'required|numeric',
        ]);

        $statusMetode = StatusMetodePembayaran::where('id',1)->first();

        $metodepembayaran = MetodePembayaran::create([
            'metode' => $request->metode_pembayaran,
            'no_rek' => $request->no_rek,
            'status_metode' => $statusMetode->status,
            'jumlah_order'=> 0
        ]);

        return 'success';
    }

   
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

    public function jumlahOrder($idMetode){
        $order = Order::where('id_metode_pembayaran',$idMetode)->count();
        
        $metodepembayaran = MetodePembayaran::findOrFail($idMetode);
        $metodepembayaran->jumlah_order = $order;
        $metodepembayaran->save();
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statusMetode = StatusMetodePembayaran::findOrFail(2)->pluck('status');

        $metodepembayaran = MetodePembayaran::findOrFail($id);
        $metodepembayaran->status_metode = $statusMetode;
        $metodepembayaran->save();

        return 'success';
    }
}
