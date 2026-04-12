
@extends('cms.parent')

@section('title', 'إنشاء كويز جديد')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء كويز جديد | منصة الكويزات</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0f1c !important;
            font-family: 'Segoe UI', 'Tahoma', system-ui, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .app-layout {
            display: flex;
            width: 100%;
            gap: 30px;
        }

        /* الداشبورد (يمين) */
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

        .dashboard ul {
            list-style: none;
        }

        .dashboard li {
            margin-bottom: 16px;
        }

        .dashboard a {
            color: #cbd5e6;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
        }

        .dashboard a:hover {
            color: white;
            transform: translateX(-4px);
        }

        .dashboard .active {
            color: #60a5fa;
            font-weight: bold;
        }

        /* المحتوى الرئيسي */
        .main-content {
            flex: 1;
            padding: 32px 40px;
            background: transparent;
        }

        /* الكارد - نفس حجم create question */
        .form-card {
            max-width: 800px;
            background: #111827;
            border-radius: 32px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.4);
            padding: 32px 36px;
            margin: 0 auto;
            border: 1px solid #1f2937;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 28px;
            border-right: none;
            padding-right: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #e2e8f0;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #334155;
            border-radius: 20px;
            font-size: 1rem;
            background: #1e293b;
            color: #f1f5f9;
            transition: all 0.2s;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
            background: #0f172a;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #1f2937;
        }

        .btn-primary {
            background: linear-gradient(95deg, #2563eb, #7c3aed);
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        .btn-secondary {
            background: #1e293b;
            color: #cbd5e1;
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: bold;
            border: 1px solid #334155;
            transition: 0.2s;
        }

        .btn-secondary:hover {
            background: #334155;
            color: white;
        }

        .alert-success {
            background: #064e3b;
            color: #a7f3d0;
            padding: 12px;
            border-radius: 20px;
            margin-bottom: 20px;
            border-right: 4px solid #10b981;
        }

        @media (max-width: 800px) {
            .app-layout {
                flex-direction: column;
                gap: 0;
            }
            .dashboard {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                padding: 20px;
            }
            .form-card {
                padding: 24px;
            }
        }
    </style>
@endsection

@section('content')
<div class="app-layout">
    <aside class="dashboard">
        <h3>📋 لوحة التحكم</h3>
        <ul>
            <li><a href="{{ route('quizzs.index') }}">📚 جميع الكويزات</a></li>
            <li><a href="{{ route('quizzs.create') }}" class="active">➕ كويز جديد</a></li>
            <li><a href="{{ route('questions.index') }}">📋 بنك الأسئلة</a></li>
            <li><a href="#">📊 إحصائيات</a></li>
        </ul>
        <hr style="margin: 30px 0; border-color: #334155;">
        <div style="font-size: 0.8rem; color: #94a3b8;">إدارة الكويزات<br>أنشئ كويزاً وأضف أسئلة</div>
    </aside>

    <main class="main-content">
        <div class="form-card">
            <div class="form-title">
                <i class="fas fa-plus-circle"></i> إنشاء كويز جديد
            </div>

            @if(session('success'))
                <div class="alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('quizzs.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>عنوان الكويز *</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="مثال: اختبار أساسيات الويب" required>
                    @error('title') <span style="color:#f87171;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>الوصف (اختياري)</label>
                    <textarea name="description" placeholder="وصف مختصر للكويز...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>المدة الزمنية (دقائق) - اختياري</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" placeholder="اتركه فارغاً">
                </div>

                <div class="form-group">
                    <label>العلامة الكلية</label>
                    <input type="text" name="total_marks" value="{{ old('total_marks', '100') }}" placeholder="مثال: 100">
                </div>

                <div class="form-group">
                    <label>رقم المادة (course_id) *</label>
                    <input type="number" name="course_id" value="{{ old('course_id', 1) }}" required>
                    @error('course_id') <span style="color:#f87171;">{{ $message }}</span> @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('quizzs.index') }}" class="btn-secondary">رجوع</a>
                    <button type="submit" class="btn-primary">💾 حفظ الكويز</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    // تأثير بسيط لتحسين تجربة المستخدم
    document.querySelectorAll('input, textarea, select').forEach(el => {
        el.addEventListener('focus', () => {
            el.style.transform = 'scale(1.01)';
        });
        el.addEventListener('blur', () => {
            el.style.transform = 'scale(1)';
        });
    });
</script>
@endsection
