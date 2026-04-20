<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User1>
 */
class User1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->username(),

            'email' => $this->faker->email(),
            'password' => $this->faker->numberBetween(0, 100),
            'role' => $this->faker->randomElement([
                'Admin','instructor','student'
            ]),
          'actor_type'=> $this->faker->randomElement([
            'Admin','instructor','student'
        ]),
        'actor_id' => $this->faker->numberBetween(0, 100)

        ];
    }
}
