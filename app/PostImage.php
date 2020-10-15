<?php

namespace App;

use App\Post;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostImage extends Model
{
    protected $fillable = ['post_id', 'image'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function getImageUrl(){
        return URL::assets('images/'.$this->image);
    }

    //mutator
    //public function getImageAttribute($value){
        //return Storage::url($value);
    //}
}
