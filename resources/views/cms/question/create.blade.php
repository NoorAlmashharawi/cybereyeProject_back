
@extends('cms.parent')

@section('title', 'إضافة سؤال جديد')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء سؤال جديد | بنك الأسئلة</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0f1c !important; /* خلفية كحلية غامقة */
            font-family: 'Segoe UI', 'Tahoma', system-ui, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .app-layout {
            display: flex;
            width: 100%;
            gap: 30px; /* مسافة بين الداشبورد والمحتوى */
        }

        /* تنسيق الداشبورد (تم تغيير الألوان لتتناسب مع الثيم الداكن) */
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

        /* كارد النموذج - خلفية داكنة */
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

        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #334155;
            border-radius: 20px;
            font-size: 1rem;
            background: #1e293b;
            color: #f1f5f9;
            transition: all 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
            background: #0f172a;
        }

        .radio-group {
            display: flex;
            gap: 24px;
            align-items: center;
            margin-top: 6px;
        }

        .radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: normal;
            color: #cbd5e1;
        }

        .options-wrapper {
            background: #0f172a;
            padding: 16px;
            border-radius: 24px;
            margin-top: 8px;
        }

        .option-item {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            align-items: center;
        }

        .option-item input {
            flex: 1;
        }

        .btn-add, .btn-remove {
            background: #1e293b;
            border: none;
            padding: 6px 14px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
            color: #cbd5e1;
            transition: 0.2s;
        }

        .btn-add {
            background: #2d3a5e;
            color: #a5b4fc;
        }

        .btn-add:hover {
            background: #3b4b76;
        }

        .btn-remove {
            background: #3b1e2a;
            color: #fca5a5;
        }

        .btn-remove:hover {
            background: #5c2e3e;
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

        /* رسالة النجاح بالثيم الداكن */
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
     

    <main class="main-content">
        <div class="form-card">
            <div class="form-title">✨ إنشاء سؤال جديد</div>

            @if(session('success'))
                <div class="alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('questions.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>نص السؤال *</label>
                    <textarea name="title" id="title" rows="3" required placeholder="اكتب السؤال هنا...">{{ old('title') }}</textarea>
                    @error('title') <span style="color:#f87171;">{{ $message }}</span> @enderror
                </div>

                <input type="hidden" name="quizz_id" value="1">

                <div class="form-group">
                    <label>نوع السؤال *</label>
                    <div class="radio-group">
                        <label><input type="radio" name="type" value="mc" {{ old('type')=='mc' ? 'checked' : '' }}> اختيار من متعدد (MCQ)</label>
                        <label><input type="radio" name="type" value="tf" {{ old('type')=='tf' ? 'checked' : '' }}> صح / خطأ (True/False)</label>
                    </div>
                    @error('type') <span style="color:#f87171;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" id="options-group" style="display: {{ old('type')=='mc' ? 'block' : 'none' }};">
                    <label>الخيارات (أدخل خيارين على الأقل) *</label>
                    <div class="options-wrapper">
                        <div id="options-list">
                            @php $oldOptions = old('options', ['', '']); @endphp
                            @foreach($oldOptions as $idx => $opt)
                                <div class="option-item">
                                    <input type="text" name="options[]" placeholder="الخيار {{ chr(65+$idx) }}" value="{{ $opt }}" required>
                                    <button type="button" class="btn-remove remove-option" {{ $loop->index < 2 ? 'disabled' : '' }}>✖</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-option" class="btn-add">+ إضافة خيار</button>
                    </div>
                    @error('options') <span style="color:#f87171;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>الإجابة الصحيحة *</label>
                    <input type="text" name="correct_answer" value="{{ old('correct_answer') }}" placeholder="مثال: JavaScript أو True" required>
                    @error('correct_answer') <span style="color:#f87171;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>درجة السؤال</label>
                    <input type="number" name="points" value="{{ old('points', 1) }}" min="1">
                </div>

                <div class="form-actions">
                    <a href="{{ route('questions.index') }}" class="btn-secondary">رجوع</a>
                    <button type="submit" class="btn-primary">💾 حفظ السؤال</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    // إظهار/إخفاء خيارات MCQ
    const typeRadios = document.querySelectorAll('input[name="type"]');
    const optionsGroup = document.getElementById('options-group');
    function toggleOptions() {
        const selected = document.querySelector('input[name="type"]:checked');
        if (selected && selected.value === 'mc') {
            optionsGroup.style.display = 'block';
        } else {
            optionsGroup.style.display = 'none';
        }
    }
    typeRadios.forEach(radio => radio.addEventListener('change', toggleOptions));
    toggleOptions();

    // إضافة خيار جديد
    const optionsList = document.getElementById('options-list');
    const addBtn = document.getElementById('add-option');
    function addOptionField() {
        const div = document.createElement('div');
        div.className = 'option-item';
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'options[]';
        input.placeholder = 'خيار جديد';
        input.required = true;
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn-remove remove-option';
        removeBtn.innerText = '✖';
        removeBtn.onclick = function() { div.remove(); };
        div.appendChild(input);
        div.appendChild(removeBtn);
        optionsList.appendChild(div);
    }
    if(addBtn) addBtn.addEventListener('click', addOptionField);
</script>
@endsection

