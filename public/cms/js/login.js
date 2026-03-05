// بيانات المستخدمين المخزنة مؤقتاً (مع الصلاحيات)
let users = JSON.parse(localStorage.getItem('cybereye_users')) || [
    {
        email: "student@cybereye.com",
        password: "Student@123",
        firstName: "طالب",
        lastName: "تجريبي",
        role: "student",
        createdAt: new Date().toISOString()
    },
    {
        email: "instructor@cybereye.com",
        password: "Instructor@123",
        firstName: "مدرب",
        lastName: "متخصص",
        role: "instructor",
        instructorCode: "TEACH123",
        specialization: "الأمن السيبراني",
        createdAt: new Date().toISOString()
    },
    {
        email: "admin@cybereye.com",
        password: "Admin@123",
        firstName: "مشرف",
        lastName: "النظام",
        role: "admin",
        adminKey: "ADMIN2024",
        createdAt: new Date().toISOString()
    }
];

// متغيرات DOM
const loginForm = document.getElementById('loginForm');
const signupForm = document.getElementById('signupForm');
const forgotForm = document.getElementById('forgotForm');
const authBox = document.getElementById('authBox');
const tabBtns = document.querySelectorAll('.tab-btn');
const togglePasswordBtns = document.querySelectorAll('.toggle-password');
const forgotPasswordLink = document.getElementById('forgotPassword');
const backToLoginBtn = document.getElementById('backToLogin');
const modal = document.getElementById('successModal');
const modalTitle = document.getElementById('modalTitle');
const modalMessage = document.getElementById('modalMessage');
const modalButton = document.getElementById('modalButton');

// العناصر الجديدة
const userTypeSelector = document.getElementById('userTypeSelector');
const extraFields = document.getElementById('extraFields');
const userTypeCards = document.querySelectorAll('.user-type-card');
const userTypeRadios = document.querySelectorAll('input[name="userType"]');

// تهيئة الصفحة
document.addEventListener('DOMContentLoaded', function () {
    const rememberedEmail = localStorage.getItem('rememberedEmail');
    if (rememberedEmail) {
        document.getElementById('loginEmail').value = rememberedEmail;
        document.getElementById('rememberMe').checked = true;
    }

    userTypeRadios.forEach(radio => {
        radio.addEventListener('change', handleUserTypeChange);
    });

    userTypeCards.forEach(card => {
        card.addEventListener('click', function () {
            userTypeCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
});

// التعامل مع تغيير نوع المستخدم
function handleUserTypeChange(e) {
    const selectedType = e.target.value;

    document.querySelectorAll('.extra-fields > div').forEach(field => {
        field.style.display = 'none';
    });

    if (selectedType === 'instructor') {
        document.querySelector('.instructor-fields').style.display = 'block';
        extraFields.style.display = 'block';
    } else if (selectedType === 'admin') {
        document.querySelector('.admin-fields').style.display = 'block';
        extraFields.style.display = 'block';
    } else {
        extraFields.style.display = 'none';
    }

    const loginBtn = document.querySelector('.login-btn i');
    if (selectedType === 'student') {
        loginBtn.className = 'fas fa-user-graduate';
    } else if (selectedType === 'instructor') {
        loginBtn.className = 'fas fa-chalkboard-teacher';
    } else {
        loginBtn.className = 'fas fa-user-shield';
    }
}

// تبديل بين تسجيل الدخول والتسجيل
tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const tab = btn.getAttribute('data-tab');

        tabBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.auth-form').forEach(form => {
            form.style.display = 'none';
        });

        document.getElementById(`${tab}Form`).style.display = 'block';

        if (tab === 'login') {
            userTypeSelector.style.display = 'block';
        } else {
            userTypeSelector.style.display = 'none';
            extraFields.style.display = 'none';
        }
    });
});

