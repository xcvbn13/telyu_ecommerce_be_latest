<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusOrder extends Model
{
    use HasFactory;

    protected $table = 'status_orders';

    protected $fillable = ['status'];

    public function order(){
        return $this->hasMany(Order::class);
    }
}
