<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Products;
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
        $cart = Cart::where('id_user',auth()->user()->id)->where('id_status_cart',1)->firstOrFail();
        $cartItem = CartItem::where('id_cart',$cart->id)->get();

        return response([
            'message' => "Berhasil mengambil data cart",
            'data' => $cartItem,
        ], 200);
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

        $cekProduk = Products::where('id',$request->id_produk)->pluck('jumlah_product')->first();

        if ($cekProduk < $request->jumlah_barang){
            return response([
                'message' => "Jumlah Barang Terbatas",
            ], 400);
        }

        $cartItem = CartItem::create([
            'jumlah_barang' => $request->jumlah_barang,
            'id_produk' => $request->id_produk,
            'id_cart' => $cart->id,
        ]);

        return response([
            'message' => "Berhasil menambah data cart",
        ], 200);
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
