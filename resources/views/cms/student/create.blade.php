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

    <form id="create-form" method="POST" action="{{ route('students.store') }}">
        @csrf
        
        {{-- بيانات User1 --}}
        <h3 class="form-subtitle">بيانات الدخول</h3>
        <div class="form-row">
            <div class="form-group">
                <label for="username">اسم المستخدم *</label>
                <input type="text" id="username" name="username" required placeholder="أدخل اسم المستخدم للنظام">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> اسم المستخدم للدخول إلى النظام
                </div>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" required placeholder="example@mail.com">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">كلمة المرور *</label>
                <input type="password" id="password" name="password" required placeholder="كلمة مرور قوية">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> يجب أن تحتوي على 8 أحرف على الأقل
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">تأكيد كلمة المرور *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="أعد إدخال كلمة المرور">
            </div>
        </div>

        {{-- بيانات Student --}}
        <h3 class="form-subtitle">بيانات الطالب</h3>
        <div class="form-row">
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

            <div class="form-group">
                <label for="specialization">التخصص</label>
                <input type="text" id="specialization" name="specialization" placeholder="مثال: أمن شبكات">
            </div>
        </div>

        <div class="form-row">
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

            <div class="form-group">
                <label for="progress">نسبة التقدم</label>
                <input type="number" id="progress" name="progress" min="0" max="100" value="0" placeholder="0-100">
            </div>
        </div>

        <div class="form-group">
            <label for="enrollment_date">تاريخ التسجيل</label>
            <input type="date" id="enrollment_date" name="enrollment_date" value="{{ date('Y-m-d') }}">
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
    let formData = new FormData();
    formData.append('username', document.getElementById('username').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('password', document.getElementById('password').value);
    formData.append('password_confirmation', document.getElementById('password_confirmation').value);
    formData.append('level', document.getElementById('level').value);
    formData.append('status', document.getElementById('status').value);
    formData.append('specialization', document.getElementById('specialization').value || 'General');
    formData.append('progress', document.getElementById('progress').value || 0);
    formData.append('enrollment_date', document.getElementById('enrollment_date').value);

    axios.post('{{ route('students.store') }}', formData)
        .then(function (response) {
            if (response.data.icon === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'أحسنت!',
                    text: response.data.title,
                    confirmButtonText: 'حسناً',
                    confirmButtonColor: '#28a745',
                    timer: 1500,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    // التوجيه إلى صفحة index بعد نجاح الإضافة
                    window.location.href = '{{ route('students.index') }}';
                });
            }
        })
        .catch(function (error) {
            if (error.response && error.response.data) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ!',
                    text: error.response.data.title,
                    confirmButtonText: 'حسناً',
                    confirmButtonColor: '#dc3545',
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ!',
                    text: 'حدث خطأ غير متوقع',
                    confirmButtonText: 'حسناً',
                });
            }
        });
}
</script>
@endsection