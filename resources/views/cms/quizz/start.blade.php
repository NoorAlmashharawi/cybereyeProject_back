  @extends('cms.parent')

@section('title','إضافة فيديو جديد')

@section('styles')


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $quiz->title }} | Verif. Quiz</title>
    <style>
        * { margin:0; padding:0; box-sizing: border-box; }
        body {
            background: #eef2f5;
            font-family: 'Segoe UI', system-ui, sans-serif;
            display: flex;
            min-height: 100vh;
            padding: 24px 20px;
        }
        /* إزاحة لليمين لترك مساحة للداشبورد (يتم إضافته من layout الأب) */
        .quiz-shifted {
            width: 100%;
            max-width: 1000px;
            margin-left: 22%;
            margin-right: 2%;
        }
        .quiz-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .verif-header {
            padding: 20px 28px 8px;
            border-bottom: 1px solid #e9edf2;
        }
        .verif-badge {
            background: #f0f4f9;
            display: inline-block;
            padding: 4px 14px;
            border-radius: 40px;
            font-weight: 600;
        }
        .question-section { padding: 16px 28px; }
        .q-meta {
            display: flex;
            justify-content: space-between;
            border-left: 4px solid #3b82f6;
            padding-left: 16px;
            margin-bottom: 20px;
        }
        .question-text {
            font-size: 1.55rem;
            font-weight: 600;
            margin: 12px 0 28px;
        }
        .options-area { display: flex; flex-direction: column; gap: 14px; margin-bottom: 28px; }
        .option-row {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #fafcff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 12px 20px;
            cursor: pointer;
        }
        .option-row:hover { background: #f8fafc; }
        .option-radio { width: 20px; height: 20px; accent-color: #3b82f6; }
        .option-letter {
            font-weight: 700;
            background: #f1f5f9;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 40px;
        }
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            padding: 8px 28px 24px;
            border-top: 1px solid #edf2f7;
        }
        .nav-btn {
            background: white;
            border: 1.5px solid #cbd5e1;
            padding: 10px 28px;
            border-radius: 60px;
            font-weight: 600;
            cursor: pointer;
        }
        .nav-btn:disabled { opacity: 0.45; cursor: not-allowed; }
        .btn-submit { background: #1e293b; color: white; border: none; }
        @media (max-width: 800px) { .quiz-shifted { margin-left: 5%; margin-right: 5%; } }
    </style>
 @endsection

@section('content')
<div class="quiz-shifted">
    <div class="quiz-card">
        <div class="verif-header">
            <div class="verif-badge">📋 verif. assessment</div>
        </div>

        <form id="quizForm" method="POST" action="{{ route('quiz.submit', $quiz->id) }}">
            @csrf
            <div id="questionsContainer">
                @foreach($questions as $index => $question)
                    <div class="question-block" data-qid="{{ $question->id }}" style="{{ $index === 0 ? 'display:block' : 'display:none' }}">
                        <div class="question-section">
                            <div class="q-meta">
                                <span>سؤال {{ $index+1 }} من {{ count($questions) }}</span>
                                <span>{{ $question->type === 'mc' ? 'اختيار من متعدد' : 'صح/خطأ' }}</span>
                            </div>
                            <div class="question-text">{{ $question->text }}</div>
                            <div class="options-area">
                                @php
                                    $options = ($question->type === 'tf') ? ['True', 'False'] : ($question->options ?? []);
                                    $letters = ['A','B','C','D'];
                                    $saved = $tempAnswers[$question->id] ?? null;
                                @endphp
                                @foreach($options as $optIdx => $opt)
                                    <label class="option-row">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $opt }}"
                                               {{ $saved === $opt ? 'checked' : '' }} class="option-radio">
                                        <span class="option-letter">{{ $letters[$optIdx] ?? chr(65+$optIdx) }}</span>
                                        <span>{{ $opt }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="nav-buttons">
                <button type="button" id="prevBtn" class="nav-btn" disabled>◀ السابق</button>
                <button type="button" id="nextBtn" class="nav-btn">التالي ▶</button>
                <button type="submit" class="nav-btn btn-submit">✔ إنهاء الامتحان</button>
            </div>
        </form>
    </div>
</div>


@endsection

@section('scripts')
<script>
    const blocks = document.querySelectorAll('.question-block');
    let current = 0;
    const total = blocks.length;
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    function showQuestion(index) {
        blocks.forEach((b, i) => b.style.display = i === index ? 'block' : 'none');
        prevBtn.disabled = (index === 0);
        nextBtn.disabled = (index === total-1);
    }
    prevBtn.onclick = () => { if(current > 0) { current--; showQuestion(current); } };
    nextBtn.onclick = () => { if(current < total-1) { current++; showQuestion(current); } };
    showQuestion(0);

    // حفظ مؤقت عبر AJAX (اختياري)
    function saveTempAnswers() {
        let answers = {};
        document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
            let name = radio.getAttribute('name');
            if(name) answers[name] = radio.value;
        });
        fetch('{{ route("quiz.saveTemp", $quiz->id) }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ answers: answers })
        });
    }
    document.querySelectorAll('input[type="radio"]').forEach(r => r.addEventListener('change', saveTempAnswers));
</script>

@endsection

