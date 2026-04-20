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
    <style>
        body {
            background: #0a0e27;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        
        .admin-menu {
            padding: 20px;
            background: linear-gradient(135deg, #0a0f1e 0%, #0d1428 100%);
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 255, 255, 0.1), 0 0 20px rgba(0, 255, 255, 0.05);
            border: 1px solid rgba(0, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }
        
        .admin-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00ffff, #00ff88, #00ffff, transparent);
            animation: scan 3s linear infinite;
        }
        
        @keyframes scan {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* عناوين الأقسام */
        .menu-title {
            font-size: 13px;
            font-weight: 700;
            color: #00ffff;
            padding: 15px 0 8px 0;
            margin-top: 10px;
            border-bottom: 1px solid rgba(0, 255, 255, 0.3);
            letter-spacing: 2px;
            text-transform: uppercase;
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.5);
            position: relative;
        }
        
        .menu-title::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 50px;
            height: 2px;
            background: #00ffff;
            box-shadow: 0 0 10px #00ffff;
        }
        
        .menu-title:first-of-type {
            margin-top: 0;
        }
        
        /* العنصر العادي */
        .admin-menu-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            margin: 5px 0;
            color: #a8b3cf;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
        }
        
        .admin-menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .admin-menu-item:hover::before {
            left: 100%;
        }
        
        .admin-menu-item i {
            margin-left: 12px;
            width: 22px;
            font-size: 16px;
            transition: all 0.3s ease;
            color: #00ffff;
            text-shadow: 0 0 3px #00ffff;
        }
        
        .admin-menu-item span {
            font-size: 14px;
            font-weight: 500;
        }
        
        .admin-menu-item:hover {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.1) 0%, rgba(0, 255, 136, 0.05) 100%);
            color: #00ffff;
            transform: translateX(-5px);
            border-color: rgba(0, 255, 255, 0.3);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
        }
        
        .admin-menu-item:hover i {
            color: #00ff88;
            text-shadow: 0 0 8px #00ff88;
        }
        
        .admin-menu-item.active {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.15) 0%, rgba(0, 255, 136, 0.1) 100%);
            color: #00ffff;
            border-color: rgba(0, 255, 255, 0.5);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.5);
        }
        
        .admin-menu-item.active i {
            color: #00ff88;
            text-shadow: 0 0 10px #00ff88;
        }
        
        /* ========== القوائم المنسدلة السيبرانية ========== */
        .dropdown-menu-item {
            position: relative;
            margin: 5px 0;
        }
        
        .dropdown-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 10px 15px;
            background: linear-gradient(135deg, rgba(10, 20, 40, 0.8) 0%, rgba(5, 15, 30, 0.9) 100%);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #a8b3cf;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .dropdown-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .dropdown-btn:hover::before {
            left: 100%;
        }
        
        .dropdown-btn:hover {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.1) 0%, rgba(0, 255, 136, 0.05) 100%);
            color: #00ffff;
            border-color: rgba(0, 255, 255, 0.5);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
        }
        
        .dropdown-btn:hover i {
            color: #00ff88;
            text-shadow: 0 0 5px #00ff88;
        }
        
        .dropdown-btn span i {
            margin-left: 12px;
            width: 22px;
            font-size: 16px;
            color: #00ffff;
            text-shadow: 0 0 3px #00ffff;
        }
        
        .dropdown-btn .arrow {
            transition: transform 0.3s ease;
            font-size: 12px;
            color: #00ffff;
        }
        
        .dropdown-btn.active {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.15) 0%, rgba(0, 255, 136, 0.1) 100%);
            border-color: rgba(0, 255, 255, 0.6);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }
        
        .dropdown-btn.active .arrow {
            transform: rotate(180deg);
            color: #00ff88;
        }
        
        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, rgba(5, 15, 30, 0.95) 0%, rgba(10, 20, 40, 0.95) 100%);
            border-radius: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
            border: 1px solid rgba(0, 255, 255, 0.1);
            position: relative;
        }
        
        .dropdown-content.show {
            max-height: 500px;
        }
        
        .dropdown-content a {
            display: flex;
            align-items: center;
            padding: 8px 15px 8px 40px;
            color: #8892b0;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s ease;
            border-right: 3px solid transparent;
            position: relative;
        }
        
        .dropdown-content a::before {
            content: '>';
            position: absolute;
            left: 20px;
            opacity: 0;
            transition: all 0.3s ease;
            color: #00ffff;
        }
        
        .dropdown-content a i {
            margin-left: 12px;
            width: 20px;
            font-size: 13px;
            color: #00ffff;
            text-shadow: 0 0 3px #00ffff;
        }
        
        .dropdown-content a:hover {
            background: linear-gradient(90deg, rgba(0, 255, 255, 0.1) 0%, transparent 100%);
            color: #00ffff;
            border-right-color: #00ffff;
            padding-right: 40px;
            text-shadow: 0 0 3px rgba(0, 255, 255, 0.5);
        }
        
        .dropdown-content a:hover::before {
            opacity: 1;
            left: 15px;
        }
        
        .dropdown-content a:hover i {
            color: #00ff88;
            text-shadow: 0 0 8px #00ff88;
        }
        
        /* شريط التمرير المخصص */
        .admin-menu::-webkit-scrollbar {
            width: 5px;
        }
        
        .admin-menu::-webkit-scrollbar-track {
            background: rgba(0, 255, 255, 0.05);
            border-radius: 10px;
        }
        
        .admin-menu::-webkit-scrollbar-thumb {
            background: #00ffff;
            border-radius: 10px;
            box-shadow: 0 0 5px #00ffff;
        }
        
        /* تأثير النيون عند التمرير */
        @keyframes neonPulse {
            0% { box-shadow: 0 0 5px rgba(0, 255, 255, 0.5); }
            50% { box-shadow: 0 0 20px rgba(0, 255, 255, 0.8); }
            100% { box-shadow: 0 0 5px rgba(0, 255, 255, 0.5); }
        }
        
        .admin-menu-item:hover,
        .dropdown-btn:hover {
            animation: neonPulse 1s infinite;
        }
        
        /* ========== التجاوب مع الشاشات الصغيرة ========== */
        @media (max-width: 768px) {
            .admin-menu {
                padding: 15px;
            }
            
            .admin-menu-item,
            .dropdown-btn {
                padding: 8px 12px;
                font-size: 13px;
            }
            
            .admin-menu-item i,
            .dropdown-btn span i {
                width: 20px;
                font-size: 14px;
            }
            
            .dropdown-content a {
                padding: 6px 15px 6px 35px;
                font-size: 12px;
            }
        }
        
        /* تأثير الشاشة السيبرانية */
        @keyframes glitch {
            0% { text-shadow: 0.05em 0 0 rgba(255, 0, 0, 0.5), -0.05em -0.025em 0 rgba(0, 255, 255, 0.5); }
            14% { text-shadow: 0.05em 0 0 rgba(255, 0, 0, 0.5), -0.05em -0.025em 0 rgba(0, 255, 255, 0.5); }
            15% { text-shadow: -0.05em -0.025em 0 rgba(255, 0, 0, 0.5), 0.025em 0.025em 0 rgba(0, 255, 255, 0.5); }
            49% { text-shadow: -0.05em -0.025em 0 rgba(255, 0, 0, 0.5), 0.025em 0.025em 0 rgba(0, 255, 255, 0.5); }
            50% { text-shadow: 0.025em 0.05em 0 rgba(255, 0, 0, 0.5), 0.05em 0 0 rgba(0, 255, 255, 0.5); }
            99% { text-shadow: 0.025em 0.05em 0 rgba(255, 0, 0, 0.5), 0.05em 0 0 rgba(0, 255, 255, 0.5); }
            100% { text-shadow: -0.025em 0 0 rgba(255, 0, 0, 0.5), -0.025em -0.025em 0 rgba(0, 255, 255, 0.5); }
        }
        
        /* مصفوفة الخلفية (Matrix Effect) */
        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.05;
            pointer-events: none;
        }

        /* ========== جعل القائمة الجانبية قابلة للتمرير ========== */
