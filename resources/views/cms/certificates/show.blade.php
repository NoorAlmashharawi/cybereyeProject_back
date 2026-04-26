<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة تقدير - CYBEReye</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', 'Tajawal', 'Segoe UI', serif;
            background: #4a6b3c;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px;
        }

        .certificate-wrapper {
            max-width: 950px;
            width: 100%;
            background: #fdf8e7;
            padding: 45px 55px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
            position: relative;
            border: 1px solid #d4c9a6;
        }

        /* إطار ذهبي كلاسيكي */
        .certificate-wrapper::before {
            content: '';
            position: absolute;
            top: 12px;
            left: 12px;
            right: 12px;
            bottom: 12px;
            border: 2px solid #c9a53b;
            pointer-events: none;
        }

        /* زوايا مزخرفة */
        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            border-color: #c9a53b;
            border-style: solid;
            border-width: 0;
        }

        .corner-tl {
            top: 20px;
            left: 20px;
            border-top-width: 3px;
            border-left-width: 3px;
        }

        .corner-tr {
            top: 20px;
            right: 20px;
            border-top-width: 3px;
            border-right-width: 3px;
        }

        .corner-bl {
            bottom: 20px;
            left: 20px;
            border-bottom-width: 3px;
            border-left-width: 3px;
        }

        .corner-br {
            bottom: 20px;
            right: 20px;
            border-bottom-width: 3px;
            border-right-width: 3px;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 14px;
            letter-spacing: 4px;
            color: #8b7a4b;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .certificate-title {
            font-size: 42px;
            font-weight: 800;
            color: #2c2b26;
            letter-spacing: 3px;
            margin: 10px 0;
        }

        .certificate-subtitle {
            font-size: 13px;
            color: #6b5a3a;
            letter-spacing: 2px;
            border-bottom: 1px solid #d4c9a6;
            display: inline-block;
            padding-bottom: 5px;
        }

        .award-text {
            font-size: 16px;
            color: #3a3524;
            margin: 30px 0 15px;
            line-height: 1.8;
            text-align: center;
        }

        .student-section {
            text-align: center;
            margin: 15px 0;
        }

        .student-name {
            font-size: 38px;
            font-weight: 700;
            color: #1e3a2f;
            letter-spacing: 2px;
            font-family: 'Times New Roman', serif;
            border-bottom: 1px dashed #c9a53b;
            display: inline-block;
            padding-bottom: 8px;
        }

        .course-section {
            text-align: center;
            margin: 25px 0 15px;
        }

        .course-label {
            font-size: 15px;
            color: #5e5538;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .course-name-box {
            display: inline-block;
            background: linear-gradient(135deg, #1e3a2f 0%, #2c5a4a 100%);
            color: #fdf8e7;
            padding: 12px 35px;
            border-radius: 50px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            border: 1px solid #c9a53b;
        }

        .completion-text {
            font-size: 15px;
            color: #4a4532;
            margin: 20px 0 5px;
            line-height: 1.7;
            text-align: center;
        }

        .gratitude-text {
            font-size: 14px;
            color: #7a6b42;
            margin: 20px 0 10px;
            font-style: italic;
            font-weight: 500;
            text-align: center;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin: 40px 0 25px;
            text-align: center;
        }

        .signature-item {
            flex: 1;
        }

        .signature-line {
            font-family: 'Dancing Script', cursive;
            font-size: 24px;
            font-weight: 500;
            color: #2c3e2f;
            margin-bottom: 8px;
            border-bottom: 1px solid #c9a53b;
            display: inline-block;
            padding-bottom: 5px;
            min-width: 160px;
        }

        .signature-title {
            color: #7a6b42;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .badge-text {
            font-size: 11px;
            color: #c9a53b;
            margin-top: 8px;
            font-weight: bold;
        }

        /* ========== الختم السيبراني المحسن ========== */
        .stamp-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* الختم السيبراني الدائري */
        .cyber-stamp {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            background: linear-gradient(145deg, #0a0f1a, #06090f);
            /* border: 2px solid #00ffcc; */
            /* box-shadow: 0 0 15px rgba(0, 255, 204, 0.5), inset 0 0 8px rgba(0, 255, 204, 0.3); */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            position: relative;
            transition: all 0.3s ease;
        }

        /* تأثير نبض للختم */
        .cyber-stamp::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border-radius: 50%;
            border: 1px solid rgba(0, 255, 204, 0.4);
            animation: pulse 2s ease-out infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
            70% {
                transform: scale(1.12);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        .cyber-stamp i {
            font-size: 30px;
            color: #00ffcc;
            margin-bottom: 3px;
           filter: drop-shadow(0 0 5px #00ffcc);
        }

        .cyber-stamp span {
            font-size: 8px;
            color: #00ffcc;
            text-align: center;
            font-weight: 700;
            letter-spacing: 1.5px;
            font-family: monospace;
        }

        .stamp-text {
            font-size: 10px;
            color: #00aa99;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* نص VERIFIED سيبراني */
        .verified-badge {
            margin-top: 5px;
            font-size: 9px;
            /* color: #00ffcc; */
            background: rgba(0, 255, 204, 0.1);
            padding: 2px 8px;
            border-radius: 20px;
            font-family: monospace;
        }

        .certificate-meta {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e0d5b5;
            text-align: center;
            font-size: 11px;
            color: #8b7a4b;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cert-number {
            font-family: monospace;
            background: #f0ebd8;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .btn-print {
            margin-top: 25px;
            background: #2c3e2f;
            border: none;
            color: #fdf8e7;
            padding: 8px 28px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print:hover {
            background: #1e2a1f;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .btn-print {
                display: none;
            }
            .certificate-wrapper {
                box-shadow: none;
                padding: 40px;
            }
            .cyber-stamp {
                border-color: #2c5a4a;
                background: #f0ebd8;
            }
            .cyber-stamp i, .cyber-stamp span {
                color: #2c5a4a;
            }
            .cyber-stamp::before {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="certificate-wrapper">
    <div class="corner-decoration corner-tl"></div>
    <div class="corner-decoration corner-tr"></div>
    <div class="corner-decoration corner-bl"></div>
    <div class="corner-decoration corner-br"></div>

    <div class="certificate-header">
        <div class="header-title">شهادة تقدير</div>
        <h1 class="certificate-title">CERTIFICATE</h1>
        <div class="certificate-subtitle">OF ACHIEVEMENT</div>
    </div>

    <div class="award-text">
        تُمنح هذه الشهادة إلى / This certificate is awarded to
    </div>

    <div class="student-section">
        <div class="student-name">
            {{ $student->user1->username ?? 'Juliana Silva' }}
        </div>
    </div>

    <div class="course-section">
        <div class="course-label">لإتمامها بنجاح الدورة التدريبية</div>
        <div class="course-name-box">
            <i class="fas fa-microchip" style="margin-left: 8px;"></i>
            {{ $course->course_name ?? 'Cyber Security Fundamentals' }}
        </div>
    </div>

    <div class="completion-text">
        وقد أظهرت التزاماً مميزاً ومهارات عالية خلال فترة التدريب.
    </div>

    <div class="gratitude-text">
        "نقدم هذه الشهادة بكل تقدير، على أمل أن تكون حافزاً لتحقيق المزيد من النجاحات"
    </div>

    <div class="signatures">
        <div class="signature-item">
            <div class="signature-line">
                {{ $course->instructor->user1->username ?? 'ادارة المنصة' }}
            </div>
            <div class="signature-title">instructor</div>
        </div>

        <!-- الختم السيبراني المحسن -->
        <div class="signature-item stamp-container">
            <div class="cyber-stamp">
                <i class="fas fa-fingerprint"></i>
                <span>CYBEReye</span>
                <span style="font-size: 7px;">SECURE v2.0</span>
            </div>
            <div class="stamp-text">ختم موثق رقمياً</div>
            <div class="verified-badge">
                <i class="fas fa-check-circle"></i> VERIFIED
            </div>
        </div>

        <div class="signature-item">
            <div class="signature-line">
               CYBEReye
            </div>
            <div class="signature-title">General Manager</div>
        </div>
    </div>

    <div class="certificate-meta">
        <div class="cert-number">
            <i class="fas fa-hashtag"></i> رقم الشهادة: {{ $certificate->certificate_number ?? 'CY-' . rand(10000, 99999) }}
        </div>
        <div>
            <i class="fas fa-qrcode"></i> بصمة رقمية: 0x{{ substr(md5(rand()), 0, 8) }}
        </div>
        <div>
            <i class="fas fa-calendar-alt"></i> التاريخ: {{ now()->format('Y/m/d') }}
        </div>
    </div>

    <div style="text-align: center;">
        <button class="btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> طباعة الشهادة
        </button>
    </div>
</div>

</body>
</html>