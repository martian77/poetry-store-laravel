<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentTaggable\Taggable;

/**
 * Class Author
 * @package App
 */
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
     * @return string                Either preferred name or combined if not set.
     */
    public function getPreferredNameAttribute( $preferredName)
    {
      if (!empty($preferredName) ) {
        return $preferredName;
      }
      return $this->getCombinedNames();
    }

    /**
     * Fetches the combined author names.
     *
     * @return string
     */
    public function getCombinedNames() {
      return $this->firstname . ' ' . $this->familyname;
    }

    /**
     * Fetches the poems that are connected to this author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
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

    /**
     * Fetches the user that this author was added by.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    /**
     * Fetches the sources stored against this author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function sources()
    {
      return $this->morphMany('App\Source', 'sourceable');
    }
}
