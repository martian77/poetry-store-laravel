<?php
namespace Database\Factories;

use App\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = explode(' ', $this->faker->name);
        return [
            'firstname' => $name[0],
            'familyname' => $name[1],
            'birthdate' => $faker->date,
            'deathdate' => $faker->date,
            'preferredName' => '',
            // 'links' => array(
            //   'https://en.wikipedia.org/wiki/Ogden_Nash',
            //   'https://www.poets.org/poetsorg/poet/ogden-nash',
            // ),
        ];
    }

    public function preferredName()
    {
        return $this->state(function (array $attributes) {
            return [
                'preferredName' => $this->faker->name,,
            ];
        });
    }
}
