@extends('cms.home.parent')

@section('title', 'CyberEye - Home')
@section('styles')
<link rel="stylesheet" href="{{ asset('cms/css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('cms/css/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="icon" type="image/x-icon" href="img/digital.jpg">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
@endsection


@section('content')


    <!-- قسم البانر -->
    <section class="login-hero">
        <div class="hero-content">
            <h1>مرحباً بعودتك!</h1>
            <p>سجل دخولك لمواصلة رحلتك التعليمية في عالم الأمن السيبراني</p>
        </div>
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <!-- مربع تسجيل الدخول/التسجيل -->
    <div class="login-container">
        <div class="auth-box" id="authBox">
            <!-- علامات التبويب -->
            <div class="auth-tabs">
                <button class="tab-btn active" data-tab="login">
                    <i class="fas fa-sign-in-alt"></i>
                    تسجيل الدخول
                </button>
                <button class="tab-btn" data-tab="signup" id="signHome">
                    <i class="fas fa-user-plus"></i>
                    إنشاء حساب
                </button>
            </div>

            <!-- نموذج تسجيل الدخول -->
            <form class="auth-form active" id="loginForm">
                @csrf
                <div class="form-header">
                    <h2>سجل دخولك</h2>
                    <p>أدخل بيانات حسابك للدخول</p>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        البريد الإلكتروني *
                    </label>
                    <input type="email" id="email" name="email" placeholder="example@email.com" required>
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        كلمة المرور *
                    </label>
                    <div class="password-input">
                        <input type="password" name="password" id="password" placeholder="أدخل كلمة المرور" required>
                        <button type="button" class="toggle-password" id="toggleLoginPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                </div>

                <div class="form-options">
                    <label class="checkbox">
                        <input type="checkbox" id="rememberMe">
                        <span>تذكرني</span>
                    </label>
                    <a href="#" class="forgot-password" id="forgotPassword">نسيت كلمة المرور؟</a>
                </div>

                <button type="button" class="submit-btn login-btn" onclick="login()">
                    <i class="fas fa-sign-in-alt"></i>
                    تسجيل الدخول
                </button>



                                    <!-- اختيار نوع الحساب (يظهر فقط في تسجيل الدخول) -->
<div class="user-type-selector" id="userTypeSelector">
    <h3 style="margin: 20px 0 15px; color: #333; text-align: center;">اختر نوع حسابك</h3>
    <div class="user-type-options">
        <label class="user-type-card">
            <input type="radio" name="userType" value="student" checked>
            <div class="user-type-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="user-type-info">

                <a href="{{ route('view.login', ['guard' => 'student']) }}" class="btn btn-success">
                    <h4>👨‍🎓 طالب</h4>
                </a>
            </div>
        </label>

        <label class="user-type-card">
            <input type="radio" name="userType" value="instructor">
            <div class="user-type-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="user-type-info">

                <a href="{{ route('view.login', ['guard' => 'instructor']) }}" class="btn btn-success">
                    <h4>🧑‍🏫 مدرب</h4>
                </a>
            </div>
        </label>

        <label class="user-type-card">
            <input type="radio" name="userType" value="admin">
            <div class="user-type-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="user-type-info">

                <a href="{{ route('view.login', ['guard' => 'admin']) }}" class="btn btn-success">
                    <h4>👑 مشرف</h4>
                </a>
            </div>
        </label>
    </div>
</div>




                <div class="divider">
                    <span>أو</span>
                </div>

                <div class="social-login">
                    <button type="button" class="social-btn google">
                        <i class="fab fa-google"></i>
                        الدخول بحساب Google
                    </button>
                    <button type="button" class="social-btn microsoft">
                        <i class="fab fa-microsoft"></i>
                        الدخول بحساب Microsoft
                    </button>
                </div>
            </form>








            <!-- نموذج إنشاء حساب -->
            <form class="auth-form" id="signupForm">
                <div class="form-header">
                    <h2>أنشئ حساباً جديداً</h2>
                    <p>انضم إلى مجتمع CyberEye التعليمي</p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">
                            <i class="fas fa-user"></i>
                            الاسم الأول *
                        </label>
                        <input type="text" id="firstName" placeholder="أحمد" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">
                            <i class="fas fa-user"></i>
                            اسم العائلة *
                        </label>
                        <input type="text" id="lastName" placeholder="محمد" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="signupEmail">
                        <i class="fas fa-envelope"></i>
                        البريد الإلكتروني *
                    </label>
                    <input type="email" id="signupEmail" placeholder="example@email.com" required>
                </div>

                <div class="form-group">
                    <label for="signupPassword">
                        <i class="fas fa-lock"></i>
                        كلمة المرور *
                    </label>
                    <div class="password-input">
                        <input type="password" id="signupPassword" placeholder="كلمة مرور قوية" required>
                        <button type="button" class="toggle-password" id="toggleSignupPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-level" id="passwordStrength"></div>
                        </div>
                        <span class="strength-text" id="strengthText">ضعيفة</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">
                        <i class="fas fa-lock"></i>
                        تأكيد كلمة المرور *
                    </label>
                    <div class="password-input">
                        <input type="password" id="confirmPassword" placeholder="أعد إدخال كلمة المرور" required>
                        <button type="button" class="toggle-password" id="toggleConfirmPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">
                        أوافق على <a href="#">الشروط والأحكام</a> و <a href="#">سياسة الخصوصية</a> *
                    </label>
                </div>

           <button type="button" class="submit-btn signup-btn" onclick="signup()">
    <i class="fas fa-user-plus"></i>
    إنشاء حساب
