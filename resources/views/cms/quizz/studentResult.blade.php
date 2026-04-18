
@extends('cms.parent')

@section('title', 'نتائج الطلاب')
@section('main-title', 'لوحة تحكم المشرف')
@section('sub-title', 'نتائج الطلاب في الكويزات')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('cms/css/viewStudents.css') }}">
<style>
    .score-highlight {
        font-weight: bold;
        color: #facc15;
    }
    .table-container {
        overflow-x: auto;
    }
    .stats {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    .stat-card {
        background: #1e293b;
        border-radius: 20px;
        padding: 20px;
        flex: 1;
        min-width: 150px;
        text-align: center;
        border: 1px solid #334155;
    }
    .stat-card h3 {
        font-size: 2rem;
        margin-bottom: 10px;
        color: #facc15;
    }
    .stat-card p {
        color: #cbd5e1;
        margin: 0;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="controls">
        <div class="action-buttons">
            <button class="btn btn-primary" onclick="window.location.href='{{ route('quizzs.index') }}'">
                <i class="fas fa-arrow-left"></i> العودة إلى الكويزات
            </button>
        </div>
    </div>

    {{-- إحصائيات سريعة --}}
    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3>{{ $totalStudents }}</h3>
            <p>إجمالي الطلاب</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>{{ $averageScore }}%</h3>
            <p>متوسط الدرجات</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <h3>{{ $highestScore }}</h3>
            <p>أعلى درجة</p>
        </div>
    </div>

    {{-- جدول النتائج --}}
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الطالب</th>
                    <th>اسم الكويز</th>
                    <th>الدرجة</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
            @forelse($results as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result->student_name ?? 'غير محدد' }}</td>
                    <td>{{ $result->quiz_title ?? 'غير محدد' }}</td>
                    <td class="score-highlight">{{ $result->score }} / {{ $result->total_points }}</td>
                    <td>{{ $result->submitted_at ? \Carbon\Carbon::parse($result->submitted_at)->format('Y-m-d') : '-' }}</td>
                    <td>
                        <a href="{{ route('quiz.review', $result->quiz_id) }}?student_id={{ $result->student_id }}"
                           class="btn-action btn-info" title="مراجعة إجابات الطالب">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">لا توجد نتائج لعرضها</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $results->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection


 