.admin-menu {
    padding: 20px;
    background: linear-gradient(135deg, #0a0f1e 0%, #0d1428 100%);
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0, 255, 255, 0.1), 0 0 20px rgba(0, 255, 255, 0.05);
    border: 1px solid rgba(0, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    position: relative;
    overflow-y: auto;  /* جعل القائمة قابلة للتمرير عموديًا */
    overflow-x: hidden; /* إخفاء التمرير الأفقي */
    max-height: calc(100vh - 40px); /* أقصى ارتفاع مناسب للشاشة */
    scroll-behavior: smooth; /* تمرير سلس */
}

/* تخصيص شريط التمرير للقائمة الجانبية */
.admin-menu::-webkit-scrollbar {
    width: 6px; /* عرض شريط التمرير */
}

.admin-menu::-webkit-scrollbar-track {
    background: rgba(0, 255, 255, 0.05); /* لون مسار التمرير */
    border-radius: 10px;
    margin: 10px 0; /* مسافة من الأعلى والأسفل */
}

.admin-menu::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #00ffff, #00ff88); /* لون شريط التمرير المتدرج */
    border-radius: 10px;
    box-shadow: 0 0 5px #00ffff; /* تأثير النيون */
}

.admin-menu::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #00ff88, #00ffff);
    box-shadow: 0 0 10px #00ffff; /* تكبير تأثير النيون عند المرور */
}

