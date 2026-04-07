<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الطالب | CYBEReye</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cms/css/student.css') }}">
  

    @yield('styles')
</head>
<body>
    <!-- شريط التنقل العلوي -->
    <nav class="student-navbar">
        <div class="nav-left">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>CYBEReye</span>
            </div>
            <span class="student-role">👨‍🎓 لوحة الطالب</span>
        </div>
        
        <div class="nav-right">
            <button class="notification-btn">
                <i class="far fa-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            
            <div class="user-info">
                <div class="user-avatar" id="userAvatar">م</div>
                <div>
                    <div id="userName">محمد أحمد</div>
                    <div id="userEmail" style="font-size: 0.8rem;">student@cybereye.com</div>
                </div>
            </div>
            
            <button class="logout-btn" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i>
                تسجيل الخروج
            </button>
        </div>
    </nav>

    <!-- المحتوى الرئيسي -->
    <div class="student-container">
        <!-- الشريط الجانبي -->
        <aside class="sidebar">
            <div class="sidebar-menu">
                <a href="{{ route('student') }}" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>لوحة التحكم</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span>كورساتي</span>
                </a>

                <a href="#" class="menu-item">
                    <i class="fas fa-certificate"></i>
                    <span>شهاداتي</span>
                </a>


                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>الإعدادات</span>
                </a>
            </div>
        </aside>
        @yield('content')
        </div>
       
   

    <!-- الفوتر -->
    <footer class="student-footer">
        <div class="footer-links">
            <a href="{{ route('home') }}"> الرئيسة</a>
            <a href="{{ route('contact') }}#faq-section">الأسئلة الشائعة</a>
            <a href="{{ route('contact') }}">تواصل معنا </a>
           
        </div>
        <div class="copyright">
            ©  CYBEReye. جميع الحقوق محفوظة.
        </div>
    </footer>
{{-- 
  <script src="{{ asset('cms/js/student.js') }}"></script> --}}
  @yield('scripts')
</body>
</html>