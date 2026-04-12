<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء الأقسام أولاً (عشان الفاكتوري يلاقي IDs يربط فيها)
        $categories = ['برمجة المواقع', 'تطبيقات الموبايل', 'التصميم الجرافيكي', 'ذكاء اصطناعي', 'تسويق رقمي'];

foreach ($categories as $name) {
   Category::create([
        'title'       => $name,
        'url'         => str()->slug($name), // بيعمل رابط زي brmgj-almoakaa
        'description' => 'وصف تجريبي لقسم ' . $name, // هان حلينا مشكلة الـ description
    ]);
}

        // 2. إنشاء مستخدمين (مدربين وطلاب)
        // بنعمل 10 مستخدمين عشوائيين
        User::factory(10)->create();

        // 3. إنشاء الكورسات باستخدام الفاكتوري اللي زبطناه قبل شوي
        // رح ننشئ 15 كورس وهمي
        Course::factory(15)->create();

        // 4. ربط الطلاب بالكورسات (جدول الـ enrollment)
        // هادي الحركة عشان "عدد الطلاب" ما يضل صفر في الجدول
        $allCourses = Course::all();
        $allUsers = User::all();

        foreach ($allCourses as $course) {
            // كل كورس بنسجل فيه من 2 لـ 5 طلاب عشوائيين
            $randomStudents = $allUsers->random(rand(2, 5))->pluck('id');
            $course->students()->attach($randomStudents);
        }
    }
}
