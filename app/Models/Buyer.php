<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Buyer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guard = 'buyer';

    protected $fillable = [
        'name', 'email','username', 'password','avatar'
    ];

    protected $hidden = [
        'password'
    ];
}
