@extends('cms.parent')

@section('title', 'تعديل الكويز')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('cms/css/createquiz.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* توسيط الفورم */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }
    .form-card {
        max-width: 800px;
        width: 100%;
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
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .form-group {
        flex: 1;
        margin-bottom: 20px;
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
    .form-help {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 5px;
    }
    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        gap: 15px;
    }
    .btn-primary, .btn-secondary {
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    .btn-primary {
        background: linear-gradient(95deg, #2563eb, #7c3aed);
        color: white;
        border: none;
    }
    .btn-secondary {
        background: #1e293b;
        color: #cbd5e1;
        border: 1px solid #334155;
    }
    .btn-primary:hover, .btn-secondary:hover {
        transform: translateY(-2px);
        filter: brightness(1.05);
    }
    @media (max-width: 700px) {
        .form-row { flex-direction: column; gap: 0; }
        .form-card { padding: 24px; }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <div class="form-card">
        <div class="form-title">
            <i class="fas fa-edit"></i> تعديل الكويز: {{ $quizz->title }}
        </div>

        <form id="edit-quizz-form">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="title">عنوان الكويز *</label>
                    <input type="text" id="title" name="title" required placeholder="أدخل عنوان الكويز" value="{{ old('title', $quizz->title) }}">
                    <div class="form-help"><i class="fas fa-info-circle"></i> اسم الكويز الظاهر للطلاب</div>
                </div>

                <div class="form-group">
                    <label for="duration_minutes">المدة (دقائق) - اختياري</label>
                    <input type="number" id="duration_minutes" name="duration_minutes" placeholder="اتركه فارغاً" value="{{ old('duration_minutes', $quizz->duration_minutes) }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="total_marks">العلامة الكلية</label>
                    <input type="text" id="total_marks" name="total_marks" placeholder="مثال: 100" value="{{ old('total_marks', $quizz->total_marks) }}">
                </div>

                <div class="form-group">
                    <label for="course_id">المادة (course) *</label>
                    <select id="course_id" name="course_id" required>
                        <option value="">-- اختر مادة --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $quizz->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="description">الوصف (اختياري)</label>
                <textarea id="description" name="description" rows="4" placeholder="وصف مختصر للكويز...">{{ old('description', $quizz->description) }}</textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('quizzs.index') }}" class="btn-secondary">رجوع</a>
                <button type="button" onclick="performUpdate({{ $quizz->id }})" class="btn-primary">
                    <i class="fas fa-save"></i> حفظ التعديلات
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
    function performUpdate(id) {
        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('title', document.getElementById('title').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('duration_minutes', document.getElementById('duration_minutes').value);
        formData.append('total_marks', document.getElementById('total_marks').value);
        formData.append('course_id', document.getElementById('course_id').value);

        let url = '{{ route("quizzs.update", $quizz->id) }}';
        axios.post(url, formData, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'multipart/form-data'
            }
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
            let message = error.response?.data?.title || error.response?.data?.message || 'حدث خطأ، يرجى المحاولة مرة أخرى';
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: message
            });
        });
    }
</script>
@endsection
