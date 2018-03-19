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
    $pagetitle = 'Author ' . $author->preferredName;
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
    $pagetitle = 'Authors listing';
    $params = array();
    if (! empty($user)) {
      $authors = Author::withCount('poems')->where('user_id', '=', $user->id);
      if ( isset($_GET['index'])) {
        $params['index'] = $_GET['index'];
        $authors = $authors->where('familyname', 'like', $params['index'] . '%');
        $pagetitle .= ': ' . $params['index'];
      }
      $sortby = '';
      if(isset($_GET['sortby'])) {
        $params['sortby'] = $_GET['sortby'];
        $sortby = $_GET['sortby'];
      }
      switch($sortby) {
        case 'created_at':
          $authors = $authors->orderBy('created_at', 'asc');
          break;
        case 'rating':
          $authors = $authors->orderBy('average_rating', 'desc');
          break;
        case 'poems':
          $authors = $authors->orderBy('poems_count', 'desc');
          break;
        default:
          $authors = $authors->orderBy('familyname', 'asc');
      }
      $authors = $authors->paginate(20);
    }

    $view_data = array(
      'pagetitle' => $pagetitle,
      'authors' => $authors,
      'params' => $params,
    );
    return view('author.list', $view_data);
  }

  public function add()
  {
    $author = new Author;
    $sources = [new Source];
    $view_data = array(
      'pagetitle' => 'Edit author',
      'author' => $author,
      'sources' => $sources,
    );
    return view('author.edit', $view_data);
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
    $data = [
      'firstname' => $request->firstname,
      'familyname' => $request->familyname,
      'birthdate' => $request->birthdate,
      'deathdate' => $request->deathdate,
      'preferredName' => $request->preferredName,
      'notes' => $request->notes,
    ];
    if ( ! empty($request->author_id)) {
      $author = Author::updateOrCreate(
        ['id' => $request->author_id],
        $data
      );
    }
    else {
      $author = $user->authors()->create($data);
    }
    $tags = is_null($request->tags)?'':$request->tags;
    $author->retag($tags);
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
