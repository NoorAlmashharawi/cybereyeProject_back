<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification
{
    use Queueable;

    protected $contact; // متغير لحفظ بيانات رسالة التواصل

    /**
     * نمرر كائن الرسالة (Contact) عند إنشاء الإشعار
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * نحدد القناة: 'database' عشان تظهر في الجرس
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * هاد أهم جزء: البيانات اللي بتظهر في الـ Blade
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'رسالة تواصل جديدة ✉️',
            'message' => 'قام ' . $this->contact->user_name . ' بإرسال رسالة تواصل جديدة.',
            'contact_id' => $this->contact->id,

            // 'url' => route('homes.contact', $this->contact->id),
            'icon' => 'fas fa-envelope text-success', // أيقونة مغلف أخضر
        ];
    }
}
