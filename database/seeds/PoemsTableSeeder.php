<?php

use Illuminate\Database\Seeder;

class PoemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Poem::class, 6)->create()->each(function ($poem) {
          $num_authors = rand(1, 3);
          $authors = App\Author::all()->random($num_authors);

          $poem->authors()->saveMany($authors);
        });
    }
}
