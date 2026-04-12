@extends('cms.parent')

@section('title', 'المسارات التعليمية - CyberEye')

@section('styles')
<style>
    /* التعديل الجوهري: جعل المحتوى يفرش بدون بياض مع الحفاظ على التنسيق */
    .admin-main {
        background-color: #0b0f19 !important;
    }

    .main-wrapper-custom {
        width: 100%;
        padding: 40px;
        background-color: #0b0f19;
        min-height: 100vh;
        direction: rtl;
        box-sizing: border-box;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        width: 100%;
    }

    .page-header-text h1 {
        color: #ffffff;
        font-size: 28px;
        font-weight: 800;
        margin: 0;
    }

    .page-header-text p {
        color: #9ca3af;
        margin-top: 8px;
        font-size: 15px;
    }

    .header-actions {
        display: flex;
        gap: 15px;
    }

    .btn-add-main {
        background-color: #10b981;
        color: white !important;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        border: none;
        cursor: pointer;
    }

    .btn-trashed {
        background-color: #374151;
        color: white !important;
    }

    .btn-add-main:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        width: 100%;
    }

    /* --- التعديل لتوحيد محاذاة الفوتر دون تغيير التصميم --- */
    .category-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        flex-direction: column; /* ترتيب العناصر عمودياً */
        height: 100%;           /* لتتساوى الكروت في الصف الواحد */
        transition: all 0.4s ease;
    }

    .category-card:hover {
        border-color: #10b981;
        transform: translateY(-8px);
    }

    .card-image-wrapper {
        position: relative;
        width: 100%;
        height: 160px;
        flex-shrink: 0; /* الحفاظ على أبعاد الصورة */
    }

    .card-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
        background: rgba(16, 185, 129, 0.9);
        color: white;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 800;
    }

    .status-badge.inactive { background: rgba(239, 68, 68, 0.9); }

    .card-content {
        padding: 18px;
        flex-grow: 1; /* السر هنا: جعل منطقة النص تتمدد لتدفع الفوتر للأسفل */
        display: flex;
        flex-direction: column;
        unicode-bidi: plaintext;
        text-align: start;
    }

    .card-content h3 {
        color: #ffffff;
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 8px;
        min-height: 2.4em; /* محاذاة العناوين حتى لو سطر واحد */
    }

    .card-content p {
        color: #9ca3af;
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 20px;
        flex-grow: 1; /* يضمن دفع الفوتر لأسفل الكارد تماماً */
    }

    .card-footer {
        margin-top: auto; /* تأكيد الالتصاق بقعر الكارد */
        padding: 15px 18px;
        background: #161e2d;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #1f2937;
    }

    .stat-item {
        font-size: 12px;
        font-weight: 600;
        color: #10b981;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .action-btns {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: 0.3s;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-edit { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .btn-delete { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .btn-edit:hover { background: #3b82f6; color: white; }
    .btn-delete:hover { background: #ef4444; color: white; }

    /* تنسيقات الـ SweetAlert */
    .dark-swal { background: #111827 !important; border: 1px solid #1f2937 !important; color: white !important; }
    .swal2-confirm-custom { background: #10b981 !important; color: white !important; padding: 10px 20px; border-radius: 8px; }
    .swal2-cancel-custom { background: #374151 !important; color: white !important; padding: 10px 20px; border-radius: 8px; }
</style>
@endsection

@section('content')
<div class="main-wrapper-custom">
    <div class="page-header">
        <div class="page-header-text">
            <h1>المسارات التعليمية</h1>
            <p>إدارة وتوجيه الأقسام الأكاديمية والبرامج التدريبية المتاحة في CyberEye</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('categories.trashed') }}" class="btn-add-main btn-trashed">
                <i class="fas fa-archive"></i> الأرشيف
            </a>
            <a href="{{ route('categories.create') }}" class="btn-add-main">
                <i class="fas fa-plus-circle"></i> مسار جديد
            </a>
        </div>
    </div>

    <div class="categories-grid" id="categories-container">
        @forelse($categories as $category)
            <div class="category-card" id="card-{{ $category->id }}">
                <a href="{{ route('courses.index', ['category_id' => $category->id]) }}" style="text-decoration: none; display: flex; flex-direction: column; flex-grow: 1;">
                    <div class="card-image-wrapper">
                        <span class="status-badge {{ $category->status == 'inactive' ? 'inactive' : '' }}">
                            {{ $category->status == 'active' ? 'نشط' : 'مؤرشف' }}
                        </span>
                        <img src="{{ asset('storage/' . $category->url) }}"
                             onerror="this.src='https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=600'"
                             alt="{{ $category->title }}">
                    </div>

                    <div class="card-content">
                        <h3>{{ $category->title }}</h3>
                        <p>{{ Str::limit($category->description, 100) }}</p>
                    </div>
                </a>

                <div class="card-footer">
                    {{-- الأزرار على اليسار (تعديل وحذف) --}}
                    <div class="action-btns">
                        <button onclick="confirmArchive({{ $category->id }})" class="btn-icon btn-delete" title="نقل إلى الأرشيف">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn-icon btn-edit" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>

                    {{-- عدد الكورسات على اليمين --}}
                    <div class="stat-item">
                        <span>{{ $category->courses_count ?? 0 }} كورس</span>
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
            </div>
        @empty
            <div style="color: white; text-align: center; width: 100%;">
                لا توجد مسارات تعليمية حالياً.
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmArchive(id) {
        Swal.fire({
            title: 'نقل إلى الأرشيف؟',
            text: "سيختفي هذا المسار من العرض العام فوراً، ويمكنك استعادته من الأرشيف.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، أرشفة',
            cancelButtonText: 'إلغاء',
            customClass: {
                popup: 'dark-swal',
                confirmButton: 'swal2-confirm-custom',
                cancelButton: 'swal2-cancel-custom'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                performArchive(id);
            }
        });
    }

    function performArchive(id) {
        axios.delete('/cms/admin/categories/' + id)
            .then(function (response) {
                const card = document.querySelector('#card-' + id);
                if (card) {
                    card.style.transition = "all 0.5s ease";
                    card.style.transform = "scale(0.8)";
                    card.style.opacity = "0";
                    setTimeout(() => card.remove(), 500);
                }
                toastr.success(response.data.message);
            })
            .catch(error => toastr.error('خطأ في العملية'));
    }
</script>
@endsection
