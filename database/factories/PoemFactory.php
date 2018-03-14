<?php

use Faker\Generator as Faker;

$factory->define(App\Poem::class, function (Faker $faker) {
    $poem = array();
    for ($i = 0; $i<10; $i++) {
      $poem[] = $faker->sentence(6);
    }
    return [
        'title' => substr($faker->sentence(2), 0, -1),
        'author' => $faker->name,
        'body' => implode('<br />', $poem),
    ];
});
