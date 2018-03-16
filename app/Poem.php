<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
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
}
