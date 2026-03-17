@extends('cms.parent')

@section('title', 'show student')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/showStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="form-container">
    <h2 class="form-title">
        <i class="fas fa-lock"></i> معلومات النظام
    </h2>

    <div class="form-row">
        <div class="form-group">
            <label for="id">المعرف *</label>
            <input type="text" id="id" value="{{ $student->id }}" disabled>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> الرقم الخاص بالمستخدم
            </div>
        </div>

        <div class="form-group">
            <label for="user1_id">معرف المستخدم</label>
            <input type="text" id="user1_id" value="{{ $student->user1_id }}" disabled>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> الرابط مع جدول المستخدمين
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="username">اسم المستخدم *</label>
            <input type="text" id="username" value="{{ $student->user1->username ?? 'غير محدد' }}" disabled>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> اسم المستخدم للدخول إلى النظام
            </div>
        </div>

        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="text" id="email" value="{{ $student->user1->email ?? 'غير محدد' }}" disabled>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> البريد المستخدم لتسجيل الدخول
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="level">المستوى</label>
            <select id="level" disabled>
                <option value="">اختر المستوى</option>
                <option value="beginner" {{ $student->level == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                <option value="midium" {{ $student->level == 'midium' ? 'selected' : '' }}>متوسط</option>
                <option value="advanced" {{ $student->level == 'advanced' ? 'selected' : '' }}>متقدم</option>
                <option value="expert" {{ $student->level == 'expert' ? 'selected' : '' }}>خبير</option>
            </select>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> مستوى الطالب
            </div>
        </div>

        <div class="form-group">
            <label for="specialization">التخصص</label>
            <input type="text" id="specialization" value="{{ $student->specialization ?? 'غير محدد' }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="status">حالة الطالب *</label>
            <select id="status" disabled>
                <option value="">اختر الحالة</option>
                <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                <option value="suspended" {{ $student->status == 'suspended' ? 'selected' : '' }}>موقوف مؤقتاً</option>
                <option value="graduated" {{ $student->status == 'graduated' ? 'selected' : '' }}>متخرج</option>
            </select>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> الحالة الحالية للطالب
            </div>
        </div>

        <div class="form-group">
            <label for="progress">نسبة التقدم</label>
            <input type="text" id="progress" value="{{ $student->progress ?? 0 }}%" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="enrollment_date">تاريخ التسجيل</label>
            <input type="text" id="enrollment_date" value="{{ $student->enrollment_date ? $student->enrollment_date->format('Y-m-d') : 'غير محدد' }}" disabled>
        </div>

        <div class="form-group">
            <label for="created_at">تاريخ الإنشاء</label>
            <input type="text" id="created_at" value="{{ $student->created_at ? $student->created_at->format('Y-m-d H:i') : 'غير محدد' }}" disabled>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> رجوع
        </a>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> تعديل
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('cms/js/addStudent.js') }}">
@endsection