/* لإخفاء شريط التمرير عندما لا يتم التمرير (اختياري) */
.admin-menu {
    scrollbar-width: thin; /* للـ Firefox */
    scrollbar-color: #00ffff rgba(0, 255, 255, 0.05); /* للـ Firefox */
}

/* تأثير لمعان عند التمرير */
.admin-menu::-webkit-scrollbar-thumb:hover {
    background: #00ff88;
    box-shadow: 0 0 8px #00ff88;
}

/* إضافة تدرج في نهاية القائمة (تأثير بصري) */
.admin-menu::after {
    content: '';
    position: sticky;
    bottom: 0;
    left: 0;
    right: 0;
    height: 30px;
    background: linear-gradient(to top, #0a0f1e, transparent);
    pointer-events: none;
    display: none; /* فعّل هذا السطر إذا أردت تأثير التدرج */
}
    </style>
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
    <!-- قسم الرئيسية -->
    <div class="admin-menu-section">
        <div class="menu-title">الرئيسية</div>
        <a href="{{ route('main') }}" class="admin-menu-item active">
            <i class="fas fa-tachometer-alt"></i>
            <span>لوحة التحكم</span>
        </a>
    </div>

    <!-- قسم إدارة المحتوى -->
    <div class="menu-title">إدارة المحتوى</div>

    <!-- الأدوار والصلاحيات - منسدل -->
    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-shield-alt"></i>
                <span>الأدوار والصلاحيات</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            <a href="{{ route('roles.index') }}">
                <i class="fas fa-shield-alt"></i>
                <span>الأدوار</span>
            </a>
            <a href="{{ route('roles.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة دور جديد</span>
            </a>
            <a href="{{ route('permissions.index') }}">
                <i class="fas fa-key"></i>
                <span>الصلاحيات</span>
            </a>
            <a href="{{ route('permissions.create') }}">
                <i class="fas fa-plus-square"></i>
                <span>إضافة صلاحية</span>
            </a>
        </div>
    </div>

    <!-- الكورسات - منسدل -->
    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-book-open"></i>
                <span>الكورسات</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>

        <div class="dropdown-content">
            {{-- @can('index-course') --}}
            <a href="{{ route('courses.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع الكورسات</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('create-course') --}}
            <a href="{{ route('courses.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة كورس جديد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <!-- التصنيفات - منسدل -->
    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-tags"></i>
                <span>التصنيفات</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
{{-- 
            @can('index-category') --}}
            <a href="{{ route('categories.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع التصنيفات</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('create-category') --}}
            <a href="{{ route('categories.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة تصنيف جديد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <!-- المواد التعليمية - منسدل -->
    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-file-download"></i>
                <span>المواد التعليمية</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('index-material') --}}
            <a href="{{ route('materials.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع المواد</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('create-material') --}}
            <a href="{{ route('materials.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>رفع مادة جديدة</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <!-- قسم إدارة المستخدمين -->
    <div class="menu-title">إدارة المستخدمين</div>

    <!-- الطلاب - منسدل -->
    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-user-graduate"></i>
                <span>الطلاب</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('index-student') --}}
            <a href="{{ route('students.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع الطلاب</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('create-student') --}}
            <a href="{{ route('students.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة طالب جديد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <!-- المدربون - منسدل -->
    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-chalkboard-teacher"></i>
                <span>المدربون</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('index-instuctor') --}}
            <a href="{{ route('instructors.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع المدربين</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('create-instuctor') --}}
            <a href="{{ route('instructors.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة مدرب جديد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <!-- المشرفون - منسدل -->
    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-user-cog"></i>
                <span>المشرفون</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('index-admin') --}}
            <a href="{{ route('admins.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع المشرفين</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('create-admin') --}}
            <a href="{{ route('admins.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة مشرف جديد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <!-- قسم تحكم الطالب -->
 
