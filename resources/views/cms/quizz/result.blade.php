 @extends('cms.parent')

@section('title', 'نتيجة الكويز')

@section('styles')
    <style>
        body {
            background: #0a0f1c;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            min-height: 100vh;
            padding: 24px 20px;

        }
        /* إزاحة لليمين لترك مساحة للداشبورد (مثل صفحة start) */
        .result-shifted {
            width: 100%;
            max-width: 1000px;
            margin:100px auto 0 auto;

        }
        .result-card {
            background: #0e172b;
            border-radius: 32px;
            padding: 40px;
            text-align: center;
            border: 1px solid #1f2937;

        }
         .result-card h1,p{
            color:rgb(77, 140, 223);
        }
        .score {
            font-size: 3rem;
            font-weight: bold;
            color: #facc15;
            margin: 20px 0;
        }
        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        .btn {
            background: linear-gradient(95deg, #5284f0, #7c3aed);
            color: white;
            padding: 10px 20px;
            border-radius: 40px;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }
        .btn-secondary {
            background: #1e293b;
            border: 1px solid #334155;
        }
        .btn-secondary:hover {
            background: #2d3a5e;
        }
        @media (max-width: 800px) {
            .result-shifted {
                margin-left: 5%;
                margin-right: 5%;
            }
        }
    </style>
@endsection

@section('content')
<div class="result-shifted">
    <div class="result-card">
        <h1>🏆 نتيجتك في الكويز</h1>
        <div class="score">
            {{ $result->score }} / {{ $result->total_points }}
        </div>
        <p>النسبة المئوية: {{ round(($result->score / $result->total_points) * 100) }}%</p>

        <div class="btn-group">
            <a href="{{ route('quiz.review', $quiz->id) }}" class="btn">📖 مراجعة إجاباتي</a>
            <a href="{{ route('quizzs.index') }}" class="btn btn-secondary">📋 قائمة الكويزات</a>
            @if($quiz->course_id)
                <a href="{{ route('courses.show', $quiz->course_id) }}" class="btn btn-secondary">📚 العودة إلى الكورس</a>
            @endif
        </div>
    </div>
</div>
@endsection

