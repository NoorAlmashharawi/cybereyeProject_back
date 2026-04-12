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
                <a href="{{ route('courses.index') }}" class="admin-menu-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span>الكورسات</span>
                </a>
                <a href="#" class="admin-menu-item">
                    <i class="fas fa-tags"></i>
                    <span>التصنيفات</span>
                </a>
                <a href="#" class="admin-menu-item">
                    <i class="fas fa-file-download"></i>
                    <span>المواد التعليمية</span>
                </a>
            </div>

            <div class="admin-menu-section">
                <div class="menu-title">إدارة المستخدمين</div>
                <a href="{{ route('students.index') }}" class="admin-menu-item">
                    <i class="fas fa-users"></i>
                    <span>الطلاب</span>
                </a>
                <a href="{{ route('instructors.index') }}" class="admin-menu-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>المدربون</span>
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