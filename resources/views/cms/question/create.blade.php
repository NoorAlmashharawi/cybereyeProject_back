@extends('cms.parent')

@section('title', 'إضافة سؤال جديد')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء سؤال جديد | بنك الأسئلة</title>

    <link rel="stylesheet" href="{{ asset('cms/css/createquestion.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="app-layout">
    <main class="main-content">
        <div class="form-card">
            <div class="form-title">✨ إنشاء سؤال جديد</div>

            <form id="questionForm">
                @csrf

                <div class="form-group">
                    <label>نص السؤال *</label>
                    <textarea name="title" id="title" rows="3" required placeholder="اكتب السؤال هنا..."></textarea>
                </div>

                 <div class="form-group">
    <label>اختر الكويز *</label>
    <select name="quizz_id" id="quizz_id" required>
        <option value="">-- اختر كويز --</option>
        @foreach($quizzes as $quiz)
            <option value="{{ $quiz->id }}">
                {{ $quiz->title }}
                @if($quiz->course && $quiz->course->name)
                    ({{ $quiz->course->name }})
                @endif
            </option>
        @endforeach
    </select>
</div>

                <div class="form-group">
                    <label>الخيارات (أدخل خيارين على الأقل) *</label>
                    <div class="options-wrapper">
                        <div id="options-list">
                            <div class="option-item">
                                <input type="text" name="options[]" placeholder="الخيار A" required>
                                <button type="button" class="btn-remove remove-option" disabled>✖</button>
                            </div>
                            <div class="option-item">
                                <input type="text" name="options[]" placeholder="الخيار B" required>
                                <button type="button" class="btn-remove remove-option" disabled>✖</button>
                            </div>
                        </div>
                        <button type="button" id="add-option" class="btn-add">+ إضافة خيار</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>الإجابة الصحيحة *</label>
                    <input type="text" name="correct_answer" id="correct_answer" required placeholder="اكتب نص الخيار الصحيح (مطابق لأحد الخيارات)">
                </div>

                <div class="form-group">
                    <label>درجة السؤال</label>
                    <input type="number" name="points" id="points" value="1" min="1">
                </div>

                <div class="form-actions">
                    <a href="{{ route('questions.index') }}" class="btn-secondary">رجوع</a>
                    <button type="button" onclick="performStore()" class="btn-primary">
                        <i class="fas fa-save"></i> حفظ
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

      function performStore() {
    let formData = new FormData();
    formData.append('quizz_id', document.getElementById('quizz_id').value);
    formData.append('title', document.getElementById('title').value);

    let correctAnswer = document.getElementById('correct_answer').value.trim();
    let points = document.getElementById('points').value;

    // جمع الخيارات
    let options = [];
    document.querySelectorAll('input[name="options[]"]').forEach(opt => {
        if (opt.value.trim() !== '') options.push(opt.value.trim());
    });

    // التحقق من وجود خيارين على الأقل
    if (options.length < 2) {
        Swal.fire({ icon: 'error', title: 'يجب إدخال خيارين على الأقل' });
        return;
    }

    // التحقق من أن الإجابة الصحيحة موجودة ضمن الخيارات
    if (!options.includes(correctAnswer)) {
        Swal.fire({
            icon: 'error',
            title: 'الإجابة الصحيحة غير مطابقة',
            text: 'يجب أن تكون الإجابة الصحيحة واحدة من الخيارات التي أدخلتها.'
        });
        return;
    }

    // إضافة البيانات إلى FormData
    formData.append('correct_answer', correctAnswer);
    formData.append('points', points);
    options.forEach(opt => {
        formData.append('options[]', opt);
    });

    // إرسال الطلب
    axios.post('{{ route('questions.store') }}', formData, {
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    })
    .then(function(response) {
        Swal.fire({
            icon: 'success',
            title: response.data.title,
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = '{{ route('questions.index') }}';
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
