@extends('cms.studentDash.parent')



@section('title', 'صفحة الطالب')


@section('styles')

@endsection

@section('content')

 
    <!-- المحتوى الرئيسي -->
    <main class="main-content">
        <!-- بطاقة الترحيب -->

        <div class="welcome-card">
            <p>استمر في رحلتك التعليمية واكتشف كورسات جديدة في عالم الأمن السيبراني</p>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="stat-number" id="coursesCount">3</div>
                <div class="stat-label">كورسات مسجلة</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number" id="studyHours">45</div>
                <div class="stat-label">ساعة دراسة</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stat-number" id="certificatesCount">1</div>
                <div class="stat-label">شهادات مكتملة</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-number" id="averageProgress">85%</div>
                <div class="stat-label">معدل التقدم</div>
            </div>
        </div>

        <!-- الكورسات النشطة -->
        <div class="courses-section">
            <div class="section-header">
                <h2>كورساتي النشطة</h2>
                <button class="view-all-btn"  onclick="goToMyCourses()">عرض جميع الكورسات</button>
            </div>
            
            <div class="courses-grid" id="activeCourses">
                <!-- الكورسات تظهر هنا -->
            </div>
        </div>

 
    </main>


@endsection

@section('scripts')

@endsection