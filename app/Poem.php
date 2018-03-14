<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    public function authors()
    {
      return $this->belongsToMany('App\Author');
    }
}