// تبديل عرض كلمة المرور
togglePasswordBtns.forEach(btn => {
    btn.addEventListener('click', function () {
        const input = this.parentElement.querySelector('input');
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

// قوة كلمة المرور للتسجيل
const passwordInput = document.getElementById('signupPassword');
const strengthBar = document.getElementById('passwordStrength');
const strengthText = document.getElementById('strengthText');

if (passwordInput) {
    passwordInput.addEventListener('input', function () {
        const password = this.value;
        let strength = 0;

        if (password.length >= 8) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;
        if (/[^A-Za-z0-9]/.test(password)) strength += 25;

        strengthBar.style.width = `${strength}%`;

        if (strength <= 25) {
            strengthBar.style.backgroundColor = '#ff4757';
            strengthText.textContent = 'ضعيفة';
        } else if (strength <= 50) {
            strengthBar.style.backgroundColor = '#ffa502';
            strengthText.textContent = 'متوسطة';
        } else if (strength <= 75) {
            strengthBar.style.backgroundColor = '#2ed573';
            strengthText.textContent = 'قوية';
        } else {
            strengthBar.style.backgroundColor = '#3742fa';
            strengthText.textContent = 'قوية جداً';
        }
    });
}

// التحقق من البريد
const emailInput = document.getElementById('signupEmail');
const emailCheck = document.getElementById('emailCheck');

if (emailInput) {
    emailInput.addEventListener('blur', function () {
        const email = this.value;
        const existingUser = users.find(user => user.email === email);

        if (existingUser) {
            emailCheck.style.display = 'block';
            emailCheck.innerHTML = '<i class="fas fa-times-circle"></i> البريد الإلكتروني مستخدم بالفعل';
            emailCheck.style.color = '#ff4757';
        } else if (email.includes('@')) {
            emailCheck.style.display = 'block';
            emailCheck.innerHTML = '<i class="fas fa-check-circle"></i> البريد الإلكتروني متاح';
            emailCheck.style.color = '#2ed573';
        } else {
            emailCheck.style.display = 'none';
        }
    });
}

// استعادة كلمة المرور
forgotPasswordLink.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelectorAll('.auth-form').forEach(form => form.style.display = 'none');
    forgotForm.style.display = 'block';
    userTypeSelector.style.display = 'none';
    extraFields.style.display = 'none';
    tabBtns.forEach(btn => btn.classList.remove('active'));
});

backToLoginBtn.addEventListener('click', function () {
    forgotForm.style.display = 'none';
    loginForm.style.display = 'block';
    userTypeSelector.style.display = 'block';
    tabBtns[0].classList.add('active');
});

// تسجيل الدخول
loginForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const rememberMe = document.getElementById('rememberMe').checked;
    const userType = document.querySelector('input[name="userType"]:checked').value;

    const user = users.find(u => u.email === email && u.password === password);

    if (!user) {
        showModal('فشل تسجيل الدخول', 'البريد الإلكتروني أو كلمة المرور غير صحيحة', 'error');
        modalButton.onclick = () => modal.style.display = 'none';
        return;
    }

    if (user.role !== userType) {
        showModal('نوع حساب خاطئ', `هذا الحساب ليس ${getRoleArabic(userType)}`, 'error');
        modalButton.onclick = () => modal.style.display = 'none';
        return;
    }

    if (userType === 'instructor') {
        const instructorCode = document.getElementById('instructorCode').value;
        if (!instructorCode || instructorCode !== user.instructorCode) {
            showModal('كود خاطئ', 'كود المدرب غير صحيح', 'error');
            return;
        }
    }

    if (userType === 'admin') {
        const adminKey = document.getElementById('adminKey').value;
        if (!adminKey || adminKey !== user.adminKey) {
            showModal('مفتاح خاطئ', 'المفتاح السري غير صحيح', 'error');
            return;
        }
    }

    const sessionData = { ...user, loginTime: new Date().toISOString(), sessionId: 'session_' + Date.now() };
    localStorage.setItem('currentUser', JSON.stringify(sessionData));

    if (rememberMe) localStorage.setItem('rememberedEmail', email);
    else localStorage.removeItem('rememberedEmail');

    showModal('تسجيل الدخول ناجح', getWelcomeMessage(userType, user.firstName));
    modalButton.onclick = () => redirectToDashboard(userType);
});

