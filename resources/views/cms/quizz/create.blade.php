  @extends('cms.parent')

@section('title', 'إنشاء كويز جديد')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
    background: #0a1a2f !important; /* لون كحلي غامق */
}
    /* تنسيق اللوحة الجانبية السوداء */
    .side-panel {
        width: 260px;
        background: #0a0a0a;
        border-radius: 24px;
        padding: 24px 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.5);
        border: 1px solid #1f1f1f;
    }
    .side-menu-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 16px;
        color: #e0e0e0;
        text-decoration: none;
        transition: all 0.2s;
        font-weight: 500;
        background: #111;
        border: 1px solid #2a2a2a;
    }
    .menu-item i {
        width: 24px;
        font-size: 1.2rem;
        color: #3b82f6;
    }
    .menu-item:hover {
        background: #1e1e1e;
        color: white;
        transform: translateX(-4px);
        border-color: #3b82f6;
    }
    .menu-item.active {
        background: #1e293b;
        color: white;
        border-color: #3b82f6;
    }

    /* تنسيق الحاوية الرئيسية (اللوحة + الفورم) */
    .quiz-create-layout {
        display: flex;
        gap: 30px;
        align-items: flex-start;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .form-container {
        flex: 1;
        background: #111827;
        border-radius: 32px;
        padding: 32px 36px;
        border: 1px solid #1f2937;
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.4);
    }
    .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #60a5fa, #a78bfa);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 28px;
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
    }
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
    }
    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 32px;
        padding-top: 20px;
        border-top: 1px solid #1f2937;
    }
    .btn-primary, .btn-secondary {
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-primary {
        background: linear-gradient(95deg, #2563eb, #7c3aed);
        color: white;
        border: none;
    }
    .btn-secondary {
        background: #1e293b;
        color: #cbd5e1;
        text-decoration: none;
        border: 1px solid #334155;
        display: inline-block;
    }
    .btn-primary:hover, .btn-secondary:hover {
        transform: translateY(-2px);
        filter: brightness(1.05);
    }
    @media (max-width: 800px) {
        .quiz-create-layout { flex-direction: column; }
        .side-panel { width: 100%; }
    }
</style>
@endsection

@section('content')
<div class="quiz-create-layout">
    {{-- اللوحة الجانبية السوداء --}}
    <aside class="side-panel">
        <div class="side-menu-list">
            <a href="{{ route('courses.index') }}" class="menu-item">
                <i class="fas fa-list-ul"></i> عرض كل الكورسات
            </a>
            <a href="{{ route('questions.create') }}" class="menu-item active">
                <i class="fas fa-plus-circle"></i> إضافة سؤال جديد
            </a>
            <a href="{{ route('quiz.studentResults') }}" class="menu-item">
                <i class="fas fa-chart-line"></i> التقارير العامة
            </a>
        </div>
    </aside>

    {{-- نموذج إنشاء الكويز --}}
    <div class="form-container">
        <div class="form-title">✨ إنشاء كويز جديد</div>

        <form id="quizForm">
            @csrf

            <div class="form-group">
                <label>عنوان الكويز *</label>
                <input type="text" name="title" id="title" required placeholder="مثال: اختبار أساسيات الويب">
            </div>

            <div class="form-group">
                <label>الوصف (اختياري)</label>
                <textarea name="description" id="description" rows="3" placeholder="وصف مختصر للكويز..."></textarea>
            </div>

            <div class="form-group">
                <label>المدة (دقائق) - اختياري</label>
                <input type="number" name="duration_minutes" id="duration_minutes" placeholder="اتركه فارغاً">
            </div>

            <div class="form-group">
                <label>العلامة الكلية</label>
                <input type="text" name="total_marks" id="total_marks" value="100">
            </div>

            <div class="form-group">
                <label>اختر المادة (course) *</label>
                <select name="course_id" id="course_id" required>
                    <option value="">-- اختر مادة --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-actions">
                <a href="{{ route('quizzs.index') }}" class="btn-secondary">رجوع</a>
                <button type="button" onclick="performStore()" class="btn-primary">
                    <i class="fas fa-save"></i> حفظ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function performStore() {
        let formData = new FormData();
        formData.append('title', document.getElementById('title').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('duration_minutes', document.getElementById('duration_minutes').value);
        formData.append('total_marks', document.getElementById('total_marks').value);
        formData.append('course_id', document.getElementById('course_id').value);

        axios.post('{{ route('quizzs.store') }}', formData, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(function(response) {
            Swal.fire({
                icon: 'success',
                title: response.data.title,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = '{{ route('quizzs.index') }}';
            });
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: error.response?.data?.title || 'حدث خطأ، يرجى المحاولة مرة أخرى'
            });
        });
    }
</script>
@endsection
