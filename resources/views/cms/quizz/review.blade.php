
@extends('cms.parent')

@section('title', 'مراجعة الإجابات - ' . $quiz->title)

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin:0; padding:0; box-sizing: border-box; }
        body { background: #0a0f1c; font-family: 'Segoe UI', system-ui, sans-serif; display: flex; min-height: 100vh; padding: 24px 20px; }
        .quiz-shifted { width: 100%; max-width: 1000px; margin-left: 22%; margin-right: 2%; }
        .quiz-card { background: #111827; border-radius: 28px; box-shadow: 0 12px 30px rgba(0,0,0,0.4); overflow: hidden; border: 1px solid #1f2937; }
        .verif-header { padding: 20px 28px 8px; border-bottom: 1px solid #1f2937; background: #0f172a; }
        .verif-badge { background: #1e293b; display: inline-block; padding: 4px 14px; border-radius: 40px; font-weight: 600; color: #60a5fa; }
        .question-section { padding: 16px 28px; }
        .q-meta { display: flex; justify-content: space-between; border-left: 4px solid #3b82f6; padding-left: 16px; margin-bottom: 20px; color: #cbd5e1; }
        .question-text { font-size: 1.55rem; font-weight: 600; margin: 12px 0 28px; color: #f1f5f9; }
        .options-area { display: flex; flex-direction: column; gap: 14px; margin-bottom: 28px; }
        .option-row { display: flex; align-items: center;  color:#bcd6f6 ; gap: 14px; background: #1e293b; border: 1px solid #334155; border-radius: 18px; padding: 12px 20px; }
        .option-row.correct { background: #064e3b; border-color: #10b981; }
        .option-row.wrong { background: #4b1e2a; border-color: #f87171; }
        .option-radio { width: 20px; height: 20px; accent-color: #3b82f6; cursor: default; }
        .option-letter { font-weight: 700; background: #0f172a; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 40px; color: #e2e8f0; }
        .correct-mark { color: #4ade80; margin-right: 8px; }
        .wrong-mark { color: #f87171; margin-right: 8px; }
        .nav-buttons { display: flex; justify-content: space-between; padding: 8px 28px 24px; border-top: 1px solid #1f2937; background: #0f172a; }
        .nav-btn { background: #1e293b; border: 1px solid #334155; padding: 10px 28px; border-radius: 60px; font-weight: 600; cursor: pointer; color: #cbd5e1; transition: 0.2s; }
        .nav-btn:hover:not(:disabled) { background: #3b82f6; color: white; border-color: #3b82f6; }
        .nav-btn:disabled { opacity: 0.45; cursor: not-allowed; }
        .btn-back { background: linear-gradient(95deg, #2563eb, #7c3aed); color: white; border: none; }
        @media (max-width: 800px) { .quiz-shifted { margin-left: 5%; margin-right: 5%; } }
    </style>
@endsection

@section('content')
<div class="quiz-shifted">
    <div class="quiz-card">
        <div class="verif-header">
            <div class="verif-badge">📋 مراجعة الإجابات</div>
        </div>

        <div id="questionsContainer">
            @foreach($questions as $index => $question)
                @php
                    $userAnswer = $answers[$question->id]->answer ?? null;
                    $isCorrect = $answers[$question->id]->is_correct ?? false;
                    $correctAnswer = $question->correct_answer;
                    $options = is_string($question->options) ? json_decode($question->options, true) : ($question->options ?? []);
                    $letters = ['A','B','C','D','E','F'];
                @endphp
                <div class="question-block" data-qid="{{ $question->id }}" style="{{ $index === 0 ? 'display:block' : 'display:none' }}">
                    <div class="question-section">
                        <div class="q-meta">
                            <span>سؤال {{ $index+1 }} من {{ count($questions) }}</span>
                            <span>{{ $isCorrect ? '✓ صحيحة' : '✗ خاطئة' }}</span>
                        </div>
                        <div class="question-text">{{ $question->title }}</div>
                        <div class="options-area">
                            @foreach($options as $optIdx => $opt)
                                @php
                                    $isUserAnswer = ($userAnswer === $opt);
                                    $isCorrectAnswer = ($correctAnswer === $opt);
                                    $rowClass = '';
                                    if ($isCorrectAnswer) $rowClass = 'correct';
                                    elseif ($isUserAnswer && !$isCorrectAnswer) $rowClass = 'wrong';
                                @endphp
                                <div class="option-row {{ $rowClass }}">
                                    <span class="option-letter">{{ $letters[$optIdx] ?? chr(65+$optIdx) }}</span>
                                    <span>{{ $opt }}</span>
                                    @if($isCorrectAnswer)
                                        <span class="correct-mark">✓ الإجابة الصحيحة</span>
                                    @endif
                                    @if($isUserAnswer && !$isCorrectAnswer)
                                        <span class="wrong-mark">✗ إجابتك</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="nav-buttons">
            <button type="button" id="prevBtn" class="nav-btn" disabled>◀ السابق</button>
            <button type="button" id="nextBtn" class="nav-btn">التالي ▶</button>
            <a href="{{ route('quiz.result', $quiz->id) }}" class="nav-btn btn-back">احصل على شهادتك الان</a>
        </div>
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
</script>
@endsection
