@extends('cms.parent')

@section('title','إضافة مدرس')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/addStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')

<div class="form-container">

<h2 class="form-title">
<i class="fas fa-chalkboard-teacher"></i>
إضافة مدرس جديد
</h2>

<form id="create-form">

{{-- بيانات المستخدم --}}
<h3 class="form-subtitle">بيانات الدخول</h3>

<div class="form-row">

<div class="form-group">
<label>اسم المستخدم</label>
<input type="text" id="username" placeholder="اسم المستخدم">
</div>

<div class="form-group">
<label>البريد الإلكتروني</label>
<input type="email" id="email" placeholder="example@mail.com">
</div>

</div>

<div class="form-row">

<div class="form-group">
<label>كلمة المرور</label>
<input type="password" id="password">
</div>

<div class="form-group">
<label>تأكيد كلمة المرور</label>
<input type="password" id="password_confirmation">
</div>

</div>


{{-- بيانات المدرس --}}
<h3 class="form-subtitle">بيانات المدرس</h3>

<div class="form-row">

<div class="form-group">
<label>التخصص</label>
<input type="text" id="specialization" placeholder="Cyber Security">
</div>

<div class="form-group">
<label>سنوات الخبرة</label>
<input type="number" id="experience_years" min="0">
</div>

</div>

<div class="form-row">

<div class="form-group">
<label>التقييم</label>
<input type="range" id="rating" min="1" max="5"step="0.5">
</div>

<div class="form-group">
<label>تاريخ الانضمام</label>
<input type="date" id="enrollment_date" value="{{ date('Y-m-d') }}">
</div>

</div>

<div class="form-group">

<label class="form-subtitle">نبذة عن المدرس</label>
<textarea id="bio" rows="4" class="bio"></textarea>

</div>


<div class="form-actions">

<a href="{{ route('instructors.index') }}" class="btn btn-secondary">
رجوع
</a>

<button type="button" onclick="performStore()" class="btn btn-primary">
<i class="fas fa-save"></i>
حفظ
</button>

</div>

</form>

</div>

@endsection


@section('scripts')

<script>

function performStore(){

let formData = new FormData();

formData.append('username',username.value);
formData.append('email',email.value);
formData.append('password',password.value);
formData.append('password_confirmation',password_confirmation.value);

formData.append('specialization',specialization.value);
formData.append('experience_years',experience_years.value);
formData.append('rating',rating.value);
formData.append('bio',bio.value);
formData.append('enrollment_date',enrollment_date.value);


axios.post('{{ route('instructors.store') }}',formData)

.then(function(response){

Swal.fire({
icon:'success',
title:response.data.title,
timer:1500,
showConfirmButton:false
})

.then(()=>{
window.location.href='{{ route('instructors.index') }}'
})

})

.catch(function(error){

Swal.fire({
icon:'error',
title:'خطأ',
text:error.response.data.title
})

})

}

</script>

@endsection
