<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;

class Author extends Model
{
  use Taggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'familyname', 'firstname', 'preferredName', 'birthdate', 'deathdate', 'notes',
    ];

    /**
     * Accessor for preferred name attribute.
     *
     * If no preferred name has been set, returns a combination of first and
     * last names.
     *
     * @param  string $preferredName Preferred name as set in the database.
     * @return [type]                [description]
     */
    public function getPreferredNameAttribute( $preferredName)
    {
      if (!empty($preferredName) ) {
        return $preferredName;
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

    /**
     * Returns the mean rating for this author.
     *
     * Only returns the mean of those poems that have been rated. Ignores
     * poems which the user hasn't bother rating yet.
     *
     * @return number
     */
    public function getAveragePoemRating() {
      return $this->poems()->where('rating', '>', 0)->avg('rating');
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
