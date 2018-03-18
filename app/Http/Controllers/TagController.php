<?php

namespace App\Http\Controllers;

use App\Poem;
use App\Author;
use Cviebrock\EloquentTaggable\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function show($normalised)
    {
      $tagname = urldecode($normalised);
      $tag = Tag::findByName($tagname);
      $user = Auth::user();
      $authors = $tag->authors->where('user_id', '=', $user->id);
      $poems = $tag->poems->where('user_id', '=', $user->id);
      $view_data = array(
        'pagetitle' => 'Tag: ' . $tag->name,
        'authors' => $authors,
        'poems' => $poems,
      );
      return view('tags.show', $view_data);
    }
}
