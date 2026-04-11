<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dictionary;

class DictionarySeeder extends Seeder
{
    public function run(): void
    {
        $terms = [
            ['term' => 'Backdoor', 'definition' => 'ثغرة خلفية تسمح للمخترق بالدخول', 'img' => 'cms/cyber/backdoor.jpg'],
            ['term' => 'Botnet', 'definition' => 'شبكة من الأجهزة المخترقة', 'img' => 'cms/cyber/botnet.png'],
            ['term' => 'Firewall', 'definition' => 'جدار ناري لحماية الشبكة', 'img' => 'cms/cyber/firewall.png'],
            ['term' => 'Malware', 'definition' => 'برمجية خبيثة', 'img' => 'cms/cyber/malware.jpg'],
            ['term' => 'Phishing', 'definition' => 'احتيال إلكتروني', 'img' => 'cms/cyber/phishing.jpg'],
            ['term' => 'Ransomware', 'definition' => 'برمجية فدية', 'img' => 'cms/cyber/ransomware.jpg'],
            ['term' => 'Social Engineering', 'definition' => 'هندسة اجتماعية', 'img' => 'cms/cyber/social.jpg'],
            ['term' => 'Spyware', 'definition' => 'برمجية تجسس', 'img' => 'cms/cyber/spyware.png'],
            ['term' => 'Trojan', 'definition' => 'حصان طروادة', 'img' => 'cms/cyber/trojan.jpg'],
            ['term' => 'VPN', 'definition' => 'شبكة خاصة افتراضية', 'img' => 'cms/cyber/vpn.jpg'],
            ['term' => 'Brute Force', 'definition' => 'هجوم القوة الغاشمة', 'img' => 'cms/cyber/brute.png'],
        ];

        foreach ($terms as $item) {
            Dictionary::create([
                'term' => $item['term'],
                'definition' => $item['definition'],
                'img' => $item['img'],  
            ]);
        }
        
        $this->command->info('تم إضافة ' . Dictionary::count() . ' صور');
    }
}