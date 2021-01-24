<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Author;

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
          $user->authors()->saveMany(Author::factory()->count(rand(1, 10))->preferredName()->make());
          $user->authors()->saveMany(Author::factory()->count(rand(2, 10))->make());
        });
    }
}
