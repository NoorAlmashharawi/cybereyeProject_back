@extends('cms.parent')

@section('title', 'عرض تفاصيل الكورس')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/addStudent.css') }}">
<style>
/* عشان نعمل الحقول ديسيبل */
input:disabled, select:disabled, textarea:disabled {
        background-color: #fdfdfd !important;
        color: #333 !important;
        cursor: not-allowed;
        border: 1px solid #ddd !important;
    }
    .status-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        background: #5e72e4;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <h2 class="form-title">
        <i class="fas fa-eye"></i> تفاصيل الكورس: {{ $course->course_name }}
    </h2>

    <form>
        {{-- عرض الصورة بشكل ثابت --}}
        <h3 class="form-subtitle">غلاف الكورس</h3>
        <div style="text-align: center; margin-bottom: 20px;">
            {{-- هنا بنجيب الصورة المحفوظة بالداتا بيز --}}
            <img src="{{ asset('storage/' . $course->course_image) }}"
                 style="width: 250px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        </div>

        <h3 class="form-subtitle">بيانات الكورس</h3>

        <div class="form-row">
            <div class="form-group">
                <label>اسم الكورس</label>
                <input type="text" value="{{ $course->course_name }}" disabled>
            </div>
            <div class="form-group">
                <label>التصنيف</label>
                <input type="text" value="{{ $course->category->name }}" disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>المدرب</label>
                <input type="text" value="{{ $course->instructor->user1->username ?? 'غير محدد' }}" disabled>
            </div>
            <div class="form-group">
                <label>المستوى</label>
                <input type="text" value="{{ ucfirst($course->level) }}" disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>عدد الساعات</label>
                <input type="text" value="{{ $course->no_hours }} ساعة" disabled>
            </div>
            <div class="form-group">
                <label>الحالة</label>
                <div>
                    <span class="status-badge">{{ $course->status == 'active' ? 'نشط' : 'مسودة' }}</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>وصف الكورس</label>
            <textarea rows="5" disabled>{{ $course->short_description }}</textarea>
        </div>

        <div class="form-actions">
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i> عودة للجدول
            </a>
            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> انتقل للتعديل
            </a>
        </div>
    </form>
</div>
@endsection
