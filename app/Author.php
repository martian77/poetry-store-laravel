<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'familyname', 'firstname', 'preferredName', 'birthdate', 'deathdate'
    ];

    public function getPreferredName()
    {
      if (!empty($this->preferredName) ) {
        return $this->preferredName;
      }
      return $this->getCombinedNames();
    }

    public function getCombinedNames() {
      return $this->firstname . ' ' . $this->familyname;
    }

    public function poems()
    {
      return $this->belongsToMany('App\Poem');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
