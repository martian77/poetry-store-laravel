<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PoemController extends Controller
{

  public function show($id)
  {
    $poems = $this->getPoems();
    $poem = array_pop($poems);
    return view('poem.show', array('pagetitle' => $poem['title'], 'poem' => $poem) );
  }
  public function list()
  {
    $poems = $this->getPoems();
    return view('poem.list', array('pagetitle' => 'Poems Listing', 'poems' => $poems));
  }

  private function getPoems()
  {
    return array(
      array(
        'id' => 1,
        'title' => 'Winter Morning Poem',
        'author' => 'Ogden Nash',
        'lines' => array(
          'Winter is the king of showmen',
          'Turning tree stumps into snow men',
          'And houses into birthday cakes',
          'And spreading sugar over lakes',
          'Smooth and clean and frosty white',
          'The world looks good enough to bite',
          'That\'s the season to be young',
          'Catching snowflakes on your tongue',
          'Snow is snowy when it\'s snowing',
          'I\'m sorry it\'s slushy when it\'s going',
        ),
        'sources' => array(
          'https://sites.google.com/site/andrewminerportfolio/home/inspiration-continued/winter-morning-poem-by-ogden-nash',
        ),
      )
    );
  }
}
