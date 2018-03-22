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

// Poem routes
Route::get('/poem', 'PoemController@list')->name('poem.list');
Route::get('/poem/{id}', 'PoemController@show')->where(['id' => '[0-9]+'])->name('poem')->middleware('auth');
Route::get('/poem/add', 'PoemController@add')->middleware('auth')->name('poem.add');
Route::get('/poem/{id}/edit', 'PoemController@edit')->where(['id' => '[0-9]+'])->middleware('auth')->name('poem.edit');
Route::post('/poem', 'PoemController@store')->middleware('auth')->name('poem.store');

// Author routes
Route::get('/author', 'AuthorController@list')->name('author.list');
Route::get('/author/{id}', 'AuthorController@show')->where(['id' => '[0-9]+'])->name('author')->middleware('auth');
Route::get('/author/add', 'AuthorController@add')->middleware('auth')->name('author.add');
Route::get('/author/{id}/edit', 'AuthorController@edit')->where(['id' => '[0-9]+'])->middleware('auth')->name('author.edit');
Route::post('/author', 'AuthorController@store')->middleware('auth')->name('author.store');

Route::get('/tag/{normalised}', 'TagController@show')->name('tag')->middleware('auth');

// Admin functions
Route::get('/admin', function() {
  return view('admin.dashboard', ['pagetitle' => 'Admin dashboard']);
})->middleware('auth', 'checkability:manage-app')->name('admin.main');
Route::get('/admin/users', 'UserController@index')->middleware('auth', 'checkability:admin-user-list')->name('admin.users');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
