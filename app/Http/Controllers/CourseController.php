<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function index()
//     {
//     $courses = Course::all();
// return view('cms.course.index', compact('courses'));
// }

public function index(Request $request)
{
    // 1. جلب الكورسات مع عداد الطلاب المسجلين ارجعيله
    $query = Course::with(['instructor.user1', 'category'])->withCount('students');

    if ($request->has('category_id') && $request->category_id != '') {
        $query->where('category_id', $request->category_id);
    }

    // 2. زر البحث
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('course_name', 'like', '%' . $search . '%')
              ->orWhereHas('instructor.user1', function($q2) use ($search) {
                  $q2->where('username', 'like', '%' . $search . '%');
              });
        });
    }

    // 3. حساب الكاردات (أرقام حقيقية ودقيقة من الداتابيز)
    $totalCourses = Course::count();
    $activeCourses = Course::where('status', 'active')->count();
    $totalInstructors = Instructor::count();

    // 4. paginate
    $courses = $query->latest()
                     ->paginate(10)
                     ->appends(['search' => $request->search]);

    // 5. إرسال البيانات للفيو
    return view('cms.course.index', compact(
        'courses',
        'totalCourses',
        'activeCourses',
        'totalInstructors'
    ));
}


public function create()
{
    $categories = Category::all();
    $instructors = Instructor::with('user1')->get();


    return view('cms.course.create', compact('categories', 'instructors'));
}

public function store(Request $request)
{
    $validator = Validator($request->all(), [
        'course_name'   => 'required|string|min:3|max:100',
        'instructor_id' => 'required|exists:instructors,id',
        'category_id'   => 'required',
        'level'         => 'required',
        'no_hours'      => 'required|numeric',
        'course_image'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if (!$validator->fails()) {
        $course = new Course();
        $course->course_name = $request->input('course_name');
        $course->short_description = $request->input('short_description');
        $course->level = $request->input('level');
        $course->no_hours = $request->input('no_hours');
        $course->rating = 0;
        $course->status = $request->input('status', 'active');
        $course->category_id = $request->input('category_id');
        $course->instructor_id = $request->input('instructor_id');

        // --- التعديل هنا ليتوافق مع الـ Update والـ Storage Link ---

        if ($request->hasFile('course_image')) {
            $file = $request->file('course_image');

            // 1. توليد اسم الملف
            $filename = time() . '_' . $file->getClientOriginalName();

            // 2. التخزين باستخدام نفس الطريقة في الـ Update (مهم جداً!)
            $file->storeAs('courses', $filename, ['disk' => 'public']);

            // 3. حفظ المسار النسبي في قاعدة البيانات
            $course->course_image = 'courses/' . $filename;
        }

        $isSaved = $course->save();

        return response()->json([
            'icon' => $isSaved ? 'success' : 'error',
            'title' => $isSaved ? 'تم حفظ الكورس بنجاح' : 'فشل الحفظ'
        ], $isSaved ? 201 : 400);

    } else {
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first()
        ], 400);
    }
}
    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $course = Course::with(['instructor.user1', 'category'])->findOrFail($id);
    return view('cms.course.show', compact('course'));
}

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
{
    // جلب الكورس أو إعطاء خطأ 404 لو مش موجود
    $course = Course::findOrFail($id);

    // جلب الأقسام والمدربين عشان الـ Select Options
    $categories = Category::all();
    $instructors = Instructor::with('user1')->get();

    return view('cms.course.edit', compact('course', 'categories', 'instructors'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    // 1. التحقق من البيانات
    $validator = Validator($request->all(), [
        'course_name'       => 'required|string|min:3|max:100',
        'category_id'       => 'required|exists:categories,id',
        'instructor_id'     => 'required|exists:instructors,id',
        'no_hours'          => 'required|integer|min:1',
        'level'             => 'required|in:beginner,intermediate,advanced',
        'status'            => 'required|in:active,draft',
        'short_description' => 'nullable|string|max:500',
        'course_image'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if (!$validator->fails()) {
        $course = Course::findOrFail($id);

        $course->course_name = $request->input('course_name');
        $course->category_id = $request->input('category_id');
        $course->instructor_id = $request->input('instructor_id');
        $course->no_hours = $request->input('no_hours');
        $course->level = $request->input('level');
        $course->status = $request->input('status');
        $course->short_description = $request->input('short_description');

        // 2. التعامل مع الصورة (التعديل هنا)
        if ($request->hasFile('course_image')) {

            // تأكدي أولاً أن الحقل ليس فارغاً وأن الملف موجود فعلياً على القرص قبل الحذف
            if ($course->course_image && Storage::disk('public')->exists($course->course_image)) {
                Storage::disk('public')->delete($course->course_image);
            }

            // تخزين الصورة الجديدة
            $file = $request->file('course_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('courses', $imageName, ['disk' => 'public']);

            // حفظ المسار الجديد
            $course->course_image = 'courses/' . $imageName;
        }

        $isSaved = $course->save();

        return response()->json([
            'icon' => $isSaved ? 'success' : 'error',
            'title' => $isSaved ? 'تم تحديث الكورس بنجاح' : 'فشل التحديث'
        ], $isSaved ? 200 : 400);

    } else {
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first()
        ], 400);
    }
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    // 1. البحث عن الكورس
    $course = Course::find($id);

    // 2. التحقق من الوجود
    //هدا مهم لما يكون عندي كزا ادمن بيحاولوا يحذفوا نفس الكورس
   // بحط هاي عشان ما يصير تضارب لما يعمل الادمن ريفريش
    if (!$course) {
        return response()->json([
            'icon' => 'error',
            'title' => 'خطأ!',
            'text' => 'الكورس الذي تحاول حذفه غير موجود.'
        ], 404);
    }

    // 3. تنفيذ الحذف
    $deleted = $course->delete();

    if ($deleted) {
        return response()->json([
            'icon' => 'success',
            'title' => 'تم الحذف بنجاح',
            'text' => 'تمت إزالة الكورس من قاعدة البيانات.'
        ], 200);
    } else {
        return response()->json([
            'icon' => 'error',
            'title' => 'فشل الحذف',
            'text' => 'حدث خطأ ما أثناء محاولة الحذف.'
        ], 400);
    }
}


    public function showCourseDetails($id)
    {
        // جلب الكورس مع كل العلاقات اللي رح نحتاجها في الصفحة مرة واحدة
        $course = Course::with([
            'lessons',
            'materials',
            'reviews.user',
            'instructor.user1' // معلومات المدرب
        ])->findOrFail($id);

        // توجيه الطالب لصفحة العرض
        return view('course-details', compact('course'));
    }

 public function storeReview(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|numeric|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    // نحدد الـ guard يدويا عشان نجيب الـ id صح
    $userId = auth('student')->id();

    if (!$userId) {
        return back()->with('error', 'يجب تسجيل الدخول كطالب للتقييم');
    }

    \App\Models\Review::create([
        'course_id' => $id,
        'user_id'   => $userId,
        'rating'    => $request->rating,
        'comment'   => $request->comment,
    ]);

    return back()->with('success', 'تم إرسال تقييمك بنجاح!');
}




}
