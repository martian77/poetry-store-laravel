<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::all()->each(function($user){
          $user->authors()->saveMany(factory(App\Author::class, rand(1, 10))->states('preferredName')->make());
          $user->authors()->saveMany(factory(App\Author::class, rand(2, 10))->make());
        });
    }
}
