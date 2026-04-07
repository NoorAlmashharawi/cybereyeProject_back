<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
     
    $instructors = Instructor::with('user1')->orderBy('id', 'desc')->withoutTrashed()->paginate(10);
    

    // عدد المدرسين
    $totalInstructors = Instructor::count();

    // متوسط التقييم
    $avgRating = round(Instructor::avg('rating'), 1);

    // متوسط سنوات الخبرة
    $avgExperience = round(Instructor::avg('experience_years'));

    return view('cms.instructor.index', compact(
        'instructors',
        'totalInstructors',
        'avgRating',
        'avgExperience'
    ));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return response()->view('cms.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $validator = Validator($request->all(), [
                      'username' => 'required|string|min:3|max:20|unique:user1s,username',
            'email' => 'required|email|unique:user1s,email',
            'password' => 'required|min:8|confirmed',

            'specialization' => 'required|string',
            'experience_years' => 'required|integer|min:0',
            'rating' => 'required|numeric|min:1|max:5',
            'bio' => 'nullable|string',
            'enrollment_date' => 'nullable|date',
         ]);
 
         if ($validator->fails()) {
             return response()->json([
                 'icon'  => 'error',
                 'title' => $validator->errors()->first(),
             ], 400);
         }
 
         try {
             DB::beginTransaction();
 
             $instructor =  Instructor::create([
                'specialization'=>$request->specialization,           
                'experience_years'=>$request->experience_years,
                'rating'=>$request->rating,
                'bio'=>$request->bio,
                'enrollment_date'=>$request->enrollment_date ?? now(),
             ]);
 
        

             $user1 = User1::create([
                 'username'   => $request->username,
                 'email'      => $request->email,
                 'password'   => Hash::make($request->password),
                 'role'       => 'instructor',
                 'actor_id'   => $instructor->id,
                 'actor_type' => 'App\Models\instructor',
             ]);
 
             DB::commit();
 
             return response()->json([
                 'icon'  => 'success',
                 'title' => 'تم إنشاء المدرب بنجاح'
             ], 200);
 
         } catch (\Exception $e) {
             DB::rollBack();
             return response()->json([
                 'icon'  => 'error',
                 'title' => 'خطأ: ' . $e->getMessage()
             ], 500);
         }
     }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {


        $instructor = Instructor::with('user1')->findOrFail($id);

        return response()->view('cms.instructor.show',compact('instructor'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

   $instructor = Instructor::with('user1')->findOrFail($id);

    return view('cms.instructor.edit', compact('instructor'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, $id)
    {
                $validator = Validator($request->all(),[
            'username' => 'required|string|min:3|max:20|unique:user1s,username,' . $this->getUser1Id($id),
            'email' => 'required|email|unique:user1s,email,' . $this->getUser1Id($id),

            'specialization' => 'required|string',
            'experience_years' => 'required|integer|min:0',
            'rating' => 'required|numeric|min:1|max:5',
            'bio' => 'nullable|string',
            'enrollment_date' => 'nullable|date',
        ]);

        if($validator->fails()){
            return response()->json([
                'icon'=>'error',
                'title'=>$validator->errors()->first(),
            ],400);
        }

        try{

            $instructor = Instructor::with('user1')->findOrFail($id);

            // تحديث المستخدم
            $instructor->user1->update([
                'username'=>$request->username,
                'email'=>$request->email,
            ]);

            // تحديث المدرس
            $instructor->update([
                'specialization'=>$request->specialization,
                'experience_years'=>$request->experience_years,
                'rating'=>$request->rating,
                'bio'=>$request->bio ?? $instructor->bio,
                'enrollment_date'=>$request->enrollment_date ?? $instructor->enrollment_date,
            ]);

            return response()->json([
                'icon'=>'success',
                'title'=>'تم تحديث بيانات المدرس بنجاح'
            ],200);

        }catch(\Exception $e){

            return response()->json([
                'icon'=>'error',
                'title'=>'خطأ في التحديث: '.$e->getMessage()
            ],500);

        }

    }


    // حذف مؤقت (نقل إلى سلة المحذوفات)
    public function destroy($id)
    {
        $instructor = Instructor::find($id);
        
        if (!$instructor) {
            return redirect()->back()->with('error', 'المدرب غير موجود');
        }
        
        if ($instructor->user1) {
            $instructor->user1->delete();
        }
        
        $instructor->delete();
        
        return redirect()->back()->with('success', 'تم حذف المدرب مؤقتاً');
    }

    public function trashed()
{
    // ✅ استخدم withTrashed() مع user1
    $instructors = Instructor::onlyTrashed()
        ->with(['user1' => function($query) {
            $query->withTrashed();  // جلب user1 المحذوف أيضاً
        }])
        ->orderBy('deleted_at', 'desc')
        ->get();
    
    return view('cms.instructor.trashed', compact('instructors'));
}

    // عرض سلة المحذوفات
    // public function trashed()
    // {
    //     $instructors = Instructor::onlyTrashed()->with('user1')->orderBy('deleted_at', 'desc')->get();
    //     return response()->view('cms.instructor.trashed', compact('instructors'));
    // }

    // استعادة المدرب من سلة المحذوفات


    public function restore($id)
{
    try {
        $instructor = Instructor::onlyTrashed()->findOrFail($id);
        $instructor->restore();
        
      
        $user1 = User1::where('actor_id', $instructor->id)
                      ->where('actor_type', 'App\Models\Instructor')
                      ->withTrashed()
                      ->first();
        
        if ($user1 && $user1->trashed()) {
            $user1->restore();
        }
        
        return redirect()->back()->with('success', 'تم استعادة المدرس والمستخدم بنجاح');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'خطأ: ' . $e->getMessage());
    }
}
    // public function restore($id)
    // {
    //     $instructors = Instructor::onlyTrashed()->findOrFail($id)->restore();
    //     return back()->with('success','success');
    // }

    // حذف نهائي المدرب واحد
    public function force($id)
    {
        $instructors = instructor::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('sucess','sucess');
    
    
    }

    public function forceAll()
    {
    $instructors = Instructor::onlyTrashed()->forceDelete();
    return back()->with('sucess','sucess');


    }
}
//     // دالة لجلب user1_id
//     private function getUser1Id($instructorId)
//     {
//         $instructor = Instructor::find($instructorId);
//         return $instructor ? $instructor->user1_id : 0;
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy($id)
//     {
//         Instructor::destroy($id);

//         return response()->json([
//             'icon'=>'success',
//             'title'=>'تم حذف المدرس'
//         ]);
//     }


// public function search(Request $request)
// {
//     $query = $request->get('query', '');

//     $instructors = \App\Models\Instructor::whereHas('user1', function($q) use ($query) {
//         $q->where('username', 'like', "%{$query}%");
//     })->get();

//     if($instructors->count() == 0) {
//         return response()->json(['found' => false]);
//     }

//     // إنشاء HTML مختصر للجدول ليعرض في الصفحة
//     $html = '';
//     foreach($instructors as $instructor){
//         $ratingStars = str_repeat('⭐', $instructor->rating) . str_repeat('☆', 5 - $instructor->rating);
//         $html .= "<tr>
//                     <td>{$instructor->id}</td>
//                     <td>{$instructor->user1->username}</td>
//                     <td>{$instructor->user1->email}</td>
//                     <td>{$instructor->specialization}</td>
//                     <td>{$instructor->experience_years} سنة</td>
//                     <td>{$ratingStars}</td>
//                     <td>
//                         <a href='".route('instructors.show',$instructor->id)."' class='btn-action btn-info'><i class='fas fa-eye'></i></a>
//                         <a href='".route('instructors.edit',$instructor->id)."' class='btn-action btn-edit-custom'><i class='fas fa-edit'></i></a>
//                         <form action='".route('instructors.destroy',$instructor->id)."' method='POST' style='display:inline'>
//                             @csrf
//                             @method('DELETE')
//                             <button type='button' onclick='performDestroy({$instructor->id}, this)' class='btn-action btn-delete-custom'><i class='fas fa-trash'></i></button>
//                         </form>
//                     </td>
//                   </tr>";
//     }

//     return response()->json(['found' => true, 'html' => $html]);
// }
// }
