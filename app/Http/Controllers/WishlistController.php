<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = Wishlist::where('id_user',auth()->user()->id)->get();

        return response([
            'message' => "Berhasil mengambil data wishlist",
            'data' => $wishlist,
        ], 200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $wishlist = Wishlist::create([
            'id_produk' => $id,
            'id_user' => auth()->user()->id,
        ]);

        return response([
            'message' => "Berhasil",
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
        $wishlist = Wishlist::findOrFail($id);

        $wishlist->delete();

        return response([
            'message' => "Berhasil Dihapus",
        ], 200);
    }
}
