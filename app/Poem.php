<?php

namespace App;

use App\Events\PoemSaved;
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
  protected $fillable = ['title', 'body', 'publishedDate', 'copyright', 'license', 'rating'];

  protected $dispatchesEvents = [
      'saved' => PoemSaved::class,
  ];

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
