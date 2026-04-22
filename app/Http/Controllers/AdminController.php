<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use IlluminateHttpResponse;
use IlluminateHttpFacadesDB;
use App\http\Controllers\StudentController;
use App\Models\Student;
use App\Models\Course;
use App\Models\Instructor;
use Spatie\Permission\Models\Role;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User1;
use Spatie\Permission\Traits\HasRoles;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Admin::class);
        $admins = Admin::with('user1')->orderBy('id', 'desc')->paginate(10);

        return response()->view('cms.admin.index',compact('admins'));

    }



public function main()
{
    $newStudents = Student::with('user1')->latest()->limit(10)->get();
    $courses = Course::all(); // هاد المتغير موجود
    $totalUsers = User1::count();
    $totalCourses = Course::count();
    $weeklyRegistrations = $this->getWeeklyRegistrations();
    $monthlyRegistrations = $this->getMonthlyRegistrations();

    return view('cms.admin.main', compact('newStudents', 'courses','totalUsers', 'totalCourses', 'weeklyRegistrations', 'monthlyRegistrations'));


    // شغل سجا العسل
    $activeCourses = Course::where('status', 'active')->count();
    $latestCourses = Course::with(['instructor.user1', 'category'])
            ->withCount('students')
            ->latest()
            ->limit(5)
            ->get();

    // التعديل هون: ضفنا 'courses' و 'latestCourses' (تأكدي إنك باعتة التنين لو بتستخدميهم)
    return view('cms.admin.main', compact(
        'newStudents',
        'totalUsers',
        'totalCourses',
        'weeklyRegistrations',
        'monthlyRegistrations',
        'activeCourses',
        'latestCourses',
        'courses'
    ));
}

/**
 * تحويل رقم اليوم إلى اسم عربي
 */

 private function getWeeklyRegistrations()
{
    $data = [
        'students' => [],
        'instructors' => [],
        'admins' => []
    ];
    $labels = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $labels[] = $this->getArabicDayName($date->dayOfWeek);

        // عدد الطلاب المسجلين في هذا اليوم
        $data['students'][] = User1::whereDate('created_at', $date->toDateString())
            ->where('role', 'student')
            ->count();

        // عدد المدربين المسجلين في هذا اليوم
        $data['instructors'][] = User1::whereDate('created_at', $date->toDateString())
            ->where('role', 'instructor')
            ->count();

        // عدد المشرفين المسجلين في هذا اليوم
        $data['admins'][] = User1::whereDate('created_at', $date->toDateString())
            ->where('role', 'admin')
            ->count();
    }

    return [
        'labels' => $labels,
        'students' => $data['students'],
        'instructors' => $data['instructors'],
        'admins' => $data['admins']
    ];
}

private function getMonthlyRegistrations()
{
    $months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
               'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];

    $data = [
        'students' => [],
        'instructors' => [],
        'admins' => []
    ];

    for ($i = 1; $i <= 12; $i++) {
        // عدد الطلاب المسجلين في هذا الشهر
        $data['students'][] = User1::whereMonth('created_at', $i)
            ->whereYear('created_at', date('Y'))
            ->where('role', 'student')
            ->count();

        // عدد المدربين المسجلين في هذا الشهر
        $data['instructors'][] = User1::whereMonth('created_at', $i)
            ->whereYear('created_at', date('Y'))
            ->where('role', 'instructor')
            ->count();

        // عدد المشرفين المسجلين في هذا الشهر
        $data['admins'][] = User1::whereMonth('created_at', $i)
            ->whereYear('created_at', date('Y'))
            ->where('role', 'admin')
            ->count();
    }

    return [
        'labels' => $months,
        'students' => $data['students'],
        'instructors' => $data['instructors'],
        'admins' => $data['admins']
    ];
}
private function getArabicDayName($dayOfWeek)
{
    $days = [
        1 => 'الإثنين',
        2 => 'الثلاثاء',
        3 => 'الأربعاء',
        4 => 'الخميس',
        5 => 'الجمعة',
        6 => 'السبت',
        7 => 'الأحد',
    ];

    // في Laravel، يوم الأحد = 7 (أو 0 حسب الإعداد)
    if ($dayOfWeek == 0) {
        $dayOfWeek = 7;
    }

    return $days[$dayOfWeek] ?? 'غير محدد';
}





    public function create()
    {
        $roles = Role::where('guard_name' , 'admin')->get();
        $this->authorize('create', Admin::class);
        return response()->view('cms.admin.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $this->authorize('create', Admin::class);

        $validator = Validator($request->all(), [
            'username' => 'required|string|min:3|max:20|unique:user1s,username',
            'email'    => 'required|email|unique:user1s,email',
            'password' => 'required|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon'  => 'error',
                'title' => $validator->errors()->first(),
            ], 400);
        }

        try {

            $admin = Admin::create([

            ]);

            // 1. إنشاء Admin (بدون أي حقول)
            $admin = Admin::create();

            // 2. إنشاء User1 مرتبط بـ Admin
            // إنشاء Admin
            $admin = Admin::create();

            // إنشاء User1 مرتبط بـ Admin
            $user1 = User1::create([
                'username'   => $request->username,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'role'       => 'Admin',
                'guard_name' => 'admin',
                'actor_type' => 'App\Models\Admin',
                'actor_id'   => $admin->id,
            ]);






            $roles = Role::findOrFail($request->get('role_id'));
            $admin ->assignRole($roles->name);


            // 3. تعيين الدور للمستخدم

            // تعيين الدور للمستخدم
            $role = Role::findOrFail($request->role_id);
            $user1->assignRole($role->name);

            return response()->json([
                'icon'  => 'success',
                'title' => 'تم إنشاء المسؤول بنجاح'
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->authorize('delete', Admin::class);
        $admins = Admin::destroy($id);
    }


    public function trashed()
    {
        $students = Student::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return response()->view('cms.student.trashed',compact('students'));

    }

    public function restore($id)
    {
        $students = Student::onlyTrashed()->findOrFail($id)->restore();
        return back()->withFragment('success',"success");

    }

    public function force($id)
    {
        $students = Student::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->withFragment('success',"success");

    }

    public function forceAll()
    {
        $students = Student::onlyTrashed()->forceDelete();
        return back()->withFragment('success',"success");

    }
}
