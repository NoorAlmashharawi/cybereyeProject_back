<?php

namespace Database\Seeders;

use App\Models\Quizz;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuizzSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ar_SA');
        
        // جلب جميع الكورسات الموجودة
        $courses = Course::all();
        
        if ($courses->isEmpty()) {
            $this->command->error(' لا توجد كورسات! قم بتشغيل CourseSeeder أولاً');
            return;
        }
        
        $quizzes = [];
        
        $quizTitles = [
            'اختبار المنتصف',
            'الاختبار النهائي',
            'اختبار سريع',
            'اختبار فهم المحتوى',
            'تقييم المستوى',
            'اختبار عملي',
            'مراجعة شاملة',
            'اختبار قصير (Quiz)',
            'تحدي المعرفة',
            'اختبار نهاية الوحدة'
        ];
        
        foreach ($courses as $course) {
            // لكل كورس 2-4 كويزات
            $numQuizzes = rand(2, 4);
            
            for ($i = 0; $i < $numQuizzes; $i++) {
                $title = $quizTitles[array_rand($quizTitles)];
                $duration = rand(15, 60); // 15-60 دقيقة
                $totalMarks = rand(20, 100);
                
                $quizzes[] = [
                    'title' => $title . ' - ' . $course->course_name,
                    'description' => $faker->paragraph(2),
                    'duration_minutes' => $duration,
                    'total_marks' => $totalMarks,
                    'course_id' => $course->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        foreach ($quizzes as $quiz) {
            Quizz::create($quiz);
        }
        
        $this->command->info('تم إضافة ' . count($quizzes) . ' كويز بنجاح');
    }
}