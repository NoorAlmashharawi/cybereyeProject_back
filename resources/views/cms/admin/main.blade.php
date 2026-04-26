@extends('cms.parent')

@section('title', 'Admin')
@section('main-title', 'لوحة التحكم')
@section('sub-title', 'مرحباً بك في لوحة التحكم')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/main.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.css" rel="stylesheet">
@endsection

@section('content')

@if(auth('admin')->check())
<!-- شريط الأدوات العلوي -->
<div class="admin-toolbar">
    <div class="toolbar-title">
        <h1>لوحة تحكم المشرف</h1>
        <p>مرحباً بعودتك، يمكنك إدارة جميع جوانب المنصة من هنا</p>
    </div>

    <!-- إشعارات -->
    <div class="admin-notifications dropdown" style="position: relative;">
        <button class="notification-btn dropdown-toggle" id="notificationButton" style="background: none; border: none; cursor: pointer; position: relative;">
            <i class="far fa-bell" style="font-size: 1.5rem; color: #4361ee;"></i>
            @if(auth('admin')->check() && auth('admin')->user()->unreadNotifications->count() > 0)
                <span class="badge badge-danger navbar-badge" style="position: absolute; top: -5px; right: -5px; font-size: 10px; background: red; color: white; border-radius: 50%; padding: 2px 5px;">
                    {{ auth('admin')->user()->unreadNotifications->count() }}
                </span>
            @endif
        </button>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificationMenu"
             style="display: none; position: absolute; left: 0; top: 40px; min-width: 300px; background: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999;">
            <span class="dropdown-header font-weight-bold" style="display: block; padding: 10px; border-bottom: 1px solid #eee;">الإشعارات الجديدة</span>
            <div style="max-height: 350px; overflow-y: auto;">
                @if(auth('admin')->check())
                    @forelse(auth('admin')->user()->unreadNotifications->take(10) as $notification)
                        <a href="{{ route('openNotification', $notification->id) }}" class="dropdown-item d-flex align-items-center" style="display: flex; padding: 10px; border-bottom: 1px solid #eee; text-decoration: none; color: #333; gap: 10px;">
                            <div class="icon-circle text-white p-2" style="border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; background: {{ isset($notification->data['contact_id']) ? '#28a745' : '#4361ee' }}; color: white;">
                                <i class="{{ $notification->data['icon'] ?? 'fas fa-bell' }}"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="small text-muted" style="font-size: 0.75rem; color: #888;">{{ $notification->created_at->diffForHumans() }}</div>
                                <span class="font-weight-bold d-block" style="font-weight: bold; display: block;">{{ $notification->data['title'] ?? 'إشعار جديد' }}</span>
                                <p class="mb-0 text-sm text-gray-600" style="margin: 0; font-size: 0.85rem; color: #666;">{{ $notification->data['message'] ?? '' }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="dropdown-item text-center text-muted py-3" style="padding: 20px; text-align: center; color: #999;">
                            لا توجد إشعارات غير مقروءة
                        </div>
                    @endforelse
                @endif
            </div>
        </div>
    </div>

    <div>
        <a href="{{ route('view.logout') }}">
            <i class="nav-icon fas fa-sign-out-alt"></i>
        </a>
        <p>logout</p>
    </div>
</div>

<!-- إحصائيات سريعة -->
<div class="quick-stats">
    <div class="stat-card users">
        <div class="stat-content">
            <div class="stat-icon users">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3 id="tot">{{ $totalUsers ?? 0 }}</h3>
                <p>إجمالي المستخدمين</p>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="stat-card courses">
        <div class="stat-content">
            <div class="stat-icon courses">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-info">
                <h2>{{ $activeCourses ?? 0 }}</h2>
                <p>الكورسات النشطة</p>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>{{ $newCoursesCount ?? 0 }} كورسات جديدة</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- المخططات والرسوم البيانية -->
<div class="charts-section">
    <div class="chart-card">
        <div class="chart-header">
            <h3>تسجيلات المستخدمين</h3>
            <div class="chart-period">
                <button class="period-btn active">أسبوعي</button>
                <button class="period-btn">شهري</button>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="registrationsChart"></canvas>
        </div>
    </div>
</div>

<!-- الجداول -->
<div class="tables-section">
    <div class="table-container">
        <h3>الطلبة المنضمين حديثا</h3>
        <table id="studentsTable">
            <thead>
                <tr>
                    <th><i class="fas fa-sort"></i> المعرف</th>
                    <th><i class="fas fa-sort"></i> اسم الطالب</th>
                    <th><i class="fas fa-sort"></i> الايميل</th>
                    <th><i class="fas fa-sort"></i> مستوى المهارة</th>
                    <th><i class="fas fa-sort"></i> التخصص</th>
                    <th><i class="fas fa-sort"></i> الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newStudents ?? [] as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->user1->username ?? 'غير محدد' }}</td>
                    <td>{{ $student->user1->email ?? 'غير محدد' }}</td>
                    <td>{{ $student->level }}</td>
                    <td>{{ $student->specialization }}</td>
                    <td>
                        @if($student->status == 'active')
                            <span class="badge bg-success">نشط</span>
                        @elseif($student->status == 'inactive')
                            <span class="badge bg-secondary">غير نشط</span>
                        @elseif($student->status == 'suspended')
                            <span class="badge bg-warning">موقوف</span>
                        @elseif($student->status == 'graduated')
                            <span class="badge bg-info">متخرج</span>
                        @else
                            <span class="badge bg-dark">{{ $student->status }}</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="{{ route('students.show', $student->id) }}" class="btn-action btn-info" title="عرض التفاصيل">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn-action btn-primary" title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn-action btn-danger" title="حذف" onclick="performDestroy({{ $student->id }}, this)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- جدول الكورسات الأكثر شعبية -->
    <div class="table-card">
        <div class="table-header">
            <h3>الكورسات الأكثر شعبية</h3>
            <div class="table-actions">
                <button class="table-action-btn" title="تحديث">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>اسم الكورس</th>
                        <th>المدرب</th>
                        <th>التصنيف</th>
                        <th>عدد الطلاب</th>
                        <th>المستوى</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses ?? [] as $course)
                    <tr>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->instructor->user1->username ?? 'بدون مدرب' }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $course->category->title ?? 'غير مصنف' }}</span>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $course->students_count }} طالب</span>
                        </td>
                        <td>
                            @if($course->level == 'beginner')
                                <span class="badge bg-success">مبتدئ</span>
                            @elseif($course->level == 'intermediate')
                                <span class="badge bg-warning text-dark">متوسط</span>
                            @elseif($course->level == 'advanced')
                                <span class="badge bg-danger">متقدم</span>
                            @else
                                <span class="badge bg-info">{{ $course->level }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $course->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $course->status == 'active' ? 'نشط' : 'معطل' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons" style="display: flex; gap: 10px;">
                                <a href="{{ route('courses.show', $course->id) }}" style="color: #17a2b8;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('courses.edit', $course->id) }}" style="color: #ffc107;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmDelete('{{ $course->id }}', this)" style="color: #dc3545; background: none; border: none; cursor: pointer;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@if(auth('instructor')->check())
<div class="instructor-modern-dashboard" dir="rtl" style="padding: 10px; font-family: 'Cairo', sans-serif;">

    <div style="background: linear-gradient(135deg, #1e293b 0%, #4361ee 100%); border-radius: 24px; padding: 40px; color: white; margin-bottom: 30px; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(67, 97, 238, 0.25);">
        <div style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1;">
            <div style="display: flex; align-items: center; gap: 25px;">
                <div style="width: 85px; height: 85px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.2); overflow: hidden;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=4361ee&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div>
                    <span style="background: rgba(255, 255, 255, 0.2); padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; color: #fff; font-weight: 600;">لوحة المدرب</span>
                    <h1 style="margin: 10px 0 5px 0; font-weight: 800; font-size: 2rem;">مرحباً بك، أ. {{ $user->username }} ✨</h1>
                    <p style="opacity: 0.9; font-size: 1.1rem; font-weight: 300;">طلابك بانتظار إبداعك وتوجيهك اليوم في المساقات التعليمية.</p>
                </div>
            </div>

            <div style="position: relative; z-index: 2;">
                <a href="{{ route('view.logout') }}" style="background: rgba(255,255,255,0.1); color: white; padding: 10px 20px; border-radius: 12px; text-decoration: none; font-size: 0.9rem; font-weight: 600; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                    تسجيل الخروج <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>
                </a>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 25px; margin-bottom: 40px;">
        <div style="background: white; border-radius: 20px; padding: 25px; display: flex; align-items: center; gap: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
            <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #4361ee, #4895ef); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="fas fa-book-open"></i></div>
            <div>
                <h4 style="margin: 0; color: #64748b; font-size: 0.95rem;">كورساتي</h4>
                <div style="font-size: 1.7rem; font-weight: 800; color: #1e293b;">{{ $instructorCourses->count() }}</div>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 25px; display: flex; align-items: center; gap: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
            <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #4cc9f0, #4361ee); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="fas fa-clock"></i></div>
            <div>
                <h4 style="margin: 0; color: #64748b; font-size: 0.95rem;">إجمالي عدد الساعات </h4>
                <div style="font-size: 1.7rem; font-weight: 800; color: #1e293b;">{{ $totalHours }} ساعة</div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
        <div style="width: 5px; height: 25px; background: #4361ee; border-radius: 10px;"></div>
        <h3 style="font-weight: 800; color: #1e293b; margin: 0;"> الكورسات التي أقدمها</h3>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
        @foreach($instructorCourses as $course)
            <div style="background: white; border-radius: 24px; overflow: hidden; border: 1px solid #f1f5f9; box-shadow: 0 10px 20px rgba(0,0,0,0.02);">
                <div style="height: 8px; background: linear-gradient(90deg, #4361ee, #7209b7);"></div>
                <div style="padding: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <h4 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 1.2rem; line-height: 1.4;">{{ $course->course_name }}</h4>
                        <span style="background: #eef2ff; color: #4361ee; padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; font-weight: 700;">
                            <i class="fas fa-clock" style="margin-left: 4px;"></i> {{ $course->no_hours }} ساعة
                        </span>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px; color: #64748b; font-size: 0.9rem;">
                            <i class="fas fa-hourglass-half" style="color: #4361ee; width: 20px;"></i>
                            <span>مدة الكورس: <strong>{{ $course->no_hours }} ساعة</strong></span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: #64748b; font-size: 0.9rem;">
                            <i class="fas fa-layer-group" style="color: #4361ee; width: 20px;"></i>
                            <span>المستوى: <strong>{{ $course->level ?? 'متوسط' }}</strong></span>
                        </div>
                    </div>

                    <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between;">
                         @if($course->status == 'active' || $course->status == 'نشط')
                            <span style="font-size: 0.8rem; font-weight: 700; color: #10b981; display: flex; align-items: center; gap: 5px;">
                                <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; display: inline-block; box-shadow: 0 0 8px #10b981;"></span>
                                متاح الآن للطلاب
                            </span>
                         @else
                            <span style="font-size: 0.8rem; font-weight: 700; color: #ef4444; display: flex; align-items: center; gap: 5px;">
                                <span style="width: 8px; height: 8px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                متوقف حالياً
                            </span>
                         @endif
                         <i class="fas fa-chevron-left" style="color: #cbd5e1; font-size: 0.8rem;"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif



@if(auth('student')->check())
<div class="student-modern-dashboard" dir="rtl" style="padding: 10px; font-family: 'Cairo', sans-serif;">

    <div style="background: linear-gradient(105deg, #1e293b 0%, #334155 100%); border-radius: 24px; padding: 35px; color: white; margin-bottom: 30px; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <div style="position: relative; z-index: 2; display: flex; align-items: center; gap: 20px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; border: 3px solid rgba(255,255,255,0.2); overflow: hidden;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=4361ee&color=fff&size=128" alt="student-avatar" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div>
                <span style="background: rgba(67, 97, 238, 0.3); padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; color: #4cc9f0; font-weight: 700;">لوحة الطالب</span>
                <h1 style="margin: 5px 0; font-weight: 800; font-size: 1.8rem;">مرحباً، {{ $user->username }} ✨</h1>
                <p style="opacity: 0.7; font-size: 0.95rem; margin: 0;"><i class="far fa-envelope" style="margin-left: 5px;"></i> {{ $user->email }}</p>
            </div>
        </div>
        <div style="position: relative; z-index: 2;">
            <a href="{{ route('view.logout') }}" style="background: rgba(255,255,255,0.1); color: white; padding: 10px 20px; border-radius: 12px; text-decoration: none; font-size: 0.9rem; font-weight: 600; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                تسجيل الخروج <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 40px;">
        <div style="background: white; border-radius: 20px; padding: 25px; display: flex; align-items: center; gap: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;">
            <div style="width: 60px; height: 60px; border-radius: 15px; background: #eef2ff; color: #4361ee; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;"><i class="fas fa-book-open"></i></div>
            <div>
                <h4 style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 600;">الكورسات المسجلة</h4>
                <div style="font-size: 1.6rem; font-weight: 800; color: #1e293b;">{{ $enrolledCourses->count() }}</div>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 25px; display: flex; align-items: center; gap: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;">
            <div style="width: 60px; height: 60px; border-radius: 15px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;"><i class="fas fa-medal"></i></div>
            <div>
                <h4 style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 600;">الشهادات المحصلة</h4>
                <div style="font-size: 1.6rem; font-weight: 800; color: #1e293b;">{{ $certificatesCount }}</div>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 25px; display: flex; align-items: center; gap: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.03); border: 1px solid #f1f5f9;">
            <div style="width: 60px; height: 60px; border-radius: 15px; background: #fff7ed; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;"><i class="fas fa-graduation-cap"></i></div>
            <div>
                <h4 style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 600;">التخصص الحالي</h4>
                <div style="font-size: 1.1rem; font-weight: 800; color: #1e293b;">{{ $student->specialization ?? 'لم يحدد بعد' }}</div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 40px;">
        <div style="margin-bottom: 25px;">
            <h3 style="margin: 0; font-weight: 800; color: #1e293b; font-size: 1.5rem;">📚 رحلتي التعليمية</h3>
            <p style="color: #64748b; margin-top: 5px; font-size: 0.9rem;">استكشف كافة الكورسات التي انضممت إليها</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
            @forelse($enrolledCourses as $course)
                <div style="background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; transition: all 0.3s ease; position: relative;">
                    <div style="position: absolute; top: 15px; left: 15px; z-index: 5;">
                        <span style="background: rgba(67, 97, 238, 0.1); color: #4361ee; padding: 5px 12px; border-radius: 10px; font-size: 0.7rem; font-weight: 700; backdrop-filter: blur(5px);">
                             {{ $course->level == 'beginner' ? 'مبتدئ' : ($course->level == 'intermediate' ? 'متوسط' : 'متقدم') }}
                        </span>
                    </div>
                    <div style="height: 140px; background: linear-gradient(45deg, #f8fafc, #e2e8f0); display: flex; align-items: center; justify-content: center;">
                         <i class="fas fa-graduation-cap" style="font-size: 3.5rem; color: #cbd5e1;"></i>
                    </div>
                    <div style="padding: 25px;">
                        <h4 style="margin: 0 0 15px; font-weight: 800; color: #1e293b; font-size: 1.15rem; line-height: 1.5; min-height: 54px;">{{ $course->course_name }}</h4>
                        <div style="display: flex; flex-direction: column; gap: 12px; border-top: 1px solid #f1f5f9; padding-top: 15px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; background: #4361ee; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.7rem;"><i class="fas fa-user-tie"></i></div>
                                <div>
                                    <p style="margin: 0; font-size: 0.75rem; color: #94a3b8;">المدرب</p>
                                    <p style="margin: 0; font-size: 0.85rem; font-weight: 700; color: #475569;">{{ $course->instructor->user1->username ?? 'غير محدد' }}</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div style="display: flex; align-items: center; gap: 6px; color: #64748b; font-size: 0.8rem;"><i class="far fa-clock" style="color: #4361ee;"></i><span>{{ $course->no_hours }} ساعة</span></div>
                                <div style="display: flex; align-items: center; gap: 6px; color: #64748b; font-size: 0.8rem;"><i class="far fa-folder-open" style="color: #10b981;"></i><span>{{ $course->category->title ?? 'عام' }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- كود الـ empty --}}
            @endforelse
        </div>
    </div>
