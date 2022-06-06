<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\StatusCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = ['id_user','id_status_cart'];
    protected $with = ['cart_item','user','status'];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function cart_item(){
        return $this->hasMany(CartItem::class,'id_cart');
    }

    public function order(){
        return $this->hasOne(Order::class,'id_cart');
    }

    public function status(){
        return $this->belongsTo(StatusCart::class,'id_status_cart');
    }


}
