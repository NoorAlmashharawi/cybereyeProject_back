<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | CYBEReye</title>

    <link rel="stylesheet" href="{{ asset('cms/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.css" rel="stylesheet">

    @yield('styles')
</head>

<body>
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <aside class="admin-sidebar">
        <div class="admin-header">
            <div class="admin-logo">
                <i class="fas fa-shield-alt"></i>
                CYBEReye
            </div>
        </div>

        <nav class="admin-menu">
            <div class="admin-menu-section">
                <div class="menu-title">الرئيسية</div>
                <a href="{{ route('main') }}" class="admin-menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>لوحة التحكم</span>
                </a>
            </div>
            <div class="admin-menu-section">
                <div class="menu-title">إدارة المحتوى</div>
            
                <a href="{{ route('roles.index') }}" class="admin-menu-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>الأدوار</span>
                </a>
                <a href="{{ route('roles.create') }}" class="admin-menu-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>إضافة دور جديد</span>
                </a>
            
                <a href="{{ route('permissions.index') }}" class="admin-menu-item">
                    <i class="fas fa-key"></i>
                    <span>الصلاحيات</span>
                </a>
                <a href="{{ route('permissions.create') }}" class="admin-menu-item">
                    <i class="fas fa-plus-square"></i>
                    <span>إضافة صلاحية</span>
                </a>
            
                <a href="{{ route('courses.index') }}" class="admin-menu-item">
                    <i class="fas fa-book-open"></i>
                    <span>الكورسات</span>
                </a>
                <a href="{{ route('categories.index') }}" class="admin-menu-item">
                    <i class="fas fa-tags"></i>
                    <span>التصنيفات</span>
                </a>
                <a href="{{ route('materials.index') }}" class="admin-menu-item">
                    <i class="fas fa-file-download"></i>
                    <span>المواد التعليمية</span>
                </a>
            </div>
            
            <div class="admin-menu-section">
                <div class="menu-title">إدارة المستخدمين</div>
                <a href="{{ route('students.index') }}" class="admin-menu-item">
                    <i class="fas fa-user-graduate"></i>
                    <span>الطلاب</span>
                </a>
                <a href="{{ route('instructors.index') }}" class="admin-menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>المدربون</span>
                </a>
                <a href="{{ route('admins.index') }}" class="admin-menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span>المشرفون</span>
                </a>
            </div>
            
            <div class="admin-menu-section">
                <div class="menu-title">تحكم الطالب</div>
                <a href="{{ route('student.dashboard') }}" class="admin-menu-item">
                    <i class="fas fa-book-reader"></i>
                    <span>كورساتي</span>
                </a>
                <a href="{{ route('student.my-certificates') }}" class="admin-menu-item">
                    <i class="fas fa-certificate"></i>
                    <span>شهاداتي</span>
                </a>
            </div>
            
            <div class="admin-menu-section">
                <div class="menu-title">تحكم المدرب</div>
            
                <a href="{{ route('courses.create') }}" class="admin-menu-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>إنشاء كورس جديد</span>
                </a>
            
                <a href="{{ route('categories.create') }}" class="admin-menu-item">
                    <i class="fas fa-folder-plus"></i>
                    <span>إضافة تصنيف</span>
                </a>
            
                <a href="{{ route('materials.create') }}" class="admin-menu-item">
                    <i class="fas fa-file-upload"></i>
                    <span>رفع مادة تعليمية</span>
                </a>
            
                <a href="{{ route('videos.index') }}" class="admin-menu-item">
                    <i class="fas fa-video"></i>
                    <span>إدارة الفيديوهات</span>
                </a>
            
                <a href="{{ route('quizzs.create') }}" class="admin-menu-item">
                    <i class="fas fa-edit"></i>
                    <span>إنشاء كويز جديد</span>
                </a>
            </div>
        </nav>

        <div class="admin-footer">
            <div class="admin-profile">
                <div class="admin-avatar">م</div>
                <div class="admin-info">
                    <h4>مشرف النظام</h4>
                    <p>admin@cybereye.com</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="admin-main">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('cms/js/admin.js') }}"></script>
    <script src="{{ asset('cms/js/crud.js') }}"></script>

    @yield('scripts')
</body>

</html>
