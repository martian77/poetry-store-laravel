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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/poem', 'PoemController@list');
Route::get('/poem/{id}', 'PoemController@show')->name('poem');

Route::get('/author', 'AuthorController@list');
Route::get('/author/{id}', 'AuthorController@show')->name('author');
