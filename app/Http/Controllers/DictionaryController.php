<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class DictionaryController extends Controller
{
    /**
     * عرض كل الصور (للمبرمج)
     */
    public function index()
    {
        $terms = Dictionary::latest()->paginate(10);
        return view('cms.dictionaries.index', compact('terms'));
    }
    /**
     * عرض فورم الإضافة (للمبرمج)
     */
    public function create()
    {
        return view('cms.dictionaries.create');
    }


    /**
     * حفظ الصورة في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'term' => 'required|string|max:100|unique:dictionary_entries,term',
            'definition' => 'required|string',
            'category' => 'nullable|string|max:50',
            'example' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->errors()->first()
            ], 400);
        }

        try {
            Dictionary::create([
                'term' => $request->term,
                'definition' => $request->definition,
                'category' => $request->category,
                'example' => $request->example,
            ]);

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إضافة المصطلح بنجاح',
                'redirect' => route('dictionary.index')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }
    // عرض نموذج التعديل
    public function edit($id)
    {
        $term = Dictionary::findOrFail($id);
        return view('cms.dictionaries.edit', compact('term'));
    }

    // تحديث مصطلح
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'term' => 'required|string|max:100|unique:dictionary_entries,term,' . $id,
            'definition' => 'required|string',
            'category' => 'nullable|string|max:50',
            'example' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->errors()->first()
            ], 400);
        }

        try {
            $term = Dictionary::findOrFail($id);
            $term->update([
                'term' => $request->term,
                'definition' => $request->definition,
                'category' => $request->category,
                'example' => $request->example,
            ]);

            return response()->json([
                'icon' => 'success',
                'title' => 'تم تحديث المصطلح بنجاح',
                'redirect' => route('dictionary.index')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $term = Dictionary::findOrFail($id);
            $term->delete();
    
            return response()->json([
                'icon' => 'success',
                'title' => 'تم حذف المصطلح بنجاح'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }



    public function home()
    {
    
        $dictionaries = Dictionary::all();

        $latestReviews = \App\Models\Review::with(['user', 'course'])
                            ->latest()
                            ->take(3)
                            ->get();

        return view('cms.home.home', compact('dictionaries', 'latestReviews'));
    }



    
    public function search(Request $request)
    {
        $term = $request->get('term');
        
        $entry = Dictionary::where('term', 'like', '%' . $term . '%')
                                ->orWhere('term', 'like', '%' . strtolower($term) . '%')
                                ->first();
        
        if ($entry) {
            return response()->json([
                'found' => true,
                'term' => $entry->term,
                'definition' => $entry->definition,
                'category' => $entry->category,
                'example' => $entry->example,
            ]);
        }
        
        return response()->json([
            'found' => false,
            'message' => 'المصطلح "' . $term . '" غير متوفر في القاموس حالياً'
        ]);
    }
    
}


