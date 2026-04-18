<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة حضور - Cyber Eye</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .certificate-wrapper {
            max-width: 1000px;
            width: 100%;
        }

        .certificate-box {
            border: 15px double #d4af37;
            border-radius: 20px;
            background: linear-gradient(135deg, #fff8e7, #fff);
            padding: 50px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .certificate-title {
            font-size: 48px;
            color: #d4af37;
            margin: 20px 0;
            font-weight: bold;
        }

        .platform-name {
            font-size: 32px;
            color: #2c3e50;
            font-weight: bold;
        }

        .student-name {
            font-size: 36px;
            color: #27ae60;
            font-weight: bold;
            margin: 25px 0;
            border-bottom: 3px solid #27ae60;
            display: inline-block;
            padding: 0 20px 10px;
        }

        .course-name {
            font-size: 28px;
            color: #3498db;
            margin: 20px 0;
            font-weight: bold;
        }

        .instructor-name {
            font-size: 22px;
            color: #e67e22;
        }

        .certificate-number {
            background: #f0f0f0;
            padding: 8px 16px;
            border-radius: 50px;
            display: inline-block;
            margin-top: 20px;
            font-family: monospace;
            direction: ltr;
        }

        .btn {
            margin-top: 25px;
            padding: 10px 20px;
            background: #95a5a6;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        @media print {
            .btn { display: none; }
            body { background: white; }
            .certificate-box { box-shadow: none; }
        }
    </style>
</head>

<body>

<div class="certificate-wrapper">
    <div class="certificate-box">

        <h1 class="certificate-title">شهادة حضور</h1>

        <p>تشهد منصة</p>
        <div class="platform-name">Cyber Eye</div>

        <p>بأن</p>
        <div class="student-name">
            {{ $certificate->student->name ?? $certificate->student->username ?? Auth::user()->name ?? 'طالب' }}
        </div>

        <p>قد أتم بنجاح كورس</p>
        <div class="course-name">
            {{ $certificate->course->course_name ?? $certificate->course->name ?? 'كورس' }}
        </div>

        <p>بتقديم المدرب</p>
        <div class="instructor-name">
            {{ $certificate->instructor->name ?? $certificate->instructor->username ?? $certificate->course->instructor->name ?? 'مدرب' }}
        </div>

        <div class="certificate-number">
            <i class="fas fa-hashtag"></i> {{ $certificate->certificate_number ?? '---' }}
        </div>

        {{-- <div style="margin-top: 15px; color: #7f8c8d;">
            📅 تاريخ الإصدار: {{ optional($certificate->issued_date)->format('Y/m/d') ?? now()->format('Y/m/d') }}
        </div> --}}

        <button class="btn" onclick="window.print()">🖨️ طباعة الشهادة</button>

    </div>
</div>

</body>
</html>