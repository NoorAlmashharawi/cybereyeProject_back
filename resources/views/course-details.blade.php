<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->course_name }} | CYBEReye</title>

    <link rel="stylesheet" href="{{ asset('cms/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/css/course-details.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body dir="ltr">
    <header>
        <div class="container">
            <div class="header-content">
                <a href="{{ route('home') }}" class="logo">
                    <i class="fas fa-shield-alt"></i>
                    CYBEReye
                </a>

                <nav>
                    <div class="logo">
                        <h1>CYBER<span>eye</span></h1>
                    </div>

                    <ul>
                        <li><a href="{{ route('home') }}" class="active">Home</a></li>
                        <li><a href="{{ route('home') }}#dictionary">Dictionary</a></li>
                        <li><a href="{{ route('home') }}#roadmap">Roadmap</a></li>
                        <li><a href="{{ route('home') }}#courses">Courses</a></li>
                        <li><a href="{{ route('home') }}#resources">Resources</a></li>
                        <li><a href="{{ route('home') }}#about">About</a></li>
                        <li><a href="{{ route('home') }}#Review">Review</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li class="search">
                            <label for="search">
                                <input type="text" id="search" placeholder="Search...">
                                <i class="fas fa-search"></i>
                            </label>
                        </li>
                    </ul>
                </nav>

                <div class="user-menu" style="display: flex; align-items: center; gap: 15px;">
                    @auth('student')
                        <a href="#" id="userCoursesLink" style="color: white; text-decoration: none;">My Courses</a>

                        <span style="color: white;">
                            <i class="fas fa-user"></i> {{ auth('student')->user()->user1->username ?? auth('student')->user()->username }}
                        </span>
                    @else
                        <a href="{{ route('view.login', ['guard' => 'student']) }}" class="login-btn" id="loginBtn">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main dir="rtl" style="text-align: right;">
        <section class="course-hero">
            <div class="container">
                <h1 class="course-title">{{ $course->course_name }}</h1>
                <div class="course-meta">
                    <div class="meta-item">
                        <i class="fas fa-chart-line"></i>
                        <span>المستوى: {{ $course->level }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>مدة الكورس: {{ $course->no_hours }} ساعة</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-star" style="color: #ffc107;"></i>
                        <span>{{ number_format($course->reviews->avg('rating') ?: 5, 1) }} / 5</span>
                    </div>
                </div>

                <p style="font-size: 1.2rem; margin-top: 1.5rem; opacity: 0.9;">
                    {{ $course->short_description }}
                </p>

                <div class="course-actions" style="margin-top: 2rem;">
                    <form action="{{ route('course.enroll', $course->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-play-circle"></i> ابدأ الكورس الآن
                        </button>
                    </form>

                    </div>
            </div>
        </section>

        <div class="container">
            <div class="course-content" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-top: 3rem;">
                <div class="course-main">
                    <div class="content-card" style="background: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h2><i class="fas fa-info-circle"></i> وصف الكورس</h2>
                        <p style="color: #4a5568; line-height: 1.8;">{{ $course->short_description }}</p>
                    </div>

                    <div class="content-card" style="background: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-right: 5px solid #10b981;">
                        <h2 style="color: #1a1a2e; margin-bottom: 1.5rem;">
                            <i class="fas fa-file-download" style="color: #10b981;"></i> المصادر والملفات المرفقة
                        </h2>

                        @if($course->materials->count() > 0)
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 15px;">
                                @foreach($course->materials as $material)
                                <div style="border: 1px solid #edf2f7; padding: 15px; border-radius: 12px; display: flex; align-items: center; gap: 12px; transition: 0.3s; background: #f8fafc;">
                                    <div style="font-size: 1.8rem;">
                                        @if($material->file_type == 'pdf')
                                            <i class="fas fa-file-pdf" style="color: #ef4444;"></i>
                                        @else
                                            <i class="fas fa-file-alt" style="color: #6b7280;"></i>
                                        @endif
                                    </div>
                                    <div style="flex-grow: 1;">
                                        <h4 style="font-size: 0.95rem; margin: 0; color: #2d3748; font-weight: bold;">{{ Str::limit($material->title, 18) }}</h4>
                                        <small style="color: #718096; font-size: 0.8rem;">{{ strtoupper($material->file_type) }}</small>
                                    </div>

                                    <a href="{{ route('materials.show', $material->id) }}" title="تحميل الملف" style="color: #10b981; font-size: 1.3rem;">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p style="color: #9ca3af; font-style: italic;">لا توجد ملفات مرفقة لهذا الكورس حالياً.</p>
                        @endif
                    </div>

                    <div class="rating-section" style="background: white; padding: 2rem; border-radius: 12px; margin-top: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h2 style="margin-bottom: 1.5rem;"><i class="fas fa-star" style="color: #ffc107;"></i> تقييم الكورس</h2>

                        <form action="{{ route('course.review.store', $course->id) }}" method="POST" id="reviewForm">
                            @csrf
                            <div class="stars-input" style="direction: ltr; text-align: right; font-size: 2rem; margin-bottom: 1rem;">
                                <input type="hidden" name="rating" id="ratingValue" value="5">
                                <span class="star-btn" data-v="5" style="cursor: pointer; color: #ffc107;">★</span>
                                <span class="star-btn" data-v="4" style="cursor: pointer; color: #ffc107;">★</span>
                                <span class="star-btn" data-v="3" style="cursor: pointer; color: #ffc107;">★</span>
                                <span class="star-btn" data-v="2" style="cursor: pointer; color: #ffc107;">★</span>
                                <span class="star-btn" data-v="1" style="cursor: pointer; color: #ffc107;">★</span>
                            </div>
                            <textarea name="comment" id="commentText" placeholder="شاركنا برأيك في الكورس..." style="width: 100%; height: 100px; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; resize: none;"></textarea>

                            @auth('student')
                                <button type="submit" class="btn btn-primary" style="margin-top: 1rem; padding: 12px 25px;">إرسال التقييم</button>
                            @else
                                <button type="button" onclick="showLoginAlert()" class="btn btn-primary" style="margin-top: 1rem; padding: 12px 25px;">إرسال التقييم</button>
                            @endauth
                        </form>
                    </div>

                    <div class="reviews-list" style="margin-top: 3rem;">
                        <h2 style="margin-bottom: 1.5rem; color: #1a1a2e; border-bottom: 2px solid #4361ee; display: inline-block; padding-bottom: 5px;">آراء الطلاب ({{ $course->reviews->count() }})</h2>

                        @forelse($course->reviews as $review)
                            <div style="background: #ffffff; padding: 1.5rem; border-radius: 12px; margin-bottom: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.03); display: flex; gap: 15px;">
                                <img src="{{ asset('storage/' . ($review->student->user1->profile_image ?? 'default.jpg')) }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                <div style="flex-grow: 1;">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <h4 style="margin: 0; color: #2d3748;">{{ $review->student->user1->username ?? 'طالب' }}</h4>
                                        <div style="color: #ffc107; font-size: 0.9rem;">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p style="color: #4a5568; margin-top: 8px; line-height: 1.5;">{{ $review->comment }}</p>
                                    <small style="color: #a0aec0;">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <p style="color: #9ca3af; text-align: center; padding: 20px;">لا توجد مراجعات لهذا الكورس بعد.</p>
                        @endforelse
                    </div>
                </div>

                <div class="course-sidebar">
                    <div class="instructor-card" style="background: white; padding: 1.5rem; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 1.5rem;">
                        <img src="{{ asset('storage/' . ($course->instructor->user1->profile_image ?? 'default.jpg')) }}"
                             style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #4361ee;"
                             alt="{{ $course->instructor->user1->username }}">

                        <h4 style="margin-top: 1rem; color: #1a1a2e; font-size: 1.1rem; font-weight: bold;">{{ $course->instructor->user1->username }}</h4>
                        <p style="color: #64748b; font-size: 0.9rem;">{{ $course->instructor->specialization ?? 'خبير أمن سيبراني' }}</p>
                    </div>

                    <div class="stats-card" style="background: white; padding: 1.8rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h3 style="font-size: 1.1rem; margin-bottom: 1.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; color: #1e293b;">مميزات الكورس:</h3>

                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px;">
                            <i class="fas fa-video" style="color: #4361ee; width: 20px;"></i>
                            <span style="color: #475569;">{{ $course->lessons->count() }}+ درس تعليمي</span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px;">
                            <i class="fas fa-file-code" style="color: #4361ee; width: 20px;"></i>
                            <span style="color: #475569;">{{ $course->materials->count() }} ملفات ومصادر تعليمية</span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px;">
                            <i class="fas fa-clock" style="color: #4361ee; width: 20px;"></i>
                            <span style="color: #475569;">{{ $course->no_hours }} ساعة تدريبية</span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px;">
                            <i class="fas fa-infinity" style="color: #4361ee; width: 20px;"></i>
                            <span style="color: #475569;">وصول غير محدود مدى الحياة</span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-certificate" style="color: #ffc107; width: 20px;"></i>
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-weight: bold; color: #1e293b;">شهادة إتمام معتمدة</span>
                                <small style="color: #94a3b8; font-size: 0.75rem;">تُمنح عند إنهاء جميع الدروس</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer" dir="ltr" style="background: #0d1b2a; color: white; padding: 3rem 0; text-align: center; margin-top: 5rem;">
        <div class="container">
            <p style="font-size: 1.1rem; letter-spacing: 1px;">cybereye@gmail.com | © 2024 CyberEye. All rights reserved.</p>
            <div class="footer-links" style="margin-top: 20px;">
                <a href="{{ route('home') }}" style="color: #94a3b8; margin: 0 15px; text-decoration: none;">Home</a>
                <a href="#courses" style="color: #94a3b8; margin: 0 15px; text-decoration: none;">Courses</a>
                <a href="{{ route('contact') }}" style="color: #94a3b8; margin: 0 15px; text-decoration: none;">Contact</a>
            </div>
        </div>
    </footer>

    <script>
        // تفاعل النجوم للتقييم
        document.querySelectorAll('.star-btn').forEach(star => {
            star.onclick = function() {
                let val = this.getAttribute('data-v');
                document.getElementById('ratingValue').value = val;
                document.querySelectorAll('.star-btn').forEach(s => {
                    s.style.color = s.getAttribute('data-v') <= val ? '#ffc107' : '#e2e8f0';
                });
            }
        });

        // رسالة تنبيه لغير المسجلين
        function showLoginAlert() {
            if(confirm("يجب عليك تسجيل الدخول أولاً لتتمكن من إضافة تقييم. هل تريد الذهاب لصفحة تسجيل الدخول؟")) {
                window.location.href = "{{ route('view.login', ['guard' => 'student']) }}";
            }
        }
    </script>
</body>
</html>
