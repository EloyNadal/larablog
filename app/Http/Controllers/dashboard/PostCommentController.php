<?php

namespace App\Http\Controllers\dashboard;

use App\Post;
use App\PostComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postComments = PostComment::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.post-comment.index', ['postComments' => $postComments]);
    }

    public function post(Post $post)
    {

        $posts = Post::all();

        $postComments = PostComment
        ::orderBy('created_at', 'desc')
        ->where('post_id', $post->id)
        ->paginate(10);
        return view('dashboard.post-comment.post',
        ['postComments' => $postComments, 'posts' => $posts, 'post' => $post]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        return view('dashboard.post-comment.show', ['postComment' => $postComment]);
    }

    public function jshow(PostComment $postComment)
    {
        return response()->json($postComment);
        //para mostrar formulario en modal
        //return view('dashboard.post-comment.show', ['postComment' => $postComment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        $postComment->delete();
        return back()->with('status', 'Comentario eliminado con exito');
    }
}
