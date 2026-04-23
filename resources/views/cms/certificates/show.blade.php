<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة حضور - Cyber Eye</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', 'Segoe UI', sans-serif;
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
            position: relative;
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
            margin-top: 15px;
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

        .issue-date {
            margin-top: 15px;
            color: #7f8c8d;
            font-size: 14px;
        }

        .btn {
            margin-top: 25px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        @media print {
            .btn { display: none; }
            body { background: white; padding: 0; }
            .certificate-box { 
                box-shadow: none; 
                border: 10px double #d4af37;
            }
        }
    </style>
</head>

<body>

<div class="certificate-wrapper">
    <div class="certificate-box">

        <h1 class="certificate-title">شهادة حضور</h1>

        <p>تشهد منصة</p>
        <div class="platform-name">Cyber Eye</div>

        <p>بأن الطالب/الطالبة</p>
        <div class="student-name">
            {{ $student->user1->username }}
        </div>

        <p>قد أتم بنجاح كورس</p>
        <div class="course-name">
            {{ $course->course_name }}
        </div>

        <p>بتقديم المدرب</p>
        <div class="instructor-name">
            <i class="fas fa-chalkboard-user"></i>
            {{ $course->instructor->user1->username ?? 'إدارة المنصة' }}
        </div>

        <div class="certificate-number">
            <i class="fas fa-hashtag"></i> {{ $certificate->certificate_number }}
        </div>

        <div class="issue-date">
            <i class="fas fa-calendar-alt"></i> تاريخ الإصدار: {{ \Carbon\Carbon::parse($certificate->issue_date)->format('Y/m/d') }}
        </div>

        <button class="btn" onclick="window.print()">
            <i class="fas fa-print"></i> طباعة الشهادة
        </button>

    </div>
</div>

</body>
</html>