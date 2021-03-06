<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'isbn' => $this->faker->unique()->numberBetween(1000,5000),
            'authors' => [$this->faker->name()],
            'country' => $this->faker->country(),
            'number_of_pages' => $this->faker->numberBetween(120, 400),
            'publisher' => $this->faker->name(),
            'release_date' => $this->faker->date()
        ];
    }
}
