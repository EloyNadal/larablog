<?php

namespace App\Http\Controllers\api;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseController;

class PostController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::join('post_images', 'post_images.post_id', '=', 'posts.id')
                        ->join('categories', 'categories.id', '=', 'posts.category_id')
                        ->select('posts.*', 'categories.title as category', 'post_images.image')
                        ->orderBy('posts.created_at', 'desc')->paginate(10);

        return $this->successResponse($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->image;
        $post->category;
        return $this->successResponse($post);
    }

    public function url_clean(String $url_clean)
    {
        $post = Post::where('url_clean', $url_clean)->firstOrFail();
        $post->image;
        $post->category;
        return $this->successResponse($post);
    }

    public function category(Category $category)
    {
        return $this->successResponse(['posts' => $category->posts()->paginate(10), 'category' => $category]);
    }


}
