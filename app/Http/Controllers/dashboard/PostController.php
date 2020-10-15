<?php

namespace App\Http\Controllers\dashboard;

use App\Tag;
use App\Post;
use App\Category;
use App\PostImage;
use App\Helpers\CustomUrl;
use Illuminate\Http\Request;

use App\Jobs\ProcessImageSmall;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostPost;
use App\Http\Requests\UpdatePostPut;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
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
    public function index(Request $request)
    {

        #test email con cola
        //SendEmail::dispatch("Email enviado por colas", 'bydoser@email.com');


        $posts = Post::with('category')
                ->orderBy('created_at', request('created_at', 'DESC'));

        if($request->has('search')){
            $posts = $posts->where('title', 'LIKE', '%'.request('search').'%');
        }

        $posts = $posts->paginate(5);

        return view('dashboard.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('id', 'title');
        $categories = Category::pluck('id', 'title');
        return view("dashboard.post.create", ['post' => new Post(), 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostPost $request)
    {
        if ($request->url_clean == "") {
            $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->title), '-', true);
        } else {
            $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->url_clean), '-', true);
        }

        $requestData = $request->validated(); //clonado el request
        $requestData['url_clean'] = $urlClean;

        $validator = Validator::make($requestData, StorePostPost::myRules());

        if ($validator->fails()) {
            return redirect('dashboard/post/create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::create($requestData);

        $post->tags()->sync($request->tags_id);

        return back()->with('status', 'Post creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::pluck('id', 'title');
        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostPut $request, Post $post)
    {

        //$post->tags()->attach(1); //crea relacion
        //$post->tags()->detach(1); //elimina relacion
        $post->tags()->sync($request->tags_id);

        $post->update($request->validated());
        return back()->with('status', 'Post actualizado con exito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image(Request $request, Post $post)
    {

        $request->validate([
            'image' => 'required|mimes:jpeg,bmp,png|max:10240' //10M
        ]);

        $filename = time() . "." . $request->image->extension();

        $request->image->move(public_path('images'), $filename);

        //$path = $request->image->store('public/image');

        $image = PostImage::create([
            'image' => /*$path*/ $filename,
            'post_id' => $post->id
        ]);

        ProcessImageSmall::dispatch($image);

        return back()->with('status', 'Imagen cargada con exito');
    }

    public function contentImage(Request $request)
    {

        $request->validate(['image' => 'required|mimes:jpeg,bmp,png|max:10240']); //10M

        $filename = time() . "." . $request->image->extension();

        $request->image->move(public_path('images_post'), $filename);

        return response()->json(["default" => URL::to('/') . '/images_post/' . $filename]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('status', 'Post eliminado con exito');
    }

    private function sendMail()
    {
        $data['title'] = "Datos de prueba";

        Mail::send('emails.email', $data, function ($message) {
            $message->to('andres@gmail.com', 'Pepito')
                ->subject("Gracias por escribirnos");
        });

        //dd(Mail::failures());
        if (Mail::failures()) {
            return "Mensaje no enviado";
        } else {
            return "Mensaje enviado";
        }
    }
}
