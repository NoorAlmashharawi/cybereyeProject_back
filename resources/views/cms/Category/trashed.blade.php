@extends('cms.parent')

@section('title', 'سلة محذوفات التصنيفات - CyberEye')

@section('styles')
<style>
    /* الخلطة السحرية: فرش الصفحة بالكامل وتوحيد اللون */
    .trash-page-container {
        width: 100%;
        padding: 40px;
        background-color: #0b0f19; /* نفس لون الداشبورد المعتمد */
        min-height: 100vh;
        direction: rtl;
        box-sizing: border-box;
    }

    /* إلغاء أي فراغات بيضاء من الأب */
    .admin-main {
        background-color: #0b0f19 !important;
        padding: 0 !important;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .page-header h1 {
        color: #ffffff;
        font-size: 28px;
        font-weight: 800;
        margin: 0;
    }

    .btn-back {
        background-color: #1f2937;
        color: #9ca3af !important;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
        border: 1px solid #374151;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background-color: #374151;
        color: white !important;
        transform: translateX(-5px);
    }

    /* تنسيق الجدول بأسلوب الـ Cyber */
    .trashed-table-card {
        background: #111827;
        border: 1px solid #1f2937;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .trashed-table {
        width: 100%;
        border-collapse: collapse;
        color: white;
    }

    .trashed-table th {
        background-color: #1f2937;
        color: #9ca3af;
        padding: 20px 15px;
        text-align: right;
        font-weight: 600;
        font-size: 14px;
        border-bottom: 1px solid #1f2937;
    }

    .trashed-table tbody tr {
        border-bottom: 1px solid #1f2937;
        transition: 0.3s;
    }

    .trashed-table tbody tr:hover {
        background-color: rgba(16, 185, 129, 0.02);
    }

    .trashed-table td {
        padding: 20px 15px;
        text-align: right;
        vertical-align: middle;
    }

    /* أزرار الإجراءات */
    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none !important;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-restore {
        background-color: rgba(16, 185, 129, 0.1);
        color: #10b981 !important;
    }

    .btn-restore:hover {
        background-color: #10b981;
        color: white !important;
    }

    .btn-force {
        background-color: rgba(239, 68, 68, 0.1);
        color: #ef4444 !important;
    }

    .btn-force:hover {
        background-color: #ef4444;
        color: white !important;
    }

    /* حالة السلة الفارغة */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #9ca3af;
    }

    .empty-state i {
        color: #374151;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #ffffff;
        font-size: 22px;
        margin-bottom: 10px;
    }

    /* تحسين الظهور على الموبايل */
    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; gap: 20px; }
        .btn-back { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')
<div class="trash-page-container">
    <div class="page-header">
        <div class="header-text">
            <h1><i class="fas fa-trash-restore text-success ml-2"></i> سلة المحذوفات</h1>
            <p class="text-muted mt-2">يمكنك استعادة التصنيفات المحذوفة أو حذفها نهائياً من النظام</p>
        </div>
        <a href="{{ route('categories.index') }}" class="btn-back">
            العودة للتصنيفات <i class="fas fa-arrow-left"></i>
        </a>
    </div>

    <div class="trashed-table-card">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="trashed-table">
                    <thead>
                        <tr>
                            <th width="80">ID</th>
                            <th>عنوان التصنيف</th>
                            <th>تاريخ الحذف</th>
                            <th width="250" style="text-align: center;">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td style="color: #10b981; font-family: monospace;">#{{ $category->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold" style="font-size: 16px;">{{ $category->title }}</span>
                                </div>
                            </td>
                            <td class="text-muted">
                                <i class="far fa-clock ml-1"></i> {{ $category->deleted_at->diffForHumans() }}
                            </td>
                            <td style="text-align: center;">
                                {{-- زر الاستعادة --}}
                                <a href="{{ route('categories.restore', $category->id) }}" class="btn-action btn-restore">
                                    <i class="fas fa-undo"></i> استعادة
                                </a>

                                {{-- زر الحذف النهائي --}}
                                <a href="{{ route('categories.force', $category->id) }}"
                                   onclick="return confirm('تنبيه: سيتم حذف كافة البيانات والصور المرتبطة بهذا التصنيف نهائياً! هل أنت متأكد؟')"
                                   class="btn-action btn-force">
                                    <i class="fas fa-fire"></i> حذف نهائي
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-box-open fa-5x"></i>
                <h3>سلة المحذوفات فارغة</h3>
                <p>لا توجد أي تصنيفات في الأرشيف حالياً.</p>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-success mt-4 px-4" style="border-radius: 10px;">
                    تصفح التصنيفات النشطة
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
