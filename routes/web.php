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

Route::get('/poem', function () {
  $poems = array(
    array(
      'id' => 1,
      'poem_title' => 'Winter Morning Poem',
      'poem_author' => 'Ogden Nash',
    ),
  );

});

Route::get('/poem/{id}', function($id) {
  $poem_title = '<h1>Winter Morning Poem</h1>';
  $poem_author = '<h2>Ogden Nash</h2>';

  $poem = '<div class="poem">';
  $poem .= 'Winter is the king of showmen<br />';
  $poem .= 'Turning tree stumps into snow men<br />';
  $poem .= 'And houses into birthday cakes<br />';
  $poem .= 'And spreading sugar over lakes<br />';
  $poem .= 'Smooth and clean and frosty white<br />';
  $poem .= 'The world looks good enough to bite<br />';
  $poem .= 'That\'s the season to be young<br />';
  $poem .= 'Catching snowflakes on your tongue<br />';
  $poem .= 'Snow is snowy when it\'s snowing<br />';
  $poem .= 'I\'m sorry it\'s slushy when it\'s going<br />';
  $poem .= '</p>';

  $poem_source = 'https://sites.google.com/site/andrewminerportfolio/home/inspiration-continued/winter-morning-poem-by-ogden-nash';

  return $poem_title . $poem_author . $poem . $poem_source;
});

Route::get('/author', function() {
  $authors = array(
    array(
      'id' => 1,
      'author_firstname' => 'Ogden',
      'author_familyname' => 'Nash',
    ),
  );
});

Route::get('/author/{id}', function($id) {
  $author_firstname = 'Ogden';
  $author_familyname = 'Nash';
  return '<h1>' . $author_firstname . ' ' . $author_familyname . '</h1>';
});
