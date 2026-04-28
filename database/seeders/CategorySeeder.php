<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
          
            [
                'title' => 'أساسيات الأمن السيبراني',
                'url' => 'cybersecurity-basics',
                'description' => 'تعلم أساسيات الأمن السيبراني والمفاهيم الأساسية',
                'status' => 'active'
            ],
            [
                'title' => 'أمن الشبكات',
                'url' => 'network-security',
                'description' => 'حماية الشبكات من الاختراقات والهجمات',
                'status' => 'active'
            ],
            [
                'title' => 'الاختراق الأخلاقي',
                'url' => 'ethical-hacking',
                'description' => 'تعلم تقنيات الاختراق الأخلاقي بطرق قانونية',
                'status' => 'active'
            ],
            [
                'title' => 'أمن التطبيقات',
                'url' => 'application-security',
                'description' => 'تأمين التطبيقات ضد الثغرات والهجمات',
                'status' => 'active'
            ],
            [
                'title' => 'الاستجابة للحوادث',
                'url' => 'incident-response',
                'description' => 'كيفية التعامل مع الحوادث الأمنية والاختراقات',
                'status' => 'active'
            ],
            [
                'title' => 'أمن قواعد البيانات',
                'url' => 'database-security',
                'description' => 'حماية قواعد البيانات من الاختراق',
                'status' => 'active'
            ],
            [
                'title' => 'أمن السحابة',
                'url' => 'cloud-security',
                'description' => 'تأمين البنية التحتية السحابية',
                'status' => 'active'
            ],
            [
                'title' => 'الهندسة الاجتماعية',
                'url' => 'social-engineering',
                'description' => 'فهم أساليب الهندسة الاجتماعية وكيفية الحماية منها',
                'status' => 'active'
            ],
            [
                'title' => 'التشفير',
                'url' => 'cryptography',
                'description' => 'تعلم أساسيات التشفير والخوارزميات',
                'status' => 'active'
            ],
            [
                'title' => 'اختبار الاختراق',
                'url' => 'penetration-testing',
                'description' => 'تقنيات اختبار الاختراق المهنية',
                'status' => 'active'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info(' تم إضافة ' . count($categories) . ' تصنيف بنجاح');
    }
}