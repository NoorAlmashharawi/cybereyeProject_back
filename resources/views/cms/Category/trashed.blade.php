@extends('cms.parent')

@section('title', 'سلة محذوفات التصنيفات')

@section('styles')
<style>
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
    }

    .page-header h1 { color: #ffffff; font-size: 28px; }

    .btn-back {
        background-color: #374151;
        color: white !important;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
    }

    .trashed-table {
        width: 100%;
        border-collapse: collapse;
        background: #111827;
        color: white;
        border-radius: 12px;
        overflow: hidden;
    }

    .trashed-table th, .trashed-table td {
        padding: 15px;
        text-align: right;
        border-bottom: 1px solid #1f2937;
    }

    .trashed-table th { background-color: #1f2937; color: #9ca3af; }

    .btn-action {
        padding: 5px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        margin-left: 5px;
    }

    .btn-restore { background-color: #10b981; color: white !important; }
    .btn-force { background-color: #ef4444; color: white !important; }

    .empty-state {
        text-align: center;
        padding: 50px;
        color: #9ca3af;
    }

    @media (max-width: 991px) { .main-wrapper { margin-right: 0; width: 100%; } }
</style>
@endsection

@section('content')
<div class="main-wrapper">
    <div class="page-header">
        <h1>سلة المحذوفات (التصنيفات)</h1>
        <a href="{{ route('categories.index') }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> العودة للتصنيفات
        </a>
    </div>

    @if($categories->count() > 0)
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
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->deleted_at->format('Y-m-d H:i') }}</td>
                    <td>
                        {{-- زر الاستعادة --}}
                        <a href="{{ route('categories.restore', $category->id) }}" class="btn-action btn-restore">
                            <i class="fas fa-undo"></i> استعادة
                        </a>

                        {{-- زر الحذف النهائي --}}
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
    @else
        <div class="empty-state">
            <i class="fas fa-trash-open" style="font-size: 48px; margin-bottom: 20px;"></i>
            <h3>سلة المحذوفات فارغة</h3>
        </div>
    @endif
</div>
@endsection
