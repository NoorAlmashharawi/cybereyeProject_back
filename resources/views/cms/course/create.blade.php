@extends('cms.parent')

@section('title', 'إضافة كورس جديد')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* الحاوية الأساسية */
    .dashboard-wrapper {
        display: flex;
        gap: 25px;
        padding: 20px;
        background: #f8f9fe;
        min-height: 90vh;
        direction: rtl;
    }

    /* السايد بار الجانبي */
    .side-panel {
        width: 300px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* صندوق رفع الصورة */
    .image-upload-wrapper {
        background: white;
        border-radius: 20px;
        padding: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        cursor: pointer;
        transition: 0.3s;
        border: 2px dashed #d1d9e6;
        text-align: center;
    }

    .image-upload-wrapper:hover {
        border-color: #5e72e4;
        background: #f6f9fc;
    }

    .upload-box {
        height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        border-radius: 15px;
    }

    .upload-box i {
        font-size: 3rem;
        color: #5e72e4;
        margin-bottom: 15px;
    }

    .upload-box p {
        font-size: 0.9rem;
        color: #8898aa;
        font-weight: 600;
        margin: 0;
    }

    #image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        display: none;
    }

    /* القائمة تحت الصورة */
    .side-menu-list {
        background: white;
        border-radius: 20px;
        padding: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #525f7f;
        text-decoration: none;
        border-radius: 12px;
        margin-bottom: 8px;
        transition: 0.3s;
        font-weight: 600;
    }

    .menu-item i { margin-left: 12px; color: #5e72e4; font-size: 1.1rem; }

    .menu-item:hover, .menu-item.active {
        background: #5e72e4;
        color: white;
    }

    .menu-item:hover i, .menu-item.active i { color: white; }

    /* منطقة الفورم */
    .main-form-content {
        flex: 1;
        background: white;
        border-radius: 25px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
    }

    .form-subtitle {
        color: #32325d;
        font-weight: 800;
        margin-bottom: 35px;
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.5rem;
        border-right: 5px solid #5e72e4;
        padding-right: 15px;
    }

    .form-row { display: flex; gap: 25px; margin-bottom: 25px; flex-wrap: wrap; }
    .form-group { flex: 1; min-width: 250px; display: flex; flex-direction: column; gap: 10px; }

    label { font-weight: 700; color: #525f7f; font-size: 0.95rem; }

    input, select, textarea {
        border-radius: 12px !important;
        padding: 15px !important;
        border: 1px solid #e9ecef !important;
        background: #fcfcfc;
        font-size: 0.95rem;
        transition: 0.2s;
    }

    input:focus, select:focus {
        border-color: #5e72e4 !important;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(94, 114, 228, 0.1) !important;
    }

    .btn-save {
        background: #5e72e4;
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 15px;
        font-weight: 800;
        cursor: pointer;
        font-size: 1.1rem;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(94, 114, 228, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-save:hover { transform: translateY(-3px); box-shadow: 0 7px 20px rgba(94, 114, 228, 0.5); }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">

    <aside class="side-panel">
        <div class="image-upload-wrapper" onclick="document.getElementById('course_image').click()">
            <div class="upload-box">
                <i class="fas fa-cloud-upload-alt" id="upload-icon"></i>
                <p id="upload-text">اضغطي لرفع غلاف الكورس</p>
                <img src="" id="image-preview">
            </div>
            <input type="file" id="course_image" style="display: none;" accept="image/*" onchange="previewImage(event)">
        </div>

        <div class="side-menu-list">
            <a href="{{ route('courses.index') }}" class="menu-item">
                <i class="fas fa-list-ul"></i> عرض كل الكورسات
            </a>
            <a href="#" class="menu-item active">
                <i class="fas fa-plus-circle"></i> إضافة كورس جديد
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-chart-line"></i> تقارير التسجيل
            </a>
        </div>
    </aside>

    <main class="main-form-content">
        <form id="create_form">
            <h3 class="form-subtitle">بيانات الكورس الجديد</h3>

            <div class="form-row">
                <div class="form-group">
                    <label for="course_name">اسم الكورس بالكامل *</label>
                    <input type="text" id="course_name" placeholder="مثلاً: دبلوم البرمجة بلغة PHP">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category_id">التصنيف الدراسي *</label>
                    <select id="category_id">
                    <option value="">-- اختر المسار التعليمي --</option>
                    @foreach($categories as $category)
                        {{-- هنا بنعرض الـ title تبع المسارات اللي أنتِ عملتيها --}}
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="instructor_id">المدرب المسؤول *</label>

                    <select id="instructor_id">
                        <option value="">حدد مدرب الدورة</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}">
                                {{ $instructor->user1->username ?? $instructor->user1->username ?? 'مدرب غير معروف' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label for="short_description">وصف تفصيلي للكورس</label>
                <textarea id="short_description" rows="4" placeholder="اكتبي هنا محاور الدورة وماذا سيتعلم الطالب..."></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="level">مستوى الدورة</label>
                    <select id="level">
                        <option value="beginner">مبتدئ (Beginner)</option>
                        <option value="intermediate">متوسط (Intermediate)</option>
                        <option value="advanced">متقدم (Advanced)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_hours">إجمالي الساعات</label>
                    <input type="number" id="no_hours" placeholder="00">
                </div>
                <div class="form-group">
                    <label for="status">حالة النشر</label>
                    <select id="status">
                        <option value="active">نشط الآن</option>
                        <option value="draft">حفظ كمسودة</option>
                    </select>
                </div>
            </div>

            <div style="text-align: left; margin-top: 40px;">
                <button type="button" onclick="performStore()" class="btn-save">
                    <i class="fas fa-save"></i> اعتماد وحفظ البيانات
                </button>
            </div>
        </form>
    </main>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('image-preview');
                const icon = document.getElementById('upload-icon');
                const text = document.getElementById('upload-text');

                preview.src = reader.result;
                preview.style.display = 'block';
                icon.style.display = 'none';
                text.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    }

    function performStore() {
        let formData = new FormData();

        formData.append('course_name', document.getElementById('course_name').value);
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('instructor_id', document.getElementById('instructor_id').value);
        formData.append('short_description', document.getElementById('short_description').value);
        formData.append('level', document.getElementById('level').value);
        formData.append('no_hours', document.getElementById('no_hours').value);
        formData.append('status', document.getElementById('status').value);
        formData.append('start_date', '{{ date("Y-m-d") }}');

        const imageFile = document.getElementById('course_image').files[0];
        if (imageFile) {
            formData.append('course_image', imageFile);
        }

        // استدعاء دالة store من ملف crud.js
        store('{{ route("courses.store") }}', formData);
    }
</script>
@endsection
