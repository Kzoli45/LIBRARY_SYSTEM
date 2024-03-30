<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "postcode" => $this->faker->randomNumber(4),
            "city" => $this->faker->city(),
            "street" => $this->faker->streetAddress(),
            "door" => $this->faker->numberBetween(1, 100),
            "type" => $this->faker->randomElement(['student', 'teacher', 'foreign', 'other']),
            "contact" => $this->faker->phoneNumber()
        ];
    }
}
