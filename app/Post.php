<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title', 'content', 'tags', 'status', 'author_id',
    ];

    public function author()
    {
        return $this->belongsTo("App\Author");
    }

    public function comment()
    {
        return $this->hasMany("App\Comment");
    }
}