</button>
            </form>

            <!-- استعادة كلمة المرور -->
            <form class="auth-form" id="forgotForm" style="display: none;">
                <div class="form-header">
                    <h2>استعادة كلمة المرور</h2>
                    <p>أدخل بريدك الإلكتروني لإرسال رابط إعادة التعيين</p>
                </div>

                <div class="form-group">
                    <label for="forgotEmail">
                        <i class="fas fa-envelope"></i>
                        البريد الإلكتروني *
                    </label>
                    <input type="email" id="forgotEmail" placeholder="example@email.com" required>
                </div>

                <button type="submit" class="submit-btn forgot-btn">
                    <i class="fas fa-paper-plane"></i>
                    إرسال رابط الاستعادة
                </button>

                <button type="button" class="back-to-login" id="backToLogin">
                    <i class="fas fa-arrow-right"></i>
                    العودة لتسجيل الدخول
                </button>
            </form>
        </div>





        <!-- مزايا التسجيل -->
        <div class="features-section">
            <h2>لماذا تنضم إلى CyberEye؟</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-graduation-cap"></i></div>
                    <h3>وصول كامل للدورات</h3>
                    <p>استفد من مكتبتنا الشاملة لدورات الأمن السيبراني</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-certificate"></i></div>
                    <h3>شهادات معتمدة</h3>
                    <p>احصل على شهادات إتمام معترف بها</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-users"></i></div>
                    <h3>مجتمع متخصص</h3>
                    <p>انضم إلى مجتمع من المتخصصين</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>تتبع التقدم</h3>
                    <p>راقب تقدمك التعليمي</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <h3>دعم فني متواصل</h3>
                    <p>فريق دعم متاح 24/7</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-trophy"></i></div>
                    <h3>تحديات وجوائز</h3>
                    <p>شارك في تحديات أمنية</p>
                </div>
            </div>

            <div class="stats-section">
                <div class="stat-item">
                    <h3>10,000+</h3>
                    <p>مستخدم نشط</p>
                </div>
                <div class="stat-item">
                    <h3>50+</h3>
                    <p>دورة متخصصة</p>
                </div>
                <div class="stat-item">
                    <h3>95%</h3>
                    <p>رضا العملاء</p>
                </div>
            </div>
        </div>
    </div>



    @endsection

    @section('scripts')
    <script src="{{ asset('cms/js/login.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function login() {
            var guard = '{{ request('guard') ?? 'admin' }}';
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            axios.post('/cms/' + guard + '/login', {
                email: email,
                password: password,
                guard: guard
            })

            .then(function(response) {
                if (response.data.icon === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'تم تسجيل الدخول',
                        text: response.data.title,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/cms/admin/main';

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'فشل تسجيل الدخول',
                        text: response.data.title
                    });
                }
            })
            .catch(function(error) {
                var errorMsg = 'حدث خطأ في الاتصال';
                if (error.response && error.response.data) {
                    errorMsg = error.response.data.title || 'البيانات غير صحيحة';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: errorMsg
                });
            });
        }


document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', () => {
        const tab = button.getAttribute('data-tab');

        // 1. شيل اللون النشط من كل الأزرار وحطه ع اللي انضغط
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        // 2. إخفاء كل الفورمات
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('signupForm').style.display = 'none';

        // 3. إظهار الفورم المطلوب
        if(tab === 'login') {
            document.getElementById('loginForm').style.display = 'block';
            // إذا بدك يظهر اختيار (طالب/مدرب) بس باللوجن
            document.getElementById('userTypeSelector').style.display = 'block';
        } else {
            document.getElementById('signupForm').style.display = 'block';
            // إخفاء اختيار النوع في صفحة الإنشاء إذا كنتِ بس بتسجلي طلاب
            document.getElementById('userTypeSelector').style.display = 'none';
        }
    });
});

function signup() {
    // 1. جلب القيم من المدخلات
    let fName = document.getElementById('firstName').value;
    let lName = document.getElementById('lastName').value;
    let email = document.getElementById('signupEmail').value;
    let password = document.getElementById('signupPassword').value;
    let password_confirmation = document.getElementById('confirmPassword').value;

    // 2. تجهيز البيانات (لاحظي إني ضفت username يدوي)
    let formData = new FormData();
    formData.append('username', fName + ' ' + lName); // هان الحل! دمجنا الاسمين في حقل واحد
    formData.append('email', email);
    formData.append('password', password);
    formData.append('password_confirmation', password_confirmation);

    // اختياري: إذا الكنترولر بطلب firstName و lastName كحقول منفصلة كمان
    formData.append('firstName', fName);
    formData.append('lastName', lName);

    // 3. الإرسال
    axios.post('{{ route('student.register') }}', formData)
    .then(function (response) {
        Swal.fire({
            icon: 'success',
            title: 'تم إنشاء الحساب بنجاح',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '{{ route('view.login', ['guard' => 'student']) }}';
        });
    })
    .catch(function (error) {
        Swal.fire({
            icon: 'error',
            title: 'خطأ في البيانات',
            text: error.response.data.title || 'تأكد من تعبئة جميع الحقول بشكل صحيح'
        });
    });
}

    </script>
    @endsection
