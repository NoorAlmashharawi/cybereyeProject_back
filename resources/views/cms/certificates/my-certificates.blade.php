@extends('cms.parent')

@section('title', 'شهاداتي')

@section('styles')
    <style>
        .certificates-container {
            padding: 20px;
        }
        
        .page-header {
            margin-bottom: 30px;
        }
        
        .page-header h1 {
            font-size: 28px;
            color: #00ffff;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
            margin-bottom: 10px;
        }
        
        .page-header p {
            color: #a8b3cf;
        }
        
        .certificates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }
        
        .certificate-card {
            background: linear-gradient(135deg, #0a0f1e 0%, #0d1428 100%);
            border-radius: 20px;
            border: 1px solid rgba(0, 255, 255, 0.2);
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        
        .certificate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 255, 255, 0.15);
            border-color: rgba(0, 255, 255, 0.5);
        }
        
        .certificate-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 20px;
            text-align: center;
            position: relative;
        }
        
        .certificate-header i {
            font-size: 48px;
            color: #d4af37;
            text-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        
        .certificate-body {
            padding: 20px;
            text-align: center;
        }
        
        .course-name {
            font-size: 18px;
            font-weight: bold;
            color: #00ffff;
            margin-bottom: 10px;
        }
        
        .certificate-number {
            font-size: 12px;
            color: #8892b0;
            font-family: monospace;
            margin-bottom: 15px;
        }
        
        .issue-date {
            font-size: 13px;
            color: #a8b3cf;
            margin-bottom: 20px;
        }
        
        .btn-view {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #0a0f1e 0%, #0d1428 100%);
            border-radius: 20px;
            border: 1px solid rgba(0, 255, 255, 0.2);
        }
        
        .empty-state i {
            font-size: 64px;
            color: #00ffff;
            opacity: 0.5;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            color: #00ffff;
            margin-bottom: 10px;
        }
        
        .empty-state p {
            color: #8892b0;
        }
        
        .pagination {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }
        
        .pagination .page-link {
            background: #0d1428;
            border-color: rgba(0, 255, 255, 0.2);
            color: #00ffff;
        }
        
        .pagination .page-link:hover {
            background: #00ffff;
            color: #0d1428;
        }
    </style>
@endsection

@section('content')
<div class="certificates-container">
    <div class="page-header">
        <h1><i class="fas fa-certificate"></i> شهاداتي</h1>
        <p>جميع الشهادات التي حصلت عليها بعد إتمام الكورسات بنجاح</p>
    </div>
    
    @if($certificates->count() > 0)
        <div class="certificates-grid">
            @foreach($certificates as $cert)
                <div class="certificate-card" onclick="window.location.href='{{ route('certificate.show', $cert->id) }}'">
                    <div class="certificate-header">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="certificate-body">
                        <div class="course-name">
                            {{ $cert->course_name ?? $cert->course->course_name ?? 'كورس' }}
                        </div>
                        <div class="certificate-number">
                            <i class="fas fa-hashtag"></i> {{ $cert->certificate_number }}
                        </div>
                        <div class="issue-date">
                            <i class="fas fa-calendar-alt"></i> 
                            {{ \Carbon\Carbon::parse($cert->issue_date)->format('Y/m/d') }}
                        </div>
                        <a href="{{ route('certificate.show', $cert->id) }}" class="btn-view">
                            <i class="fas fa-eye"></i> عرض الشهادة
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="pagination">
            {{ $certificates->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-certificate"></i>
            <h3>لا توجد شهادات بعد</h3>
            <p>قم بإتمام الكورسات بنجاح للحصول على شهاداتك الأولى</p>
            <a href="{{ route('student.dashboard') }}" class="btn-view" style="margin-top: 20px;">
                <i class="fas fa-book-open"></i> استعرض الكورسات
            </a>
        </div>
    @endif
</div>
@endsection