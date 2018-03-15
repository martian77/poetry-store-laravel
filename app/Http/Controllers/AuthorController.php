<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

  public function add()
  {
    $author = new Author;
    return view('author.edit', ['pagetitle' => 'Add author', 'author' => $author]);
  }

  public function edit($id)
  {
    $author = Author::findOrFail($id);
    return view('author.edit', ['pagetitle' => 'Edit author', 'author' => $author]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'firstname' => 'required',
      'familyname' => 'required',
      'birthdate' => 'date|before:today',
      'deathdate' => 'date|after:birthdate|before:tomorrow',
    ]);

    $user = Auth::user();
    if ( ! empty($request->author_id)) {
      $author = Author::updateOrCreate(
        ['id' => $request->author_id],
        [
          'firstname' => $request->firstname,
          'familyname' => $request->familyname,
          'birthdate' => $request->birthdate,
          'deathdate' => $request->deathdate,
          'preferredName' => $request->preferredName,
        ]
      );
    }
    else {
      $author = $user->authors()->create([
        'firstname' => $request->firstname,
        'familyname' => $request->familyname,
        'birthdate' => $request->birthdate,
        'deathdate' => $request->deathdate,
        'preferredName' => $request->preferredName,
      ]);
    }
    if(!empty($author->id)) {
      return redirect( route('author', ['id' => $author->id] ) );
    }
    return redirect(route('author.list'));
  }
}
