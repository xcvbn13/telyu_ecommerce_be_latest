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
        $metodepembayaran = MetodePembayaran::where('id_status_metode',1)->get();

        $data = ['metodepembayaran'=>$metodepembayaran];
        return view('MetodePembayaran.index',$data);
    }

    public function index_informasi()
    {
        $metodepembayaran = MetodePembayaran::with(['order' => function($query) {
            $query->where('status_order_id', 1)->orWhere('status_order_id', 2)->orWhere('status_order_id', 3);
        },'status_metode'])->get();

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
        $request->validate([
            'metode_pembayaran'=> 'required|string',
            'no_rek'=> 'required|numeric',
        ]);

        $metodepembayaran = MetodePembayaran::create([
            'metode' => $request->metode_pembayaran,
            'no_rek' => $request->no_rek,
            'id_status_metode' => 1
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
        $metodepembayaran = MetodePembayaran::findOrFail($id);
        $metodepembayaran->id_status_metode = 2;
        $metodepembayaran->save();

        return 'success';
    }
}
