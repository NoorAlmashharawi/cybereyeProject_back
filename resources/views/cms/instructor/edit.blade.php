@extends('cms.parent')

@section('title', 'تعديل بيانات المدرس')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/editStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="form-container">
    <h2 class="form-title">
        <i class="fas fa-chalkboard-teacher"></i> معلومات النظام: '{{ optional($instructor->user1)->username ?? "غير محدد" }}'
    </h2>

    <form id="edit-instructor-form">
        <div class="form-row">
            <div class="form-group">
                <label for="id">المعرف *</label>
                <input type="text" id="id_display" value="{{ $instructor->id }}" disabled>
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> الرقم التعريفي الخاص بالمدرس
                </div>
            </div>

            <div class="form-group">
                <label for="username">اسم المستخدم *</label>
                <input type="text" id="username" name="username" required placeholder="أدخل اسم المستخدم" value="{{ optional($instructor->user1)->username }}">
                <div class="form-help">
                    <i class="fas fa-info-circle"></i> اسم الدخول للنظام
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" required placeholder="example@mail.com" value="{{ optional($instructor->user1)->email }}">
            </div>

            <div class="form-group">
                <label for="specialization">التخصص</label>
                <input type="text" id="specialization" name="specialization" placeholder="مثال: علوم الحاسوب" value="{{ $instructor->specialization }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="experience_years">سنوات الخبرة</label>
                <input type="number" id="experience_years" name="experience_years" min="0" value="{{ $instructor->experience_years }}">
            </div>

            <div class="form-group">
                <label for="rating">التقييم</label>
                <input type="number" id="rating" name="rating" min="1" max="5" value="{{ $instructor->rating }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="enrollment_date">تاريخ الانضمام</label>
                <input type="date" id="enrollment_date" name="enrollment_date" value="{{ optional($instructor->enrollment_date)->format('Y-m-d') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="bio">نبذة عن المدرس</label>
            <textarea id="bio" name="bio" rows="4">{{ $instructor->bio }}</textarea>
        </div>

        <div class="form-actions">
            <a href="{{ route('instructors.index') }}" class="btn btn-secondary">رجوع</a>
            <button type="button" onclick="performUpdate({{ $instructor->id }})" class="btn btn-primary">
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
    formData.append('email', document.getElementById('email').value);
    formData.append('specialization', document.getElementById('specialization').value);
    formData.append('experience_years', document.getElementById('experience_years').value);
    formData.append('rating', document.getElementById('rating').value);
    formData.append('bio', document.getElementById('bio').value);
    formData.append('enrollment_date', document.getElementById('enrollment_date').value);

    axios.post('/cms/instructor/instructors/' + id, formData)
    .then(function (response) {
        if (typeof toastr !== 'undefined') {
            toastr.success(response.data.title);
        } else {
            alert(response.data.title);
        }
        setTimeout(() => {
            window.location.href = '/cms/instructor/instructors';
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
