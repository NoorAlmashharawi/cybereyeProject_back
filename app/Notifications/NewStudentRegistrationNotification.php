<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewStudentRegistrationNotification extends Notification
{
    use Queueable;

    protected $student;

    // 1. نمرر بيانات الطالب للإشعار عند إنشائه
    public function __construct($student)
    {
        $this->student = $student;
    }

    // 2. نحدد القناة لتكون قاعدة البيانات (Database) بدل الإيميل
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    // 3. نحدد شكل البيانات اللي حتتخزن في جدول notifications
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'تسجيل طالب جديد',
            'message' => 'قام الطالب ' . $this->student->firstName . ' ' . $this->student->lastName . ' بإنشاء حساب جديد.',
            'student_id' => $this->student->id,
            'email' => $this->student->email,
        ];
        
    }
}
