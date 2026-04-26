@extends('cms.parent')

@section('title', 'رفع مادة تعليمية - CyberEye')

@section('styles')
<style>
    .create-page-wrapper { width: 100%; padding: 50px 20px; background-color: #0b0f19; min-height: 100vh; direction: rtl; box-sizing: border-box; }
    .admin-main { background-color: #0b0f19 !important; }
    .cyber-form-card { background: #111827; border: 1px solid #1f2937; border-radius: 20px; padding: 50px; max-width: 900px; margin: 0 auto; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6); }

    .form-header-title { color: #10b981; font-size: 26px; font-weight: 800; margin-bottom: 40px; display: flex; align-items: center; gap: 15px; }
    .form-cyber-label { color: #f3f4f6; font-weight: 700; font-size: 16px; margin-bottom: 12px; display: block; }

    .form-cyber-control {
        background: #0b0f19 !important;
        border: 2px solid #1f2937 !important;
        color: #ffffff !important;
        border-radius: 12px;
        padding: 18px;
        width: 100%;
        transition: 0.3s;
        appearance: auto; /* لضمان دعم المتصفحات في القوائم المنسدلة */
    }

    .form-cyber-control option {
        background-color: #111827 !important;
        color: #ffffff !important;
        padding: 10px;
    }

    .upload-zone {
        width: 100%; height: 180px; background: #0b0f19; border: 2px dashed #374151; border-radius: 15px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        cursor: pointer; transition: 0.3s; margin-top: 10px;
    }
    .upload-zone:hover { border-color: #10b981; background: #0d1421; }
    .file-info { display: none; color: #10b981; font-weight: bold; margin-top: 10px; text-align: center; }

    .action-footer { display: flex; gap: 20px; margin-top: 45px; border-top: 1px solid #1f2937; padding-top: 30px; }
    .btn-save-cyber { background: linear-gradient(90deg, #10b981, #059669) !important; color: white !important; border: none; flex: 2; padding: 18px; border-radius: 12px; font-weight: 800; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; }
    .btn-back-cyber { background: #1f2937 !important; color: #9ca3af !important; flex: 1; padding: 18px; border-radius: 12px; text-align: center; text-decoration: none; font-weight: 700; display: flex; align-items: center; justify-content: center; }
</style>
@endsection

@section('content')
<div class="create-page-wrapper">
    <div class="cyber-form-card">
        <h2 class="form-header-title"><i class="fas fa-file-upload"></i> رفع مادة تعليمية جديدة</h2>

                <form id="create-material-form" enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-7 mb-5">
                    <label class="form-cyber-label">عنوان المادة التعليمية</label>
                    <input type="text" class="form-cyber-control" id="title" placeholder="مثلاً: ملف تدريب الأكسل">
                </div>
<input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
<div class="col-md-12 mb-5">
    <label class="form-cyber-label">الكورس التابع له</label>
    <p class="text-white bg-dark p-2 rounded" style="background: #1f2937; padding: 12px; border-radius: 8px;">
        {{ $course->course_name }}
    </p>
</div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">تحميل الملف (يدعم معظم الصيغ)</label>
                    <input type="file" id="fileInput" style="display: none;" onchange="handleFile(this)">
                    <div class="upload-zone" id="upload-box" onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-cloud-upload-alt fa-3x" id="uploadIcon" style="color: #374151;"></i>
                        <p id="uploadText" class="text-muted mt-3">انقر هنا لاختيار الملف من جهازك</p>
                        <div id="fileStatus" class="file-info"></div>
                    </div>
                </div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">وصف الملف (اختياري)</label>
                    <textarea class="form-cyber-control" id="description" rows="3" placeholder="ملاحظات للطلاب..."></textarea>
                </div>

                <div class="col-md-12 action-footer">
                    <a href="{{ route('materials.index') }}" class="btn-back-cyber">إلغاء</a>
                    <button type="button" onclick="performStore()" class="btn-save-cyber">تأكيد الرفع والحفظ <i class="fas fa-check-circle"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleFile(input) {
        if (input.files && input.files[0]) {
            let fileName = input.files[0].name;
            document.getElementById('fileStatus').innerText = "تم اختيار الملف: " + fileName;
            document.getElementById('fileStatus').style.display = 'block';
            document.getElementById('uploadIcon').style.color = '#10b981';
            document.getElementById('uploadText').style.display = 'none';
            document.getElementById('upload-box').style.borderColor = '#10b981';
        }
    }

function performStore() {
    let title = document.getElementById('title').value;
    let course_id = document.getElementById('course_id').value;
    let description = document.getElementById('description').value;
    let fileInput = document.getElementById('fileInput').files[0];

    if (!title) {
        showError('حقل العنوان فارغ، يرجى كتابة عنوان للمادة');
        return;
    }
    if (!course_id) {
        showError('لم يتم اختيار كورس، يرجى تحديد الكورس من القائمة');
        return;
    }
    if (!fileInput) {
        showError('لم يتم اختيار ملف، يرجى رفع ملف أولاً');
        return;
    }

    let formData = new FormData();
    formData.append('title', title);
    formData.append('course_id', course_id);
    formData.append('description', description);
    formData.append('file', fileInput);

    axios.post('/cms/instructor/materials', formData)
        .then(function (response) {
            Swal.fire({
                icon: 'success',
                title: 'تم الحفظ!',
                text: response.data.message || 'تم الرفع بنجاح',
                background: '#111827',
                color: '#fff',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
               
                window.location.href = "/cms/instructor/materials?course_id=" + course_id;
            });
        })
        .catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'خطأ في العملية',
                text: error.response?.data?.message || 'حدث خطأ غير متوقع',
                background: '#111827',
                color: '#fff'
            });
        });
}

    function showError(msg) {
        Swal.fire({
            icon: 'warning',
            title: 'بيانات ناقصة',
            text: msg,
            background: '#111827',
            color: '#fff',
            confirmButtonColor: '#10b981'
        });
    }
</script>
@endsection
