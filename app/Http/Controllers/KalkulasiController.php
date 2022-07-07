<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Http\Request;

class KalkulasiController extends Controller
{
    public function totalHargaOnOrder($idCart){
        // sum total harga 
        $cartItem = CartItem::where('id_cart',$idCart)->get();
        $jumlah_harga = 0;

        if(sizeof($cartItem) == 0){
            return response([
                'message' => "Tambah Produk Ke Cart Terlebih Dahulu",
            ], 400);
        }

        foreach ($cartItem as $key => $item) {
            $product = Products::where('id', $item->id_produk)->first();
            if ($item->jumlah_barang > $product->jumlah_product){
                return response([
                    'message' => "Permintaan Anda Untuk $product->product_name Melebihi Stok",
                ], 400 );
                break;
            }
            $jumlah_barang = CartItem::where('id_produk',$product->id)->pluck('jumlah_barang');
            $hargaperproduk = $product->harga * $jumlah_barang;

            $jumlah_harga += $hargaperproduk;
        }
        
        return $jumlah_harga;
    }

    public function penguranganJumlahProductOnOrder($idCart){
        // pengurangan jumlah produk 
        $cartItem = CartItem::where('id_cart',$idCart)->get();
        $jumlah_barang = 0;

        foreach ($cartItem as $key => $item) {
            // produk yg ada di cart -> ngambil stok
            $product = Products::where('id', $item['id_produk'])->first();
            // jumlah produk yg ada di cart
            $jumlah_barang = CartItem::where('id_produk',$product->id)->first();

            $product->jumlah_product = $product->jumlah_product - $jumlah_barang->jumlah_barang;
            $product->save();
        }
    }

    public function penambahanJumlahProductOnOrder($idCart){
        // penambahan jumlah produk 
        $cartItem = CartItem::where('id_cart',$idCart)->get();
        $jumlah_barang = 0;

        foreach ($cartItem as $key => $item) {
            $product = Products::where('id', $item['id_produk'])->first();
            $jumlah_barang = CartItem::where('id_produk',$product->id)->first();

            $product->jumlah_product = $product->jumlah_product + $jumlah_barang->jumlah_barang;
            $product->save();
        }
    }
}
