<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index(Request $request){

        if($request->react){
            return view('web.test_react');
        }
        return view('web.test');
    }

}
