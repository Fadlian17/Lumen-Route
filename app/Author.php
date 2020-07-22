<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'username', 'password', 'salt', 'email', 'profile',
    ];


    public function post()
    {
        return $this->hasMany("App\Post");
    }

    public function comment()
    {
        return $this->hasMany("App\Comment");
    }
}
