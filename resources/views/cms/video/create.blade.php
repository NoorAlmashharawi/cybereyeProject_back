@extends('cms.parent')

@section('title','إضافة فيديو جديد')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/createvideo.css') }}">
<link rel="stylesheet" href="https://cloudflare.com">
<style>
    /* تحسينات إضافية سريعة للمعاينة */
    #videoPreviewContainer {
        display: none;
        margin-top: 15px;
        background: #000;
        border-radius: 12px;
        overflow: hidden;
    }
    .file-name-display {
        color: #6f42c1;
        font-weight: bold;
        margin-top: 10px;
        display: none;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="form-container">
        <h2 class="form-title">
            <i class="fa-solid fa-circle-plus"></i>
            إضافة فيديو جديد للمساق
        </h2>

        <form id="create-form">
            <h3 class="form-subtitle">1. رفع ملف الوسائط</h3>

            <div class="form-group">
                <div class="upload-box" id="dropZone" onclick="document.getElementById('videoInput').click()">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <h5>اسحب وأفلت الفيديو هنا أو اضغط للاختيار</h5>
                    <p class="text-muted small">الصيغ المدعومة: MP4, MOV, AVI (الحد الأقصى 50MB)</p>
                    <div id="fileName" class="file-name-display"></div>
                </div>
                <input type="file" id="videoInput" hidden accept="video/*" onchange="previewVideo(event)">

                {{-- حاوية معاينة الفيديو --}}
                <div id="videoPreviewContainer">
                    <video id="mainVideoPreview" controls style="width: 100%; max-height: 300px;"></video>
                </div>
            </div>

            <h3 class="form-subtitle">2. معلومات الفيديو التفصيلية</h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="fw-bold mb-2">عنوان الفيديو <span class="text-danger">*</span></label>
                    <input type="text" id="title" class="form-control" placeholder="مثلاً: مقدمة في لغة جافا">
                </div>

                <div class="form-group">
                    <label class="fw-bold mb-2">المدة (بالدقائق)</label>
                    <input type="number" id="duration_minutes" class="form-control" placeholder="0">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="fw-bold mb-2">ترتيب الظهور</label>
                    <input type="number" id="order" class="form-control" value="1">
                </div>
                <div class="form-group">
                    {{-- يمكنك إضافة حقل إضافي هنا مثل القسم أو الحالة --}}
                </div>
            </div>

            <div class="form-group">
                <label class="fw-bold mb-2">وصف الدرس / الفيديو</label>
                <textarea id="description" rows="4" class="form-control" placeholder="اكتب ملخصاً بسيطاً لمحتوى الفيديو..."></textarea>
            </div>

            <div class="form-actions mt-4">
                <a href="{{ route('videos.index') }}" class="btn btn-secondary px-4">
                    إلغاء التغييرات
                </a>
                <button type="button" onclick="performStore()" class="btn btn-primary px-5">
                    <i class="fa-solid fa-cloud-arrow-up me-2"></i>
                    بدء الرفع والحفظ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// دالة معاينة الفيديو قبل الرفع
function previewVideo(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('videoPreviewContainer');
    const videoPlayer = document.getElementById('mainVideoPreview');
    const fileNameDisplay = document.getElementById('fileName');

    if (file) {
        const url = URL.createObjectURL(file);
        videoPlayer.src = url;
        previewContainer.style.display = 'block';
        fileNameDisplay.innerText = "تم اختيار: " + file.name;
        fileNameDisplay.style.display = 'block';
    }
}

// دالة الحفظ باستخدام Axios
function performStore(){
    // التأكد من اختيار ملف
    let videoFile = document.getElementById('videoInput').files[0];
    if(!videoFile) {
        Swal.fire({ icon: 'warning', title: 'تنبيه', text: 'يرجى اختيار ملف فيديو أولاً' });
        return;
    }

    // إظهار مؤشر التحميل
    Swal.fire({
        title: 'جاري معالجة ورفع الفيديو...',
        html: 'يرجى عدم إغلاق الصفحة حتى اكتمال العملية',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });

    let formData = new FormData();
    formData.append('title', document.getElementById('title').value);
    formData.append('description', document.getElementById('description').value);
    formData.append('duration_minutes', document.getElementById('duration_minutes').value);
    formData.append('order', document.getElementById('order').value);
    formData.append('video', videoFile);

    axios.post('{{ route("videos.store") }}', formData)
    .then(function(response){
        Swal.fire({
            icon: 'success',
            title: 'تم الرفع والحفظ بنجاح',
            text: response.data.message,
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = '{{ route("videos.index") }}';
        });
    })
    .catch(function(error){
        Swal.close();
        let msg = "حدث خطأ أثناء الحفظ، تحقق من الاتصال";
        if(error.response && error.response.data.errors) {
            msg = Object.values(error.response.data.errors)[0][0]; // جلب أول خطأ من Laravel Validation
        }
        Swal.fire({ icon: 'error', title: 'فشل الرفع', text: msg });
    });
}



function playLesson(videoUrl, title, description) {
    const video = document.getElementById('lessonVideo');
    const placeholder = document.getElementById('videoPlaceholder');

    document.getElementById('currentLessonTitle').innerText = title;
    document.getElementById('lessonDescription').innerText = description || "لا يوجد وصف";

    video.src = videoUrl;
    video.style.display = 'block';
    placeholder.style.display = 'none';

    video.load();
    video.play();

    // تمييز العنصر النشط
    document.querySelectorAll('.lesson-item').forEach(el => el.classList.remove('active'));
    event.currentTarget.classList.add('active');
}
</script>
@endsection
