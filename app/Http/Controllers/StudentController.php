<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User1;        


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
         // 1. جلب الطلاب مع الترقيم
         $students = Student::with('user1')->orderBy('id', 'desc')->paginate(10);


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
        'intermediate' => 'متوسط',  
        'advanced' => 'متقدم',
        'expert' => 'خبير'          
    ];
    $avgSkillArabic = $skillsMap[$mostCommonLevel->level] ?? $mostCommonLevel->level;
}

// قيم إضافية للإحصائيات الأخرى
$certCount = $totalStudents * 2; 
$threats = 156; 

// 3. الـ return النهائي
return response()->view('cms.student.index', compact(
    'students', 
    'totalStudents', 
    'avgSkillArabic', 
    'certCount', 
    'threats'
));}


    

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
             'username' => 'required|string|min:3|max:20|unique:user1s,username',
             'email'    => 'required|email|unique:user1s,email',
             'password' => 'required|min:8|confirmed',
             'level'    => 'required|string',          
             'status'   => 'required|string',
         ]);
     
         if ($validator->fails()) {
             return response()->json([
                 'icon'  => 'error',
                 'title' => $validator->errors()->first(),
             ], 400);
         }
     
         try {
             $user1 = User1::create([
                 'username' => $request->username,
                 'email'    => $request->email,
                 'password' => Hash::make($request->password),
                 'role'     => 'student',
             ]);
     
             $student = Student::create([
                 'user1_id'        => $user1->id,
                 'level'           => $request->level,           
                 'status'          => $request->status,
                 'specialization'  => $request->specialization ?? 'General',
                 'progress'        => $request->progress ?? 0,
                 'enrollment_date' => $request->enrollment_date ?? now(),
                 'role'            => 'student',
             ]);
     
             return response()->json([
                 'icon'  => 'success',
                 'title' => 'تم إنشاء الطالب بنجاح'
             ], 200);
             
     
         } catch (\Exception $e) {
             return response()->json([
                 'icon'  => 'error',
                 'title' => 'خطأ في قاعدة البيانات: ' . $e->getMessage()
             ], 500);
         }
     }
 


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $student = Student::with('user1')->findOrFail($id);  
        return response()->view('cms.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $student = Student::with('user1')->findOrFail($id);
            //    return response()->view('cms.student.edit', compact('students'));

        return view('cms.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         $validator = Validator($request->all(), [
             'username' => 'required|string|min:3|max:20|unique:user1s,username,' . $this->getUser1Id($id),
             'email'    => 'required|email|unique:user1s,email,' . $this->getUser1Id($id),
             'level'    => 'required|string',
             'status'   => 'required|string',
             'specialization' => 'nullable|string',
             'progress' => 'nullable|integer|min:0|max:100',
             'enrollment_date' => 'nullable|date',
         ], [
             'username.required' => 'اسم المستخدم مطلوب',
             'username.unique'   => 'اسم المستخدم موجود بالفعل',
             'email.required'    => 'البريد الإلكتروني مطلوب',
             'email.unique'      => 'البريد الإلكتروني موجود بالفعل',
             'level.required'    => 'المستوى مطلوب',
             'status.required'   => 'الحالة مطلوبة',
         ]);
     
         if ($validator->fails()) {
             return response()->json([
                 'icon'  => 'error',
                 'title' => $validator->errors()->first(),
             ], 400);
         }
     
         try {
             // البحث عن الطالب
             $student = Student::with('user1')->findOrFail($id);
             
             // تحديث بيانات User1
             $student->user1->update([
                 'username' => $request->username,
                 'email'    => $request->email,
             ]);
     
             // تحديث بيانات Student
             $student->update([
                 'level'           => $request->level,
                 'status'          => $request->status,
                 'specialization'  => $request->specialization ?? $student->specialization,
                 'progress'        => $request->progress ?? $student->progress,
                 'enrollment_date' => $request->enrollment_date ?? $student->enrollment_date,
             ]);
     
             return response()->json([
                 'icon'  => 'success',
                 'title' => 'تم تحديث البيانات بنجاح'
             ], 200);
     
         } catch (\Exception $e) {
             return response()->json([
                 'icon'  => 'error',
                 'title' => 'خطأ في التحديث: ' . $e->getMessage()
             ], 500);
         }
     }
     
     // دالة مساعدة لجلب user1_id من student_id
     private function getUser1Id($studentId)
     {
         $student = Student::find($studentId);
         return $student ? $student->user1_id : 0;
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $students = Student::destroy($id);
        
    }
}
