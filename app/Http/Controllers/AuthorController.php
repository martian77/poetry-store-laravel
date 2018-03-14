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
    $author = factory(Author::class)->states('preferredName')->make();
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
    $authors = factory(Author::class, 3)->states('preferredName')->make();

    return view('author.list', array('pagetitle' => 'Authors listing', 'authors' => $authors));
  }
}
