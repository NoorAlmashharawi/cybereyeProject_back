@extends('cms.parent')

@section('title', 'تعديل التصنيف - CyberEye')

@section('styles')
<style>
    /* التعديل الجوهري: إزالة الـ main-wrapper القديم واستبداله بتنسيق مرن */
    .edit-page-container {
        width: 100%;
        padding: 40px;
        background-color: #0b0f19; /* توحيد لون الخلفية مع الداشبورد */
        min-height: 100vh;
        direction: rtl;
        box-sizing: border-box;
    }

    /* ضمان عدم وجود بياض في الحاوية الأكبر */
    .admin-main {
        background-color: #0b0f19 !important;
    }

    .cyber-form-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 20px;
        padding: 50px;
        margin-bottom: 40px;
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

    .upload-preview-area img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

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

    .btn-back-cyber {
        background: #1f2937;
        color: #9ca3af !important;
        flex: 1;
        padding: 18px;
        border-radius: 12px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-back-cyber:hover {
        background: #374151;
        color: white !important;
    }

    /* تنسيق كارد الجدول */
    .cyber-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 15px;
        padding: 25px;
    }

    .section-title {
        color: #10b981;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid #1f2937;
        padding-bottom: 10px;
    }

    .cyber-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
    .cyber-table thead th { color: #9ca3af; padding: 15px; font-weight: 600; text-align: right; }
    .cyber-table tbody tr { background: #161e2d; transition: 0.3s; }
    .cyber-table td { padding: 15px; color: white; vertical-align: middle; text-align: right; }

    .badge-status { padding: 5px 12px; border-radius: 6px; font-size: 12px; }
    .status-active { background: rgba(16, 185, 129, 0.2); color: #10b981; }

    .btn-add-table {
        background: #3b82f6;
        color: white !important;
        font-size: 13px;
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="edit-page-container">
    <div class="cyber-form-card">
        <h2 class="form-header-title">
            <i class="fas fa-edit"></i> تعديل بيانات التصنيف: {{ $category->title }}
        </h2>

        <form id="edit-category-form">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">مُسمى التصنيف (Title)</label>
                    <input type="text" class="form-cyber-control" id="title" value="{{ $category->title }}">
                </div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">الهوية البصرية (تغيير غلاف المسار)</label>
                    <input type="file" id="imageInput" style="display: none;" accept="image/*" onchange="previewImage(this)">
                    <div class="upload-preview-area" onclick="document.getElementById('imageInput').click()">
                        <img src="{{ asset('storage/'.$category->url) }}" id="imagePreview">
                        <div id="placeholderText" class="text-center text-muted" style="display: none;">
                            <i class="fas fa-file-upload fa-3x mb-3" style="color: #10b981;"></i>
                            <p class="font-weight-bold">انقر لتغيير الصورة</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-5">
                    <label class="form-cyber-label">نبذة تعريفية عن التصنيف</label>
                    <textarea class="form-cyber-control" id="description" rows="4">{{ $category->description }}</textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-cyber-label">نظام الظهور (Status)</label>
                    <select class="form-cyber-control" id="status">
                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>نشط</option>
                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                    </select>
                </div>

                <div class="col-md-12 action-footer">
                    <a href="{{ route('categories.index') }}" class="btn-back-cyber">
                        <i class="fas fa-arrow-right ml-2"></i> العودة للقائمة
                    </a>
                    <button type="button" onclick="performUpdate({{ $category->id }})" class="btn-save-cyber">
                        تحديث البيانات وحفظ التغييرات <i class="fas fa-check-circle"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- جدول الكورسات --}}
    <div class="cyber-card">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h2 class="section-title mb-0" style="border:none;"><i class="fas fa-graduation-cap"></i> الكورسات التابعة له</h2>
        </div>
        <div class="table-responsive">
            <table class="cyber-table">
                <thead>
                    <tr>
                        <th># المعرف</th>
                        <th>اسم الكورس</th>
                        <th>المدرب</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($category->courses as $course)
    <tr>
        <td>#{{ $course->id }}</td>

        {{-- التعديل هنا: استخدام course_name بدلاً من title --}}
        <td>{{ $course->course_name }}</td>

        {{-- التعديل هنا: الوصول لاسم المدرب من خلال العلاقة --}}
        <td>{{ $course->instructor->user1->username ?? 'غير محدد' }}</td>

        <td>
            <span class="badge-status {{ $course->status == 'active' ? 'status-active' : 'status-inactive' }}">
                {{ $course->status == 'active' ? 'نشط' : 'مسودة' }}
            </span>
        </td>
        <td>
            <div class="d-flex gap-2">
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-edit"></i>
                </a>
                <button onclick="deleteCourse({{ $course->id }})" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center text-muted">لا يوجد كورسات مضافة لهذا التصنيف بعد.</td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    // معاينة الصورة عند اختيارها
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

    function performUpdate(id) {
        console.log("بدء عملية التحديث للمعرف: " + id);

        // تجميع البيانات
        let formData = new FormData();
        formData.append('_method', 'PUT'); // مهم جداً لأننا نستخدم POST لمحاكاة PUT
        formData.append('title', document.getElementById('title').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('status', document.getElementById('status').value);

        let imageFile = document.getElementById('imageInput').files[0];
        if(imageFile) {
            formData.append('url', imageFile);
        }

        // إرسال الطلب عبر Axios
        axios.post('/cms/admin/categories/' + id, formData)
            .then(function (response) {
                console.log("نجاح العملية:", response.data);
                Swal.fire({
                    title: response.data.message,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    background: '#111827',
                    color: '#fff'
                }).then(() => {
                    window.location.href = "{{ route('categories.index') }}";
                });
            })
            .catch(function (error) {
                console.error("فشل العملية. الرد من السيرفر:", error.response);

                let errorMsg = 'حدث خطأ غير متوقع';

                // إذا كان الخطأ من الـ Validation (كود 422)
                if (error.response && error.response.status === 422) {
                    errorMsg = error.response.data.message;
                }

                // استخدام Swal بدلاً من Toastr لضمان الظهور
                Swal.fire({
                    icon: 'error',
                    title: 'عذراً..',
                    text: errorMsg,
                    background: '#111827',
                    color: '#fff',
                    confirmButtonColor: '#10b981'
                });
            });
    }

    function deleteCourse(id) {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم حذف الكورس نهائياً!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
            background: '#111827',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('/cms/admin/courses/' + id)
                    .then(res => {
                        Swal.fire({
                            title: 'تم الحذف!',
                            icon: 'success',
                            background: '#111827',
                            color: '#fff'
                        });
                        location.reload();
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'فشل الحذف',
                            background: '#111827',
                            color: '#fff'
                        });
                    });
            }
        });
    }
</script>
@endsection
