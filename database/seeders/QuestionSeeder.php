<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Quizz;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = Quizz::all();
        
        if ($quizzes->isEmpty()) {
            $this->command->error(' لا توجد كويزات! قم بتشغيل QuizzSeeder أولاً');
            return;
        }
        
        $questions = [];
        
        foreach ($quizzes as $quiz) {
            // أسئلة اختيار من متعدد (MCQ)
            $mcqQuestions = [
                [
                    'title' => 'ما هو الأمن السيبراني؟',
                    'type' => 'mc',
                    'options' => json_encode(['حماية الأجهزة فقط', 'حماية البيانات والشبكات', 'حماية المستخدمين فقط', 'كل ما سبق']),
                    'correct_answer' => 'كل ما سبق',
                    'points' => 2,
                ],
                [
                    'title' => 'أي من التالي يعتبر برنامج ضار؟',
                    'type' => 'mc',
                    'options' => json_encode(['Firewall', 'Antivirus', 'Malware', 'Encryption']),
                    'correct_answer' => 'Malware',
                    'points' => 2,
                ],
                [
                    'title' => 'ما هو هجوم التصيد (Phishing)؟',
                    'type' => 'mc',
                    'options' => json_encode(['هجوم على الشبكات', 'احتيال إلكتروني لسرقة البيانات', 'هجوم على الخوادم', 'اختراق كلمة المرور']),
                    'correct_answer' => 'احتيال إلكتروني لسرقة البيانات',
                    'points' => 3,
                ],
                [
                    'title' => 'أي مما يلي يستخدم لحماية الشبكات؟',
                    'type' => 'mc',
                    'options' => json_encode(['Firewall', 'Antivirus', 'VPN', 'كل ما سبق']),
                    'correct_answer' => 'كل ما سبق',
                    'points' => 2,
                ],
                [
                    'title' => 'ما هو الغرض من التشفير؟',
                    'type' => 'mc',
                    'options' => json_encode(['إخفاء البيانات', 'تأمين البيانات', 'حماية البيانات', 'كل ما سبق']),
                    'correct_answer' => 'كل ما سبق',
                    'points' => 2,
                ],
            ];
            
            // أسئلة صح/خطأ (True/False)
            $tfQuestions = [
                [
                    'title' => 'جدار الحماية (Firewall) يستخدم لمنع الوصول غير المصرح به.',
                    'type' => 'tf',
                    'options' => null,
                    'correct_answer' => 'صح',
                    'points' => 1,
                ],
                [
                    'title' => 'البرامج الضارة لا تؤثر على أنظمة التشغيل.',
                    'type' => 'tf',
                    'options' => null,
                    'correct_answer' => 'خطأ',
                    'points' => 1,
                ],
                [
                    'title' => 'VPN تستخدم لإخفاء عنوان IP الخاص بالمستخدم.',
                    'type' => 'tf',
                    'options' => null,
                    'correct_answer' => 'صح',
                    'points' => 1,
                ],
                [
                    'title' => 'الهندسة الاجتماعية تعتمد على استغلال الثغرات التقنية فقط.',
                    'type' => 'tf',
                    'options' => null,
                    'correct_answer' => 'خطأ',
                    'points' => 1,
                ],
                [
                    'title' => 'التشفير المتماثل يستخدم نفس المفتاح للتشفير وفك التشفير.',
                    'type' => 'tf',
                    'options' => null,
                    'correct_answer' => 'صح',
                    'points' => 2,
                ],
            ];
            
            // إضافة 3-5 أسئلة MCQ لكل كويز
            $numMcq = rand(3, 5);
            for ($i = 0; $i < $numMcq; $i++) {
                $question = $mcqQuestions[array_rand($mcqQuestions)];
                $questions[] = [
                    'title' => $question['title'],
                    'type' => $question['type'],
                    'options' => $question['options'],
                    'correct_answer' => $question['correct_answer'],
                    'points' => $question['points'],
                    'quizz_id' => $quiz->id,
                ];
            }
            
            // إضافة 2-4 أسئلة صح/خطأ لكل كويز
            $numTf = rand(2, 4);
            for ($i = 0; $i < $numTf; $i++) {
                $question = $tfQuestions[array_rand($tfQuestions)];
                $questions[] = [
                    'title' => $question['title'],
                    'type' => $question['type'],
                    'options' => $question['options'],
                    'correct_answer' => $question['correct_answer'],
                    'points' => $question['points'],
                    'quizz_id' => $quiz->id,
                ];
            }
        }
        
        foreach ($questions as $question) {
            Question::create($question);
        }
        
        $this->command->info('تم إضافة ' . count($questions) . ' سؤال بنجاح');
    }
}