<div class="menu-title">تحكم الطالب</div>

<div class="dropdown-menu-item">
    <button class="dropdown-btn" onclick="toggleDropdown(this)">
        <span>
            <i class="fas fa-book-reader"></i>
            <span>كورساتي</span>
        </span>
        <i class="fas fa-chevron-down arrow"></i>
    </button>
    <div class="dropdown-content">
        {{-- @can('index-course') --}}
        <a href="{{ route('student.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>كورساتي</span>
        </a>
        {{-- @endcan --}}
    </div>
</div>


 
        <span>
            <a href="{{ route('student.my-certificates') }}">
            <i class="fas fa-certificate"></i>
            <span>شهاداتي</span>
        </span>
        

 


   
    <!-- قسم تحكم المدرب -->
    <div class="menu-title">تحكم المدرب</div>
  
    <div class="dropdown-menu-item">
      
                   <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-chalkboard-teacher"></i>
                <span>إدارة الكورسات</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('create-course') --}}
            <a href="{{ route('courses.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إنشاء كورس جديد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>
  

    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-tags"></i>
                <span>التصنيفات</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('create-category') --}}
            <a href="{{ route('categories.create') }}">
                <i class="fas fa-folder-plus"></i>
                <span>إضافة تصنيف</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('index-category') --}}
            <a href="{{ route('categories.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع التصنيفات</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-file-upload"></i>
                <span>المواد التعليمية</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('create-material') --}}
            <a href="{{ route('materials.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>رفع مادة تعليمية</span>
            </a>
            {{-- @endcan
            @can('index-material') --}}
            <a href="{{ route('materials.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع المواد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-video"></i>
                <span>الفيديوهات</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            <a href="{{ route('videos.index') }}">
                <i class="fas fa-list"></i>
                <span>إدارة الفيديوهات</span>
            </a>
            {{-- @can('create-video') --}}
            <a href="{{ route('videos.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة فيديو جديد</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>

    <div class="dropdown-menu-item">
        <button class="dropdown-btn" onclick="toggleDropdown(this)">
            <span>
                <i class="fas fa-edit"></i>
                <span>الكويزات</span>
            </span>
            <i class="fas fa-chevron-down arrow"></i>
        </button>
        <div class="dropdown-content">
            {{-- @can('create-quiz') --}}
            <a href="{{ route('quizzs.create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>إنشاء كويز جديد</span>
            </a>
            {{-- @endcan
            @can('index-quiz') --}}
            <a href="{{ route('quizzs.index') }}">
                <i class="fas fa-list"></i>
                <span>جميع الكويزات</span>
            </a>
            {{-- @endcan --}}
        </div>
    </div>
</nav>

        <div class="admin-footer">
            <div class="admin-profile">
                <div class="admin-avatar">م</div>
                <div class="admin-info">
                    <h4> المستخدم</h4>
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
    <script>
        function toggleDropdown(btn) {
            btn.classList.toggle('active');
            let content = btn.nextElementSibling;
            content.classList.toggle('show');
        }
        
        // إغلاق القوائم عند الضغط خارجها
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown-menu-item')) {
                document.querySelectorAll('.dropdown-content').forEach(function(content) {
                    content.classList.remove('show');
                });
                document.querySelectorAll('.dropdown-btn').forEach(function(btn) {
                    btn.classList.remove('active');
                });
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
