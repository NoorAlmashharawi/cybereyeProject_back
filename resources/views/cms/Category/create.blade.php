@extends('cms.parent')

@section('title', 'إضافة تصنيف - CyberEye')

@section('styles')
<style>
    .main-content-fluid {
        margin-right: 250px;
        background-color: #0b0f19;
        min-height: 100vh;
        padding: 50px 20px;
        direction: rtl;
        width: calc(100% - 250px);
        float: left;
    }

    .cyber-form-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 20px;
        padding: 50px;
        max-width: 950px;
        margin: 0 auto;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
    }

    .form-header-title {
        color: #10b981;
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .form-cyber-label {
        color: #f3f4f6;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 12px;
        display: block;
    }

    .form-cyber-control {
        background: #0b0f19 !important;
        border: 2px solid #1f2937 !important;
        color: #ffffff !important;
        border-radius: 12px;
        padding: 18px;
        font-size: 16px;
        width: 100%;
        transition: 0.3s all ease-in-out;
    }

    .form-cyber-control:focus {
        border-color: #10b981 !important;
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.1) !important;
        outline: none;
    }

    /* منطقة إرفاق الصورة الاحترافية */
    .upload-preview-area {
        width: 100%;
        height: 250px;
        background: #0b0f19;
        border: 2px dashed #374151;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        cursor: pointer;
        transition: 0.3s;
        overflow: hidden;
    }

    .upload-preview-area:hover {
        border-color: #10b981;
        background: #0d1421;
    }

    .upload-preview-area img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* أزرار التحكم بالأسفل */
    .action-footer {
        display: flex;
        gap: 20px;
        margin-top: 45px;
        border-top: 1px solid #1f2937;
        padding-top: 30px;
    }

    .btn-save-cyber {
        background: linear-gradient(90deg, #10b981, #059669) !important;
        color: white !important;
        border: none;
        flex: 2;
        padding: 18px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 17px;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-save-cyber:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-back-cyber {
        background: #1f2937 !important;
        color: #9ca3af !important;
        border: 1px solid #374151;
        flex: 1;
        padding: 18px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        text-align: center;
        transition: 0.3s;
    }

    .btn-back-cyber:hover {
        background: #374151 !important;
        color: white !important;
    }

    @media (max-width: 991px) { .main-content-fluid { margin-right: 0; width: 100%; } }
</style>
@endsection

@section('content')
<div class="main-content-fluid">
    <div class="cyber-form-card">
        <h2 class="form-header-title">
            <i class="fas fa-shield-alt"></i> إعداد تصنيف تعليمي جديد
        </h2>

        <form id="create-category-form">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">مسمى التصنيف (Title)</label>
                    <input type="text" class="form-cyber-control" id="title" placeholder="أدخل اسماً يعبر عن محتوى المسار التعليمي...">
                </div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">الهوية البصرية (إرفاق غلاف من جهازك)</label>
                    <input type="file" id="imageInput" style="display: none;" accept="image/*" onchange="previewImage(this)">
                    <div class="upload-preview-area" onclick="document.getElementById('imageInput').click()">
                        <img src="" id="imagePreview" style="display: none;">
                        <div id="placeholderText" class="text-center text-muted">
                            <i class="fas fa-file-upload fa-3x mb-3" style="color: #10b981;"></i>
                            <p class="font-weight-bold">انقر لاختيار صورة الغلاف</p>
                            <span style="font-size: 12px;">يفضل أبعاد 16:9 للحصول على أفضل ظهور</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">نبذة تعريفية عن التصنيف</label>
                    <textarea class="form-cyber-control" id="description" rows="4" placeholder="اكتب وصفاً مختصراً يوضح أهداف هذا التصنيف للطلاب..."></textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-cyber-label">نظام الظهور (Status)</label>
                    <select class="form-cyber-control" id="status">
                        <option value="active">نشر فوري (نشط)</option>
                        <option value="inactive">أرشفة مؤقتة (غير نشط)</option>
                    </select>
                </div>

                <div class="col-md-12 action-footer">
                    <a href="{{ route('categories.index') }}" class="btn-back-cyber">
                        <i class="fas fa-arrow-right ml-2"></i> العودة للقائمة
                    </a>
                    <button type="button" onclick="performStore()" class="btn-save-cyber">
                         تأكيد وحفظ التصنيف <i class="fas fa-check-circle"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // وظيفة معاينة الصورة قبل الرفع
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('imagePreview');
                img.src = e.target.result;
                img.style.display = 'block';
                document.getElementById('placeholderText').style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // وظيفة الإرسال البرمجي 
    function performStore() {
        // 1. جمع البيانات من الفورم
        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let status = document.getElementById('status').value;
        let imageFile = document.getElementById('imageInput').files[0];

        // 2. التحقق من البيانات الأساسية
        if(!title || !description || !imageFile) {
            Swal.fire({
                title: 'نقص في البيانات!',
                text: 'الرجاء التأكد من تعبئة العنوان والوصف وإرفاق صورة الغلاف',
                icon: 'warning',
                confirmButtonText: 'مفهوم',
                confirmButtonColor: '#10b981',
                background: '#111827',
                color: '#ffffff'
            });
            return;
        }

        // 3. تجهيز البيانات للإرسال
        let formData = new FormData();
        formData.append('title', title);
        formData.append('description', description);
        formData.append('status', status);
        formData.append('url', imageFile);

        // 4. تنفيذ طلب الـ POST
        axios.post('/cms/admin/categories', formData)
            .then(function (response) {
                // إظهار رسالة النجاح
                Swal.fire({
                    title: 'تمت الإضافة!',
                    text: response.data.message || 'تم إنشاء التصنيف الجديد بنجاح',
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false,
                    background: '#111827',
                    color: '#ffffff'
                }).then(() => {
                    // التوجيه لصفحة القائمة بعد اختفاء الرسالة
                    window.location.href = "{{ route('categories.index') }}";
                });
            })
            .catch(function (error) {
                // عرض رسالة الخطأ
                Swal.fire({
                    title: 'فشل الإجراء',
                    text: error.response?.data?.message || 'حدث خطأ أثناء الحفظ',
                    icon: 'error',
                    confirmButtonText: 'حاول مجدداً',
                    confirmButtonColor: '#ef4444',
                    background: '#111827',
                    color: '#ffffff'
                });
            });
    }
</script>
@endsection