// إنشاء حساب جديد
signupForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('signupEmail').value;
    const password = document.getElementById('signupPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const terms = document.getElementById('terms').checked;

    if (password !== confirmPassword) {
        showModal('خطأ في التأكيد', 'كلمات المرور غير متطابقة', 'error');
        return;
    }

    if (!terms) {
        showModal('خطأ في التسجيل', 'يجب الموافقة على الشروط والأحكام', 'error');
        return;
    }

    const existingUser = users.find(user => user.email === email);
    if (existingUser) {
        showModal('البريد مستخدم', 'هذا البريد الإلكتروني مسجل بالفعل', 'error');
        return;
    }

    const newUser = { email, password, firstName, lastName, role: 'student', createdAt: new Date().toISOString() };
    users.push(newUser);
    localStorage.setItem('cybereye_users', JSON.stringify(users));

    localStorage.setItem('currentUser', JSON.stringify({ ...newUser, loginTime: new Date().toISOString() }));
    showModal('حساب جديد', 'تم إنشاء حسابك بنجاح! مرحباً بك في CyberEye');
    modalButton.onclick = () => window.location.href = '../html/student-dashboard.html';
});

// استعادة كلمة المرور
forgotForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('forgotEmail').value;
    const user = users.find(u => u.email === email);

    if (user) {
        showModal('تم الإرسال', 'تم إرسال رابط إعادة التعيين إلى بريدك الإلكتروني');
        modalButton.onclick = () => { modal.style.display = 'none'; backToLoginBtn.click(); };
    } else {
        showModal('غير موجود', 'لا يوجد حساب مرتبط بهذا البريد الإلكتروني', 'error');
        modalButton.onclick = () => modal.style.display = 'none';
    }
});

// الدخول بحساب Google/Microsoft
document.querySelector('.social-btn.google').addEventListener('click', () => showModal('قريباً', 'ميزة الدخول بحساب Google قريباً', 'info'));
document.querySelector('.social-btn.microsoft').addEventListener('click', () => showModal('قريباً', 'ميزة الدخول بحساب Microsoft قريباً', 'info'));

// المودال
function showModal(title, message, type = 'success') {
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    const modalIcon = document.querySelector('.modal-icon i');
    if (type === 'error') { modalIcon.className = 'fas fa-times-circle'; modalIcon.style.color = '#ff4757'; }
    else if (type === 'info') { modalIcon.className = 'fas fa-info-circle'; modalIcon.style.color = '#3742fa'; }
    else { modalIcon.className = 'fas fa-check-circle'; modalIcon.style.color = '#2ed573'; }
    modal.style.display = 'flex';
}

window.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });
function getRoleArabic(role) { const roles = { 'student': 'طالب', 'instructor': 'مدرب', 'admin': 'مشرف' }; return roles[role] || role; }
function getWelcomeMessage(role, name) { const messages = { 'student': `مرحباً ${name}! سيتم تحويلك إلى لوحة الطالب`, 'instructor': `أهلاً بك ${name}! سيتم تحويلك إلى لوحة المدربين`, 'admin': `مرحباً ${name}! سيتم تحويلك إلى لوحة الإدارة` }; return messages[role] || 'مرحباً بك!'; }
function redirectToDashboard(role) { const dashboards = { 'student': '../html/student.html', 'instructor': '../html/instructor.html', 'admin': '../html/admin.html' }; window.location.href = dashboards[role] || '../html/index.html'; }

// **تعديل زر "إنشاء حساب"**
document.getElementById('signHome').onclick = function (e) {
    e.preventDefault();
    tabBtns.forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    loginForm.style.display = 'none';
    signupForm.style.display = 'block';
    userTypeSelector.style.display = 'none';
    extraFields.style.display = 'none';
};