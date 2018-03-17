<?php

namespace App\Http\Controllers;

use App\Author;
use App\Source;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorRequest;

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
    $sources = $author->sources()->get();
    $sources[] = new Source;
    $view_data = array(
      'pagetitle' => 'Edit author',
      'author' => $author,
      'sources' => $sources,
    );
    return view('author.edit', $view_data);
  }

  public function store(StoreAuthorRequest $request)
  {
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

    $counter = 0;
    while (!empty($request->input('sourceType' . $counter))) {
      $source_id = $request->input('sourceId' . $counter);
      if ( !empty($source_id)) {
        $source = Source::find($source_id);
      }
      else {
        $source = new Source;
      }
      $source->sourceType = $request->input('sourceType' . $counter);
      $source->description = $request->input('sourceDescription' . $counter);
      $source->link = $request->input('sourceLink' . $counter);
      if(!empty($source->description) || !empty($source->description)) {
        $author->sources()->save($source);
      }
      elseif(!empty($source_id)) {
        $author->sources()->where('id', '=', $source_id)->delete();;
      }
      $counter++;
    }

    if(!empty($author->id)) {
      return redirect( route('author', ['id' => $author->id] ) );
    }
    return redirect(route('author.list'));
  }
}
