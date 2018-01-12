<?php

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
Route::get('/about','PagesController@about');

Route::get('/','PagesController@index');
Route::get('/services','PagesController@services');


// get all the routes from PostsController
Route::resource('posts','PostsController');

// Route::get('/user/{id}/{name}',function($id,$name){
//     return "<h1>This is user :".$id."with name ".$name."</h1>";
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
