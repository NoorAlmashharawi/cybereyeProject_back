<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryEntry;
use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    public function run()
    {
        $terms = [
            ['term' => 'Phishing', 'definition' => 'هي عملية احتيال إلكتروني للحصول على معلومات حساسة مثل كلمات المرور من خلال انتحال شخصية جهة موثوقة.', 'category' => 'أمن سيبراني', 'example' => 'تلقى بريداً إلكترونياً يطلب منه تحديث كلمة المرور من رابط وهمي.'],
            ['term' => 'Malware', 'definition' => 'برامج ضارة تهدف إلى اختراق أو إتلاف الأجهزة والبيانات.', 'category' => 'أمن سيبراني', 'example' => 'فيروس، دودة، حصان طروادة، برامج فدية.'],
            ['term' => 'Firewall', 'definition' => 'نظام أمان يراقب ويمنع حركة البيانات غير المصرح بها.', 'category' => 'أمن سيبراني', 'example' => 'جدار حماية يمنع الدخول غير المصرح به للشبكة.'],
            ['term' => 'Encryption', 'definition' => 'تحويل البيانات إلى صيغة غير قابلة للقراءة لحمايتها.', 'category' => 'أمن سيبراني', 'example' => 'تشفير البيانات في تطبيقات المراسلة مثل واتساب.'],
            ['term' => 'Laravel', 'definition' => 'إطار عمل (Framework) مفتوح المصدر لتطوير تطبيقات الويب بلغة PHP.', 'category' => 'برمجيات', 'example' => 'تم بناء هذا المشروع باستخدام Laravel 12.'],
            ['term' => 'Middleware', 'definition' => 'طبقة وسيطة بين الطلب والاستجابة تستخدم لفحص الطلبات.', 'category' => 'Laravel', 'example' => 'Middleware auth:admin لحماية لوحة التحكم.'],
            ['term' => 'Eloquent', 'definition' => 'ORM المدمج في Laravel للتعامل مع قاعدة البيانات بسهولة.', 'category' => 'Laravel', 'example' => 'User::where("role", "admin")->get();'],
        ];
        
        foreach ($terms as $term) {
            Dictionary::create($term);
        }
        
        echo " تم إدخال " . count($terms) . " مصطلح في القاموس\n";
    }
}