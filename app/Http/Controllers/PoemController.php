<?php

namespace App\Http\Controllers;

use App\Poem;
use App\Source;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePoemRequest;

class PoemController extends Controller
{

  public function show($id)
  {
    $poem = Poem::findOrFail($id);
    return view('poem.show', array('pagetitle' => $poem['title'], 'poem' => $poem) );
  }

  /**
   * Lists all of a user's poems.
   * @return [type] [description]
   */
  public function list()
  {
    $user = Auth::user();
    $poems = array();
    if (! empty($user)) {
      $poems = $user->poems()->get();
    }
    return view('poem.list', array('pagetitle' => 'Poems Listing', 'poems' => $poems));
  }

  public function add()
  {
    $user = Auth::user();
    $poem = new Poem;
    $authors = $user->authors()->get();
    $sources = [new Source];

    $view_data = array(
      'pagetitle' => 'Edit Poem',
      'poem' => $poem,
      'authors' => $authors,
      'sources' => $sources,
    );

    return view('poem.edit', $view_data);
  }

  public function edit($id)
  {
    $user = Auth::user();
    $poem = $user->poems()->find($id);
    $authors = $user->authors()->get();
    $sources = $poem->sources()->get();
    $sources[] = new Source;

    $view_data = array(
      'pagetitle' => 'Edit Poem',
      'poem' => $poem,
      'authors' => $authors,
      'sources' => $sources,
    );
    return view('poem.edit', $view_data);
  }

  /**
   * Stores the details of a poem.
   *
   * @param  StorePoemRequest $request
   */
  public function store(StorePoemRequest $request)
  {
    $user = Auth::user();

    $data = [
      'title' => $request->title,
      'body' => $request->body,
      'publishedDate' => $request->publishedDate,
      'copyright' => $request->copyright,
      'license' => $request->license,
    ];
    if ( ! empty($request->poem_id)) {
      $poem = $user->poems()->updateOrCreate(['id' => $request->poem_id], $data);
    }
    else {
      $poem = $user->poems()->create($data);
    }

    $author_request = $request->author;
    if ( ! is_array($author_request)) {
      $author_request = [$author_request];
    }
    $authors = $user->authors()->wherein('id', $author_request)->get();
    $poem->authors()->sync($authors);

    $tags = is_null($request->tags)?'':$request->tags;
    $poem->retag($tags);

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
        $poem->sources()->save($source);
      }
      elseif(!empty($source_id)) {
        $poem->sources()->where('id', '=', $source_id)->delete();
      }
      $counter++;
    }

    return redirect( route('poem', ['id' => $poem->id] ) );
  }
}
