<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('courses')->get();
        return view('cms.Category.index', compact('categories'));
    }

    public function create()
    {
        return view('cms.Category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:100',
            'status'      => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'url'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('url')) {
            $data['url'] = $request->file('url')->store('categories', 'public');
        }

        $category = Category::create($data);

        return response()->json([
            'message' => $category ? 'تم الحفظ بنجاح' : 'فشل الحفظ'
        ], $category ? 200 : 400);
    }

    public function edit(Category $category)
    {
        return view('cms.Category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:100',
            'status'      => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'url'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('url')) {
            if ($category->url && Storage::disk('public')->exists($category->url)) {
                Storage::disk('public')->delete($category->url);
            }
            $data['url'] = $request->file('url')->store('categories', 'public');
        }

        $isUpdated = $category->update($data);

        return response()->json([
            'message' => $isUpdated ? 'تم تحديث البيانات بنجاح' : 'فشل التحديث'
        ], $isUpdated ? 200 : 400);
    }

    // --- دوال الحذف والأرشفة ---

    public function destroy(Category $category)
    {
        $isDeleted = $category->delete();
        return response()->json([
            'message' => $isDeleted ? 'تم نقل المسار إلى الأرشيف' : 'حدث خطأ ما'
        ], $isDeleted ? 200 : 400);
    }

    /**
     * عرض الأرشيف (سلة المحذوفات)
     */
    public function trashed()
    {
        $categories = Category::onlyTrashed()->get();
        return view('cms.Category.trashed', compact('categories'));
    }

    /**
     * استعادة من الأرشيف
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->back()->with('success', 'تم استعادة التصنيف بنجاح');
    }

    /**
     * الحذف النهائي
     */
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        // حذف الصورة نهائياً من الـ Storage
        if ($category->url && Storage::disk('public')->exists($category->url)) {
            Storage::disk('public')->delete($category->url);
        }

        $category->forceDelete();
        return redirect()->back()->with('success', 'تم حذف التصنيف نهائياً');
    }
}
