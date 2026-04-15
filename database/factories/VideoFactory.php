<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'lesson_id' => Lesson::inRandomOrder()->first()->id ?? 1,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'video_url' => 'https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4',
            'duration' => rand(300, 2000),
            'order' => rand(1, 10),
        ];
    }
}
