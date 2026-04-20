@extends('cms.parent')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/addStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="form-container">
    <h2 class="form-title">
        <i class="fas fa-user-plus"></i> معلومات النظام
    </h2>

    <form id="create-form" method="POST" action="{{ route('admins.store') }}">
        @csrf
        
        <div class="form-group">
            <label>Role NAme</label>
            <select class="form-control select2" id="role_id" name="role_id"  style="width: 100%;">
              @foreach ($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>

              @endforeach
          
            </select>
          </div>
  
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


    
   


        <div class="form-actions">
            <a href="{{ route('admins.index') }}" class="btn btn-secondary">رجوع</a>
            <button type="button" onclick="performStore()" class="btn btn-primary">
                <i class="fas fa-save"></i> حفظ 
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
    formData.append('role_id', document.getElementById('role_id').value);

    axios.post('{{ route('admins.store') }}', formData)
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
                    window.location.href = '{{ route('admins.index') }}';
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endsection