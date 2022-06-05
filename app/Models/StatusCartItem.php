<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCartItem extends Model
{
    use HasFactory;

    protected $table='status_cart_items';
    protected $fillable = ['status'];

}
