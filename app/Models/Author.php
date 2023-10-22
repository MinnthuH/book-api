<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Author extends Model implements AuthenticatableContract
{
    use HasFactory, HasApiTokens, Authenticatable;

    public $timestamps = false;

    protected $fillable = ['name','email','password','phone'];
}
