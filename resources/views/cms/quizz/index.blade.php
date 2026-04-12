@extends('cms.parent')

@section('title', 'قائمة الكويزات')

@section('styles')
    <style>
        :root {
            --bg-dark: #0a0f1c;
            --card-dark: #111827;
            --border-dark: #1f2937;
            --primary-dark: #3b82f6;
            --text-light: #f3f4f6;
        }

        body {
            background: var(--bg-dark) !important;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }

        /* ===== تنسيق الداشبورد الموروث ===== */
        .dashboard {
            background: #0f172a !important;
            border-left: 1px solid #1e293b !important;
            color: #e2e8f0 !important;
        }
        .dashboard * {
            color: #e2e8f0 !important;
        }
        .dashboard a {
            color: #cbd5e6 !important;
        }
        .dashboard a:hover,
        .dashboard .active {
            background: #1e293b !important;
            color: white !important;
        }

        /* ===== حاوية رئيسية بمسافة من الداشبورد ===== */
        .app-layout {
            display: flex;
            gap: 50px;
            align-items: flex-start;
        }

        .dashboard {
            flex-shrink: 0;
            width: 280px;
            position: sticky;
            top: 0;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            padding: 32px 40px;
            background: transparent !important;
        }

        /* ===== رأس الصفحة ===== */
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-bar h2 {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(95deg, #2563eb, #7c3aed);
            color: white;
            padding: 10px 24px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        /* ===== شبكة الكروت ===== */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 28px;
        }

        /* ===== الكارد الواحد ===== */
        .quiz-card {
            background: var(--card-dark);
            border-radius: 28px;
            border: 1px solid var(--border-dark);
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .quiz-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -10px rgba(0,0,0,0.5);
        }

        .card-header {
            padding: 18px 20px;
            background: rgba(255,255,255,0.03);
            border-bottom: 1px solid var(--border-dark);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .quiz-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-light);
        }

        .quiz-points {
            background: #1e293b;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .card-body {
            padding: 18px 20px;
        }

        .quiz-description {
            color: #9ca3af;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .quiz-meta {
            display: flex;
            gap: 20px;
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 12px;
        }

        .quiz-meta i {
            margin-left: 5px;
        }

        .card-actions {
            padding: 12px 20px 20px;
            display: flex;
            gap: 16px;
            border-top: 1px solid var(--border-dark);
        }

        .edit-btn, .delete-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 30px;
            transition: 0.2s;
        }

        .edit-btn {
            color: #60a5fa;
        }
        .edit-btn:hover {
            background: #1e293b;
        }
        .delete-btn {
            color: #f87171;
        }
        .delete-btn:hover {
            background: #1e293b;
        }

        /* رسالة نجاح */
        .alert-success-dark {
            background: #064e3b;
            border-right: 4px solid #10b981;
            padding: 14px;
            border-radius: 24px;
            margin-bottom: 28px;
            color: #a7f3d0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* رسالة عند عدم وجود بيانات */
        .empty-state {
            text-align: center;
            padding: 60px;
            background: var(--card-dark);
            border-radius: 36px;
            border: 1px solid var(--border-dark);
        }

        .empty-state i {
            font-size: 3rem;
            color: #4b5563;
            margin-bottom: 16px;
        }

        .empty-state p {
            color: #9ca3af;
        }

        @media (max-width: 900px) {
            .app-layout {
                flex-direction: column;
            }
            .dashboard {
                width: 100%;
                position: relative;
            }
            .main-content {
                padding: 20px;
            }
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;500;600;700&display=swap');
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    </style>
@endsection

@section('content')
<div class="app-layout">
    {{-- الداشبورد الجانبي --}}
    <aside class="dashboard">
        <h3><i class="fas fa-moon"></i> لوحة التحكم</h3>
        <ul>
            <li><a href="{{ route('quizzs.index') }}" class="active"><i class="fas fa-list-ul"></i> جميع الكويزات</a></li>
            <li><a href="{{ route('quizzs.create') }}"><i class="fas fa-plus-circle"></i> كويز جديد</a></li>
            <li><a href="{{ route('questions.index') }}"><i class="fas fa-question-circle"></i> بنك الأسئلة</a></li>
            <li><a href="#"><i class="fas fa-chart-line"></i> إحصائيات</a></li>
        </ul>
        <hr style="margin: 30px 0; border-color: #1e293b;">
        <div style="font-size: 0.75rem; color: #64748b;">
            <i class="fas fa-gem"></i> إدارة الكويزات والأسئلة
        </div>
    </aside>

    {{-- المحتوى الرئيسي: قائمة الكويزات --}}
    <main class="main-content">
        <div class="header-bar">
            <h2><i class="fas fa-layer-group"></i> قائمة الكويزات</h2>
            <a href="{{ route('quizzs.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i> كويز جديد
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success-dark">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($quizzes->count() > 0)
            <div class="cards-grid">
                @foreach($quizzes as $quiz)
                    <div class="quiz-card" data-id="{{ $quiz->id }}">
                        <div class="card-header">
                            <span class="quiz-title">{{ $quiz->title }}</span>
                            <span class="quiz-points"><i class="fas fa-star"></i> {{ $quiz->total_marks ?? '0' }}</span>
                        </div>
                        <div class="card-body">
                            <div class="quiz-description">
                                {{ $quiz->description ?? 'لا يوجد وصف لهذا الكويز.' }}
                            </div>
                            <div class="quiz-meta">
                                <span><i class="fas fa-clock"></i> {{ $quiz->duration_minutes ? $quiz->duration_minutes . ' دقيقة' : 'غير محدد' }}</span>
                                <span><i class="fas fa-book"></i> المادة: {{ $quiz->course_id }}</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('quizzs.edit', $quiz->id) }}" class="edit-btn">
                                <i class="fas fa-edit"></i> تعديل
                            </a>
                            <button onclick="deleteQuiz({{ $quiz->id }})" class="delete-btn">
                                <i class="fas fa-trash-alt"></i> حذف
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination" style="margin-top: 32px;">
                {{ $quizzes->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>🚀 لا توجد كويزات حالياً.</p>
                <a href="{{ route('quizzs.create') }}" class="btn-primary" style="margin-top: 16px; display: inline-block;">
                    <i class="fas fa-plus"></i> أضف أول كويز
                </a>
            </div>
        @endif
    </main>
</div>
@endsection

@section('scripts')
<script>
    function deleteQuiz(id) {
        if (confirm('هل أنت متأكد من حذف هذا الكويز؟ سيتم حذف جميع الأسئلة المرتبطة به. لا يمكن التراجع.')) {
            fetch(`/quizzes/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      location.reload();
                  } else {
                      alert('حدث خطأ أثناء الحذف');
                  }
              }).catch(() => alert('خطأ في الاتصال'));
        }
    }
</script>
@endsection



