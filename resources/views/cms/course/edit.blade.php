@extends('cms.parent')

@section('title', 'تعديل الكورس')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/addStudent.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* الحاوية الأساسية */
    .dashboard-wrapper {
        display: flex; gap: 25px; padding: 20px;
        background: #05080a !important;
        min-height: 90vh; direction: rtl;
        font-family: 'Cairo', sans-serif;
    }

    .side-panel { width: 300px; display: flex; flex-direction: column; gap: 20px; }

    /* الكروت الجانبية */
    .image-upload-wrapper, .management-menu {
        background: #0a141a !important;
        border-radius: 20px !important;
        padding: 15px;
        border: 1px solid #14262e !important;
    }

    .upload-box {
        height: 200px; background: #040709 !important;
        border-radius: 15px; border: 1px solid #14262e !important;
        display: flex; align-items: center; justify-content: center; overflow: hidden;
    }

    #image-preview { width: 100%; height: 100%; object-fit: cover; }

    .manage-btn {
        display: flex; align-items: center; padding: 12px 15px; margin-bottom: 10px;
        border-radius: 12px; color: #7d8d96 !important; text-decoration: none !important;
        background: #0d1a21 !important; transition: 0.3s; width: 100%; font-weight: 600;
    }

    .manage-btn:hover { background: #14262e !important; color: #1abc9c !important; transform: translateX(-8px); }
    .manage-btn i { width: 25px; color: #1abc9c !important; }

    /* منطقة الفورم */
    .main-content-area { flex: 1; }
    .form-container {
        background: #0a141a !important; border-radius: 25px !important;
        padding: 40px !important; border: none !important; box-shadow: none !important;
    }

    /* أيقونة التعديل والعنوان - جنزاري بالكامل */
    .form-title {
        color: #ffffff !important; font-weight: 800; margin-bottom: 35px;
        display: flex; align-items: center; gap: 15px; font-size: 1.4rem;
    }
    .form-title i { color: #1abc9c !important; text-shadow: none; }

    /* المعلومات الأساسية - بدون خطوط بيضاء */
    .form-subtitle {
        color: #1abc9c !important; font-weight: 700; font-size: 1.1rem;
        margin-bottom: 25px !important; border: none !important; /* شلنا الخط */
        background: transparent !important; padding: 0 !important;
    }

    .form-row { display: flex; gap: 20px; margin-bottom: 20px; flex-wrap: wrap; }
    .form-group { flex: 1; min-width: 200px; }

    /* وصف الكورس - بعرض الفورم كامل */
    .form-group-full { width: 100%; margin-top: 10px; }

    label { color: #5c707a !important; font-weight: 600; font-size: 0.9rem; margin-bottom: 10px; display: block; }

    /* المدخلات */
    .form-control, input, select, textarea {
        background: #040709 !important; border: 1px solid #14262e !important;
        color: #d1dce2 !important; border-radius: 10px !important;
        padding: 12px 15px !important; width: 100%; box-shadow: none !important;
    }

    .form-control:focus { border-color: #1abc9c !important; outline: none; }

    /* زر الحفظ */
    .btn-primary {
        background: #1abc9c !important; color: #05080a !important;
        border: none !important; padding: 15px 50px !important;
        border-radius: 12px !important; font-weight: 800 !important;
        cursor: pointer; transition: 0.3s;
    }
    .btn-primary:active { background: #00bcd4 !important; box-shadow: 0 0 20px rgba(0, 188, 212, 0.4) !important; }

    /* تنظيف أي خطوط أفقية ناتجة عن الـ Bootstrap */
    hr { border-top: 1px solid #14262e !important; opacity: 0.2; margin: 20px 0; }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">

    {{-- السايد بار الجانبي --}}
    <aside class="side-panel">
        {{-- كارد الصورة --}}
        <div class="image-upload-wrapper" onclick="document.getElementById('course_image').click()">
            <label style="display: block; margin-bottom: 10px; color: #525f7f; font-weight: bold;">غلاف الكورس</label>
            <div class="upload-box">
                <img src="{{ asset('storage/' . $course->course_image) }}" id="image-preview" alt="Course Cover">
            </div>
            <p style="margin-top: 10px; font-size: 0.8rem; color: #5e72e4;">اضغطي لتغيير الصورة</p>
            <input type="file" id="course_image" style="display: none;" accept="image/*" onchange="previewImage(event)">
        </div>

        {{-- أزرار الإدارة  )--}}
        <div class="management-menu">
            <h5 style="font-size: 0.9rem; color: #8898aa; margin-bottom: 15px; padding-right: 10px;">إدارة المحتوى</h5>


            <a href="{{ route('videos.index', $course->id) }}" class="manage-btn">
    <i class="fas fa-play-circle"></i>
    <span>إدارة الدروس</span>
</a>

            <a href="{{ route('quizzs.create') }}" class="manage-btn">
                <i class="fas fa-question-circle"></i>
                <span>إدارة الكويزات</span>
            </a>




            <hr style="border-top: 1px solid #f0f2f9;">

            <a href="{{ route('courses.index') }}" class="manage-btn" style="background: transparent;">
                <i class="fas fa-arrow-right" style="color: #adb5bd;"></i>
                <span>عودة للقائمة</span>
            </a>
        </div>
    </aside>

    {{-- منطقة الفورم الأساسية --}}
    <main class="main-content-area">
        <div class="form-container">
            <h2 class="form-title">
                <i class="fas fa-edit"></i>
                تعديل بيانات الكورس
            </h2>

            <form id="edit-form">
                <h3 class="form-subtitle">المعلومات الأساسية</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label>اسم الكورس بالكامل</label>
                        <input type="text" id="course_name" value="{{ $course->course_name }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>التصنيف الدراسي</label>
                        <select id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>

                                    {{ $course->category->title ?? 'غير مصنف' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>المدرب المسؤول</label>
                        <select id="instructor_id" class="form-control">
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ $course->instructor_id == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->user1->username ?? 'مدرب غير معروف' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>مستوى الدورة</label>
                        <select id="level" class="form-control">
                            <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                            <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                            <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }}>متقدم</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>إجمالي الساعات</label>
                        <input type="number" id="no_hours" value="{{ $course->no_hours }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>حالة النشر</label>
                        <select id="status" class="form-control">
                            <option value="active" {{ $course->status == 'active' ? 'selected' : '' }}>نشط الآن</option>
                            <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>مسودة</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>وصف تفصيلي للكورس</label>
                    <textarea id="short_description" rows="5" class="form-control">{{ $course->short_description }}</textarea>
                </div>

                <div class="form-actions text-start">
                    <button type="button" onclick="performUpdate({{ $course->id }})" class="btn btn-primary px-5">
                        <i class="fas fa-save ms-2"></i> حفظ التعديلات
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('image-preview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function performUpdate(id) {
        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('course_name', document.getElementById('course_name').value);
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('instructor_id', document.getElementById('instructor_id').value);
        formData.append('level', document.getElementById('level').value);
        formData.append('no_hours', document.getElementById('no_hours').value);
        formData.append('status', document.getElementById('status').value);
        formData.append('short_description', document.getElementById('short_description').value);

        const img = document.getElementById('course_image').files[0];
        if (img) formData.append('course_image', img);

        axios.post('/cms/course/courses/' + id, formData)
        .then(res => Swal.fire({ icon: 'success', title: 'تم التحديث!', timer: 1500, showConfirmButton: false }))
        .catch(err => Swal.fire({ icon: 'error', title: 'خطأ في التحديث' }));
    }
</script>
@endsection
