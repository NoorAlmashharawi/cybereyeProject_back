<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //    id()
             //specialization
             //experience_years
           //bio
           //rating
          //enrollment_date

        return [

            'username' => $this->faker->unique()->username(),

           'email' => $this-> faker->email(),
           'experience_years' =>$this-> faker->numberBetween(0,10),

            'specialization' =>$this-> faker->word,



        ];

    }
}
