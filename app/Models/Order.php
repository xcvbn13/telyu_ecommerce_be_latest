<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Opsikirim;
use App\Models\Pembayaran;
use App\Models\StatusOrder;
use App\Models\MetodePembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['no_resi','jumlah_harga','alamat','status_order_id','pembayaran_id','id_cart','id_opsikirim','id_metode_pembayaran'];
    protected $dates = ['order_date'];
    
    public function cart(){
        return $this->belongsTo(Cart::class,'id_cart');
    }

    public function opsikirim(){
        return $this->belongsTo(Opsikirim::class,'id_opsikirim');
    }

    public function metodepembayaran(){
        return $this->belongsTo(MetodePembayaran::class,'id_metode_pembayaran');
    }

    public function status_order(){
        return $this->belongsTo(StatusOrder::class,'status_order_id');
    }

    public function pembayaran(){
        return $this->belongsTo(Pembayaran::class,'pembayaran_id');
    }
}
