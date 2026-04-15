@extends('cms.parent')

@section('title', 'Courses')
@section('main-title', 'Courses')

@section('sub-title', 'courses')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('cms/css/course-details.css') }}">
<style>
    /* تصغير حجم أزرار الباجينيت */
    .pagination {
        margin-bottom: 0;
        gap: 5px; /* مسافة بين الأرقام */
    }
    .page-item .page-link {
        border-radius: 5px !important;
        padding: 6px 12px;
        color: #5e72e4;
        border: 1px solid #dee2e6;
        font-size: 14px;
    }
    /* لون الزر النشط (الصفحة الحالية) */
    .page-item.active .page-link {
        background-color: #5e72e4 !important;
        border-color: #5e72e4 !important;
        color: white !important;
    }

    .pagination span, .pagination small {
        display: none;
    }
</style>

@endsection




@section('content')
    <div class="admin-toolbar">
        <div class="toolbar-title">
            <h1>إدارة الكورسات</h1>
            <p>لوحة التحكم بالمساقات التعليمية</p>
        </div>

        <div class="toolbar-actions">
            <form action="{{ route('courses.index') }}" method="GET" class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="search-input" placeholder="ابحث...">
                @if(request()->has('search') && request('search') != '')
                    <a href="{{ route('courses.index') }}" class="ms-2 text-danger" title="إلغاء البحث">
                        <i class="fas fa-times-circle"></i>
                    </a>
                @endif
            </form>

            <a href="{{ route('courses.create') }}" class="btn btn-primary" style="border-radius: 10px; padding: 10px 20px; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-plus"></i>
                <span>إضافة كورس جديد</span>
            </a>
        </div>
    </div>

    <div class="quick-stats">
        {{-- كارد الكورسات النشطة --}}
        <div class="stat-card courses">
            <div class="stat-content">
                <div class="stat-icon courses">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-info">

                    <h2>  {{ $activeCourses }} </h2>


                    <p>الكورسات النشطة</p>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>{{ $activeCourses }} كورس متاح حالياً</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- كارد إجمالي المدربين --}}
        <div class="stat-card revenue">
            <div class="stat-content">
                <div class="stat-icon revenue">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-info">

                    <h2>{{ $totalInstructors }}</h2>
                    <p>إجمالي المدربين</p>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>{{ $totalInstructors }} نخبة الخبراء</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- كارد نسبة الرضا --}}
        <div class="stat-card active">
            <div class="stat-content">
                <div class="stat-icon active">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    {{-- <h3>4.9</h3> --}}
                    <p>نسبة الرضا</p>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        {{-- <span>أداء ممتاز</span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
<h1>العدد هو: {{ $activeCourses }}</h1>
    <div class="table-card mt-4">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>اسم الكورس</th>
                        <th>المدرب</th>
                        <th>التصنيف</th>
                        <th>عدد الطلاب</th>
                        <th>المستوى</th>
                        <th>الحالة</th>
                        <th>الحدث</th>
                    </tr>
                </thead>
                <tbody id="courseTableBody">

                    @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->instructor->user1->username ?? 'بدون مدرب' }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $course->category->title ?? 'غير مصنف' }}</span>
                        </td>
                        <td>
                            {{-- هنا عدد الطلاب المسجلين بالكورس خليها هيك حاليا هرجعلها --}}
                            <span class="badge badge-info">{{ $course->students_count }} طالب</span>
                        </td>

                       <td>
    @if($course->level == 'beginner')
        <span class="badge bg-success">مبتدئ</span>
    @elseif($course->level == 'intermediate')
        <span class="badge bg-warning text-dark">متوسط</span>
    @elseif($course->level == 'advanced')
        <span class="badge bg-danger">متقدم</span>
    @else
        <span class="badge bg-info">{{ $course->level }}</span>
    @endif
</td>
                        <td>
                            <span class="badge {{ $course->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $course->status == 'active' ? 'نشط' : 'معطل' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('courses.show', $course->id) }}" style="color: #17a2b8; margin-right: 10px;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('courses.edit', $course->id) }}" class="action-btn edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmDelete('{{ $course->id }}', this)" class="action-btn delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- الباجينيت --}}
            <div class="d-flex justify-content-center mt-3">
                <div class="pagination-wrapper">
                    {!! $courses->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
{{-- إضافة مكتبة SweetAlert2 للتنبيهات --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- إضافة مكتبة Axios للتعامل مع الطلبات --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'هل أنتِ متأكدة؟',
            text: "سيتم حذف الكورس نهائياً من النظام!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم',
            cancelButtonText: 'إلغاء',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id, reference);
            }
        })
    }

    function performDelete(id, reference) {
        // إرسال طلب الحذف للسيرفر
        axios.delete('/cms/course/courses/' + id)
            .then(function (response) {
                // في حال النجاح
                Swal.fire({
                    title: response.data.title,
                    text: response.data.message,
                    icon: response.data.icon,
                    timer: 2000,
                    showConfirmButton: false
                });

                // حذف السطر من الجدول بتأثير اختفاء ناعم
                reference.closest('tr').style.transition = "all 0.5s ease";
                reference.closest('tr').style.opacity = "0";
                setTimeout(() => {
                    reference.closest('tr').remove();
                }, 500);
            })
            .catch(function (error) {
                // في حال وجود خطأ (مثلاً الكورس مرتبط ببيانات أخرى)
                Swal.fire({
                    title: 'خطأ!',
                    text: error.response.data.message || 'حدث خطأ غير متوقع',
                    icon: 'error'
                });
            });
    }
</script>
@endsection
