
// التحقق من حالة تسجيل الدخول
function checkLoginStatus() {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const userCoursesLink = document.getElementById('userCoursesLink');
    const loginBtn = document.getElementById('loginBtn');
    const enrollBtn = document.getElementById('enrollBtn');

    if (isLoggedIn) {
        const userName = localStorage.getItem('userName') || 'المستخدم';
        userCoursesLink.style.display = 'inline-block';
        loginBtn.innerHTML = '<i class="fas fa-user"></i> ' + userName;
        loginBtn.href = "html/profile.html";
        loginBtn.className = "";

        // تحديث نص زر التسجيل
        enrollBtn.innerHTML = '<i class="fas fa-play-circle"></i> ابدأ الكورس الآن';
        enrollBtn.onclick = function () {
            enrollInCourse();
        };
    } else {
        enrollBtn.onclick = function () {
            showEnrollModal();
        };
    }
}

// عرض مودال التسجيل
function showEnrollModal() {
    document.getElementById('enrollModal').style.display = 'flex';
}

// إغلاق المودال
function closeModal() {
    document.getElementById('enrollModal').style.display = 'none';
    document.getElementById('successModal').style.display = 'none';
}

// إضافة إلى المفضلة
function addToFavorites() {
    alert('تمت إضافة الكورس إلى المفضلة');
    // هنا يمكن إضافة كود لحفظ المفضلة في localStorage أو قاعدة البيانات
}

// تحميل ملف
function downloadFile(filename) {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

    if (!isLoggedIn) {
        alert('يجب تسجيل الدخول أولاً لتحميل الملفات');
        showEnrollModal();
        return;
    }

    alert('جاري تحميل ملف: ' + filename);
    // هنا يمكن إضافة كود التحميل الفعلي
}

// تقييم النجوم
const stars = document.querySelectorAll('.star');
let selectedRating = 0;

stars.forEach(star => {
    star.addEventListener('click', function () {
        const value = parseInt(this.getAttribute('data-value'));
        selectedRating = value;

        stars.forEach((s, index) => {
            if (index < value) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });
    });

    star.addEventListener('mouseover', function () {
        const value = parseInt(this.getAttribute('data-value'));

        stars.forEach((s, index) => {
            if (index < value) {
                s.style.color = '#ffc107';
            }
        });
    });

    star.addEventListener('mouseout', function () {
        stars.forEach((s, index) => {
            if (index >= selectedRating) {
                s.style.color = '#ddd';
            }
        });
    });
});

// إرسال التقييم
function submitReview() {
    if (selectedRating === 0) {
        alert('الرجاء اختيار تقييم');
        return;
    }

    const reviewText = document.getElementById('reviewText').value;

    if (!reviewText.trim()) {
        alert('الرجاء كتابة مراجعة');
        return;
    }

    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

    if (!isLoggedIn) {
        alert('يجب تسجيل الدخول أولاً لإرسال التقييم');
        showEnrollModal();
        return;
    }

    alert('شكراً لتقييمك! تم إرسال المراجعة بنجاح.');
    document.getElementById('reviewText').value = '';

    // إعادة تعيين النجوم
    stars.forEach(star => {
        star.classList.remove('active');
        star.style.color = '#ddd';
    });
    selectedRating = 0;
}

// تسجيل الكورس
function enrollInCourse() {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

    if (!isLoggedIn) {
        showEnrollModal();
        return;
    }

    // تسجيل الكورس للمستخدم المسجل
    saveCourseEnrollment();
    document.getElementById('successModal').style.display = 'flex';
}

// حفظ تسجيل الكورس
function saveCourseEnrollment() {
    const userId = localStorage.getItem('userId') || 'user_' + Date.now();
    const enrolledCourses = JSON.parse(localStorage.getItem('enrolledCourses') || '[]');

    const course = {
        id: 'java-cyber-security',
        title: 'دورة جافا للأمن السيبراني',
        enrolledDate: new Date().toISOString(),
        progress: 0,
        lastAccessed: new Date().toISOString()
    };

    if (!enrolledCourses.some(c => c.id === course.id)) {
        enrolledCourses.push(course);
        localStorage.setItem('enrolledCourses', JSON.stringify(enrolledCourses));
    }

    localStorage.setItem('currentCourse', JSON.stringify(course));
}

// إعادة التوجيه إلى صفحة الكورس
function redirectToCourse() {
    closeModal();
    window.location.href = '../html/courseplayerJava.html';
}

// معالجة نموذج التسجيل
document.getElementById('enrollmentForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // هنا يمكن إضافة كود إرسال البيانات للخادم
    const formData = {
        fullName: document.getElementById('fullName').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value
    };

    // حفظ بيانات المستخدم في localStorage (مؤقت)
    localStorage.setItem('userName', formData.fullName);
    localStorage.setItem('userEmail', formData.email);
    localStorage.setItem('isLoggedIn', 'true');
    localStorage.setItem('userId', 'user_' + Date.now());

    document.getElementById('enrollModal').style.display = 'none';
    saveCourseEnrollment();
    document.getElementById('successModal').style.display = 'flex';

    // تحديث واجهة المستخدم
    setTimeout(checkLoginStatus, 100);
});

// معاينة مجانية
document.getElementById('previewBtn').addEventListener('click', function () {
    alert('جاري فتح معاينة مجانية للدرس الأول...');
    // هنا يمكن إضافة كود فتح فيديو المعاينة
});

// إغلاق المودال بالنقر خارج المحتوى
window.addEventListener('click', function (e) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});

// عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function () {
    checkLoginStatus();
});
