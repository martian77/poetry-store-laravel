<?php

namespace App\Http\Controllers;

use App\Poem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}
