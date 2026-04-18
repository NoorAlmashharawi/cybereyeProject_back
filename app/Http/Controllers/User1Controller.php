<?php

namespace App\Http\Controllers;

use App\Models\User1;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Admin;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User1Controller extends Controller
{
    

    
    
  
    public function notifications($id)
    {
        $user = User1::with('actor')->findOrFail($id);
        
        // جلب جميع الإشعارات مع ترقيم الصفحات
        $notifications = $user->notifications()->paginate(20);
        
        // عدد الإشعارات غير المقروءة
        $unreadCount = $user->unreadNotifications->count();
        
        return view('users.notifications', compact('user', 'notifications', 'unreadCount'));
    }
    
 
    public function showNotification($userId, $notificationId)
    {
        $user = User1::findOrFail($userId);
        $notification = $user->notifications()->findOrFail($notificationId);
        
        // تعليم الإشعار كمقروء
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }
        
        // استخراج البيانات من الـ notification
        $data = $notification->data;
        
        return view('users.notification-details', compact('notification', 'data', 'user'));
    }
 
    public function markAsRead($userId, $notificationId)
    {
        $user = User1::findOrFail($userId);
        $notification = $user->notifications()->findOrFail($notificationId);
        
        $notification->markAsRead();
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'تم تعليم الإشعار كمقروء');
    }
    
    /**
     * تعليم جميع الإشعارات كمقروءة
     */
    public function markAllAsRead($userId)
    {
        $user = User1::findOrFail($userId);
        $user->unreadNotifications->markAsRead();
        
        return redirect()->back()->with('success', 'تم تعليم جميع الإشعارات كمقروءة');
    }
    
    /**
     * حذف إشعار
     */
    public function deleteNotification($userId, $notificationId)
    {
        $user = User1::findOrFail($userId);
        $notification = $user->notifications()->findOrFail($notificationId);
        
        $notification->delete();
        
        return redirect()->back()->with('success', 'تم حذف الإشعار');
    }
    
    /**
     * حذف جميع الإشعارات
     */
    public function deleteAllNotifications($userId)
    {
        $user = User1::findOrFail($userId);
        $user->notifications()->delete();
        
        return redirect()->back()->with('success', 'تم حذف جميع الإشعارات');
    }
    
    /**
     * API: جلب الإشعارات غير المقروءة (للـ AJAX)
     */
    public function getUnreadNotifications($userId)
    {
        $user = User1::findOrFail($userId);
        $notifications = $user->unreadNotifications;
        $count = $notifications->count();
        
        return response()->json([
            'count' => $count,
            'notifications' => $notifications,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
         

        
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User1 $user1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User1 $user1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User1 $user1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User1 $user1)
    {
        //
    }
}
