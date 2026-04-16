@extends('cms.parent')

@section('title', 'تعديل المادة - CyberEye')

@section('styles')
<style>
    .edit-page-container { width: 100%; padding: 40px; background-color: #0b0f19; min-height: 100vh; direction: rtl; box-sizing: border-box; }
    .admin-main { background-color: #0b0f19 !important; }
    .cyber-form-card { background: #111827; border: 1px solid #1f2937; border-radius: 20px; padding: 50px; max-width: 900px; margin: 0 auto; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6); }
    .form-header-title { color: #3b82f6; font-size: 26px; font-weight: 800; margin-bottom: 40px; display: flex; align-items: center; gap: 15px; }
    .form-cyber-label { color: #f3f4f6; font-weight: 700; margin-bottom: 12px; display: block; }

    .form-cyber-control {
        background: #0b0f19 !important;
        border: 2px solid #1f2937 !important;
        color: #ffffff !important;
        border-radius: 12px;
        padding: 18px;
        width: 100%;
    }

    .current-file-box { background: rgba(59, 130, 246, 0.1); border: 1px solid #3b82f6; padding: 15px; border-radius: 12px; color: #3b82f6; display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }

    .action-footer { display: flex; gap: 20px; margin-top: 45px; border-top: 1px solid #1f2937; padding-top: 30px; }
    .btn-update-cyber { background: linear-gradient(90deg, #3b82f6, #2563eb) !important; color: white !important; border: none; flex: 2; padding: 18px; border-radius: 12px; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.3s; }
    .btn-update-cyber:hover { opacity: 0.9; transform: translateY(-2px); }
    .btn-back-cyber { background: #1f2937 !important; color: #9ca3af !important; flex: 1; padding: 18px; border-radius: 12px; text-align: center; text-decoration: none; font-weight: 700; display: flex; align-items: center; justify-content: center; }
</style>
@endsection

@section('content')
<div class="edit-page-container">
    <div class="cyber-form-card">
        <h2 class="form-header-title"><i class="fas fa-edit"></i> تعديل المادة: {{ $material->title }}</h2>

        <form id="edit-material-form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">عنوان المادة</label>
                    <input type="text" class="form-cyber-control" id="title" value="{{ $material->title }}" placeholder="اكتب العنوان الجديد">
                </div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">الملف الحالي</label>
                    <div class="current-file-box">
                        <i class="fas fa-file-alt"></i>
                        <span>ملف مرفوع سابقاً بصيغة ({{ strtoupper($material->file_type) }})</span>
                    </div>

                    <label class="form-cyber-label">استبدال الملف (اختياري - يدعم الإكسل والمضغوط)</label>
                    <input type="file" id="fileInput" class="form-cyber-control">
                </div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">وصف المادة</label>
                    <textarea class="form-cyber-control" id="description" rows="3" placeholder="تعديل الوصف...">{{ $material->description }}</textarea>
                </div>

                <div class="col-md-12 action-footer">
                    <a href="{{ route('materials.index') }}" class="btn-back-cyber">إلغاء</a>
                    <button type="button" onclick="performUpdate()" class="btn-update-cyber">حفظ التعديلات <i class="fas fa-save"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function performUpdate() {
        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let fileInput = document.getElementById('fileInput').files[0];

        if (!title) {
            showError('يرجى كتابة عنوان المادة التعليمية');
            return;
        }

        let formData = new FormData();
        // في Laravel، عند استخدام PUT مع ملفات، نرسل الطلب كـ POST ونضع _method = PUT
        formData.append('_method', 'PUT');
        formData.append('title', title);
        formData.append('description', description);

        if (fileInput) {
            formData.append('file', fileInput);
        }

        axios.post('/cms/instructor/materials/{{ $material->id }}', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(function (response) {
            Swal.fire({
                icon: 'success',
                title: 'تم التحديث!',
                text: 'تم تعديل بيانات المادة بنجاح',
                background: '#111827',
                color: '#fff',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "{{ route('materials.index') }}";
            });
        })
        .catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'فشل التحديث',
                text: error.response?.data?.message || 'حدث خطأ أثناء حفظ التعديلات، تأكد من حجم الملف',
                background: '#111827',
                color: '#fff'
            });
        });
    }

    function showError(msg) {
        Swal.fire({
            icon: 'warning',
            title: 'تنبيه',
            text: msg,
            background: '#111827',
            color: '#fff',
            confirmButtonColor: '#3b82f6'
        });
    }
</script>
@endsection
