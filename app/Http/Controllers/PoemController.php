<?php

namespace App\Http\Controllers;

use App\Poem;
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
    $poem = new Poem;
    $authors = $user->authors()->get();
    return view('poem.edit', array('pagetitle' => 'Add Poem', 'poem' => $poem, 'authors' => $authors));
  }
  public function edit($id)
  {
    $user = Auth::user();
    $poem = $user->poems()->find($id);
    $authors = $user->authors()->get();
    return view('poem.edit', array('pagetitle' => 'Edit Poem', 'poem' => $poem, 'authors' => $authors));
  }
  public function store(StorePoemRequest $request)
  {

  }
}
