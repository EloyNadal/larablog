<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'url_clean'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
