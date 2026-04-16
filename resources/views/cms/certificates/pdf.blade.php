<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>شهادة حضور - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            size: landscape;
            margin: 1cm;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: white;
        }
        
        .certificate {
            border: 15px double #d4af37;
            padding: 40px;
            text-align: center;
            min-height: 500px;
            background: #fff;
        }
        
        h1 {
            font-size: 48px;
            color: #d4af37;
            margin: 30px 0;
        }
        
        .platform-name {
            font-size: 32px;
            color: #2c3e50;
            font-weight: bold;
            margin: 15px 0;
        }
        
        .student-name {
            font-size: 36px;
            color: #27ae60;
            font-weight: bold;
            margin: 30px 0;
            border-bottom: 2px solid #27ae60;
            display: inline-block;
            padding: 0 30px;
        }
        
        .course-name {
            font-size: 28px;
            color: #3498db;
            font-weight: bold;
            margin: 20px 0;
        }
        
        .instructor-name {
            font-size: 24px;
            color: #e67e22;
            margin: 15px 0;
        }
        
        .certificate-text {
            font-size: 20px;
            color: #555;
            margin: 10px 0;
        }
        
        .footer {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px dashed #ccc;
        }
        
        .certificate-number {
            font-size: 12px;
            color: #999;
        }
        
        .signature-img {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        
        {{-- Title --}}
        <h1>شهادة حضور</h1>
        
        <p class="certificate-text">تشهد منصة</p>
        <div class="platform-name">{{ $platform }}</div>
        
        <p class="certificate-text">بأن</p>
        <div class="student-name">{{ $student->first_name }} {{ $student->last_name }}</div>
        
        <p class="certificate-text">قد أتم بنجاح كورس</p>
        <div class="course-name">{{ $course->name }}</div>
        
        <p class="certificate-text">بتقديم المدرب</p>
        <div class="instructor-name">{{ $instructor->first_name }} {{ $instructor->last_name }}</div>
        
        {{-- Footer --}}
        <div class="footer">
            <div style="float: left; text-align: left;">
                <p><strong>تاريخ الإصدار:</strong> {{ $date }}</p>
            </div>
            <div style="float: right; text-align: right;">
                <p><strong>رقم الشهادة:</strong> {{ $certificate->certificate_number }}</p>
            </div>
            <div style="clear: both;"></div>
            
            {{-- <div class="signature-img">
                <img src="{{ public_path('images/signature.png') }}" width="150">
                <p>مدير المنصة</p>
            </div> --}}
        </div>
        
        <div class="certificate-number mt-3">
            صادرة عن منصة Cyber Eye التعليمية
        </div>
    </div>
</body>
</html>