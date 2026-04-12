<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $videos = Video::with('lesson')->orderBy('id', 'desc')->paginate(10);

        return response()->view('cms.video.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $lessons = Lesson::all();
    return view('cms.video.create', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
 
    // 1. Validation
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'lesson_id' => 'required|exists:lessons,id',
        'video' => 'required|file|mimes:mp4,mov,avi,webm|max:20480',
        'duration_minutes' => 'nullable|integer',
        'order' => 'nullable|integer',
    ]);

    // 2. Upload Video
    $file = $request->file('video');
    $path = $file->store('videos', 'public');

    // 3. Save
    Video::create([
        'title' => $request->title,
        'description' => $request->description,
        'lesson_id' => $request->lesson_id,
        'file_path' => $path,
        'duration_minutes' => $request->duration_minutes,
        'order' => $request->order ?? 1,
    ]);

    // 4. Response
    return response()->json([
        'title' => 'تم رفع الفيديو بنجاح'
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
