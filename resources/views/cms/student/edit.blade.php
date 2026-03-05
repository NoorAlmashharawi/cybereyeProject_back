@extends('cms.parent')

@section('title', 'تعديل بيانات الطالب')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/editStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="form-container">
    <h2 class="form-title">
        <i class="fas fa-user-edit"></i> معلومات النظام: '{{ $students->username }}'
    </h2>

    <form id="edit-student-form">
        <div class="form-row">
            <div class="form-group">
                <label for="id">المعرف *</label>
                <input type="text" id="id_display" value="{{ $students->id }}" disabled>
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> الرقم التعريفي الخاص بالطالب
                </div>
            </div>

            <div class="form-group">
                <label for="username">اسم المستخدم *</label>
                <input type="text" id="username" name="username" required placeholder="أدخل اسم المستخدم" value="{{ $students->username }}">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> اسم الدخول للنظام
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" required placeholder="example@mail.com" value="{{ $students->email }}">
            </div>

            <div class="form-group">
                <label for="level">المستوى *</label>
                <select id="level" name="level" required>
                    <option value="">اختر المستوى</option>
                    <option value="beginner" {{ $students->level == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                    <option value="midium" {{ $students->level == 'midium' ? 'selected' : '' }}>متوسط</option>
                    <option value="advanced" {{ $students->level == 'advanced' ? 'selected' : '' }}>متقدم</option>
                    <option value="expert" {{ $students->level == 'expert' ? 'selected' : '' }}>خبير</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="status">حالة الطالب *</label>
            <select id="status" name="status" required>
                <option value="">اختر الحالة</option>
                <option value="active" {{ $students->status == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive" {{ $students->status == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                <option value="suspended" {{ $students->status == 'suspended' ? 'selected' : '' }}>موقوف مؤقتاً</option>
                <option value="graduated" {{ $students->status == 'graduated' ? 'selected' : '' }}>متخرج</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">رجوع</a>
            <button type="button" onclick="performUpdate({{ $students->id }})" class="btn btn-primary">
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