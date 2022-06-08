<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusMetodePembayaran extends Model
{
    use HasFactory;

    protected $table='status_metode_pembayarans';
    protected $fillable = ['status'];
}
