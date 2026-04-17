<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>شهادة حضور</title>

    <style>
        @page { size: landscape; margin: 1cm; }

        body {
            font-family: DejaVu Sans, sans-serif;
            background: white;
        }

        .certificate {
            border: 15px double #d4af37;
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #d4af37;
            font-size: 42px;
        }

        .name {
            font-size: 30px;
            color: #27ae60;
            margin: 20px 0;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="certificate">

    <h1>شهادة حضور</h1>

    <p>تشهد منصة</p>
    <div>{{ $platform ?? 'Cyber Eye' }}</div>

    <p>بأن</p>
    <div class="name">
        {{ $student->first_name ?? '' }} {{ $student->last_name ?? '' }}
    </div>

    <p>أنهى كورس</p>
    <div>{{ $course->name ?? '' }}</div>

    <p>بإشراف</p>
    <div>{{ $instructor->first_name ?? '' }} {{ $instructor->last_name ?? '' }}</div>

    <hr>

    <p>
        <strong>رقم الشهادة:</strong>
        {{ $certificate->certificate_number ?? '' }}
    </p>

    <p>
        <strong>التاريخ:</strong>
        {{ $date ?? now()->format('Y-m-d') }}
    </p>

</div>

</body>
</html>