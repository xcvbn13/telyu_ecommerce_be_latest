<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';
    protected $fillable = ['jumlah_barang','id_produk','id_cart'];

    public function cart(){
        return $this->belongsTo(Cart::class,'id_cart');
    }

    public function produk(){
        return $this->belongsTo(Products::class,'id_produk');
    }
}