</div>
@endif

<!-- AI Assistant Chat -->
<div class="ai-assistant-card" style="margin-top: 30px; background: white; border-radius: 15px; padding: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
    <div class="card-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
        <i class="fas fa-robot" style="font-size: 24px; color: #4361ee;"></i>
        <h3 style="margin: 0;">المساعد الذكي</h3>
    </div>

    <div class="chat-container" style="height: 350px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 10px; padding: 15px; margin-bottom: 15px; background: #f8f9fa;" id="chatContainer">
        <div id="chatMessages">
            <div class="message ai-message" style="margin-bottom: 15px;">
                <div style="display: flex; gap: 10px; align-items: flex-start;">
                    <div style="background: #4361ee; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div style="background: white; padding: 12px 18px; border-radius: 18px 18px 18px 5px; max-width: 80%; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <p style="margin: 0; color: #1e293b;">مرحباً! أنا المساعد الذكي. كيف يمكنني مساعدتك اليوم؟</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="chat-input" style="display: flex; gap: 10px;">
        <input type="text" id="chatInput" placeholder="اكتب سؤالك هنا..." style="flex: 1; padding: 14px 18px; border: 2px solid #e9ecef; border-radius: 30px; font-size: 0.95rem; outline: none;">
        <button onclick="sendMessage()" style="background: #4361ee; color: white; border: none; border-radius: 30px; padding: 0 30px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-paper-plane"></i> إرسال
        </button>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    function sendMessage() {
        let input = document.getElementById('chatInput');
        let message = input.value.trim();
        if (!message) return;

        addMessage(message, 'user');
        input.value = '';
        showTypingIndicator();

        fetch('{{ route("ai.chat") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            removeTypingIndicator();
            if (data.success) {
                addMessage(data.message, 'ai');
            } else {
                addMessage('عذراً، حدث خطأ: ' + data.message, 'error');
            }
        })
        .catch(error => {
            removeTypingIndicator();
            addMessage('عذراً، حدث خطأ في الاتصال', 'error');
        });
    }

    function addMessage(text, type) {
        let chat = document.getElementById('chatMessages');
        let messageDiv = document.createElement('div');
        messageDiv.style.marginBottom = '15px';

        let content = '';
        if (type === 'user') {
            content = `
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <div style="background: #4361ee; color: white; padding: 12px 18px; border-radius: 18px 18px 5px 18px; max-width: 80%;">
                        <p style="margin: 0;">${text}</p>
                    </div>
                    <div style="background: #6c757d; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            `;
        } else if (type === 'ai') {
            content = `
                <div style="display: flex; gap: 10px; align-items: flex-start;">
                    <div style="background: #4361ee; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div style="background: white; padding: 12px 18px; border-radius: 18px 18px 18px 5px; max-width: 80%; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <p style="margin: 0; color: #1e293b;">${text}</p>
                    </div>
                </div>
            `;
        } else {
            content = `
                <div style="display: flex; gap: 10px; align-items: flex-start;">
                    <div style="background: #dc3545; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div style="background: #f8d7da; padding: 12px 18px; border-radius: 18px; max-width: 80%; color: #721c24;">
                        <p style="margin: 0;">${text}</p>
                    </div>
                </div>
            `;
        }

        messageDiv.innerHTML = content;
        chat.appendChild(messageDiv);
        chat.scrollTop = chat.scrollHeight;
    }

    function showTypingIndicator() {
        let chat = document.getElementById('chatMessages');
        let typingDiv = document.createElement('div');
        typingDiv.id = 'typingIndicator';
        typingDiv.style.marginBottom = '15px';
        typingDiv.innerHTML = `
            <div style="display: flex; gap: 10px; align-items: flex-start;">
                <div style="background: #4361ee; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-robot"></i>
                </div>
                <div style="background: white; padding: 12px 18px; border-radius: 18px 18px 18px 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <p style="margin: 0; color: #1e293b;">يكتب...</p>
                </div>
            </div>
        `;
        chat.appendChild(typingDiv);
        chat.scrollTop = chat.scrollHeight;
    }

    function removeTypingIndicator() {
        let indicator = document.getElementById('typingIndicator');
        if (indicator) indicator.remove();
    }

    document.getElementById('chatInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
    @if(auth('admin')->check())
    // بيانات الرسم البياني
    const weeklyLabels = @json($weeklyRegistrations['labels']);
    const weeklyStudents = @json($weeklyRegistrations['students']);
    const weeklyInstructors = @json($weeklyRegistrations['instructors']);
    const weeklyAdmins = @json($weeklyRegistrations['admins']);

    const monthlyLabels = @json($monthlyRegistrations['labels']);
    const monthlyStudents = @json($monthlyRegistrations['students']);
    const monthlyInstructors = @json($monthlyRegistrations['instructors']);
    const monthlyAdmins = @json($monthlyRegistrations['admins']);

    let registrationsChart;

    function initChart(type = 'weekly') {
        const ctx = document.getElementById('registrationsChart').getContext('2d');
        if (registrationsChart) registrationsChart.destroy();

        const labels = type === 'weekly' ? weeklyLabels : monthlyLabels;
        const studentsData = type === 'weekly' ? weeklyStudents : monthlyStudents;
        const instructorsData = type === 'weekly' ? weeklyInstructors : monthlyInstructors;
        const adminsData = type === 'weekly' ? weeklyAdmins : monthlyAdmins;

        registrationsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    { label: 'الطلاب', data: studentsData, backgroundColor: '#ff4757', borderRadius: 6 },
                    { label: 'المدربين', data: instructorsData, backgroundColor: '#2c3e50', borderRadius: 6 },
                    { label: 'المشرفين', data: adminsData, backgroundColor: '#2ecc71', borderRadius: 6 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', rtl: true, labels: { color: '#e0e0e0' } },
                    tooltip: { backgroundColor: '#1a1f2e', titleColor: '#00ffcc' }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#e0e0e0', stepSize: 1 } },
                    x: { grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#e0e0e0' } }
                }
            }
        });
    }

    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            initChart(this.textContent.includes('أسبوعي') ? 'weekly' : 'monthly');
        });
    });

    document.addEventListener('DOMContentLoaded', () => initChart('weekly'));

    // إشعارات
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('notificationButton');
        const menu = document.getElementById('notificationMenu');
        const badge = btn ? btn.querySelector('.navbar-badge') : null;

        if (btn && menu) {
            btn.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();

                if (menu.style.display === 'none' || menu.style.display === '') {
                    menu.style.display = 'block';

                    if (badge) {
                        badge.style.display = 'none';
                        fetch('{{ route("markNotificationRead") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).catch(error => console.error('Error marking notifications read:', error));
                    }
                } else {
                    menu.style.display = 'none';
                }
            };

            document.onclick = function(e) {
                if (menu && !menu.contains(e.target) && !btn.contains(e.target)) {
                    menu.style.display = 'none';
                }
            };
        }
    });

    function performDestroy(id, element) {
        if (confirm('هل أنت متأكد من حذف هذا الطالب؟')) {
            // قم بإضافة منطق الحذف عبر AJAX أو نموذج
            console.log('Delete student with id: ' + id);
        }
    }

    function confirmDelete(id, element) {
        if (confirm('هل أنت متأكد من حذف هذا الكورس؟')) {
            console.log('Delete course with id: ' + id);
        }
    }
    @endif
</script>
@endsection
