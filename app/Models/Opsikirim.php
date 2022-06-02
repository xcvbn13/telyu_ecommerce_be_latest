<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opsikirim extends Model
{
    use HasFactory;

    protected $table = 'opsikirims';

    protected $fillable = ['opsi'];
}
