<?php

namespace App\Models;

use App\Models\StatusMetodePembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayarans';
    protected $fillable = [
        'metode',
        'no_rek',
        'status_metode',
        'jumlah_order'
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function status_metode_pembayaran(){
        return $this->belongsTo(StatusMetodePembayaran::class,'status_metode','status');
    }
}
