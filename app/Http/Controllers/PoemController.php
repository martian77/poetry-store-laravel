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
        $pagetitle = 'Poems Listing';
        $poems = array();
        $params = array();

        if (! empty($user)) {
          $poems = $user->poems();

          if ( isset($_GET['index'])) {
            $params['index'] = $_GET['index'];
            $poems = $poems->where('title', 'like', $params['index'] . '%');
            $pagetitle .= ': ' . $params['index'];
          }

          $sortby = '';
          if(isset($_GET['sortby'])) {
            $params['sortby'] = $_GET['sortby'];
            $sortby = $_GET['sortby'];
          }
          switch($sortby) {
            case 'created_at':
              $poems = $poems->orderBy('created_at', 'asc');
              break;
            case 'rating':
              $poems = $poems->orderBy('rating', 'desc');
              break;
            default:
              $poems = $poems->orderBy('title', 'asc');
          }
          $poems = $poems->paginate(15);
        }

        $view_data = array(
          'pagetitle' => $pagetitle,
          'poems' => $poems,
          'params' => $params,
        );
        return view('poem.list', $view_data);
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
            'rating' => $request->rating,
        ];
        if (!empty($request->poem_id)) {
            $poem = $user->poems()->updateOrCreate(['id' => $request->poem_id], $data);
        } else {
            $poem = $user->poems()->create($data);
        }

        $author_request = $request->author;
        if (!is_array($author_request)) {
            $author_request = [$author_request];
        }
        $authors = $user->authors()->wherein('id', $author_request)->get();
        $poem->authors()->sync($authors);

        $tags = is_null($request->tags) ? '' : $request->tags;
        $poem->retag($tags);

//        $counter = 0;
//        while (!empty($request->input('sourceType' . $counter))) {
//            $source_id = $request->input('sourceId' . $counter);
//            if (!empty($source_id)) {
//                $source = Source::find($source_id);
//            } else {
//                $source = new Source;
//            }
//            $source->sourceType = $request->input('sourceType' . $counter);
//            $source->description = $request->input('sourceDescription' . $counter);
//            $source->link = $request->input('sourceLink' . $counter);
//            if (!empty($source->description) || !empty($source->description)) {
//                $poem->sources()->save($source);
//            } elseif (!empty($source_id)) {
//                $poem->sources()->where('id', '=', $source_id)->delete();
//            }
//          $counter++;
//        }
        $this->storeSources( $request->source, $poem);
        return redirect(route('poem', ['id' => $poem->id]));
    }

    /**
     * Updates the sources on the poem with the form values.
     *
     * @param $sources      Sources submitted in the form.
     * @param Poem $poem    The poem to add the sources to.
     * @return Poem         The updated poem.
     */
    protected function storeSources( $sources, Poem $poem )
    {
        $existingSources = $poem->sources;
        if ( count($existingSources) > 0 )
        {
            foreach( $existingSources as $existing )
            {
                $id = $existing->id;
                $updated = false;
                foreach($sources as $key => $source)
                {
                    if ($id == $source['id']) {
                        if ( ! (empty($source['description']) && empty($source['link']))) {
                            $updated = true;
                            $existing->sourceType = $source['sourceType'];
                            $existing->description = $source['description'];
                            $existing->link = $source['link'];
                            $existing->save();
                        }
                        unset($sources[$key]);
                        break;
                    }
                }
                if ( ! $updated )
                {
                    $existing->delete();
                }
            }
        }
        // Now add anything that's left.
        if (count($sources) > 0 ) {
            foreach($sources as $source) {
                if ( ! (empty($source['description']) && empty($source['link']))) {
                    $poem->sources()->create($source);
                }
            }
        }
        return $poem;
    }
}
