<?php

namespace Database\Factories;

use App\Models\Category; //  import
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
         return [
        //     // استخدمت sentence عشان يعطيكِ اسم كورس منطقي مش كلمة واحدة
        //     'course_name' => fake()->sentence(3),

        //     // Faker ما عنده shortdescription، بنستخدم text وبنحدد عدد الحروف
        //     'short_description' => fake()->text(100),

        //     'no_hours' => fake()->numberBetween(1, 50),

        //     // الـ rating عادة بكون رقم عشري بين 1 و 5
        //     'rating' => fake()->randomFloat(1, 1, 5),
        //     'level'=> fake()->randomElement(['مبتدئ', 'متوسط', 'متقدم']),
        //     // هان بنسحب ID عشوائي من الأقسام الموجودة فعلياً
        //     'category_id' => Category::all()->random()->id,
        //     'instructor_id'     => \App\Models\User::inRandomOrder()->first()->id ?? \App\Models\User::factory(),
      ];
    }
}
