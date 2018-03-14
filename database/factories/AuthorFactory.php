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

$factory->define( App\Author::class, function() {
  return array(
    'id' => 1,
    'firstname' => 'Ogden',
    'familyname' => 'Nash',
    'birthdate' => '1902-08-19',
    'deathdate' => '1971-05-19',
    'links' => array(
      'https://en.wikipedia.org/wiki/Ogden_Nash',
      'https://www.poets.org/poetsorg/poet/ogden-nash',
    ),
  );
});

$factory->state(App\Author::class, 'preferredName', function($faker) {
  return [
    'preferredName' => $faker->name,
  ];
});

$factory->state(App\Author::class, 'noPreferredName', function($faker) {
  return [
    'preferredName' => '',
  ];
});
