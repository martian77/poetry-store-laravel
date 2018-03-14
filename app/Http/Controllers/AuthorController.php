<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
  /**
   * Shows a single author.
   *
   * @param  int $id The id of the author to display.
   */
  public function show($id)
  {
    $authors = $this->getAuthors();
    $author = array_pop($authors);
    $pagetitle = 'Author ' . $author['firstname'] . ' ' . $author['familyname'];
    return view('author.show', array('pagetitle' => $pagetitle, 'author' => $author ));
  }

  /**
   * Lists all authors.
   *
   * @return [type] [description]
   */
  public function list()
  {
    $authors = $this->getAuthors();
    return view('author.list', array('pagetitle' => 'Authors listing', 'authors' => $authors));
  }

  /**
   * Temporary data generating function.
   *
   * @return array Array of authors. 
   */
  private function getAuthors()
  {
    return array(
      array(
        'id' => 1,
        'firstname' => 'Ogden',
        'familyname' => 'Nash',
        'preferred_name' => 'Ogden Nash',
        'birthdate' => '1902-08-19',
        'deathdate' => '1971-05-19',
        'links' => array(
          'https://en.wikipedia.org/wiki/Ogden_Nash',
        ),
      ),
    );
  }
}
