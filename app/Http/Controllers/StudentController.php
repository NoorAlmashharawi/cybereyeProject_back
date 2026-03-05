<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
{
    // 1. جلب الطلاب مع الترقيم (السطر الذي تحتاجينه)
    $students = Student::orderBy('id', 'desc')->paginate(10);

    // 2. حساب الإحصائيات من قاعدة البيانات مباشرة
    $totalStudents = Student::count(); 
    
    // تحديد المستوى الأكثر تكراراً بين الطلاب
    $mostCommonLevel = Student::select('level')
        ->groupBy('level')
        ->orderByRaw('COUNT(*) DESC')
        ->first();

    $avgSkillArabic = 'غير محدد';
    if ($mostCommonLevel) {
        $skillsMap = [
            'beginner' => 'مبتدئ',
            'midium'   => 'متوسط',
            'advanced' => 'متقدم'
        ];
        $avgSkillArabic = $skillsMap[$mostCommonLevel->level] ?? $mostCommonLevel->level;
    }

    // قيم إضافية للإحصائيات الأخرى
    $certCount = $totalStudents * 2; // مثال: كل طالب لديه شهادتان
    $threats = 156; // قيمة ثابتة أو يمكنك ربطها بجدول آخر

    // 3. الـ return النهائي الذي يرسل "الطلاب" + "الإحصائيات" معاً
    return response()->view('cms.student.index', compact(
        'students', 
        'totalStudents', 
        'avgSkillArabic', 
        'certCount', 
        'threats'
    ));
}
//     public function index()
//     {
//         $students = Student::orderBy('id', 'desc')->paginate(10);

//         return response()->view('cms.student.index', compact('students'));


// }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('cms.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
{
    $validator = Validator($request->all(), [
        'username' => 'required|string|min:3|max:20',
        'email'    => 'required|email', // تأكد من أنها email
        'level'    => 'required|string',
        'status'   => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon'  => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }

    try {
        $student = new Student();
        $student->username = $request->username;
        $student->email    = $request->email;
        $student->level    = $request->level;
        $student->status   = $request->status;

        // قيم ثابتة
        $student->role            = 'student';
        $student->progress        = 0;
        $student->specialization  = 'General';
        $student->enrollment_date = now();

        $student->save();

        return response()->json([
            'icon'  => 'success',
            'title' => 'Created successfully'
        ], 200);

    } catch (\Exception $e) {
        // إذا فشل الحفظ، سيظهر لك السبب الحقيقي (مثلاً حقل ناقص في القاعدة)
        return response()->json([
            'icon'  => 'error',
            'title' => 'Database Error: ' . $e->getMessage()
        ], 500);
    }
}
    // public function store(Request $request)
    // {

    //     $validator = Validator($request->all(),[
    //         'username' => 'required|string|min:3|max:20',
    //         'email' => 'required|string',
    //         'level' => 'required|string',
    //         'status' => 'required|string',
     

    //     ]);
    
    //     if ($validator->fails()){
    //         return response()->json([
    //             'icon'=>'error',
    //             'title'=> $validator->getMessageBag()->first(),
    //         ],400);
    //     }
    
    //     $student = new Student();
    //     $student->username = $request->username;
    //     $student->email = $request->email;
    //     $student->level = $request->level;
    //     $student->status = $request->status;

    //     $student->role           = 'student';      // قيمة نصية ثابتة
    //     $student->progress       = 0;              // قيمة رقمية ثابتة
    //     $student->specialization = 'General';      // تخصص افتراضي
    //     $student->enrollment_date = now();         // تاريخ التسجيل الحالي باستخدام helper لارافيل


    //     $student->save();
    
    //     return response()->json([
    //         'icon'=>'success',
    //         'title'=> 'created successfully'
    //     ]);
   
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $students = Student::findOrFail($id);
        return response()->view('cms.student.show', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = Student::findOrFail($id);
        return response()->view('cms.student.edit', compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id) // غيرناها لتستقبل id
{
    $validator = Validator($request->all(), [
        'username' => 'required|string|min:3|max:20',
        'email'    => 'required|email', // تأكد أنها email
        'level'    => 'required|string',
        'status'   => 'required|string',
    ], [
        'username.required' => 'اسم المستخدم مطلوب',
        'email.required'    => 'البريد الإلكتروني مطلوب',
        'level.required'    => 'المستوى مطلوب',
        'status.required'   => 'الحالة مطلوبة',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon'  => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }

    // البحث عن الطالب باستخدام الـ id الممرر في الرابط
    $student = Student::findOrFail($id);
    $student->username = $request->input('username');
    $student->email    = $request->input('email');
    $student->level    = $request->input('level');
    $student->status   = $request->input('status');

    // ملاحظة: حذفنا سطر الباسوورد تماماً لأنه يسبب خطأ 500
    $isSaved = $student->save();

    if ($isSaved) {
        return response()->json([
            'icon'  => 'success',
            'title' => 'تم تحديث البيانات بنجاح',
        ], 200);
    } else {
        return response()->json([
            'icon'  => 'error',
            'title' => 'فشل في حفظ التعديلات',
        ], 400);
    }
}
//     public function update(Request $request, $id)
//     {
        
//         $validator = Validator($request->all(),[
//             'username'=>'required|string|min:3|max:20',

//             'email'=>'required|string',
//             'level'=>'required|string',
//             'status'=>'required|string',

            
//         ],[
//            'username.required' =>'هذا الحقل مطلوب',
//            'username.min' =>'  لا يقبل اقل من 3 حروف',
//            'username.max' =>'  لا يقبل اكثر من 20 حرف',
//            'email.required' =>'هذا الحقل مطلوب',
//            'level.required' =>'هذا الحقل مطلوب',
//            'status.required' =>'هذا الحقل مطلوب',
//                    // قيم ثابتة
      

//         ]);
//         if ($validator->fails()){
//             return response()->json([
//                 'icon'=>'error',
//                 'title'=> $validator->getMessageBag()->first(),
//             ],400);
//         }else{
//             $student = Student::findOrFail($id);

// $student->username = $request->username;
// $student->password = Hash::make($request->password);
// $student->email = $request->email;
// $student->level = $request->level;
// $student->status = $request->status;

// $student->save();
//             return['redirect'=>route('students.index')];
//         } 
//     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $students = Student::destroy($id);
        
    }
}
