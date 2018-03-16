<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function sourceable()
    {
      return $this->morphTo();
    }
}
