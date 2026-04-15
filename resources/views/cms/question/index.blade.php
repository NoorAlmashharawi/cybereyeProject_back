@extends('cms.parent')

@section('title', 'قائمة الأسئلة')

@section('styles')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>بنك الأسئلة – كروت</title>
    <style>
        * { margin:0; padding:0; box-sizing: border-box; }
        body {
            background: #0a0f1c !important; /* خلفية كحلية غامقة */
            font-family: 'Segoe UI', Tahoma, system-ui, sans-serif;
            display: flex;
            min-height: 100vh;
        }
        /* الداشبورد - ألوان داكنة */
        .dashboard {
            width: 280px;
            background: #0f172a !important;
            color: #e2e8f0;
            padding: 28px 16px;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            border-left: 1px solid #1e293b;
        }
        .dashboard h3 {
            font-size: 1.3rem;
            margin-bottom: 24px;
            border-bottom: 1px solid #334155;
            padding-bottom: 12px;
            color: #f1f5f9;
        }
        .dashboard ul { list-style: none; }
        .dashboard li { margin-bottom: 16px; }
        .dashboard a {
            color: #cbd5e6;
            text-decoration: none;
            display: block;
            padding: 8px 12px;
            border-radius: 12px;
            transition: 0.2s;
        }
        .dashboard a:hover, .dashboard .active {
            background: #1e293b;
            color: white;
        }
        /* المحتوى الرئيسي */
        .main-content {
            flex: 1;
            padding: 32px 40px;
            overflow-y: auto;
            background: transparent;
        }
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        .header-bar h2 {
            color: #e2e8f0;
        }
        .btn-primary {
            background: linear-gradient(95deg, #2563eb, #7c3aed);
            color: white;
            padding: 10px 24px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }
        /* شبكة الكروت */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 24px;
        }
        /* الكارد - خلفية داكنة */
        .question-card {
            background: #111827;
            border-radius: 28px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            overflow: hidden;
            border: 1px solid #1f2937;
            transition: transform 0.25s;
        }
        .question-card:hover {
            transform: translateY(-4px);
        }
        .card-header {
            padding: 16px 20px;
            background: #0f172a;
            border-bottom: 1px solid #1f2937;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .question-type {
            font-size: 0.75rem;
            background: #1e293b;
            color: #a5b4fc;
            padding: 4px 12px;
            border-radius: 30px;
        }
        .question-points {
            background: #1e293b;
            padding: 4px 12px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            color: #cbd5e1;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            background: #1e293b;
            min-width: 180px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            border-radius: 16px;
            z-index: 10;
            border: 1px solid #334155;
        }
        .points-dropdown { position: relative; display: inline-block; }
        .dropdown-menu button, .dropdown-menu a {
            display: block;
            width: 100%;
            padding: 10px 16px;
            text-align: right;
            background: none;
            border: none;
            cursor: pointer;
            color: #e2e8f0;
        }
        .dropdown-menu button:hover, .dropdown-menu a:hover {
            background: #334155;
        }
        .card-body { padding: 20px; }
        .question-text {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 16px;
            color: #f1f5f9;
        }
        .options-list {
            background: #0f172a;
            border-radius: 20px;
            padding: 12px;
            margin: 12px 0;
            color: #cbd5e1;
        }
        .option-item { display: flex; align-items: center; gap: 8px; padding: 6px 0; }
        .option-letter {
            width: 28px; height: 28px;
            background: #1e293b;
            color: #e2e8f0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 30px;
        }
        .correct-badge {
            display: inline-block;
            background: #064e3b;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
            color: #a7f3d0;
        }
        .card-actions {
            padding: 12px 20px 20px;
            display: flex;
            gap: 16px;
            border-top: 1px solid #1f2937;
        }
        .edit-btn, .delete-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.2s;
        }
        .edit-btn { color: #60a5fa; }
        .edit-btn:hover { color: #93c5fd; }
        .delete-btn { color: #f87171; }
        .delete-btn:hover { color: #fca5a5; }
        .alert-success {
            background: #064e3b;
            color: #a7f3d0;
            padding: 12px;
            border-radius: 28px;
            margin-bottom: 24px;
            border-right: 4px solid #10b981;
        }
        .pagination { margin-top: 32px; display: flex; justify-content: center; }
        .pagination .page-link {
            background: #1e293b;
            color: #cbd5e1;
            border: 1px solid #334155;
        }
        @media (max-width: 800px) {
            body { flex-direction: column; }
            .dashboard { width: 100%; height: auto; position: relative; }
        }
    </style>
@endsection

@section('content')

    <div class="main-content">
        <div class="header-bar">
            <h2>📋 بنك الأسئلة</h2>
            <a href="{{ route('questions.create') }}" class="btn-primary">+ إضافة سؤال جديد</a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="cards-grid">
            @forelse($questions as $question)
                <div class="question-card">
                    <div class="card-header">
                        <span class="question-type">{{ $question->type === 'mc' ? '📌 اختيار من متعدد' : '✓ صح / خطأ' }}</span>
                        <div class="points-dropdown">
                            <span class="question-points" onclick="toggleDropdown({{ $question->id }})">⚡ {{ $question->points }} نقطة</span>
                            <div id="dropdown-{{ $question->id }}" class="dropdown-menu">
                                <button onclick="deleteQuestion({{ $question->id }})">🗑️ حذف السؤال بالكامل مع خياراته</button>
                                <a href="{{ route('questions.edit', $question->id) }}">✏️ تعديل السؤال</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="question-text">{{ $question->title }}</div>

                        @if($question->type === 'mc' && !empty($question->options))
                            <div class="options-list">
                                @foreach($question->options as $idx => $opt)
                                    <div class="option-item">
                                        <span class="option-letter">{{ chr(65+$idx) }}</span>
                                        <span>{{ $opt }}</span>
                                        @if($opt === $question->correct_answer)
                                            <span style="color:#4ade80;"> (صحيحة)</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @elseif($question->type === 'tf')
                            <div class="options-list">
                                <div class="option-item"><span class="option-letter">أ</span> صح @if($question->correct_answer == 'True') <span style="color:#4ade80;"> (صحيحة)</span> @endif</div>
                                <div class="option-item"><span class="option-letter">ب</span> خطأ @if($question->correct_answer == 'False') <span style="color:#4ade80;"> (صحيحة)</span> @endif</div>
                            </div>
                        @endif

                        <div class="correct-badge">✅ الإجابة الصحيحة: {{ $question->correct_answer }}</div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('questions.edit', $question->id) }}" class="edit-btn">✏️ تعديل</a>
                        <button onclick="deleteQuestion({{ $question->id }})" class="delete-btn">🗑️ حذف</button>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 48px; color:#9ca3af;">🚀 لا توجد أسئلة حالياً. <a href="{{ route('questions.create') }}" style="color:#60a5fa;">أضف أول سؤال</a></div>
            @endforelse
        </div>
        <div class="pagination">{{ $questions->links() }}</div>
    </div>
@endsection

@section('scripts')
<script>
    function toggleDropdown(id) {
        const menu = document.getElementById(`dropdown-${id}`);
        const allMenus = document.querySelectorAll('.dropdown-menu');
        allMenus.forEach(m => { if (m.id !== `dropdown-${id}`) m.style.display = 'none'; });
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
    window.onclick = function(e) {
        if (!e.target.classList.contains('question-points')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
        }
    }
    function deleteQuestion(id) {
        if (confirm('هل أنت متأكد من حذف هذا السؤال وجميع خياراته؟')) {
            fetch(`/questions/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json', 'Content-Type': 'application/json' }
            }).then(response => response.json())
              .then(data => { if (data.success) location.reload(); else alert('حدث خطأ'); })
              .catch(() => alert('خطأ في الاتصال'));
        }
    }
</script>
@endsection
