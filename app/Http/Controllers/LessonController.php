<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $lessons = Lesson::with('course')->latest()->paginate(10);
        return view('cms.video.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all(); // عشان نختار الدرس تابع لأي كورس
        return view('cms.video.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'required|url', // رابط الفيديو (يوتيوب مثلا)
            'duration' => 'nullable|string',
        ]);

        $isSaved = Lesson::create($request->all());

        return response()->json([
            'icon' => $isSaved ? 'success' : 'error',
            'title' => $isSaved ? 'تم إضافة الدرس بنجاح' : 'فشل الحفظ'
        ], $isSaved ? 201 : 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        return view('cms.video.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('cms.video.edit', compact('lesson', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        $isUpdated = $lesson->update($request->all());

        return response()->json([
            'icon' => $isUpdated ? 'success' : 'error',
            'title' => $isUpdated ? 'تم التحديث بنجاح' : 'فشل التحديث'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
       $isDeleted = $lesson->delete();
        return response()->json([
            'icon' => $isDeleted ? 'success' : 'error',
            'title' => $isDeleted ? 'تم حذف الدرس' : 'فشل الحذف'
        ]);
    }

}
