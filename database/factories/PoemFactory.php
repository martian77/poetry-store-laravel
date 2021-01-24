<?php
namespace Database\Factories;

use App\Poem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PoemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Poem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
    }
}
