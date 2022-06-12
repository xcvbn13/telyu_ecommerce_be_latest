<?php

namespace App\Models;

use App\Models\StatusMetodePembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayarans';
    protected $fillable = ['metode','no_rek','id_status_metode'];

    public function order(){
        return $this->hasMany(Order::class,'id_metode_pembayaran');
    }

    public function status_metode(){
        return $this->belongsTo(StatusMetodePembayaran::class,'id_status_metode');
    }
}
