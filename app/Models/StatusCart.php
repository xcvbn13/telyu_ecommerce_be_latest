<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCart extends Model
{
    use HasFactory;

    protected $table='status_carts';
    protected $fillable = ['status'];
}
