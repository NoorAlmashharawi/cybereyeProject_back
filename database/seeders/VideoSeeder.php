<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Course;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        
        if ($courses->isEmpty()) {
            $this->command->warn('لا توجد كورسات، تأكد من تشغيل CourseSeeder أولاً');
            return;
        }
        
        $videosData = [];
        
        foreach ($courses as $course) {
            $videosData = array_merge($videosData, [
                [
                    'title' => 'مقدمة عن ' . $course->course_name,
                    'description' => 'تعريف عام بالمحتوى الذي سيتم تغطيته في هذه الدورة',
                    'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration' => 600,
                    'order_number' => 1,
                    'course_id' => $course->id,
                ],
                [
                    'title' => 'أساسيات ' . $course->course_name,
                    'description' => 'شرح المفاهيم الأساسية والمصطلحات الهامة',
                    'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration' => 1200,
                    'order_number' => 2,
                    'course_id' => $course->id,
                ],
                [
                    'title' => 'تطبيقات عملية على ' . $course->course_name,
                    'description' => 'تمارين وتطبيقات عملية على ما تم تعلمه',
                    'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'duration' => 900,
                    'order_number' => 3,
                    'course_id' => $course->id,
                ],
            ]);
        }
        
        foreach ($videosData as $video) {
            Video::create($video);
        }
        
        $this->command->info('تم إضافة ' . count($videosData) . ' فيديو بنجاح');
    }
}