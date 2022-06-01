<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserType extends Model
{
    use HasFactory;

    protected $table = 'user_types';
    protected $fillable = ['name','description'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
