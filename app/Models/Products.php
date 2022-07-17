<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'gambar_product',
        'jumlah_product',
        'deskripsi_product',
        'harga',
        'id_category'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'id_category');
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function cart_item(){
        return $this->hasOne(CartItem::class,'id_produk');
    }
}
