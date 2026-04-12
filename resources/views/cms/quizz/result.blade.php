 
    <title>نتيجة {{ $quiz->title }}</title>
    <style>
        body {
            background: #eef2f5;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 24px;
        }
        .result-card {
            background: white;
            border-radius: 28px;
            padding: 32px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
        }
        .score {
            font-size: 3rem;
            font-weight: bold;
            color: #1e293b;
            margin: 20px 0;
        }
        .btn {
            background: #1e293b;
            color: white;
            padding: 10px 24px;
            border-radius: 40px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="result-card">
    <h1>{{ $quiz->title }}</h1>
    <div class="score">
        {{ $result['score'] }} / {{ $result['total'] }}
    </div>
    <p>النسبة المئوية: {{ round(($result['score'] / $result['total']) * 100) }}%</p>
    <p>العلامة الكلية للكويز: {{ $quiz->total_marks }}</p>
    <a href="{{ route('quiz.show', $quiz->id) }}" class="btn">🔁 إعادة المحاولة</a>
</div>
</body>
</html>




