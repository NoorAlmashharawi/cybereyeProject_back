<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DictionaryController extends Controller
{
    /**
     * عرض كل الصور (للمبرمج)
     */
    public function index()
    {
        $dictionaries = Dictionary::all();
        return view('dictionaries.index', compact('dictionaries'));
    }

    /**
     * عرض فورم الإضافة (للمبرمج)
     */
    public function create()
    {
        return view('dictionaries.create');
    }

    /**
     * حفظ الصورة في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'term' => 'nullable|string|max:255',
            'definition' => 'nullable|string',
        ]);

        $imagePath = $request->file('img')->store('dictionaries', 'public');

        Dictionary::create([
            'term' => $request->term,
            'definition' => $request->definition,
            'img' => $imagePath,
        ]);

        return redirect()->route('home.home')->with('success', 'تم إضافة الصورة بنجاح');
    }



    /**
     * حذف الصورة
     */
     public function destroy(Dictionary $dictionary)
    {
        if ($dictionary->img) {
            Storage::disk('public')->delete($dictionary->img);
        }
        
        $dictionary->delete();

        return redirect()->route('home.home')->with('success', 'تم حذف الصورة بنجاح');
    }

    public function home()
    {
        // جلب كل الصور من قاعدة البيانات
        $dictionaries = Dictionary::all();
        
        // عرض الصفحة الرئيسية مع الصور
        return view('cms.home.home', compact('dictionaries'));
    }
}