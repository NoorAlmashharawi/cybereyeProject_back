 @extends('cms.parent')

@section('title', 'عرض المدرس')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/showStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')

<div class="form-container">

<h2 class="form-title">
<i class="fas fa-chalkboard-teacher"></i>
معلومات المدرس
</h2>

{{-- معلومات النظام --}}
<h3 class="form-subtitle">معلومات النظام</h3>

<div class="form-row">

<div class="form-group">
<label>ID</label>
<input type="text" value="{{ $instructor->id }}" disabled>
</div>



</div>


{{-- بيانات المستخدم --}}
<h3 class="form-subtitle">بيانات المستخدم</h3>

<div class="form-row">

<div class="form-group">
<label>اسم المستخدم</label>
<input type="text" value="{{ $instructor->user1->username ?? 'غير محدد' }}" disabled>
</div>

<div class="form-group">
<label>البريد الإلكتروني</label>
<input type="text" value="{{ $instructor->user1->email ?? 'غير محدد' }}" disabled>
</div>

</div>


{{-- بيانات المدرس --}}
<h3 class="form-subtitle">بيانات المدرس</h3>

<div class="form-row">

<div class="form-group">
<label>التخصص</label>
<input type="text" value="{{ $instructor->specialization ?? 'غير محدد' }}" disabled>
</div>

<div class="form-group">
<label>سنوات الخبرة</label>
<input type="text" value="{{ $instructor->experience_years }} سنة" disabled>
</div>

</div>


<div class="form-row">

<div class="form-group">
<label>التقييم</label>
<input type="text" value="{{ $instructor->rating }} / 5" disabled>
</div>

<div class="form-group">
<label>تاريخ الانضمام</label>
<input type="text"
value="{{ $instructor->enrollment_date ? $instructor->enrollment_date->format('Y-m-d') : 'غير محدد' }}"
disabled>
</div>

</div>


<div class="form-group">

<label>نبذة عن المدرس</label>
<textarea rows="4" disabled>{{ $instructor->bio ?? 'لا توجد نبذة' }}</textarea>

</div>


<div class="form-row">

<div class="form-group">
<label>تاريخ الإنشاء</label>
<input type="text"
value="{{ $instructor->created_at ? $instructor->created_at->format('Y-m-d H:i') : 'غير محدد' }}"
disabled>
</div>

<div class="form-group">
<label>آخر تحديث</label>
<input type="text"
value="{{ $instructor->updated_at ? $instructor->updated_at->format('Y-m-d H:i') : 'غير محدد' }}"
disabled>
</div>

</div>


<div class="form-actions">

<a href="{{ route('instructors.index') }}" class="btn btn-secondary">
<i class="fas fa-arrow-right"></i>
رجوع
</a>

<a href="{{ route('instructors.edit', $instructor->id) }}" class="btn btn-primary">
<i class="fas fa-edit"></i>
تعديل
</a>

</div>

</div>

@endsection
