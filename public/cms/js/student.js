
// بيانات الطالب
const studentData = {
    name: "محمد أحمد",
    email: "student@cybereye.com",
    courses: 3,
    studyHours: 45,
    certificates: 1,
    progress: 85
};

// بيانات الكورسات
const courses = [
    {
        id: 1,
        title: "أساسيات الأمن السيبراني",
        description: "تعلم المبادئ الأساسية للأمن السيبراني والتشريعات الأمنية",
        progress: 75,
        icon: "fas fa-shield-alt",
        instructor: "د. أحمد محمد"
    },
    {
        id: 2,
        title: "برمجة جافا للأمن",
        description: "تعلم برمجة تطبيقات آمنة باستخدام لغة جافا",
        progress: 30,
        icon: "fab fa-java",
        instructor: "م. سامي علي"
    },
    {
        id: 3,
        title: "أمن تطبيقات الويب",
        description: "حماية تطبيقات الويب من الهجمات الأمنية الشائعة",
        progress: 10,
        icon: "fas fa-code",
        instructor: "أ. نورا سعيد"
    }
];

// عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // التحقق من تسجيل الدخول
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    
    if (!currentUser || currentUser.role !== 'student') {
        window.location.href = '../html/login.html';
        return;
    }

    // عرض بيانات الطالب
    loadStudentData(currentUser);
    
    // تحميل الكورسات
    loadCourses();
});

// تحميل بيانات الطالب
function loadStudentData(user) {
    document.getElementById('userName').textContent = user.firstName + ' ' + user.lastName;
    document.getElementById('userEmail').textContent = user.email;
    document.getElementById('userAvatar').textContent = user.firstName.charAt(0);
    document.getElementById('studentNameDisplay').textContent = user.firstName;
    
    // تحديث الإحصائيات
    document.getElementById('coursesCount').textContent = courses.length;
    document.getElementById('studyHours').textContent = studentData.studyHours;
    document.getElementById('certificatesCount').textContent = studentData.certificates;
    document.getElementById('averageProgress').textContent = studentData.progress + '%';
}

// تحميل الكورسات
function loadCourses() {
    const coursesContainer = document.getElementById('activeCourses');
    coursesContainer.innerHTML = '';
    
    courses.forEach(course => {
        const courseCard = document.createElement('div');
        courseCard.className = 'course-card';
        courseCard.innerHTML = `
            <div class="course-header">
                <i class="${course.icon} course-icon"></i>
                <div class="course-title">
                    <h3>${course.title}</h3>
                    <p>المدرب: ${course.instructor}</p>
                </div>
            </div>
            
            <div class="course-body">
                <p class="course-description">${course.description}</p>
                
                <div class="course-progress">
                    <div class="progress-info">
                        <span>التقدم</span>
                        <span>${course.progress}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: ${course.progress}%"></div>
                    </div>
                </div>
                
                <div class="course-actions">
                    <button class="action-btn primary" onclick="continueCourse(${course.id})">
                        <i class="fas fa-play-circle"></i>
                        استمر في الدراسة
                    </button>
                    <button class="action-btn secondary" onclick="viewCourse(${course.id})">
                        <i class="fas fa-info-circle"></i>
                        التفاصيل
                    </button>
                </div>
            </div>
        `;
        
        coursesContainer.appendChild(courseCard);
    });
}

// متابعة الكورس
function continueCourse(courseId) {
    alert(`جاري فتح الكورس ${courseId} للدراسة...`);
    // هنا يتم التوجيه لصفحة الكورس
}

// عرض تفاصيل الكورس
function viewCourse(courseId) {
    alert(`عرض تفاصيل الكورس ${courseId}`);
    // هنا يتم التوجيه لصفحة تفاصيل الكورس
}

// تسجيل الخروج
function logout() {
    if (confirm('هل تريد تسجيل الخروج؟')) {
        localStorage.removeItem('currentUser');
        window.location.href = '../html/login.html';
    }
}

// تحديث الإحصائيات كل 30 ثانية
function updateStats() {
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    if (currentUser) {
        // محاكاة تحديث البيانات
        studentData.studyHours += 1;
        document.getElementById('studyHours').textContent = studentData.studyHours;
        
        // تحديث التقدم في الكورسات
        const progressBars = document.querySelectorAll('.progress-fill');
        progressBars.forEach(bar => {
            const currentWidth = parseInt(bar.style.width);
            if (currentWidth < 100) {
                bar.style.width = (currentWidth + 1) + '%';
            }
        });
    }
}

// تحديث البيانات كل 30 ثانية
setInterval(updateStats, 30000);

// النقر على عناصر القائمة
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        
        // إزالة النشاط من جميع العناصر
        document.querySelectorAll('.menu-item').forEach(el => {
            el.classList.remove('active');
        });
        
        // إضافة النشاط للعنصر المحدد
        this.classList.add('active');
        
        // هنا يمكن إضافة كود تحميل المحتوى المناسب
        const menuText = this.querySelector('span').textContent;
        alert(`جاري تحميل ${menuText}...`);
    });
});

// الإشعارات
document.querySelector('.notification-btn').addEventListener('click', function() {
    alert('عرض الإشعارات:\n\n1. اختبار جديد متاح\n2. رد على سؤالك في المنتدى\n3. كورس جديد متاح');
});

// عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
// التحقق من تسجيل الدخول (نسخة مخففة)
const currentUser = JSON.parse(localStorage.getItem('currentUser'));

// إذا لم يكن هناك مستخدم مسجل، أنشئ واحداً تلقائياً
if (!currentUser) {
console.log('لا يوجد مستخدم مسجل، جاري إنشاء حساب تجريبي...');

// إنشاء حساب تجريبي
const demoUser = {
    email: "student@cybereye.com",
    firstName: "محمد",
    lastName: "أحمد",
    role: "student",
    loginTime: new Date().toISOString(),
    sessionId: 'demo_session'
};

localStorage.setItem('currentUser', JSON.stringify(demoUser));
location.reload(); // إعادة تحميل الصفحة
return;
}

// التحقق من أن المستخدم طالب
if (currentUser.role !== 'student') {
alert('هذه الصفحة مخصصة للطلاب فقط!');
// يمكنك توجيهه للصفحة المناسبة
if (currentUser.role === 'instructor') {
    window.location.href = '../html/instructor-dashboard.html';
} else if (currentUser.role === '../html/admin') {
    window.location.href = '../html/admin-dashboard.html';
}
return;
}

// عرض بيانات الطالب
loadStudentData(currentUser);
// تحميل الكورسات
loadCourses();
});


function goToMyCourses(){
window.location.href="../html/mycourse.html"
}
