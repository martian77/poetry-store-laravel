<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Poem;

class PoemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::all()->each(function($user){
          $user->poems()->saveMany(Poem::factory()->count(rand(6, 20))->make());
          foreach( $user->poems()->get() as $poem) {
            $num_authors = rand(1, 3);
            $authors = $poem->user->authors()->get()->random($num_authors);
            $poem->authors()->saveMany($authors);
          }

      });
    }
}
