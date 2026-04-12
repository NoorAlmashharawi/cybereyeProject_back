@extends('cms.parent')

@section('title', 'سلة محذوفات التصنيفات')

@section('styles')
<style>
    /* توحيد الخلفية ومنع البياض */
    body, .admin-main, .content-wrapper {
        background-color: #0b0f19 !important;
    }

    .main-wrapper-fixed {
        /* هاد السطر بيخليه يفرش بجانب السايد بار بدون بياض */
        width: 100%;
        padding: 40px;
        background-color: #0b0f19;
        min-height: 100vh;
        direction: rtl;
        box-sizing: border-box;
        display: block;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .page-header h1 { color: #ffffff; font-size: 28px; margin: 0; }

    .btn-back {
        background-color: #374151;
        color: white !important;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    /* تصميم الجدول الأصلي */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        background: #111827;
        border-radius: 12px;
    }

    .trashed-table {
        width: 100%;
        border-collapse: collapse;
        color: white;
    }

    .trashed-table th, .trashed-table td {
        padding: 18px;
        text-align: right;
        border-bottom: 1px solid #1f2937;
    }

    .trashed-table th {
        background-color: #1f2937;
        color: #9ca3af;
        font-size: 14px;
        text-transform: uppercase;
    }

    .btn-action {
        padding: 6px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        margin-left: 5px;
        display: inline-block;
    }

    .btn-restore { background-color: #10b981; color: white !important; }
    .btn-force { background-color: #ef4444; color: white !important; }

    .empty-state {
        text-align: center;
        padding: 100px;
        color: #9ca3af;
    }
</style>
@endsection

@section('content')
<div class="main-wrapper-fixed">
    <div class="page-header">
        <h1>سلة المحذوفات (التصنيفات)</h1>
        <a href="{{ route('categories.index') }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> العودة للتصنيفات
        </a>
    </div>

    @if($categories->count() > 0)
        <div class="table-responsive">
            <table class="trashed-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>عنوان التصنيف</th>
                        <th>تاريخ الحذف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>#{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td style="color: #9ca3af;">{{ $category->deleted_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('categories.restore', $category->id) }}" class="btn-action btn-restore">
                                <i class="fas fa-undo"></i> استعادة
                            </a>

                            <a href="{{ route('categories.force', $category->id) }}"
                               onclick="return confirm('هل أنت متأكد؟ سيتم حذف البيانات والصورة نهائياً!')"
                               class="btn-action btn-force">
                                <i class="fas fa-times"></i> حذف نهائي
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-trash-alt fa-4x" style="margin-bottom: 20px; color: #1f2937;"></i>
            <h3>سلة المحذوفات فارغة</h3>
        </div>
    @endif
</div>
@endsection
