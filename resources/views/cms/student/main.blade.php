@extends('cms.parent')



@section('title', 'Admin')
@section('main-title', 'main-title')

@section('sub-title', 'sub-title')

@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/main.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.css" rel="stylesheet">

@endsection

@section('content')

 


    <!-- المحتوى الرئيسي -->
    <main class="admin-main">
        <!-- شريط الأدوات العلوي -->
        <div class="admin-toolbar">
            <div class="toolbar-title">
                <h1>لوحة تحكم المشرف</h1>
                <p>مرحباً بعودتك، يمكنك إدارة جميع جوانب المنصة من هنا</p>
            </div>


                <div class="admin-notifications">
                    <button class="notification-btn" id="notificationButton" onclick="goToNotificatios()">
                        <i class="far fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                </div>

  
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
                        <h3>1,254</h3>
                        <p>إجمالي المستخدمين</p>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i>
                            <span>12% عن الشهر الماضي</span>
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
                        <h3>47</h3>
                        <p>الكورسات النشطة</p>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i>
                            <span>5 كورسات جديدة</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card revenue">
                <div class="stat-content">
                    <div class="stat-icon revenue">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-info">
                        <h3>$12,540</h3>
                        <p>الإيرادات الشهرية</p>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i>
                            <span>18% زيادة</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card active">
                <div class="stat-content">
                    <div class="stat-icon active">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3>87%</h3>
                        <p>نسبة الإشغال</p>
                        <div class="stat-trend trend-down">
                            <i class="fas fa-arrow-down"></i>
                            <span>3% عن الأسبوع الماضي</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- المخططات والرسوم البيانية -->
        <div class="charts-section">
            <!-- مخطط الإيرادات -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3>الإيرادات الشهرية</h3>
                    <div class="chart-period">
                        <button class="period-btn active">شهري</button>
                        <button class="period-btn">سنوي</button>
                        <button class="period-btn">إجمالي</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- مخطط التسجيلات -->
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
                <table id="studentsTable">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)"><i class="fas fa-sort"></i> المعرف</th>
                            <th onclick="sortTable(1)"><i class="fas fa-sort"></i> اسم الطالب</th>
                            <th onclick="sortTable(2)"><i class="fas fa-sort"></i> الايميل</th>
                            <th onclick="sortTable(3)"><i class="fas fa-sort"></i> مستوى المهارة</th>
                            <th onclick="sortTable(4)"><i class="fas fa-sort"></i> التخصص</th>
                            <th onclick="sortTable(5)"><i class="fas fa-sort"></i> الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody">
                        @foreach ($newStudents as $student)
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
                            <td class="text-center" style="display:flex; gap:5px;">
                                <a href="{{ route('students.show', $student->id) }}" class="btn-action btn-info" title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn-action btn-primary" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="post" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-danger" title="حذف" onclick="performDestroy({{ $student->id }}, this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        
                {{-- {{ $newStudents->links() }} --}}
                
                <div id="noResultsMessage" class="no-results" style="display: none;">
                    <i class="fas fa-search"></i>
                    <h3>لا توجد نتائج</h3>
                    <p>لم يتم العثور على طلاب ينطبقون على معايير البحث الخاصة بك</p>
                </div>
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
                                <th>المشتركين</th>
                                <th>التقييم</th>
                                <th>الإيرادات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>أساسيات الأمن السيبراني</td>
                                <td>د. أحمد محمد</td>
                                <td>450</td>
                                <td>★★★★★ (4.9)</td>
                                <td>$8,500</td>
                            </tr>
                            <tr>
                                <td>برمجة جافا للأمن</td>
                                <td>م. سامي علي</td>
                                <td>320</td>
                                <td>★★★★☆ (4.7)</td>
                                <td>$6,200</td>
                            </tr>
                            <tr>
                                <td>أمن تطبيقات الويب</td>
                                <td>أ. نورا سعيد</td>
                                <td>280</td>
                                <td>★★★★★ (4.8)</td>
                                <td>$5,800</td>
                            </tr>
                            <tr>
                                <td>تحليل الثغرات الأمنية</td>
                                <td>د. خالد حسن</td>
                                <td>190</td>
                                <td>★★★★☆ (4.6)</td>
                                <td>$4,500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- النشاطات الأخيرة -->
        <div class="activity-section">
            <h3 style="margin-bottom: 1rem;">النشاطات الأخيرة</h3>
            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">تسجيل مستخدم جديد</div>
                        <div class="activity-desc">محمد أحمد سجل في المنصة</div>
                    </div>
                    <div class="activity-time">منذ 5 دقائق</div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">شراء كورس جديد</div>
                        <div class="activity-desc">سارة محمد اشترت كورس الأمن السيبراني المتقدم</div>
                    </div>
                    <div class="activity-time">منذ ساعة</div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">إكمال كورس</div>
                        <div class="activity-desc">أحمد خالد أكمل كورس أساسيات جافا</div>
                    </div>
                    <div class="activity-time">منذ 3 ساعات</div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-comment-alt"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">تقييم جديد</div>
                        <div class="activity-desc">فاطمة علي قيمت كورس أمن الشبكات بـ 5 نجوم</div>
                    </div>
                    <div class="activity-time">منذ 5 ساعات</div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">بلاغ عن مشكلة</div>
                        <div class="activity-desc">تم الإبلاغ عن مشكلة في فيديو الدرس 3</div>
                    </div>
                    <div class="activity-time">منذ يوم</div>
                </li>
            </ul>
        </div>
    </main>

  
@endsection

@section('scripts')
  <!-- مكتبة Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="{{ asset('cms/js/admin.js') }}"></script>

@endsection