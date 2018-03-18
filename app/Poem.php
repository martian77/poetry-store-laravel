<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;

class Poem extends Model
{
  use Taggable;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['title', 'body', 'publishedDate', 'copyright', 'license'];

  public function authors()
  {
    return $this->belongsToMany('App\Author');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function sources()
  {
    return $this->morphMany('App\Source', 'sourceable');
  }
}
