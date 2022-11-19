<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guard = 'seller';

    protected $fillable = [
        'name', 'email', 'password','avatar','desc','active','username','verify_token','verify_at'
    ];

    protected $hidden = [
        'password','verify_token',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
