<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{

    public function index(Request $request)
    {
        $a = Post::with('postComments.user')->first();
        //dd($a->first()->postComments->first()->user);

        dd($a->getRelations());
        dd($a->values()->postComments->pluck('user_id'));

        if($request->react){
            return view('web.test_react');
        }
        return view('web.test');
    }

    public function testPage(Request $request)
    {
        $images = $this->getImages($request);

        return view('web.test_page', compact('images'));
    }

    public function savePage(Request $request)
    {
        $deleteText = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
        $cleanHtml = str_replace($deleteText, '', $request['gjs-customHtml']);
        //dd($cleanHtml);
        return response([]);
    }

    public function getPage(Request $request)
    {
        $html = '<div id="ieyl" style="box-sizing: border-box;"><p id="icr5" style="box-sizing: border-box; color: red;">Test</p></div><a class="button btn btn-success" style="box-sizing: border-box;">Button</a>';
        return response(['html' => $html]);
    }

    public function getImages(Request $request)
    {
        $array = scandir(public_path('images'));
        $images = [];
        foreach ($array as $value) {
            if ('.' !== $value && '..' !== $value && !is_dir(public_path("images/$value"))){
                $images[] = "images/$value";
            }
        }
        return $images;
    }

    public function saveImage(Request $request)
    {
        //$request->validate(['files' => 'required|mimes:jpeg,bmp,png|max:10240']); //10M

        //dd($request->file('files'));
        //dump($request->file('files')[0]);
        //dd($request->file('files'));
        $filename = time() . "." . $request->file('files')[0]->extension();

        $request->file('files')[0]->move(public_path('images'), $filename);

        return response()->json(["data" => [URL::to('/') . '/images/' . $filename]]);
    }

}
