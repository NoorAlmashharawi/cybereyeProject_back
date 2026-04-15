<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Quizz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
 class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['mc', 'tf']);

        return [
            'title' => $this->faker->sentence(6),

            'type' => $type,

            'options' => $type === 'mc'
                ? json_encode([
                    $this->faker->word(),
                    $this->faker->word(),
                    $this->faker->word(),
                    $this->faker->word(),
                ])
                : null,

            'correct_answer' => $type === 'mc'
                ? $this->faker->randomElement([
                    'option1',
                    'option2',
                    'option3',
                    'option4',
                ])
                : $this->faker->randomElement(['true', 'false']),

            'points' => $this->faker->numberBetween(1, 5),

            'quizz_id' => Quizz::factory(),
        ];
    }
}
