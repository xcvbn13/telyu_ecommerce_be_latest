<?php

namespace App\Models;

use App\Models\User;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';
    protected $fillable = ['id_produk','id_user'];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function product(){
        return $this->belongsTo(Products::class,'id_produk');
    }
}
