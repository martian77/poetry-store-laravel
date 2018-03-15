<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    $user = Auth::user();
    $authors = array();
    if (! empty($user)) {
      $authors = $user->authors()->get();
    }
    return view('author.list', array('pagetitle' => 'Authors listing', 'authors' => $authors));
  }
}
