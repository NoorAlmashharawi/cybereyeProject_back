@extends('cms.parent')

@section('title', 'المسارات التعليمية - CyberEye')

@section('styles')
<style>
    /* التنسيقات العامة للمحتوى */
    .main-wrapper {
        margin-right: 250px;
        width: calc(100% - 250px);
        padding: 40px;
        background-color: #0b0f19;
        min-height: 100vh;
        direction: rtl;
        box-sizing: border-box;
        float: left;
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

    /* عرض الشبكة والكروت */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        width: 100%;
    }

    .category-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: all 0.4s ease; /* التأكد من أن جميع الخصائص تتأثر بالانتقال */
    }

    .category-card:hover {
        border-color: #10b981;
        transform: translateY(-8px);
    }

    .card-image-wrapper {
        position: relative;
        width: 100%;
        height: 160px;
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
        flex-grow: 1;
        border-bottom: 1px solid #1f2937;
        unicode-bidi: plaintext;
        text-align: start;
    }

    .card-content h3 {
        color: #ffffff;
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .card-content p {
        color: #9ca3af;
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 0;
    }

    .card-footer {
        padding: 12px 18px;
        background: #161e2d;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
        width: 34px;
        height: 34px;
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

    .btn-add-course {
        color: #10b981;
        text-decoration: none;
        font-weight: 800;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: 0.3s;
    }

    .btn-add-course:hover { color: #ffffff; }

    /* --- تنسيق SweetAlert2 الموحد --- */
    .dark-swal {
        background: #111827 !important;
        border: 1px solid #1f2937 !important;
        border-radius: 20px !important;
        padding: 30px !important;
    }
    .dark-swal .swal2-title {
        color: #ffffff !important;
        font-size: 22px !important;
        font-weight: 700 !important;
    }
    .dark-swal .swal2-html-container {
        color: #9ca3af !important;
        font-size: 15px !important;
        margin-top: 10px !important;
    }

    .swal2-confirm-custom {
        background-color: #10b981 !important;
        color: white !important;
        padding: 12px 28px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        margin: 0 10px !important;
        min-width: 120px !important;
        border: none !important;
        cursor: pointer;
        transition: 0.3s;
    }
    .swal2-confirm-custom:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }

    .swal2-cancel-custom {
        background-color: #374151 !important;
        color: #ffffff !important;
        padding: 12px 28px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        margin: 0 10px !important;
        min-width: 120px !important;
        border: none !important;
        cursor: pointer;
    }

    .swal2-actions-gap { margin-top: 30px !important; }

    @media (max-width: 991px) { .main-wrapper { margin-right: 0; width: 100%; } }
</style>
@endsection

@section('content')
<div class="main-wrapper">
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

                <div class="card-footer">
                    <div class="stat-item">
                        <i class="fas fa-book-open"></i> {{ $category->courses_count ?? 0 }} كورس
                    </div>

                    <a href="#" class="btn-add-course">
                        إضافة <i class="fas fa-plus-square"></i>
                    </a>

                    <div class="action-btns">
                        <button onclick="confirmArchive({{ $category->id }})"
                                class="btn-icon btn-delete"
                                title="نقل إلى الأرشيف">
                            <i class="fas fa-archive"></i>
                        </button>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn-icon btn-edit" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div id="empty-state" style="grid-column: 1/-1; text-align: center; padding: 100px 20px; background: #111827; border-radius: 20px; border: 2px dashed #1f2937;">
                <i class="fas fa-layer-group fa-4x mb-4" style="color: #1f2937;"></i>
                <h3 style="color: #9ca3af; font-weight: 700;">سجل البيانات فارغ</h3>
                <p style="color: #4b5563;">لم يتم تأسيس أي مسارات تعليمية بعد.</p>
                <a href="{{ route('categories.create') }}" class="btn-add-main" style="display: inline-flex; margin-top: 20px;">
                    <i class="fas fa-plus-circle"></i> تأسيس أول مسار
                </a>
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
                cancelButton: 'swal2-cancel-custom',
                actions: 'swal2-actions-gap'
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
                // البحث عن الكارد
                const card = document.querySelector('#card-' + id);

                if (card) {
                    // تشغيل الأنيميشن (الاختفاء التدريجي)
                    card.style.transition = "all 0.5s cubic-bezier(0.4, 0, 0.2, 1)";
                    card.style.transform = "scale(0.8) translateY(30px)";
                    card.style.opacity = "0";

                    setTimeout(() => {
                        card.remove();

                        // التحقق إذا كانت القائمة أصبحت فارغة لإظهار رسالة "السجل فارغ"
                        const remainingCards = document.querySelectorAll('.category-card');
                        if (remainingCards.length === 0) {
                            location.reload(); 
                        }
                    }, 500);
                }

                // إظهار رسالة النجاح
                toastr.success(response.data.message || 'تم نقل المسار للأرشيف بنجاح');
            })
            .catch(function (error) {
                console.error(error);
                toastr.error(error.response?.data?.message || 'عذراً، حدث خطأ أثناء الأرشفة');
            });
    }


</script>
@endsection
