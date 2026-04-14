<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $videos = Video::orderBy('created_at', 'asc')->get();
        
        return view('cms.Video.index', compact('videos'));
    }


    public function player()
    {
        $videos = Video::orderBy('created_at', 'asc')->get();
        
        return view('cms.Video.player', compact('videos'));
    }
    
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.Video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration'    => 'nullable|integer',  
            'url'         => 'required|file|mimes:mp4,mkv,avi,mov|max:102400',
            'lesson_id'   => 'nullable|exists:lessons,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], 422);
        }
    
        $data = $validator->validated();
    
       
        $data['duration'] = $request->duration ?? 0;
    
        if ($request->hasFile('url')) {
            $path = $request->file('url')->store('videos', 'public');
            $data['url'] = Storage::url($path);
        }
    
        $video = Video::create($data);
    
        return response()->json([
            'success' => true,
            'message' => $video ? 'تم الحفظ بنجاح' : 'فشل الحفظ',
            'video' => $video
        ], $video ? 200 : 400);
    }
    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('cms.Video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('cms.Video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        
        if (!$video) {
            return response()->json(['message' => 'الفيديو غير موجود'], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration'    => 'nullable|integer',
            'url'         => 'nullable|file|mimes:mp4,mkv,avi,mov|max:102400',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()], 422);
        }
        
        $data = $validator->validated();
        $data['duration'] = $request->duration ?? 0;
        
        
        if ($request->hasFile('url')) {
           
            if ($video->url) {
                $oldPath = str_replace('/storage/', '', $video->url);
                Storage::disk('public')->delete($oldPath);
            }
            
        
            $path = $request->file('url')->store('videos', 'public');
            $data['url'] = Storage::url($path);
        }
        
        $video->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'تم التحديث بنجاح',
            'video' => $video
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        if ($video->url) {
            $path = str_replace('/storage/', '', $video->url);
            Storage::disk('public')->delete($path);
        }
        $video->delete();
        
        return redirect()->route('videos.index')->with('success', 'تم الحذف بنجاح');
    }
}