<?php

namespace App\Models;

use App\Models\User;
use App\Models\Products;
use App\Models\Pembayaran;
use App\Models\StatusOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['no_resi','jumlah','product_id','user_id','status_order_id','pembayaran_id'];
    protected $dates = ['order_date'];
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }

    public function status_order(){
        return $this->belongsTo(StatusOrder::class,'status_order_id');
    }

    public function pembayaran(){
        return $this->belongsTo(Pembayaran::class,'pembayaran_id');
    }
}
