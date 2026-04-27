<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MaterialSeeder extends Seeder
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
        
        $materials = [];
        
        // أنواع الملفات المدعومة
        $fileTypes = ['pdf', 'docx', 'pptx', 'zip', 'txt'];
        $titles = [
            'ملخص الدورة',
            'الشرائح التفاعلية',
            'تمارين عملية',
            'المراجع والمصادر',
            'واجب منزلي',
            'مشروع تطبيقي',
            'أسئلة مراجعة',
            'نماذج اختبارات',
            'دليل المدرب',
            'موارد إضافية'
        ];
        
        foreach ($courses as $course) {
            // لكل كورس 3-6 مواد تعليمية
            $numMaterials = rand(3, 6);
            
            for ($i = 0; $i < $numMaterials; $i++) {
                $fileType = $fileTypes[array_rand($fileTypes)];
                $materials[] = [
                    'title' => $titles[array_rand($titles)] . ' - ' . $course->course_name,
                    'file_path' => 'materials/' . uniqid() . '.' . $fileType,
                    'file_type' => $fileType,
                    'description' => $faker->sentence(8),
                    'downloads_count' => rand(0, 500),
                    'course_id' => $course->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        foreach ($materials as $material) {
            Material::create($material);
        }
        
        $this->command->info(' تم إضافة ' . count($materials) . ' مادة تعليمية بنجاح');
    }
}