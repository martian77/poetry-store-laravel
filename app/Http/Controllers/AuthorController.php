<?php

namespace App\Http\Controllers;

use App\Author;
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
    $author = Author::findOrFail($id);
    $pagetitle = 'Author ' . $author->getPreferredName();
    return view('author.show', array('pagetitle' => $pagetitle, 'author' => $author ));
  }

  /**
   * Lists all authors.
   *
   * @return [type] [description]
   */
  public function list()
  {
    $authors = Author::all();

    return view('author.list', array('pagetitle' => 'Authors listing', 'authors' => $authors));
  }
}
