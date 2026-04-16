
@extends('cms.parent')

@section('title', 'أسئلة الكويز: ' . $quizz->title)

@section('styles')
    <style>
        body { background: #0a0f1c; font-family: 'Segoe UI', sans-serif; }
        .container { padding: 30px; max-width: 900px; margin: auto; }
        .back-btn {  color: white; padding: 8px 20px; border-radius: 40px;
             text-decoration: none; display: inline-block; margin-bottom: 20px;
                background: linear-gradient(95deg, #9fdff2, #2247e9);
            }


        .back-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        .question-card { background: #111827; border-radius: 24px; padding: 20px; margin-bottom: 20px; border: 1px solid #1f2937; }
        .question-text { color: #f1f5f9; font-size: 1.2rem; margin-bottom: 15px; }
        .options-list { background: #0f172a; border-radius: 20px; padding: 12px; }
        .option-item { display: flex; gap: 10px; padding: 8px; color: #cbd5e1; border-bottom: 1px solid #1e293b; }
        .correct-answer { color: #4ade80; margin-top: 10px; font-size: 0.9rem; }
        h2 { color: white; margin-bottom: 20px; }


    </style>
@endsection

@section('content')
<div class="container">
    <a href="{{ route('quizzs.index') }}" class="back-btn"> رجوع إلى الكويزات</a>
    <h2>📚 أسئلة الكويز: {{ $quizz->title }}</h2>

    @forelse($questions as $question)
        <div class="question-card">
            <div class="question-text">{{ $question->title }}</div>
            <div class="options-list">
                @php
                    $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
                @endphp
                @if(is_array($options))
                    @foreach($options as $idx => $opt)
                        <div class="option-item">
                            <span>{{ chr(65+$idx) }}.</span>
                            <span>{{ $opt }}</span>
                            @if($opt === $question->correct_answer)
                                <span style="color:#4ade80;">✓ (صحيحة)</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="correct-answer">✅ الإجابة الصحيحة: {{ $question->correct_answer }}</div>
        </div>
    @empty
        <div style="color:#9ca3af; text-align:center;">لا توجد أسئلة مرتبطة بهذا الكويز حالياً.</div>
    @endforelse
</div>
@endsection


