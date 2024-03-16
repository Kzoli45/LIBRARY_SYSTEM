<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "author" => $this->faker->name(),
            "title" => $this->faker->text(30),
            "publisher" => $this->faker->company(),
            "year" => $this->faker->year(),
            "release" => $this->faker->numberBetween(1, 4),
            "ISBN" => $this->faker->randomNumber(8),
            "takeable" => $this->faker->boolean(100)
        ];
    }
}
