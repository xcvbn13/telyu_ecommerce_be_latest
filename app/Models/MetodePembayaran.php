<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayarans';
    protected $fillable = ['metode','no_rek','id_status_metode'];

    public function order(){
        return $this->hasMany(Order::class,'id_metode_pembayaran');
    }
}
