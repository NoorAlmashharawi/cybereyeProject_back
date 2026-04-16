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
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .certificate-wrapper {
            max-width: 1000px;
            width: 100%;
        }
        
        .certificate-box {
            border: 15px double #d4af37;
            border-radius: 20px;
            background: linear-gradient(135deg, #fff8e7 0%, #fff 100%);
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
            margin: 15px 0;
        }
        
        .student-name {
            font-size: 36px;
            color: #27ae60;
            font-weight: bold;
            margin: 30px 0;
            border-bottom: 3px solid #27ae60;
            display: inline-block;
            padding: 0 30px 10px;
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
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px dashed #ccc;
        }
        
        .signature-section {
            margin-top: 30px;
        }
        
        .certificate-footer {
            margin-top: 30px;
            color: #999;
            font-size: 12px;
        }
        
        .btn-group {
            margin-top: 30px;
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 5px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: inherit;
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background: #27ae60;
            color: white;
        }
        
        .btn-success:hover {
            background: #229954;
            transform: translateY(-2px);
        }
        
        @media print {
            .btn-group {
                display: none;
            }
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .certificate-box {
                box-shadow: none;
                border: 2px solid #000;
                background: white;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-wrapper">
        <div class="certificate-box">
            
            <h1 class="certificate-title">شهادة حضور</h1>
            
            <p class="certificate-text">تشهد منصة</p>
            <h2 class="platform-name">Cyber Eye</h2>
            
            <p class="certificate-text">بأن</p>
            <h3 class="student-name">
                {{ $certificate->student->username ?? $certificate->student->username ?? 'طالب' }}
            </h3>
            
            <p class="certificate-text">قد أتم بنجاح كورس</p>
            <h3 class="course-name">{{ $certificate->course->course_name ?? $certificate->course->name ?? 'كورس' }}</h3>
            
            <p class="certificate-text">بتقديم المدرب</p>
            <h4 class="instructor-name">
                {{ $certificate->instructor->username ?? '' }} 
              
            </h4>
            
            <div class="info-row">
                <div style="text-align: left;">
                    <strong>تاريخ الإصدار:</strong> 
                    {{ \Carbon\Carbon::parse($certificate->issued_date)->format('Y/m/d') }}
                </div>
                <div style="text-align: right;">
                    <strong>رقم الشهادة:</strong> 
                    {{ $certificate->certificate_number }}
                </div>
            </div>
            
         
            
            <div class="certificate-footer">
                صادرة عن منصة Cyber Eye التعليمية
            </div>
        </div>

        <div class="btn-group">
            <button onclick="window.print()" class="btn btn-secondary">
                 طباعة
            </button>
       
        </div>
    </div>
</body>
</html>