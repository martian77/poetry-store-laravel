<?php

namespace App\Listeners;

use App\Events\PoemSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateAuthorAverageRating
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PoemSaved  $event
     * @return void
     */
    public function handle(PoemSaved $event)
    {
        $poem = $event->poem;
        $authors = $poem->authors()->get();
        foreach( $authors as $author) {
          $author->average_rating = $author->getAveragePoemRating();
          $author->save();
        }
    }
}
