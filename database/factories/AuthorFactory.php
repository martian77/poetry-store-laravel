<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define( App\Author::class, function($faker) {
  $name = explode(' ', $faker->name);
  return array(
    'firstname' => $name[0],
    'familyname' => $name[1],
    'birthdate' => $faker->date,
    'deathdate' => $faker->date,
    'preferredName' => '',
    // 'links' => array(
    //   'https://en.wikipedia.org/wiki/Ogden_Nash',
    //   'https://www.poets.org/poetsorg/poet/ogden-nash',
    // ),
  );
});

$factory->state(App\Author::class, 'preferredName', function($faker) {
  return [
    'preferredName' => $faker->name,
  ];
});
