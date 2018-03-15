<?php

use Faker\Generator as Faker;

$factory->define(App\Poem::class, function (Faker $faker) {
    $poem = array();
    for ($i = 0; $i<10; $i++) {
      $poem[] = $faker->sentence(6);
    }
    return [
        'title' => substr($faker->sentence(2), 0, -1),
        'body' => implode('<br />', $poem),
        'publishedDate' => rand(1654, 2017),
        'copyright' => 'Copyright &copy ' . rand(1900, 2017) . ' ' . $faker->name,
        'license' => $faker->sentence(3),
    ];
});
