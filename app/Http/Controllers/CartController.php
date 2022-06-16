<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Opsikirim;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('id_user',auth()->user()->id)->where('id_status_cart',1)->with(['user','cart_item'])->get();

        return response([
            'message' => "Berhasil mengambil data cart",
            'data' => $cart,
        ], 200);
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

        $cart = Cart::where('id_user',auth()->user()->id)->where('id_status_cart',1)->first();

        $cartItem = CartItem::create([
            'jumlah_barang' => $request->jumlah_barang,
            'id_produk' => $request->id_produk,
            'id_cart' => $cart->id,
        ]);

        $review = Cart::where('id', $cart->id)->where('id_status_cart',1)->with(['user','cart_item'])->get();

        return response([
            'message' => "Berhasil menambah data cart",
            'data' => $review,
        ], 200);
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
        $cart = CartItem::findOrFail($id);
        $cart->delete();
        
        return response([
            'message' => "Berhasil menghapus data cart"
        ], 200);
    }
}
