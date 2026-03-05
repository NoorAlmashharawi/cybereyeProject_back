@extends('cms.parent')

@section('title', 'إضافة طالب جديد')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/addStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="form-container">
    <h2 class="form-title">
        <i class="fas fa-user-plus"></i> معلومات النظام
    </h2>

    {{-- 1. يجب أن يبدأ الفورم هنا ليحتوي على كل المدخلات --}}
    <form id="create-form">
        <div class="form-row">
            <div class="form-group">
                <label for="username">اسم المستخدم *</label>
                <input type="text" id="username" name="username" required placeholder="أدخل اسم المستخدم للنظام">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> اسم المستخدم للدخول إلى النظام
                </div>
            </div>


        <div class="form-row">
            <div class="form-group">
                <label for="email">البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" required placeholder="example@mail.com">
            </div>

            <div class="form-group">
                <label for="level">المستوى *</label>
                <select id="level" name="level" required>
                    <option value="">اختر المستوى</option>
                    <option value="beginner">مبتدئ</option>
                    <option value="midium">متوسط</option>
                    <option value="advanced">متقدم</option>
                    <option value="expert">خبير</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="status">حالة الطالب *</label>
            <select id="status" name="status" required>
                <option value="">اختر الحالة</option>
                <option value="active">نشط</option>
                <option value="inactive">غير نشط</option>
                <option value="suspended">موقوف مؤقتاً</option>
                <option value="graduated">متخرج</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">رجوع</a>
            <button type="button" onclick="performStore()" class="btn btn-primary">
                <i class="fas fa-save"></i> حفظ الطالب
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function performStore() {
        // تأكد من جلب القيم بدقة
        let formData = new FormData();
        formData.append('username', document.getElementById('username').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('level', document.getElementById('level').value);
        formData.append('status', document.getElementById('status').value);

        // استخدام الـ route الصحيح
        store("{{ route('students.store') }}", formData);
    }
</script>
@endsection