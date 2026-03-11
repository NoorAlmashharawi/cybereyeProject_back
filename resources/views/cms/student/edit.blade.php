@extends('cms.parent')

@section('title', 'تعديل بيانات الطالب')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/editStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="form-container">
    <h2 class="form-title">
        <i class="fas fa-user-edit"></i> معلومات النظام: '{{ $student->user1->username }}'
    </h2>

    <form id="edit-student-form">
        <div class="form-row">
            <div class="form-group">
                <label for="id">المعرف *</label>
                <input type="text" id="id_display" value="{{ $student->id }}" disabled>
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> الرقم التعريفي الخاص بالطالب
                </div>
            </div>

            <div class="form-group">
                <label for="username">اسم المستخدم *</label>
                <input type="text" id="username" name="username" required placeholder="أدخل اسم المستخدم" value="{{ $student->user1->username }}">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> اسم الدخول للنظام
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" required placeholder="example@mail.com" value="{{ $student->user1->email }}">
            </div>

            <div class="form-group">
                <label for="level">المستوى *</label>
                <select id="level" name="level" required>
                    <option value="">اختر المستوى</option>
                    <option value="beginner" {{ $student->level == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                    <option value="midium" {{ $student->level == 'midium' ? 'selected' : '' }}>متوسط</option>
                    <option value="advanced" {{ $student->level == 'advanced' ? 'selected' : '' }}>متقدم</option>
                    <option value="expert" {{ $student->level == 'expert' ? 'selected' : '' }}>خبير</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="specialization">التخصص</label>
                <input type="text" id="specialization" name="specialization" placeholder="مثال: أمن شبكات" value="{{ $student->specialization }}">
            </div>

            <div class="form-group">
                <label for="progress">نسبة التقدم</label>
                <input type="number" id="progress" name="progress" min="0" max="100" value="{{ $student->progress }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="status">حالة الطالب *</label>
                <select id="status" name="status" required>
                    <option value="">اختر الحالة</option>
                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>نشط</option>
                    <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                    <option value="suspended" {{ $student->status == 'suspended' ? 'selected' : '' }}>موقوف مؤقتاً</option>
                    <option value="graduated" {{ $student->status == 'graduated' ? 'selected' : '' }}>متخرج</option>
                </select>
            </div>

            <div class="form-group">
                <label for="enrollment_date">تاريخ التسجيل</label>
                <input type="date" id="enrollment_date" name="enrollment_date" value="{{ $student->enrollment_date->format('Y-m-d') }}">
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">رجوع</a>
            <button type="button" onclick="performUpdate({{ $student->id }})" class="btn btn-primary">
                <i class="fas fa-save"></i> حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performUpdate(id) {
    let formData = new FormData();
    formData.append('_method', 'PUT'); 
    formData.append('username', document.getElementById('username').value);
    formData.append('email',    document.getElementById('email').value);
    formData.append('level',    document.getElementById('level').value);
    formData.append('status',   document.getElementById('status').value);

    // استخدام axios مباشرة لضمان التحكم الكامل
    axios.post('/cms/student/students_update/' + id, formData)
    .then(function (response) {
        // إذا كان toastr غير معرف، سيستخدم alert عادي حتى لا ينهار الكود
        if (typeof toastr !== 'undefined') {
            toastr.success(response.data.title);
        } else {
            alert(response.data.title);
        }
        
        // العودة لصفحة الجدول بعد النجاح
        setTimeout(() => {
            window.location.href = '/cms/student/students';
        }, 1000);
    })
    .catch(function (error) {
        let message = error.response ? error.response.data.title : "حدث خطأ ما";
        if (typeof toastr !== 'undefined') {
            toastr.error(message);
        } else {
            alert(message);
        }
    });
}

</script>
@endsection