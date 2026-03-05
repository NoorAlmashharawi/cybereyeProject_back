@extends('cms.parent')



@section('title', 'Admin')
@section('main-title', 'لوحة تحكم المشرف')

@section('sub-title', 'مرحبًا بعودتك')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('cms/css/viewStudents.css') }}">

@endsection

@section('content')



       <!-- خلفية مصفوفة الأمن السيبراني -->
       <div class="hacker-animation" id="matrixAnimation"></div>

       <header>
           <div class="container">
               <h1><i class="fas fa-shield-alt"></i>  All Students</h1>
               <p></p>
           </div>
       </header>

       <div class="container">
           <div class="controls">
               <div class="search-box">
                   <input type="text" id="searchInput" placeholder="ابحث عن طالب بالاسم أو المعرف الأمني...">
                   <i class="fas fa-search"></i>
               </div>

   

               <div class="action-buttons">
                  
                   <button class="btn btn-primary" id="addStudentBtn" >
                       {{-- <i class="fas fa-user-secret"></i> إضافة طالب --}}
                       <a class="fas fa-user-secret"class="fas fa-user-secret" href="{{ route('students.create') }}">إضافة طالب </a>
                   </button>
               </div>
           </div>

           <div class="stats">
            <div class="stat-card">
                <div class="stat-icon hacker-icon">
                    <i class="fas fa-user-secret"></i>
                </div>
                <div class="stat-content">
                    <h3 id="totalStudents">{{ $totalStudents }}</h3>
                    <p>طالب  </p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon cert-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stat-content">
                    <h3 id="certCount">{{ $certCount }}</h3>
                    <p>شهادات معتمدة</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon skill-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3 id="avgSkill">{{ $avgSkillArabic }}</h3>
                    <p>متوسط مستوى المهارة</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon threat-icon">
                    <i class="fas fa-bug"></i>
                </div>
                <div class="stat-content">
                    <h3 id="threatsNeutralized">{{ $threats }}</h3>
                    <p>ثغرات مكتشفة</p>
                </div>
            </div>
           </div>

           <div class="table-container">
               <table id="studentsTable">
                   <thead>
                       <tr>
                           <th onclick="sortTable(0)">
                               <i class="fas fa-sort"></i> المعرف
                           </th>
                           <th onclick="sortTable(1)">
                               <i class="fas fa-sort"></i> اسم الطالب
                           </th>

                           <th onclick="sortTable(2)">
                               <i class="fas fa-sort"></i> الايميل
                           </th>
                           <th onclick="sortTable(3)">
                            <i class="fas fa-sort"></i> مستوى المهارة
                        </th>
                           <th onclick="sortTable(4)">
                               <i class="fas fa-sort"></i> الشهادات
                           </th>
                           <th onclick="sortTable(5)">
                               <i class="fas fa-sort"></i> الحالة
                           </th>
                           <th>الإجراءات</th>
                       </tr>
                   </thead>
                   <tbody id="studentsTableBody">
                    @foreach ($students as  $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->username }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->level }}</td>
                        <td>{{ $student->specialization }}</td>
                        <td>{{ $student->status }}</td>


                        <td class="text-center"  style="display:flex">
                            <a  style="display: inline; " href="{{ route('students.show',  $student->id ) }}" class="btn-action btn-edit-custom btn-info" title="عرض التفاصيل">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a  style="display: inline" href="{{ route('students.edit',  $student->id ) }}" class="btn-action btn-edit-custom  btn-primary" title=" تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="#" method="post" style="display: inline">
                            <button type="button" class="btn-action btn-delete-custom btn-danger" title="حذف" onclick="performDestroy({{ $student->id }},this)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>


                        </td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>

               {{ $students->links()  }}
               <div id="noResultsMessage" class="no-results" style="display: none;">
                   <i class="fas fa-search"></i>
                   <h3>لا توجد نتائج</h3>
                   <p>لم يتم العثور على طلاب ينطبقون على معايير البحث الخاصة بك</p>
               </div>
           </div>



       </div>
@endsection

@section('scripts')
{{-- <script src="{{ asset('cms/js/viewStudents.js') }}"></script> --}}
<script>
    
function performDestroy(id,reference){
    confirmDestroy('/cms/student/students/'+id, reference);
}
</script>



@endsection
