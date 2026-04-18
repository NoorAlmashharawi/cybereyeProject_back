<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::with('course')->get();
        return view('cms.material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $courses = Course::all();
    return view('cms.material.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'file' => 'required|file|mimes:pdf,zip,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('materials', 'public');

            $isSaved = Material::create([
                'title' => $request->title,
                'course_id' => $request->course_id,
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
                'description' => $request->description,
            ]);

            return response()->json(['icon' => 'success', 'title' => 'تم رفع الملف بنجاح']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
       //التأكد أن الملف موجود فعليا
        if (Storage::disk('public')->exists($material->file_path)) {

            // زيادة عداد التحميلات
            $material->increment('downloads_count');

            // التحميل المباشر
            return response()->download(storage_path('app/public/' . $material->file_path), $material->title . '.' . $material->file_type);
        }

        return back()->with('error', 'عذراً، الملف غير موجود على السيرفر');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $courses = Course::all();
        return view('cms.material.edit', compact('material', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id) {
    $material = Material::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar|max:20480',
    ]);

    $material->title = $request->title;
    $material->description = $request->description;

    if ($request->hasFile('file')) {
        // حذف الملف القديم من السيرفر لتوفير المساحة
        Storage::delete($material->file_path);

        // رفع الملف الجديد
        $file = $request->file('file');
        $path = $file->store('materials', 'public');
        $material->file_path = $path;
        $material->file_type = $file->getClientOriginalExtension();
    }

    $material->save();
    return response()->json(['message' => 'تم التحديث بنجاح'], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $deleted = $material->delete();

    return response()->json([
        'icon' => $deleted ? 'success' : 'error',
        'title' => $deleted ? 'تم نقل المادة للأرشيف' : 'فشل الحذف'
    ]);
    }
    // لعرض المواد المؤرشفة (سلة المحذوفات)
public function trashed() {
    $materials = Material::onlyTrashed()->with('course')->get();
    return view('cms.material.trashed', compact('materials'));
}

// لاستعادة مادة من الأرشيف
public function restore($id) {
    Material::withTrashed()->findOrFail($id)->restore();
    return redirect()->back()->with('success', 'تم استعادة المادة بنجاح');
}

// للحذف النهائي (من قاعدة البيانات والملفات)
public function forceDelete($id) {
    $material = Material::withTrashed()->findOrFail($id);
    //حذف الملف من التخزين بالاول 
    Storage::delete($material->file_path);
    $material->forceDelete();
    return redirect()->back()->with('success', 'تم الحذف النهائي للمادة');
}
    }

