<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory

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

          'email' => $this-> faker->email(),
          'progress' =>$this-> faker->numberBetween(0,100),
           'level' => $this-> faker->randomElement([
            'خبير','متوسط','مبتدئ'
           ]),
            'specialization' =>$this-> faker->word,
            'status' => $this->faker->randomElement([
                'غير نشط','نشط'
               ]),
     

        ];
    }
}
