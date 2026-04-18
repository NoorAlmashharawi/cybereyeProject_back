<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
            'text' => 'required|string|max:500',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        // 2. حفظ التعليق
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->user_id = Auth::id(); // استخدام الكلاس بشكل صريح بيمنع الإيرور
        $comment->lesson_id = $request->lesson_id;

        $isSaved = $comment->save();

        // 3. الرد (Response)
        return response()->json([
            'icon' => $isSaved ? 'success' : 'error',
            'title' => $isSaved ? 'تم إضافة التعليق بنجاح' : 'فشل إضافة التعليق'
        ], $isSaved ? 200 : 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $deleted = $comment->delete();

        return response()->json([
            'icon' => $deleted ? 'success' : 'error',
            'title' => $deleted ? 'تم حذف التعليق' : 'فشل الحذف'
        ], $deleted ? 200 : 400);
    }
}
