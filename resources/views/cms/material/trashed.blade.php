@extends('cms.parent')

@section('title', 'أرشيف المواد التعليمية')

@section('styles')
<style>
    body, .admin-main, .content-wrapper { background-color: #0b0f19 !important; }
    .main-wrapper-fixed { width: 100%; padding: 40px; background-color: #0b0f19; min-height: 100vh; direction: rtl; box-sizing: border-box; display: block; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
    .page-header h1 { color: #ffffff; font-size: 28px; margin: 0; }
    .btn-back { background-color: #374151; color: white !important; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; }
    .table-responsive { width: 100%; overflow-x: auto; background: #111827; border-radius: 12px; }
    .trashed-table { width: 100%; border-collapse: collapse; color: white; }
    .trashed-table th, .trashed-table td { padding: 18px; text-align: right; border-bottom: 1px solid #1f2937; }
    .trashed-table th { background-color: #1f2937; color: #9ca3af; font-size: 14px; }
    .btn-action { padding: 6px 15px; border-radius: 6px; text-decoration: none; font-size: 13px; margin-left: 5px; display: inline-block; border: none; cursor: pointer; }
    .btn-restore { background-color: #10b981; color: white !important; }
    .btn-force { background-color: #ef4444; color: white !important; }
    .empty-state { text-align: center; padding: 100px; color: #9ca3af; }
</style>
@endsection

@section('content')
<div class="main-wrapper-fixed">
    <div class="page-header">
        <h1>أرشيف المواد المحذوفة</h1>
        <a href="{{ route('materials.index') }}" class="btn-back">
            <i class="fas fa-arrow-right"></i> العودة للمواد النشطة
        </a>
    </div>

    @if($materials->count() > 0)
        <div class="table-responsive">
            <table class="trashed-table">
                <thead>
                    <tr>
                        <th>عنوان المادة</th>
                        <th>الكورس</th>
                        <th>تاريخ الحذف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                    <tr>
                        <td>{{ $material->title }}</td>
                        <td>{{ $material->course->course_name ?? 'غير محدد' }}</td>
                        <td style="color: #9ca3af;">{{ $material->deleted_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('materials.restore', $material->id) }}" class="btn-action btn-restore">
                                <i class="fas fa-undo"></i> استعادة
                            </a>

                            <a href="{{ route('materials.force', $material->id) }}"
                               onclick="return confirm('تحذير: سيتم حذف الملف نهائياً من السيرفر!')"
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
            <h3>الأرشيف فارغ حالياً</h3>
        </div>
    @endif
</div>
@endsection
