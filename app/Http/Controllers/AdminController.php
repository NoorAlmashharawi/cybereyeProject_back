<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use IlluminateHttpResponse;
use IlluminateHttpFacadesDB;
use App\http\Controllers\StudentController;
use App\Models\Student;
use App\Models\Instructor;  

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User1;  
    


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $admins = Admin::with('user1')->orderBy('id', 'desc')->paginate(10);

        return response()->view('cms.admin.index',compact('admins'));
    
    }

    
    
     

        public function main()
        {
            $newStudents = Student::with('user1')->latest()->limit(10)->get();
            $totalUsers = User1::count();
            
            return view('cms.admin.main', compact('newStudents', 'totalUsers'));}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('cms.admin.create');

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
            // أضيفي level و status إذا كانت موجودة في جدول admins
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

            $user1 = User1::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'admin',
                'actor_type' => 'App\Models\ِAdmin',
            'actor_id'   => $admin->id,
            ]);
    
      
          
    
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
