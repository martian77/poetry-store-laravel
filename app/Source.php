<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = ['id', 'link', 'description', 'sourceType',];
    public function sourceable()
    {
      return $this->morphTo();
    }
}
