<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * عرض قائمة التصنيفات النشطة
     */
    public function index()
    {
        $categories = Category::all();
        return view('cms.Category.index', compact('categories'));
    }

    /**
     * عرض سلة المحذوفات
     */
    public function trashed()
    {
        $categories = Category::onlyTrashed()->get();
        return view('cms.Category.trashed', compact('categories'));
    }

    /**
     * استعادة تصنيف
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

        // حذف الصورة باستخدام الدالة الخاصة بالأسفل
        $this->deleteImage($category->url);

        $category->forceDelete();
        return redirect()->back()->with('success', 'تم حذف التصنيف نهائياً');
    }

    /**
     * عرض صفحة إنشاء تصنيف جديد
     */
    public function create()
    {
        return view('cms.Category.create');
    }

    /**
     * تخزين تصنيف جديد
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('url')) {
            $data['url'] = $request->file('url')->store('categories', 'public');
        }

        $category = Category::create($data);

        return response()->json([
            'message' => $category ? 'تم الحفظ بنجاح' : 'فشل الحفظ'
        ], $category ? 200 : 400);
    }

    /**
     * عرض تفاصيل
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * عرض صفحة التعديل
     */
    public function edit(Category $category)
    {
        return view('cms.Category.edit', compact('category'));
    }

    /**
     * تحديث بيانات التصنيف
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('url')) {
            // حذف الصورة القديمة
            $this->deleteImage($category->url);
            // تخزين الجديدة
            $data['url'] = $request->file('url')->store('categories', 'public');
        }

        $isUpdated = $category->update($data);

        return response()->json([
            'message' => $isUpdated ? 'تم تحديث بيانات المسار بنجاح' : 'فشل التحديث'
        ], $isUpdated ? 200 : 400);
    }

    /**
     * نقل إلى سلة المحذوفات (Soft Delete)
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $isDeleted = $category->delete();

        return response()->json([
            'icon'    => $isDeleted ? 'success' : 'error',
            'title'   => $isDeleted ? 'تمت الأرشفة' : 'فشل الإجراء',
            'message' => $isDeleted ? 'تم نقل المسار إلى الأرشيف بنجاح' : 'حدث خطأ ما'
        ], $isDeleted ? 200 : 400);
    }

    /**
     * دالة خاصة لحذف الصور
     */
    private function deleteImage($url)
    {
        if ($url && Storage::disk('public')->exists($url)) {
            Storage::disk('public')->delete($url);
        }
    }
}
