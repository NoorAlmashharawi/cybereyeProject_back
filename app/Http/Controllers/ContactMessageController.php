<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // 1. التحقق من البيانات
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required|string|min:10',
    ]);

 // 1. تخزين الرسالة
$contact = \App\Models\ContactMessage::create([
    'user_name'  => $request->name,
    'user_email' => $request->email,
    'subject'    => $request->subject,
    'message'    => $request->message,
    'user_id'    => auth()->check() ? auth()->id() : null,
]);

// 2. إرسال الإشعار لمستخدمي جدول User1 اللي نوعهم Admin
$admins = \App\Models\User1::where('role', 'Admin')->get();

foreach ($admins as $admin) {
    // تأكدي إن اسم الكلاس NewContactMessage صح (حسب ما هو مكتوب عندك)
    $admin->notify(new \App\Notifications\NewContactMessage($contact));
}

    return back()->with('success', 'شكراً لك! تم إرسال رسالتك بنجاح وسنتواصل معك قريباً.');
}

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        //
    }
}
