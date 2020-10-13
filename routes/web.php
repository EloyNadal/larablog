<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/* DB::listen(function($query){
    echo "<code>".$query->sql."</code>";
}); */
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('dashboard/post', 'dashboard\PostController');
Route::post('dashboard/post/{post}/image', 'dashboard\PostController@image')->name('post.image');
Route::post('dashboard/post/content_image', 'dashboard\PostController@contentImage');
Route::resource('dashboard/category', 'dashboard\CategoryController');
Route::resource('dashboard/user', 'dashboard\UserController');
Route::resource('dashboard/contact', 'dashboard\ContactController')->only(['index', 'show', 'destroy']);
Route::resource('dashboard/post-comment', 'dashboard\PostCommentController')->only(['index', 'show', 'destroy']);

Route::get('dashboard/post-comment/{post}/post', 'dashboard\PostCommentController@post')->name('post-comment.post');
Route::get('dashboard/post-comment/j-show/{postComment}', 'dashboard\PostCommentController@jshow');
Route::post('dashboard/post-comment/proccess/{postComment}', 'dashboard\PostCommentController@proccess');

Route::get('/', 'web\WebController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
