
@extends('cms.parent')

@section('title', 'تعديل السؤال')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تعديل سؤال | بنك الأسئلة</title>
    <link rel="stylesheet" href="{{ asset('cms/css/createquestion.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="app-layout">
    <main class="main-content">
        <div class="form-card">
            <div class="form-title">✏️ تعديل السؤال</div>

            <form id="questionForm">
                @csrf


                <div class="form-group">
                    <label>نص السؤال *</label>
                    <textarea name="title" id="title" rows="3" required placeholder="اكتب السؤال هنا...">{{ old('title', $question->title) }}</textarea>
                </div>

               <div class="form-group">
               <label>اختر الكويز *</label>
              <select name="quizz_id" id="quizz_id" required>
               <option value="">-- اختر كويز --</option>
               @foreach($quizzes as $quiz)
               <option value="{{ $quiz->id }}" {{ $question->quizz_id == $quiz->id ? 'selected' : '' }}>
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
                            @php
                                $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
                                if (!is_array($options)) $options = [];
                            @endphp
                            @foreach($options as $idx => $opt)
                                <div class="option-item">
                                    <input type="text" name="options[]" placeholder="الخيار {{ chr(65+$idx) }}" value="{{ $opt }}" required>
                                    <button type="button" class="btn-remove remove-option" {{ $loop->index < 2 ? 'disabled' : '' }}>✖</button>
                                </div>
                            @endforeach
                            @if(count($options) < 2)
                                {{-- ضمان وجود خيارين على الأقل --}}
                                @for($i = count($options); $i < 2; $i++)
                                <div class="option-item">
                                    <input type="text" name="options[]" placeholder="الخيار {{ chr(65+$i) }}" value="" required>
                                    <button type="button" class="btn-remove remove-option" disabled>✖</button>
                                </div>
                                @endfor
                            @endif
                        </div>
                        <button type="button" id="add-option" class="btn-add">+ إضافة خيار</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>الإجابة الصحيحة *</label>
                    <input type="text" name="correct_answer" id="correct_answer" required placeholder="اكتب نص الخيار الصحيح (مطابق لأحد الخيارات)" value="{{ old('correct_answer', $question->correct_answer) }}">
                </div>

                <div class="form-group">
                    <label>درجة السؤال</label>
                    <input type="number" name="points" id="points" value="{{ old('points', $question->points) }}" min="1">
                </div>

                <div class="form-actions">
                    <a href="{{ route('questions.index') }}" class="btn-secondary">رجوع</a>
                    <button type="button" onclick="performUpdate({{ $question->id }})" class="btn-primary">
                        <i class="fas fa-save"></i> تحديث
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

    // تحديث السؤال
    function performUpdate(id) {
    let formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('quizz_id', document.getElementById('quizz_id').value);
    formData.append('title', document.getElementById('title').value);

    let correctAnswer = document.getElementById('correct_answer').value.trim();
    let points = document.getElementById('points').value;

    let options = [];
    document.querySelectorAll('input[name="options[]"]').forEach(opt => {
        if (opt.value.trim() !== '') options.push(opt.value.trim());
    });

    if (options.length < 2) {
        Swal.fire({ icon: 'error', title: 'يجب إدخال خيارين على الأقل' });
        return;
    }

    if (!options.includes(correctAnswer)) {
        Swal.fire({
            icon: 'error',
            title: 'الإجابة الصحيحة غير مطابقة',
            text: 'يجب أن تكون الإجابة الصحيحة واحدة من الخيارات التي أدخلتها.'
        });
        return;
    }

    formData.append('correct_answer', correctAnswer);
    formData.append('points', points);
    options.forEach(opt => {
        formData.append('options[]', opt);
    });

    // ✅ التصحيح هنا: استخدم placeholder ثم replace
    let url = '{{ route("questions.update", ":id") }}'.replace(':id', id);
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

